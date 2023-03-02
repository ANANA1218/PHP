<?php

function isEmail($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isLong($string ):bool {
  return strlen($string) >= 10;
}


function isLongs(string $value, int $length):bool {
  return strlen($value) >= $length ? true : false;
}




function isSubmitted():bool {
 return isset($_POST['submit']);
   
}


function getValues():array {
  return$_POST;
    
 }
 

 function checkUser(string $email, string $password):bool {
  if (!getUserByLogin($email)){
    return false;
  }

  if (!password_verify($password,getUserByLogin($email)['password'],)){
    return false;
  }
    return true;
 }
 

 function getUserByLogin(string $login):array|bool {
  $connection = connectDB();
  $sql = "SELECT email, password FROM user WHERE email = :login";
  $query = $connection->prepare($sql);
  $query->execute(['login' => $login]);
 
  return $query->fetch() ?? false;
}

function createUserAccount(string $email, string $password): void {
  $connection = connectDB();
  $sql = 'INSERT INTO videogames.user value(null, :email, :password)';
  $query = $connection->prepare($sql);
  $query->execute([
    'email' => $email,
    'password' => password_hash($password, PASSWORD_ARGON2I),
  ]);
}




function processContactForm() {
  if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $errors = array();

    // Contrainte de validation pour le sujet 
    if (empty($subject)) {
      $errors[] = "Le champ sujet est obligatoire.";
    } elseif (!isLong($subject)) {
      $errors[] = "Le sujet doit comporter au moins 10 caractères.";
    }

    // Contrainte de validation pour le message
    if (empty($message)) {
      $errors[] = "Le champ message est obligatoire.";
    } elseif (!isLong($message)) {
      $errors[] = "Le message doit comporter au moins 10 caractères.";
    }

    // Contrainte de validation pour l'email 
    if (!isEmail($email)) {
      $errors[] = "L'adresse email n'est pas valide.";
    }

    if (empty($errors) && !empty($subject) && !empty($message) && isLong($subject) && isLong($message)) {
      $submissionDate = new DateTime();
      $submissionDate->setTimestamp($_SERVER['REQUEST_TIME']);

      $submissionDateFormatted = $submissionDate->format('d/m/Y H:i:s');

      // Ajout de la notice dans la session
      $_SESSION['notice'] = "Vous serez contacté dans les plus brefs délais.";

      header('Location: index.php');
      exit;
      
    } else {
      echo "<ul>";
      foreach ($errors as $error) {
        if (!empty($error)) {
          echo "<li>$error</li>";
        }
      }
      echo "</ul>";
    }
  }
}

function connectDB():PDO {
  
  $connection=new PDO('mysql:host=127.0.0.1; dbname=videogames', 'root', '' ,[ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, ] );
  return $connection;
}

function getThreeRandomGames($number) {
  $connection = connectDB();
  $stmt = $connection->prepare('SELECT * FROM game ORDER BY RAND() LIMIT :number');
  $stmt->bindParam(':number', $number, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetchAll();
}

function getAllGames() {
  $pdo = connectDB();
  $query = "SELECT * FROM game";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $games = $stmt->fetchAll();
  return $games;
}

function getGameById($id) {
  $pdo = connectDB();
  $query = "SELECT * FROM game WHERE id = :id";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $game = $stmt->fetch();
  return $game;
}

function validateLoginForm(array $data): array {
  $errors = [];
  
  // Vérification de l'email
  if (empty($data['email'])) {
    $errors[] = "L'email est obligatoire";
  } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "L'email n'est pas valide";
  }

  // Vérification du mot de passe
  if (empty($data['password'])) {
    $errors[] = "Le mot de passe est obligatoire";
  }
  
  return $errors;
}


function getUserByEmail($email) {
  $connection = connectDB();
  $sql = "SELECT * FROM user WHERE email = :email";
  $query = $connection->prepare($sql);
  $query->execute(['email' => $email]);
  $user = $query->fetch(PDO::FETCH_ASSOC);
  return $user;
}

function verifyAdminCredentials(string $email, string $password): mixed {
  $user = getUserByEmail($email);
  if ($user && password_verify($password, $user['password'])) {
    return $user;
  } else {
    return false;
  }
}


function processLoginForm() {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Vérification des contraintes de validation du formulaire
      $errors = [];

      // Vérification de l'existence de l'utilisateur
      $email = $_POST['email'];
      $password = $_POST['password'];
      $user = getUserByEmail($email);

      if ($user !== false) {
          // Vérification du mot de passe
          if (password_verify($password, $user['password'])) {
              // L'utilisateur est authentifié, on redirige vers la page d'accueil
              header('Location: index.php');
              exit;
          } else {
              $errors[] = 'Identifiant ou mot de passe incorrect';
          }
      } else {
          $errors[] = 'Identifiant ou mot de passe incorrect';
      }

      if (count($errors) > 0) {
          // Affichage des erreurs
          echo '<div class="error">';
          echo '<ul>';
          foreach ($errors as $error) {
              echo '<li>' . $error . '</li>';
          }
          echo '</ul>';
          echo '</div>';
      }
  }
}







?>
