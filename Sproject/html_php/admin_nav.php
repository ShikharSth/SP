<?php

// @include 'config.php';

session_start();

// if(!isset($_SESSION['customer_name'])){
//    header('location:login_form.php');
// }

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
    <script src="https://kit.fontawesome.com/076ac70285.js" crossorigin="anonymous"></script>
	<style type="text/css">
		*{
			font-family: 'Poppins', sans-serif; 
			margin:0; 
			padding:0; 
			box-sizing: border-box;
			outline: none;
			border :none;
			text-decoration: none;
		}
	</style>
</head>
<body>
	<nav class="ad-navbar navbar-expand-lg navbar-dark bg-dark">
	  	<div class="container-fluid">
	    	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        		<li class="nav-item">
			        	<h2>Hi, Admin</h2> 
			        </li>
	    		</ul>

	      		<ul class="navbar-nav d-flex flex-row-reverse">
			        
				      <li class="nav-item">
				       	<a  class="nav-link-btn" aria-current="page" href="logout_admin.php" ><i class="fa-solid fa-right-from-bracket"></i></a>
				      </li>
				      <li class="nav-item">
				        	<h3>welcome <span><?php echo $_SESSION['admin_name'] ?></span></h3> 
				      </li>
	      		</ul>
	    	</div>
	  	</div>
	</nav>
</body>
</html>