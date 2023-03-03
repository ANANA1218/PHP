<?php




  
  function isEmails(string|null $value):bool {
    return filter_var($value, FILTER_VALIDATE_EMAIL);
  }
  




  function checkConstraints(array $constraints):bool{
    $validation = true; 
    foreach($constraints as $name => $field){
     if(!$field['isValidate']){
       $validation = false ;
     }
    }
    return $validation;
   }


  function getUserByLogin(string $login): array|bool {
    $connection = connectBDD();
    $sql = "SELECT email, password FROM user WHERE email = :login";
    $query = $connection->prepare($sql);
    $query->execute(['login' => $login]);
    return $query->fetch() ?? false;
  }

  function checkUser(string $email, string $password): bool {
    $user = getUserByLogin($email);
    if (!$user) {
      return false;
    }
    
    if (!password_verify($password,$user['password'])) {
      return false;
    }
  
return true;
  }


  function createUserAccount(string $email, string $password): void {
    $connection = connectBDD();
    $sql = 'INSERT INTO videogames.user value(null, :email, :password)';
    $query = $connection->prepare($sql);
    $query->execute([
      'email' => $email,
      'password' => password_hash($password, PASSWORD_ARGON2I),
    ]);
  }
  

  function processForm(): void {
    if (isset($_POST['submit'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];
      //if (isSubmitted() && isValid()){
      if (checkUser($email, $password)) {
        $_SESSION['user'] = $email;
        header('Location: admin/index.php');
        exit;
      } else {
        $_SESSION['notice'] = 'Identifiants incorrects';
      }
   /// }
    }
  }
  
function getSessionFlashMessages($key) {
  if (array_key_exists($key, $_SESSION)) {
    $message = $_SESSION[$key];
    unset($_SESSION[$key]);
    return $message;
  } else {
    return null;
  }
}
/*
function processForm():void
{
if (isSubmitted() && isValid()){
    if(checkUser (getValues()['email'], getValues()['password'])){
        echo 'utilisateur authetifité';
        header('Location: index.php');
        exit;
        //LE MOT DE PASSE est secret123
    }else{
        echo 'utilisateur non authetifité';
    };
}
}
*/

function isValid(): bool {
  $constraints = [
      'email' => [
          'isValid' => isEmail(getValues()['email']),
          'message' => 'L\'adresse email est invalide',
      ],
      'password' => [
          'isValid' => isLongs(getValues()['password'], 8),
          'message' => 'Le mot de passe doit contenir au moins 8 caractères',
      ],
      'title' => [
          'isValid' => isLongs(getValues()['title'], 8),
          'message' => 'Le titre doit contenir au moins 8 caractères',
      ],
      'description' => [
          'isValid' => isLongs(getValues()['description'], 10),
          'message' => 'La description doit contenir au moins 10 caractères',
      ],
      'price' => [
          'isValid' => isFloatInRange(getValues()['price'], 0.0, 999.99),
          'message' => 'Le prix doit être un nombre décimal entre 0 et 999.99',
      ],
  ];
  return checkConstraints($constraints);
}


function processCREATEForm():void
{
if (isSubmitted() && isValid()){
    createUserAccount(getValues()['email'], getValues()['password']);
}
}




   


  function connectBDD():PDO {
  
    $connection=new PDO('mysql:host=127.0.0.1; dbname=videogames', 'root', '' ,[ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, ] );
    return $connection;
  }
  


// etape 3

function getSessionData($key) {
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
  if (isset($_SESSION) && is_array($_SESSION) && array_key_exists($key, $_SESSION)) {
      return $_SESSION[$key];
  } else {
      return null;
  }
}



function checkAuthentication() {
  if (!array_key_exists('user', $_SESSION)) {
      $_SESSION['notice'] = 'Accès refusé';
      header('Location: /index.php');
      exit;
  }
}



  //admin :

  function insertData(array $values): void 
{
    $connection = connectBDD();
    $sql = 'INSERT INTO videogames.game VALUES (NULL, :title, :description, :release_date, :poster, :price)';
    $query = $connection->prepare($sql);
    $query->execute([
        'title' => $values['title'],
        'description' => $values['description'],
        'release_date' => $values['release_date'],
        'poster' => $values['poster'],
        'price' => $values['price'],
    ]);
}

/*
function updateData(array $values): void 
{
    $connection = connectBDD();
    $sql = 'UPDATE videogames.game SET game.title = :title, game.description = :description, game.release_date = :release_date, game.poster = :poster,game.price = :price, WHERE game.id = :id';
    $query = $connection->prepare($sql);
    $query->execute([
        'id' => $values['id'],
        'title' => $values['title'],
        'description' => $values['description'],
        'release_date' => $values['release_date'],
        'poster' => $values['poster'],
        'price' => $values['price'],
    ]);
}
*/

function updateData(array $values): void
{
$connection = connectBDD();
$sql = 'UPDATE videogames.game SET title = :title, description = :description, release_date = :release_date, poster = :poster, price = :price WHERE id = :id';
$query = $connection->prepare($sql);
$query->execute([
'id' => $values['id'],
'title' => $values['title'],
'description' => $values['description'],
'release_date' => $values['release_date'],
'poster' => $values['poster'],
'price' => $values['price'],
]);
}

function getValues():array {
  if(isset($GLOBALS['formData'])){
    return $GLOBALS['formData'];
   }
    return $_POST;
      
   }

function processGameFormUpdate(): void
{
    if (isSubmitted() && isValidForm()) {
       if(isset($_GET['id'])){
        updateData(getValues());
       }
      }
      else {
        insertData(getValues());
        $_SESSION['notice'] = 'Jeu vidéo modifier';
        header('Location: /admin/games/index.php');
        exit();
      } 
      /*elseif(!isSubmitted() && isset($_GET['id'] )){
        $id = $_GET['id'];
        $GLOBALS['formData']= getDataByID();
      };
    */
}

function processGameForm(): void
{
    if (isSubmitted() && isValidForm()) {
        insertData(getValues());
        $_SESSION['notice'] = 'Jeu vidéo ajouté';
        header('Location: /admin/games/index.php');
        exit();
    }
}

function deleteGame(): void
{
    $id = $_GET['id'];
    $connection = connectBDD();
    $sql = 'DELETE FROM videogames.game WHERE game.id = :id';
    $query = $connection->prepare($sql);
    $query->execute([
        'id' => $id,
    ]);
    $_SESSION['notice'] = 'Jeu vidéo supprimé';
    header('Location: /admin/games/index.php');
    exit();
}




function isSubmitted():bool {
    return isset($_POST['submit']);
      
   }
  


function isLongs(string $value, int $lenght):bool {
    return strlen($value) >= $lenght ? true:false;
  }


  function isFloatInRange(float $value, float $min, float $max): bool {
    return filter_var($value, FILTER_VALIDATE_FLOAT, [
        'options' => [
            'min_range' => $min,
            'max_range' => $max,
        ]
    ]) !== false;
}



function checkConstraintsForm(array $constraints): bool {
  $validation = true; 
  foreach($constraints as $name => $field){
      if(!array_key_exists('isValidForm', $field) || !$field['isValidForm']){
          $validation = false;
      }
  }
  return $validation;
}

function isValidForm(): bool {
  $constraints = [
  
     
      'title' => [
          'isValidForm' => isLongs(getValues()['title'], 8),
          'message' => 'Le titre doit contenir au moins 8 caractères',
      ],
      'description' => [
          'isValidForm' => isLongs(getValues()['description'], 10),
          'message' => 'La description doit contenir au moins 10 caractères',
      ],
      'price' => [
          'isValidForm' => isFloatInRange(getValues()['price'], 0.0, 999.99),
          'message' => 'Le prix doit être un nombre décimal entre 0 et 999.99',
      ],
  ];
  return checkConstraintsForm($constraints);
}




?>
