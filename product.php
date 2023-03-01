<?php 

echo '<pre>'; var_dump($_GET); echo '</pre>';
      require_once('_inc/header.php');
      require_once('_inc/nav.php');
     // require_once('_inc/function.php');

[
    'id' => $id,
    'message' => $message,
  
] = $_GET;

?>


  <h1> Product</h1>
 
  <?php 
  
       require_once('_inc/footer.php');
    
?>
  