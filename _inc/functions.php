<?php

function isEmail($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isLong($string) {
  return strlen($string) >= 10;
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

    if (empty($errors)) {
      $submissionDate = new DateTime();
      $submissionDate->setTimestamp($_SERVER['REQUEST_TIME']);

      $submissionDateFormatted = $submissionDate->format('d/m/Y H:i:s');

      echo "<p>Merci $firstname $lastname pour votre message :</p>";
      echo "<ul>";
      echo "<li><strong>Email :</strong> $email</li>";
      echo "<li><strong>Sujet :</strong> $subject</li>";
      echo "<li><strong>Message :</strong> $message</li>";
      echo "<li><strong>Date de soumission :</strong> $submissionDateFormatted</li>";
      echo "</ul>";
    } else {
      echo "<ul>";
      foreach ($errors as $error) {
        echo "<li>$error</li>";
      }
      echo "</ul>";
    }
  }
}

?>
