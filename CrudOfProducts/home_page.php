<?php
include 'inc/users.php';

open_file_products();

if (!(isset($_SESSION['user']))){
  header('Location: http://localhost/CrudOfProducts/login.php');
}

if (isset($_POST['logout']) || isset($_POST['account'])){
  if ($_POST['account']){

    $getData = get_data_of_users();
    $getProducts = $_SESSION['user'].'.json';

    delete_data_of_user($getData, $getProducts);
  }

  session_destroy();
  header('Location: http://localhost/CrudOfProducts/login.php');
}

$dataOfProducts = get_data_of_products();

if (isset($_POST['id'])){
  
  $deleteID = $_POST['id'];
  $deleted = deleteProducts($deleteID, $dataOfProducts);
  $dataOfProducts = get_data_of_products();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Welcome Page</title>
</head>
<body>

<div class="col-md-3">
        <button class="btn btn-primary btn-block" onclick="toggleCRUD()">Settings your data</button>
        <div id="crudOperations" class="list-group" style = "display: none;">
          <a href="updatePage.php" class="list-group-item list-group-item-action">Update Your Data</a>
          <form action="home_page.php" method="post">
            <input type="hidden" name="account" value="<?php echo $_SESSION['user'] ?? 'no data specified'; ?>">
            <button type="submit" class="list-group-item list-group-item-action" onclick="return confirm('Are you sure you want to delete your account?');">Delete Your Data</button>
          </form>
        </div>
</div>

<div class="text-right mb-3">
  <form action="home_page.php" method = 'post'>
    <button class="btn btn-warning" name = 'logout' class="list-group-item list-group-item-action" onclick="return confirm('Are you sure you want to logout from this website?');" >Logout</a>
  </form>
</div>

<div class="container mt-5">
  <h1 class="text-center mb-4">Welcome <?php echo $_SESSION['user'] ?> to Your Store!</h1>
  
  <!-- Add Product Button above the table -->
  
  <td>
    <div class="text-center mb-3">
      <a href="addProducts.php" class="btn btn-success btn-sm" role="button">Add Products</a>
    </div>
  </td>


<!-- Table and form modifications -->
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col" colspan = "2" style = "padding-left: 120px;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php if(isset($dataOfProducts)):?>
      <?php foreach ($dataOfProducts as $data): ?>
<tr>
  <td><?php echo $data['id'];  ?></td>
  <td><?php echo $data['name'];?></td>
  <td><?php echo $data['quantity']; ?></td>
  <td><?php echo $data['price']; ?></td>
  
  <td>
    <form action="updateProducts.php" method="post">
      <input type="hidden" name="id" value="<?php echo $data['id'] ?? 'no data specified'; ?>">
      <button type="submit" class="btn btn-secondary btn-sm">Update</button>
    </form>
  </td>
  <td>
    <form action="home_page.php" method="post">
      <input type="hidden" name="id" value="<?php echo $data['id'] ?? 'no data specified'; ?>">
      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
    </form>
  </td>
</tr>
<?php endforeach; ?>
<?php endif;?>
  </tbody>
</table>
<br>
  <?php if(isset($deleted) && $deleted): ?>
  <div class="alert alert-success" role="alert">
    <p><?php echo "this item deleted succefully"; ?></p>
  </div>
<?php endif; ?>

<script>
    function toggleCRUD() {
      let x = document.getElementById("crudOperations");
      x.style.display === "none" ? x.style.display = "block" : x.style.display = "none";
    }
  </script>

</body>
</html>
