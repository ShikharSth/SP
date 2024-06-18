<?php

// @include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:logout_admin.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin page</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<!-- <style type="text/css">
		*{
			font-family: 'Poppins', sans-serif; 
			margin:0; 
			padding:0; 
			box-sizing: border-box;
			outline: none;
			border :none;
			text-decoration: none;
		}
	</style> -->
	<style type="text/css">
		.add_item{
			text-decoration: none;
			color: white;
			border: 1px;
			border-radius: 8px;
			background: crimson;
			padding: 5px 8px;
		}
		.card-img-top{
			height: 300px;
		}

		
	</style>
</head>
<body>
	<?php @include 'admin_nav.php'?>
	<div style=" display: flex;">

		<div class="card" style="width: 18rem; margin: 5px;">
	  		<img src="../image/add_item.png" class="card-img-top" alt="...">
	  		<div class="card-body d-flex justify-content-center">
	    		<a href="add_products.php" class="add_item">Add Items</a>
	  		</div>
		</div>

		<div class="card" style="width: 18rem; margin: 5px;">
	  		<img src="../image/con.png" class="card-img-top" alt="...">
	  		<div class="card-body d-flex justify-content-center">
	    		<a href="view_contact.php" class="add_item">View Contact</a>
	  		</div>
		</div>

		<div class="card" style="width: 18rem; margin: 5px;">
	  		<img src="../image/view_item.webp" class="card-img-top" alt="...">
	  		<div class="card-body d-flex justify-content-center">
	    		<a href="view_product.php" class="add_item">View Items</a>
	  		</div>
		</div>

		<div class="card" style="width: 18rem; margin: 5px;">
	  		<img src="../image/user.jpeg" class="card-img-top" alt="...">
	  		<div class="card-body d-flex justify-content-center">
	    		<a href="view_user.php" class="add_item">View Customers</a>
	  		</div>
		</div>

		<div class="card" style="width: 18rem; margin: 5px;">
	  		<img src="../image/ord.jpeg" class="card-img-top" alt="...">
	  		<div class="card-body d-flex justify-content-center">
	    		<a href="view_order.php" class="add_item">View Orders</a>
	  		</div>
		</div>

	</div>
	<!-- <div class="admin-body">
		<a href="add_products.php">Add Items</a>
		<a href="add_category.php">Add Category</a>
		<a href="view_product.php">View Items</a>
		<a href="view_user.php">View Customers</a>
		<a href="view_order.php">View Orders</a>
		
	</div> -->

</body>
</html>