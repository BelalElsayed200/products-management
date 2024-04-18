<?php
include 'inc/users.php';

if (!(isset($_SESSION['user']))){
  header('location: http://localhost/CrudOfProducts/home_page.php');
}

if (isset($_POST['productId'], $_POST['productName'], $_POST['productQuantity'], $_POST['productPrice'])){

  $id = $_POST['productId'];
  $name = $_POST['productName'];
  $quantity = $_POST['productQuantity'];
  $price = $_POST['productPrice'];

  $nameValidation = is_numeric($name);

  if (!$nameValidation){

    $arrOfProducts = [
      'id' => $id,
      'name' => $name,
      'quantity' => $quantity,
      'price' => $price
    ];
  
    $isIdProdValid = is_id_valid($arrOfProducts['id'], $arrOfProducts['name']);
    
    if ($isIdProdValid){
      $addedProducts = addProducts($arrOfProducts);
      header('location: http://localhost/CrudOfProducts/home_page.php');
    }
  }
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Add Product</title>
</head>
<body>

<div class="container mt-5">
  <h2 class="mb-4">Add New Product</h2>
  <?php if (isset($isIdProdValid) && !($isIdProdValid)):?>
        <div class='alert alert-danger' role='alert'>
            ID or NAME is repeated before, try another ID or NAME.
        </div>
  <?php endif; ?>

  <form action="addProducts.php" method="post">
      <div class="form-group">
        <label for="productId">Product ID</label>
        <input type="number" class="form-control" id="productId" name="productId" required min = "1">
      </div>
      <?php if(isset($nameValidation) && $nameValidation) :?>
        <div class='alert alert-danger' role='alert'>
            write product name correctly.
        </div>
      <?php endif; ?>
      <div class="form-group">
        <label for="productName">Product Name</label>
        <input type="text" class="form-control" id="productName" name="productName" required>
      </div>
      <div class="form-group">
        <label for="productQuantity">Product Quantity</label>
        <input type="number" class="form-control" id="productQuantity" name="productQuantity" required min = "1">
      </div>
      <div class="form-group">
        <label for="productPrice">Product Price</label>
        <input type="number" class="form-control" id="productPrice" name="productPrice" required min = "1">
      </div>
      <button type="submit" class="btn btn-primary">Add Product</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
