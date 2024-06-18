<?php
session_start();

$error = [];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (empty($name) || empty($email) || empty($message)) {
        $error[] = "Don't leave any field empty!";
    } else {
        $conn = mysqli_connect('localhost', 'root', '', 'summer_project');

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $insert = "INSERT INTO contact(name, email, message) VALUES ('$name', '$email', '$message')";
        if (mysqli_query($conn, $insert)) {
            $_SESSION['success'] = true;
            header("location: contact.php");
            exit();
        } else {
            $error[] = 'Error inserting data: ' . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contact Page</title>
	<script src="https://kit.fontawesome.com/076ac70285.js" crossorigin="anonymous"></script>
	<style type="text/css">
		.body{
			width: 100%;
			height: 400px;
		}
		.foot{
			width: 100%;
			height: 292px;
			background: black;
			display: flex;
			color: white;
		}
		.foots {
			flex: 1; /* Each foots element will take up equal space */
			padding: 20px;
		}
		.foots h3 {
			margin-bottom: 15px;
		}
		.foots:nth-child(1) {
			background: gray; /* Red */
		}
		.foots:nth-child(2) {
			background: black; /* Green */
		}
		.foots:nth-child(3) {
			background: gray; /* Blue */
		}
		.contact-form input, .contact-form textarea {
			width: 100%;
			padding: 10px;
			margin: 5px 0;
			border-radius: 5px;
			border: none;
		}
		.contact-form button {
			padding: 10px 20px;
			background-color: white;
			color: black;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
		.contact-form button:hover {
			background-color: #ddd;
		}
		.submit:hover{
			background-color: white;
		}
	</style>
</head>
<body>
<?php @include 'navbar.php' ?>
<div class="body">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.514526098713!2d85.40785547521652!3d27.67048807620373!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1a9a4ca0d4d9%3A0xaa17a9a0c37d7e6b!2sS.S.%20Stationery!5e0!3m2!1sen!2snp!4v1714289699982!5m2!1sen!2snp" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<div class="foot">
	<div class="foots">
		<h3>Contact Information</h3>
		<p>Address: MCC6+55, Bhaktapur, Nepal</p>
		<p>Phone: (+977) 9811111111</p>
		<p>Email: info@example.com</p>
	</div>
	<div class="foots">
		<h3>Contact Form</h3>
		<?php
            if(isset($error)){
                foreach($error as $err){
                    echo '<span class="error-msg">' . $err . '</span>';
                }
            }
        ?>
		<form class="contact-form" action="#" method="post">
			<input type="text" name="name" placeholder="Your Name" required>
			<input type="email" name="email" placeholder="Your Email" required>
			<textarea name="message" placeholder="Your Message" rows="1" required></textarea>
			<!-- <button type="submit" name="submit">Send</button> -->
			<input type="submit" name="submit" value="Send" class="submit">
		</form>
	</div>
	<div class="foots">
		<!-- <h3>Office Hours</h3>
		<p>Monday - Friday: 9:00 AM - 5:00 PM</p>
		<p>Saturday: 10:00 AM - 2:00 PM</p>
		<p>Sunday: Closed</p> -->
		<h3>Follow Us</h3>
		<p>
			<a href="#" style="color: white;"><i class="fa-brands fa-facebook" style="margin-right: 8px;"></i>Facebook</a><br>
			<a href="#" style="color: white;"><i class="fa-brands fa-x-twitter" style="margin-right: 8px;"></i>Twitter</a><br>
			<a href="#" style="color: white;"><i class="fa-brands fa-instagram" style="margin-right: 8px;"></i>Instagram</a>
		</p>
	</div>
</div>

<?php
if (isset($_SESSION['success'])) {
    echo '<script>alert("Your message has been sent successfully!");</script>';
    unset($_SESSION['success']);
}
?>
</body>
</html>
