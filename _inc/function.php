<?php



function isLong(string $value, int $lenght):bool {
    return strlen($value) >= $lenght ? true:false;
  }
  
  function isEmail(string|null $value):bool {
    return filter_var($value, FILTER_VALIDATE_EMAIL);
  }
  

  function isValid(): bool {
    $constraints = [
      'email' => [
        'isValidate' => isEmail(getValues()['email']),
        'message' => 'L\'adresse email est invalide',
      ],
      'password' => [
        'isValidate' => isLong(getValues()['password'], 8),
        'message' => 'Le mot de passe doit contenir au moins 8 caractères',
      ],
    ];
    return checkConstraints($constraints);
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




function processCREATEForm():void
{
if (isSubmitted() && isValid()){
    createUserAccount(getValues()['email'], getValues()['password']);
}
}



function getValues():array {
    return$_POST;
      
   }

   function isSubmitted():bool {
    return isset($_POST['submit']);
      
   }
  


  function getUserByEmail(string $email): ?array {
    $pdo = connectBDD();
    $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ?: null;
  }

  function connectBDD():PDO {
  
    $connection=new PDO('mysql:host=127.0.0.1; dbname=videogames', 'root', '' ,[ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, ] );
    return $connection;
  }
  
?>
