<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
      require_once('_inc/functions.php');
      require_once('_inc/header.php');
      require_once('_inc/nav.php');
    //  require_once('_inc/function.php');
?>

<?php 
   if (isset($_GET['id'])) {
    $gameId = $_GET['id'];
    $game = getGameById($gameId);
  }
  
?>
<br/>
<br/>
<br/>

<div class="card">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="<?= $game['poster'] ?>" class="card-img" alt="<?= $game['title'] ?>">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title"><?= $game['title'] ?></h1>
        <p class="card-text"><?= $game['description'] ?></p>
        <p class="card-text"><small class="text-muted">Date de sortie : <?= date('d/m/Y', strtotime($game['release_date'])) ?></small></p>
        <p class="card-text"><small class="text-muted">Prix : <?= $game['price'] ?> €</small></p>
      </div>
    </div>
  </div>
</div>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<?php 
  
  require_once('_inc/footer.php');

?>
