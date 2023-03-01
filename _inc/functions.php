<?php

function isEmail($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isLong($string) {
  return strlen($string) >= 10;
}

function processContactForm() {
  if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $errors = array();

    //Contrainte de validation pour le sujet 
    if (!isLong($subject)) {
      $errors[] = "Le sujet doit comporter au moins 10 caractères.";
    }

    //Contrainte de validation pour le message
    if (!isLong($message)) {
      $errors[] = "Le message doit comporter au moins 10 caractères.";
    }

    //Contrainte de validation pour l'email 
    if (!isEmail($email)) {
      $errors[] = "L'adresse email n'est pas valide.";
    }

    // Vérifier s'il y a des erreurs avant d'afficher les informations de soumission
    if (empty($errors)) {
     var_dump($errors);
    } else {
      // Afficher les erreurs de validation
      echo "<ul>";
      foreach ($errors as $error) {
        echo "<li>$error</li>";
      }
      echo "</ul>";
    }
  }
}


function connectDB() {
  $servername = "localhost";
  $username = "your_username";
  $password = "your_password";
  $dbname = "videogames";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  return $conn;
}
?>
