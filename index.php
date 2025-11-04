
<?php
include ('includes/header.php');
?>
 
   <div class="py-5" style="background-image: url('./'); background-size:cover ;">
      <div class="container mt-5">
        <div class="col-md-12 py-5 text-center">
          <?php alertMessaage(); ?>
          <h1>POS SYSTEM IN PHP ,MySQL</h1>

          <?php if(!isset($_SESSION['loggedIn'])): ?>


          <a href="login.php" class="btn btn-primary mt-4">Login</a>
           <?php endif; ?>

        </div>
      </div>
   </div>
  <?php
include ('includes/footer.php');    
?>