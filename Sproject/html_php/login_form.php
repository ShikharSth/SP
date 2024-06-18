
<?php 
session_start();
$message="";
if (isset($_POST['submit'])) {
	$con = mysqli_connect('localhost','root','','summer_project') or die('unable to connect');
	$email_username = $_POST['email_username'];
	$password = $_POST['pass'];

	$sql = "SELECT * FROM customer WHERE
	email = '$email_username' OR customer_name = '$email_username'";

	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$stored_pass=$row["password"];
	if (md5($password) == $stored_pass) {
		if (is_array($row)) {
			$_SESSION['id'] = $row['customer_id'];
			$_SESSION['customer_name'] = $row['customer_name'];
		}
	}
	else {
		$error[] = 'Wrong Email/Username or password!';
	}
}

if (isset($_SESSION['id'])) {
		header("location:user_page.php");
		exit();
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	
</head>
<body>
	<div class="Login">
		<form action="#" method="post">
			<h1>Login</h1>
			<?php
				if(isset($error)){
					foreach($error as $error){
						echo '<span class="error-msg">'.$error.'</span>';
					};
				};
			?>
			<label>Email / Username</label><br>
			<input style="border-radius: 5px; height: 20px;" type="text" name="email_username" required placeholder="Enter email or username"><br><br>
			<label>Password</label><br>
			<input style="border-radius: 5px; height: 20px;" type="password" name="pass" required placeholder="Enter password"><br><br>
			<input class="btn" type="submit" name="submit" value="Login">
		
			<p>Don't have a account? <a href="register_form.php">Register</a></p>
		</form>
	</div>
</body>
</html> 