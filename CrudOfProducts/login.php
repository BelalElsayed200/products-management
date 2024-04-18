<?php
include 'inc/users.php';

if (isset($_SESSION['user'])){
  header('Location: http://localhost/CrudOfProducts/home_page.php');
}



if (isset($_POST['loginWithEmail'], $_POST['loginPass'])){

    $email = $_POST['loginWithEmail'];
    $password = $_POST['loginPass'];

    $existData = validate_login($email, $password);

    if ($existData){
        header('Location: http://localhost/CrudOfProducts/home_page.php');
    }
}

?>

<?php include 'html/header.php'; ?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-body">
          <h2 class="text-center">Login Form</h2>
            <form method = 'post' method = 'login.php'>
              <?php if (isset($existData) && !$existData): ?>
                  <div class='alert alert-danger' role='alert'>
                      Username or password is incorrect
                  </div>
              <?php endif; ?>
              <div class="form-group">
                <label for="inputEmail">Email address</label>
                <input type="email" name= 'loginWithEmail' class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
              </div>
              <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" name = 'loginPass' class="form-control" id="inputPassword" placeholder="Password">
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
              <!-- Message for registration -->
              <p class="mt-4">Don't have an account? <a href="http://localhost/CrudOfProducts/register.php">Register here</a></p>
              <br>
              <p><a href="http://localhost/CrudOfProducts/remainderYourData.php">Do you forget your password?</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'html/footer.php'; ?>
