<?php 
  include 'inc/users.php';

  if (isset($_POST['email'])){
    $email = $_POST['email'];
    $emailValidation = is_email_valid($email);

    if ($emailValidation){

      $_SESSION['user'] = $email;

      header('location: http://localhost/CrudOfProducts/resetPassword.php');
    }
  }




  include 'html/header.php';
?>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h1 class="text-center">Request Password Reset</h1>
      <form action="remainderYourData.php" method="post">
        <?php if (isset($emailValidation) && !$emailValidation):?>
          <div class='alert alert-danger' role='alert'>
            this data is wrong, try another email.
          </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
        </div>
        <button type="submit" class="btn btn-primary">Request Password Reset</button>
      </form>
    </div>
  </div>
</div>

<?php
  include 'html/footer.php';
?>