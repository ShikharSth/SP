<?php 
$error = []; 

if(isset($_POST['submit'])){
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = $_POST['pass'];
    $repassword = $_POST['repass'];
    
    // Validate Email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Invalid email format!';
    }

    // Validate Phone number (must start with 98 and be 10 digits)
    if (!preg_match('/^98\d{8}$/', $phone)) {
        $error[] = 'Invalid phone number format! It should start with 98 and be 10 digits.';
    }

    if (empty($username) || empty($address) || empty($password) || empty($repassword)) {
        $error[] = "Don't leave any required field empty!";
    } else {
        $conn = mysqli_connect('localhost','root','','summer_project');

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
        $address = mysqli_real_escape_string($conn, $address);
        $phone = mysqli_real_escape_string($conn, $phone);
        
        $select = "SELECT * FROM customer WHERE email = '$email' ";
        $result = mysqli_query($conn, $select);

        if (!$result) {
            $error[] = 'Error querying database: ' . mysqli_error($conn);
        } else {
            if(mysqli_num_rows($result) > 0){
                $error[] = 'User already exists!';
            } else {
                if ($password != $repassword) {
                    $error[] = 'Passwords do not match!';
                } else {
                    // Hash the password using md5 
                    $hashed_password = md5($password);
                    $insert = "INSERT INTO customer(customer_name,email,address,phone,password) VALUES ('$username','$email','$address','$phone','$hashed_password')";
                    if (mysqli_query($conn, $insert)) {
                        header("location:login_form.php");
                        exit();
                    } else {
                        $error[] = 'Error inserting data: ' . mysqli_error($conn);
                    }
                }
            }
        }
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
    <div class="Login">
        <form action="#" method="post">
            <h1>Register</h1>
            <?php
                if(isset($error)){
                    foreach($error as $err){
                        echo '<span class="error-msg">' . $err . '</span>';
                    }
                }
            ?>
            <!-- <label>User Name</label><br> -->
            <input type="text" name="uname" required placeholder="Enter your user name"><br><br>
            <!-- <label>Email</label><br> -->
            <input type="text" name="email" required placeholder="Enter your email"><br><br>
            <!-- <label>Address</label><br> -->
            <input type="text" name="address" required placeholder="Enter your address"><br><br>
            <!-- <label>Phone</label><br> -->
            <input type="text" name="phone" required placeholder="Enter your phone"><br><br>
            <!-- <label>Password</label><br> -->
            <input type="password" name="pass" required placeholder="Create password"><br><br>
            <!-- <label>Confirm Password</label><br> -->
            <input type="password" name="repass" required placeholder="Re-enter your password"><br><br>
            <input class="btn" type="submit" name="submit" value="Register">
        
            <p>Already have an account? <a href="login_form.php">Login</a></p>
        </form>
    </div>
</body>
</html>
