<?php
session_start();
require_once('../../_inc/functions.php');
require_once('../../_inc/function.php');
require_once('../../_inc/header.php');
require_once('../../admin/_inc/nav.php');
$games = getAllGames();
?>

<center>
  <?php 
    // Test de la connexion avec les informations d'identification "johndoe@example.com" et "secret123"
    checkAuthentication();
  ?>
</center>

<div class="container">
  <h1>Liste des jeux vidéo</h1>
  <ul class="list-group">
    <?php foreach ($games as $game): ?>
      <li class="list-group-item">
        <div class="row">
          <div class="col-md-2">
            <img src="<?= $game['poster'] ?>" alt="<?= $game['title'] ?>" class="img-fluid">
          </div>
          <div class="col-md-10">
            <h2><?= $game['title'] ?></h2>
            <p>Prix : <?= $game['price'] ?> €</p>
            <p>Date de sortie : <?= date('d/m/Y', strtotime($game['release_date'])) ?></p>
            <div class="btn-group">
              <a href="#" class="btn btn-primary">Modifier</a>
              <a href="#" class="btn btn-danger">Supprimer</a>
            </div>
          </div>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php
require_once('../../_inc/footer.php');
?>
