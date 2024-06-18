<?php

@include 'config.php';

session_start();

// if(!isset($_SESSION['user_name'])){
//    header('location:login_form.php');
// }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>About page</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
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
	<?php @include 'navbar.php'?>
	<h1 class="container">about page</h1>

</body>
</html>