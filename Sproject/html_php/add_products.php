<?php 
$error = [];

if(isset($_POST['submit'])){
    $p_name = $_POST['pname'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];
    
    // File upload handling
    $target_dir = "../image/"; // Updated path based on your folder structure
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $error[] = "File is not an image.";
        $uploadOk = 0;
    }

    
     // Check if file already exists
    if (file_exists($target_file)) {
        $error[] = "Sorry, the file already exists.";
        $uploadOk = 0;
    }

    

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        $error[] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($price < 0) {
        $error[] = "Sorry, price must be for than 0.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $error[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $error[] = "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // File uploaded successfully, now insert data into the database
            $conn = mysqli_connect('localhost','root','','summer_project');

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $insert = "INSERT INTO products(product_name, price, image_url, stock, category_id) 
                       VALUES ('$p_name', '$price', '$target_file', '$stock', '$category')";

            if (mysqli_query($conn, $insert)) {
                header("location:view_product.php");
                exit();
            } else {
                $error[] = 'Error inserting data: ' . mysqli_error($conn);
            }

            mysqli_close($conn);
        } else {
            $error[] = "Sorry, there was an error uploading your file.";
        }
    }
}
?>
<!-- Rest of your HTML code -->

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
        <form action="#" method="post" enctype="multipart/form-data">
            <h1>Add Product</h1>
            <?php
                if(isset($error)){
                    foreach($error as $err){
                        echo '<span class="error-msg">' . $err . '</span>';
                    }
                }
            ?>
            <input type="text" name="pname" required placeholder="Enter your product name"><br><br>
            <input type="text" name="price" required placeholder="Enter your price"><br><br>
            <!-- Input type file for image upload -->
            <input type="file" name="photo" accept="image/*" required><br><br>
            <input type="text" name="stock" required placeholder="Enter stock"><br><br>
            <select name="category">
                <option>Choose category</option>
                <option value="1">Book</option>
                <option value="2">Copy</option>
                <option value="3">Pen</option>
                <option value="4">Pencil</option>
            </select><br>
            <input class="btn" type="submit" name="submit" value="ADD">
            <button class="btn" type="button" onclick="window.location.href='admin_dash.php';">Back to Home</button>
        </form>
    </div>
    <!-- <a href='admin_page.php' style='float: left;'>Go Back</a> -->
</body>
</html>
