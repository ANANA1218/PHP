<?php 
//require_once('_inc/functions.php');
require_once('_inc/function.php');
require_once('_inc/header.php');
require_once('_inc/nav.php');
?>

<main>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title">Login</h1>
            <form method="post">
              <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>
              <br/>
              <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <center>
  <?php 
    // Test de la connexion avec les informations d'identification "johndoe@example.com" et "secret123"

    processForm();
  ?>
</center>
</main>

<?php require_once('_inc/footer.php'); ?>
