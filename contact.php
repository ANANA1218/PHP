<?php 

      require_once('_inc/header.php');
      require_once('_inc/nav.php');
     //require_once('_inc/function.php');
    
?>


<div class="container">
  <form action="action_page.php">

    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name..">

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name..">

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Your email">

    <label for="subject">Subject</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" value="Submit">

  </form>
</div>
 
  <?php 
  
       require_once('_inc/footer.php');
    
?>
  