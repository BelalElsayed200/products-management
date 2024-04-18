<?php
include 'inc/users.php';

if (!$_SESSION['user']){
  header('location: http://localhost/CrudOfProducts/login.php');
}

$id = $_POST['id'];

$dataOfProducts = get_data_of_products();

if (isset($id)){
  
  foreach($dataOfProducts as $data){
    if ($id == $data['id']){
      $name = $data['name'];
      $quantity = $data['quantity'];
      $price = $data['price'];
    }
  }
}
if (isset($_POST['productName'], $_POST['productQuantity'], $_POST['productPrice'])){
  $nameOfProduct = $_POST['productName'];
  $nameValidation = !is_numeric($nameOfProduct);

  if ($nameValidation){
    updateProducts($id, $nameOfProduct, $_POST['productQuantity'], $_POST['productPrice']);
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
  <h2 class="mb-4">Update Product Details</h2>
  <form action="updateProducts.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?? '' ?>">
    <?php if (isset($nameValidation) && !($nameValidation)):?>
          <div class='alert alert-danger' role='alert'>
            write product name correctly.
          </div>
    <?php endif; ?>
    <div class="form-group">
      <label for="productName">Product Name</label>
      <input type="text" class="form-control" id="productName" name="productName" required value = "<?php echo $name ?? '' ?>">
    </div>
    <div class="form-group">
      <label for="productQuantity">Product Quantity</label>
      <input type="number" min = "1" class="form-control" id="productQuantity" name="productQuantity" required value = "<?php echo $quantity ?? '' ?>">
    </div>
    <div class="form-group">
      <label for="productPrice">Product Price</label>
      <input type="number" min = "1" class="form-control" id="productPrice" name="productPrice" required value = "<?php echo $price ?? '' ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update Product</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
