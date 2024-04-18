<?php
  include 'inc/users.php';

  if (isset($_POST['newPassword'], $_POST['confirmPassword'])){
    $newPass = $_POST['newPassword']; 
    $conPass = $_POST['confirmPassword'];
    $passValidation = passValidation($newPass);

    if ($newPass == $conPass && $passValidation){
      reset_password($newPass);

      session_destroy();
      header('Location: http://localhost/CrudOfProducts/login.php');
    }
  }


  include 'html/header.php';
?>
    <div class="container mt-5">
        <h1 class="mb-4">Update Password</h1>
        <form action="resetPassword.php" method="post">
          <?php if (isset($passValidation) && !($passValidation)):?>
            <div class='alert alert-danger' role='alert'>
                length of password must be from 12 to 50 and contain characters, numbers and special characters.
            </div>
          <?php elseif (isset($conPass) && ($conPass != $newPass) && $passValidation):?>
            <div class='alert alert-danger' role='alert'>
              confirmation password is incorrect.
            </div>
          <?php endif; ?>
            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password:</label>
                <input type="password" id="newPassword" name="newPassword" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>
<?php
  include 'html/footer.php';
?>
