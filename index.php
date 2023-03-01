<?php 
      require_once('_inc/functions.php');
      require_once('_inc/header.php');
      require_once('_inc/nav.php');
    //  require_once('_inc/function.php');
?>

<?php 
  
$games = getAllGames();
$randomGames = array_rand($games, 3);
$selectedGames = array();
foreach ($randomGames as $game) {
  $selectedGames[] = $games[$game];
}

?>
 
  <div class="row">
  <?php foreach ($selectedGames as $game): ?>
    <div class="col-md-4">
      <h2><?= $game['title'] ?></h2>
      <img src="<?= $game['poster'] ?>" alt="<?= $game['title'] ?>" width="200">
      <p>Prix : <?= $game['price'] ?> €</p>
      <a href="game.php?id=<?= $game['id'] ?>" class="btn btn-primary">Consulter</a>
    </div>
  <?php endforeach ?>
</div>


  <?php 
  
       require_once('_inc/footer.php');
    
?>
  