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
	<title>Home page</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<style type="text/css">
		* {
			font-family: 'Poppins', sans-serif; 
			margin: 0; 
			padding: 0; 
			box-sizing: border-box;
			outline: none;
			border: none;
			text-decoration: none;
		}
		body {
			background-image: url('../image/pxfuel.jpg');
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			background-attachment: fixed;
			color: #333;
			overflow-x: hidden;
		}
		.home_body {
			width: 90%;
			max-width: 1200px;
			margin: 20px auto;
			padding: 20px;
			background: rgba(255, 255, 255, 0.8);
			border-radius: 10px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}
		.row {
			display: flex;
			width: 100%;
			height: 400px;
			margin: 20px 0;
			flex-wrap: wrap; /* To handle small screens */
		}
		.txt_one, .txt_two {
			flex: 1 1 70%;
			background: rgba(255, 255, 255, 0.6);
			backdrop-filter: blur(5px);
			padding: 20px;
			border-radius: 10px;
			display: flex;
			flex-direction: column;
			justify-content: center;
		}
		.img_one, .img_two {
			flex: 1 1 30%;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 10px;
		}
		.img_one_img, .img_two_img {
			width: 80%;
			height: 400px;
			object-fit: cover;
			border-radius: 10px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		}
		p {
			font-size: 18px;
			line-height: 1.6;
			text-align: justify;
			color: #333;
		}
		.home_body a {
			align-self: flex-start;
/*			border: 1px solid crimson;*/
			border-radius: 5px;
			background: black;
			color: white; /* Ensuring text color is white */
			padding: 10px 20px;
			font-size: 16px;
			margin-top: 10px;
			transition: all 0.3s ease;
			text-decoration: none;
		}
		.home_body a:hover {
			background: crimson;
			color: white; /* Ensuring text color remains white on hover */
			transform: translateY(-2px);
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		}.home_body a {
			align-self: flex-start;
			border: 1px solid crimson;
			border-radius: 5px;
			background: black;
			color: white; /* Ensuring text color is white */
			padding: 10px 20px;
			font-size: 16px;
			margin-top: 10px;
			transition: all 0.3s ease;
		}
		.home_body a:hover {
			background: crimson;
			color: white; /* Ensuring text color remains white on hover */
			transform: translateY(-2px);
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		}
		@media (max-width: 768px) {
			.txt_one, .txt_two {
				flex: 1 1 100%;
				margin-bottom: 20px;
			}
			.img_one, .img_two {
				flex: 1 1 100%;
			}
			.img_one_img, .img_two_img {
				height: 400px; /* Allow images to scale with width */
			}
		}
	</style>
</head>
<body>
	<?php @include 'navbar.php'?>
	<center>
		<div class="home_body">
			<div class="row">
	            <div class="txt_one"> 
	            	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	            	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	            	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	            	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	            	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	            	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	            	<a href="book.php">Buy Now</a>
	        	</div>
	            <div class="img_one">
	            	<img class="img_one_img" src="../image/ugly_love.jpeg">
	            </div>
	        </div>
	        <div class="row"> 
	            <div class="img_two">
	            	<img class="img_two_img" src="../image/classmate_notebook.webp">
	            </div>
	            <div class="txt_two"> 
	            	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	            	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	            	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	            	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	            	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	            	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	            	<a href="copy.php">Buy Now</a>
	            </div>
	        </div>
	        <div class="row">
	            <div class="txt_one"> 
	            	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	            	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	            	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	            	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	            	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	            	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	            	<a href="pen.php">Buy Now</a>
	        	</div>
	            <div class="img_one">
	            	<img class="img_one_img" src="../image/TECHNO TIP_59d44d12a07d8.png">
	            </div>
	        </div>
		</div>
	</center>
</body>
</html>
