<?php
session_start();
require_once('../_inc/header.php');
require_once('../_inc/function.php');
require_once('../_inc/functions.php');
require_once('_inc/nav.php');
?>

<!-- Ajoutez ici le contenu de la page d'accueil de l'espace d'administration -->
<center>
  <?php 
    // Test de la connexion avec les informations d'identification "johndoe@example.com" et "secret123"
    checkAuthentication();
  ?>
</center>
<h1>Bienvenue dans l'espace d'administration</h1>
<p>Vous pouvez gérer les jeux depuis la page <a href="games/index.php">Jeux</a></p>

<?php
require_once('../_inc/footer.php');
?>
