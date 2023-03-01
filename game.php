<?php 
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
  
echo "<h1>".$game['title']."</h1>";
echo "<img src='".$game['poster']."'>";
echo "<p>Prix : ".$game['price']." €</p>";
echo "<p>Description : ".$game['description']."</p>";
echo "<p>Date de realisation : ".$game['release_date']."</p>";
?>

<?php 
  
  require_once('_inc/footer.php');

?>
