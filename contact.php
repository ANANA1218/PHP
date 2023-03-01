<?php
if (isset($_POST['submit'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  $submissionDate = new DateTime();
  $submissionDate->setTimestamp($_SERVER['REQUEST_TIME']);

  $submissionDateFormatted = $submissionDate->format('d/m/Y H:i:s');
}
?>
<?php include '_inc/functions.php'; ?>
<?php include '_inc/header.php'; ?>
<?php include '_inc/nav.php'; ?>

<main>
  <h1>Contactez-nous</h1>

  <?php if (isset($_POST['submit'])) : ?>
    <p>Merci <?php echo $firstname . ' ' . $lastname; ?> pour votre message :</p>
    <ul>
      <li><strong>Email :</strong> <?php echo $email; ?></li>
      <li><strong>Sujet :</strong> <?php echo $subject; ?></li>
      <li><strong>Message :</strong> <?php echo $message; ?></li>
      <li><strong>Date de soumission :</strong> <?php echo $submissionDateFormatted; ?></li>
    </ul>
  <?php endif; ?>

  <main>
  
  <?php processContactForm(); ?>
 <center>
  <form method="post">
   
    <br/>
    <div class="form-group">
    <label for="firstname">Prénom :</label>
    <input type="text" name="firstname" id="firstname">
  </div>

  <br/>
    <div class="form-group">
    <label for="lastname">Nom :</label>
    <input type="text" name="lastname" id="lastname">
  </div>
  <br/>
    <div class="form-group">
    <label for="email">Email :</label>
    <input type="email" name="email" id="email">
  </div>

  <br/>
    <div class="form-group">
    <label for="subject">Sujet :</label>
    <input type="text" name="subject" id="subject">
  </div>


  <div class="form-group">
  <label for="message">Message :</label>
    <textarea name="message" id="message"></textarea>
  </div>

   <br/>
    <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>

  </form>  
</center>
</main>

 
  <?php 
  
       require_once('_inc/footer.php');
    
?>
  