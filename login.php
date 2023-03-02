<?php 
      require_once('_inc/functions.php');
      require_once('_inc/header.php');
      require_once('_inc/nav.php');
    //  require_once('_inc/function.php');
?>


	<main>
		
		
		<?php processLoginForm(); ?>
		<form method="POST" action="">
			<label for="email">Email :</label>
			<input type="email" name="email" id="email" required>
			<label for="password">Mot de passe :</label>
			<input type="password" name="password" id="password" required>
			<input type="submit" value="Se connecter">
		</form>
	</main>

<?php 
  
  require_once('_inc/footer.php');

?>

