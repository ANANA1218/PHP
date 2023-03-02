<?php 
session_start();
      require_once('_inc/functions.php');
      require_once('_inc/header.php');
      require_once('_inc/nav.php');
    //  require_once('_inc/function.php');
    $allGames = getAllGames();
?>
<br/>
<br/>
<br/>
<div class="row">
  <?php foreach ($allGames as $game): ?>

    <div class="col-sm-4 mb-3">
      <div class="card h-100">
      <img class="card-img-top" src="<?= $game['poster'] ?>" alt="<?= $game['title'] ?>" style="height: 15rem; object-fit: cover;">
        <div class="card-body">
        <h5 class="card-title"><?= $game['title'] ?></h5>
          <p class="card-text">Prix : <?= $game['price'] ?> €</p>
          <a href="game.php?id=<?= $game['id'] ?>" cclass="btn btn-primary">Consulter</a>
        </div>
      </div>
    </div>

  <?php endforeach ?>
</div>

<br/>
<br/>
<br/>

<?php 
  
  require_once('_inc/footer.php');

?>

