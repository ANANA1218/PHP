<?php
// Initialisation des variables
$firstname = '';
$lastname = '';
$email = '';
$subject = '';
$message = '';
$submissionDateFormatted = '';

// Traitement du formulaire lors de la soumission
if (isset($_POST['submit'])) {
    // Récupération des données soumises par l'utilisateur
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

 // if (empty($firstname) || empty($lastname) || empty($email) || empty($subject) || empty($message)) {
   // $error_message = 'Tous les champs sont obligatoires.';
 // } else {

    $submissionDate = new DateTime();
    $submissionDate->setTimestamp($_SERVER['REQUEST_TIME']);

    $submissionDateFormatted = $submissionDate->format('d/m/Y H:i:s');
 // }
}

?>
<?php include '_inc/functions.php'; ?>
<?php include '_inc/header.php'; ?>
<?php include '_inc/nav.php'; ?>

<main>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title">Contactez-nous</h1>
            <form method="post">
              <div class="form-group">
                <label for="firstname">Prénom :</label>
                <input type="text" name="firstname" id="firstname" class="form-control">
              </div>
              <div class="form-group">
                <label for="lastname">Nom :</label>
                <input type="text" name="lastname" id="lastname" class="form-control">
              </div>
              <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" class="form-control">
              </div>
              <div class="form-group">
                <label for="subject">Sujet :</label>
                <input type="text" name="subject" id="subject" class="form-control">
              </div>
              <div class="form-group">
                <label for="message">Message :</label>
                <textarea name="message" id="message"></textarea>
              </div>
              <br/>
              <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  //<center><?php processContactForm(); ?>  </center>
  <?php if (isset($_POST['submit']) && !empty($firstname) && !empty($lastname) && !empty($email) && !empty($subject) && !empty($message)) : ?>
  <center>
    <p>Merci <?php echo $firstname . ' ' . $lastname; ?> pour votre message :</p>
    <ul>
      <li><strong>Email :</strong> <?php echo $email; ?></li>
      <li><strong>Sujet :</strong> <?php echo $subject; ?></li>
      <li><strong>Message :</strong> <?php echo $message; ?></li>
      <li><strong>Date de soumission :</strong> <?php echo $submissionDateFormatted; ?></li>
    </ul>
  </center>
<?php endif; ?>

  <?php if (isset($error_message)) : ?>
        <center>
      <p class="error"><?php echo $error_message; ?></p>
      </center>
      <?php endif; ?>
</main>

<?php require_once('_inc/footer.php'); ?>```
