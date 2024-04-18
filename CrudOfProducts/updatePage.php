<?php
include 'inc/users.php';

if (!($_SESSION['user'])){
  header('location: http://localhost/CrudOfProducts/login.php');
}

$dataOfUsers = get_data_of_users();
foreach($dataOfUsers as $data){
  if ($_SESSION['user'] == $data['fullName']){
    $name = $data['fullName'];
    $email = $data['emailAddress'];
    $password = $data['password'];
  }
}

if (isset($_POST['username'], $_POST['email'], $_POST['password'])){
  $name = $_POST['username'];
  $em = $_POST['email'];
  $pass = $_POST['password'];

  $isNameValid = fullNameValidation($name);
  $isEmailValid = email_validation($em);
  $isPassValid = passValidation($pass);

  if ($isNameValid && $isEmailValid && $isPassValid){
    updateData($name, $em, $pass);
  }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Update Product</title>
</head>
<body>

<div class="container mt-5">
  <h2 class="mb-4">Update your data</h2>
  <form action="updatePage.php" method="post">
    <?php if (isset($isNameValid) && !$isNameValid):?>
      <div class='alert alert-danger' role='alert'>
        fullName must be its length between 4 and 30 and must not contain two space consecutive 
        and start with three characters not numbers and do not use 
        following {! @ # $ % ^ & * ( ) - _ = + \ | [ ] { } ; : / ? . >}.
      </div>

    <?php elseif(isset($isEmailValid) && !$isEmailValid) :?>
      <div class ='alert alert-danger' role='alert'>
        this email is not valid, must be its length between 4 and 30 and start with first three characters not numbers.
      </div>

    <?php elseif(isset($isPassValid) && !$isPassValid) :?>
      <div class ='alert alert-danger' role='alert'>
        length of password must be from 12 to 50 and contain characters, numbers and special characters.
      </div>

    <?php endif; ?>
    <div class="form-group">
      <label for="productName">userName</label>
      <input type="text" class="form-control" id="productName" name="username" required value = "<?php echo $name ?? '' ?>">
    </div>
    <div class="form-group">
      <label for="productQuantity">Email</label>
      <input type="email" class="form-control" id="productQuantity" name="email" required value = "<?php echo $email ?? '' ?>">
    </div>
    <div class="form-group">
      <label for="productPrice">Password</label>
      <input type="password" class="form-control" id="productPrice" name="password" required value = "<?php echo $password ?? '' ?>">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
