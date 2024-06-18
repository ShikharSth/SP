
<?php 
session_start();
$message="";
if (isset($_POST['submit'])) {
	$con = mysqli_connect('localhost','root','','summer_project') or die('unable to connect');
	$email_username = $_POST['email_username'];
	$password = $_POST['pass'];

	$sql = "SELECT * FROM admin WHERE
	email = '$email_username' OR admin_name = '$email_username'";

	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$stored_pass=$row["password"];
	if ($password == $stored_pass) {
		if (is_array($row)) {
			$_SESSION['a_id'] = $row['admin_id'];
			$_SESSION['admin_name'] = $row['admin_name'];
		} 
	}
	else {
		$error[] = 'Wrong Email/Admin name or password!';
	}
} 

if (isset($_SESSION['a_id'])) {
	header("location:admin_dash.php");
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
			<h1>Admin Login</h1>
			<?php
				if(isset($error)){
					foreach($error as $error){
						echo '<span class="error-msg">'.$error.'</span>';
					};
				};
			?>
			<label>Admin Name</label><br>
			<input type="text" name="email_username" required placeholder="Enter Admin Name"><br><br>
			<label>Password</label><br>
			<input type="password" name="pass" required placeholder="Enter password"><br><br>
			<input class="btn" type="submit" name="submit" value="Login">
			<button class="btn" type="button" onclick="window.location.href='login_form.php';">Login As Customer</button>
		
		</form>
	</div>
</body>
</html> 