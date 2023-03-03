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
  <div class="btn-group">
   <a href="/admin/games/form.php" class="btn btn-primary">ajouter un jeu</a>           
  </div>
  <br/>
  <br/>
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
            <a href="/admin/games/form.php?id=<?php echo $game['id']; ?>" class="btn btn-primary">Modifier</a>
            <a href="delete.php?id=<?php echo $game['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce jeu ?')">
    Supprimer
  </a>
            </div>
          </div>
        </div>
      </li>
    <?php endforeach; ?>
    <center>

    <?php $notice = getSessionFlashMessage('notice'); ?>
    <?php if ($notice) : ?>
    <p><?= $notice ?></p>
     <?php endif; ?>

   </center>
  </ul>
</div>

<?php
require_once('../../_inc/footer.php');
?>
