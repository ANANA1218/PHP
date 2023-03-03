<?php
session_start();
require_once('../../_inc/functions.php');
require_once('../../_inc/function.php');
require_once('../../_inc/header.php');
require_once('../../admin/_inc/nav.php');

?>

<center>
  <?php 
    // Test de la connexion avec les informations d'identification "johndoe@example.com" et "secret123"
    checkAuthentication();
  ?>
</center>

<main>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title">Modification du Jeux</h1>
            <form method="post">
              <div class="form-group">
                <label for="id"> Id :</label>
                <input type="hidden" id="id" name="id">
              </div>
              <div class="form-group">
                <label for="title">Title :</label>
                <input type="text" name="title" id="title" class="form-control">
              </div>
              <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" id="description"></textarea>
              </div>
              <div class="form-group">
                <label for="release_date">release_date :</label>
                <input type="date" id="release_date" name="release_date">
              </div>
              <div class="form-group">
                <label for="title">Poster :</label>
                <input type="text" name="poster" id="poster" class="form-control">
              </div>
              <div class="form-group">
                <label for="title">Price :</label>
                <input type="text" name="price" id="price" class="form-control">
              </div>
              <br/>
              <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
</main>
<?php
require_once('../../_inc/footer.php');
?>
