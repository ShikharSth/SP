<?php 
$error = [];

if(isset($_POST['submit'])){
    $c_name = $_POST['cname'];
    
    if (empty($c_name)) {
        $error[] = "Don't leave any field empty!";
    } else {
        $conn = mysqli_connect('localhost','root','','summer_project');

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
           
            $insert = "INSERT INTO category(category_name) VALUES ('$c_name')";
            if (mysqli_query($conn, $insert)) {
                header("location:admin_page.php");
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
    <title>Add products</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
    <div class="Login">
        <form action="#" method="post">
            <h1>Add Category</h1>
            <?php
                if(isset($error)){
                    foreach($error as $err){
                        echo '<span class="error-msg">' . $err . '</span>';
                    }
                }
            ?>
            <label>Category</label>
            <input type="text" name="cname" required placeholder="Enter category name"><br><br>
            <input class="btn" type="submit" name="submit" value="ADD">
            <button class="btn" type="button" onclick="window.location.href='admin_page.php';">Back to Home</button>
        
        </form>
    </div>
</body>
</html>
