<?php 
session_start();
      require_once('_inc/functions.php');
      require_once('_inc/header.php');
      require_once('_inc/nav.php');
    //  require_once('_inc/function.php');
    $notice = getSessionFlashMessage('notice');
?>

<?php 
  
$games = getAllGames();
$randomGames = array_rand($games, 3);
$selectedGames = array();
foreach ($randomGames as $game) {
  $selectedGames[] = $games[$game];
}

?>
<?php
  // Affichage du message de la session si celui-ci existe
  if ($notice !== null) {
    echo "<p>$notice</p>";
  }
  ?>
<br/>
<br/>
<br/>
<div class="row">
  <?php foreach ($selectedGames as $game): ?>

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
  