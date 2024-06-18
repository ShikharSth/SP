<?php
@include 'config.php';

// $error = [];

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:logout_admin.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];

    // You can add more validation and sanitization as needed

    $con = mysqli_connect('localhost', 'root', '', 'summer_project') or die('Unable to connect');
    if ($price < 1 || $stock < 0) {
        $error[] = "Price and stock can not be less than 1 and 0.";
    }else{

        $sql = "UPDATE products SET product_name = '$product_name', price = '$price', stock = '$stock', category_id = '$category_id' WHERE product_id = '$product_id'";

        $result = mysqli_query($con, $sql);

        if ($result) {
            header('location: view_product.php');
            exit;
        } else {
            echo "Error updating product: " . mysqli_error($con);
        }

        mysqli_close($con);
    }
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $con = mysqli_connect('localhost', 'root', '', 'summer_project') or die('Unable to connect');

    $sql = "SELECT product_id, product_name, price, stock, category_id
            FROM products
            WHERE product_id = '$product_id'";

    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Error in query: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        body {
            font-family: Arial, sans-serif; /* Uniform font for all text */
            background-color: #f4f4f4; /* Light gray background */
            padding: 20px; /* Adds padding around the body */
        }

        .container {
            background: white;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow around the container */
            border-radius: 8px; /* Rounds the corners */
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: calc(100% - 22px); /* Full-width minus padding and border */
        }

        input[type="submit"] {
            background-color: crimson;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: black;
        }
        .button-style {
            width: calc(100% - 40px);
            background-color: crimson;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s ease;
        }

        .button-style:hover {
            background-color: black;
        }


        .error-msg {
            color: red;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Product</h2>
        <form method="post" action="">
            <?php
                if (isset($error)) {
                    echo '<script>';
                    echo 'alert("' . implode('\n', $error) . '");';
                    echo '</script>';
                }
            ?>
            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
            
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" value="<?php echo $row['product_name']; ?>" required>

            <label for="price">Price:</label>
            <input type="text" name="price" value="<?php echo $row['price']; ?>" required>

            <label for="stock">Stock:</label>
            <input type="text" name="stock" value="<?php echo $row['stock']; ?>" required>

            <label for="category_id">Category:</label>
            <input type="text" name="category_id" value="<?php echo $row['category_id']; ?>" required>

            <input type="submit" value="Update">
        </form>

        <br>
        <a href='admin_page.php' class="button-style">Back to Admin Page</a>
    </div>
</body>
</html>

