<?php

function isEmail($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isLong($string ):bool {
  return strlen($string) >= 10;
}




function getSessionFlashMessage($key) {
  if (array_key_exists($key, $_SESSION)) {
    $message = $_SESSION[$key];
    unset($_SESSION[$key]);
    return $message;
  } else {
    return null;
  }
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



?>
