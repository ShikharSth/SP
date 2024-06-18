<?php
// Display errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['customer_name'])) {
    header('Location: login_form.php');
    exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'summer_project');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$product = null;
$invoice = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id'], $_POST['price'], $_POST['product_name'], $_POST['quantity'])) {
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        $cid = $_SESSION['id']; // Assuming you have a customer ID in the session
        $quantity = (int)$_POST['quantity']; // Get quantity from POST
        $total = mysqli_real_escape_string($conn, $_POST['price']) * $quantity;

        $sql = "SELECT * FROM products WHERE product_id='$product_id'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $product = mysqli_fetch_assoc($result);

            $invoice = $product_id . time();
            $pname = mysqli_real_escape_string($conn, $product['product_name']);
            $price = $product['price'];

            $insert = "INSERT INTO `orders` (product_name, quantity, invoice_no, price, sub_total, product_id, customer_id) VALUES ('$pname', '$quantity', '$invoice', '$price', '$total', '$product_id', '$cid')";
            if (!mysqli_query($conn, $insert)) {
                die('Error: ' . mysqli_error($conn));
            } else {
                $newStock = $product['stock'] - $quantity;
                $update = "UPDATE products SET stock = '$newStock' WHERE product_id = '$product_id'";
                if (!mysqli_query($conn, $update)) {
                    die('Error: ' . mysqli_error($conn));
                }
            }
        } else {
            die('Error fetching product: ' . mysqli_error($conn));
        }
    } else {
        die('Required POST variables not set');
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Order</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #000;
            margin: 0;
            padding: 0;
        }
        .item img {
            height: 200px;
            width: 150px;
        }
        .inpt {
            width: 80px;
            padding: 5px;
            margin-top: 5px;
            border: 1px solid #000;
            color: #000;
        }
        form {
            margin: 20px;
            padding: 20px;
            width: 300px;
            background-color: #fff;
            border: 1px solid #000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .quantity-controls button {
            background-color: #dc143c;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .quantity-controls button:hover {
            background-color: #a10f2d;
        }
        .quantity-controls input {
            text-align: center;
        }
        input[type="submit"] {
            background-color: #dc143c;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #a10f2d;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php @include 'navbar.php'; ?>

<form action="https://uat.esewa.com.np/epay/main" method="POST">
    <div class="item">
        <?php 
        if ($product) {
            echo "<img src='{$product['image_url']}'/>";
            echo "<p>{$product['product_name']}</p>";
            echo "<p>RS. {$product['price']}</p>";
        } else {
            echo "<p>Product not found.</p>";
        }
        ?>
    </div>

    <label>Quantity</label><br>
    <div class="quantity-controls">
        <!-- <button type="button" onclick="decrementQuantity()">-</button> -->
        <input class="inpt" type="number" name="quantity" id="quantity" value="<?php echo $quantity; ?>" min="1" max="<?php echo $product['stock']; ?>" required oninput="updateTotal()" readonly>
        <!-- <button type="button" onclick="incrementQuantity()">+</button> -->
    </div>

    <input type="hidden" name="cid" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
    <input type="hidden" name="p_id" value="<?php echo htmlspecialchars($product['product_id']); ?>"><br>
    
    <label>Total</label><br>
    <input class="inpt" type="text" name="tAmt" id="total" value="<?php echo htmlspecialchars($product['price'] * $quantity); ?>" readonly>
    <input value="<?php echo htmlspecialchars($product['price'] * $quantity); ?>" name="amt" type="hidden">
    <input value="0" name="txAmt" type="hidden">
    <input value="0" name="psc" type="hidden">
    <input value="0" name="pdc" type="hidden">
    <input value="epay_payment" name="scd" type="hidden">
    <input value="<?php echo htmlspecialchars($invoice); ?>" name="pid" type="hidden">
    <input value="http://localhost/Sproject/html_php/esewa_succ.php" type="hidden" name="su">
    <input value="http://localhost/Sproject/html_php/failed.php" type="hidden" name="fu">
    <br>
    <label>Pay With</label>
    <input type="image" src="../image/esewa.png">
</form>

<script>
function updateTotal() {
    var quantity = document.getElementById('quantity').value;
    var initialPrice = <?php echo $product['price']; ?>;
    var total = quantity * initialPrice;
    document.getElementById('total').value = total;
    document.getElementsByName('amt')[0].value = total;
}

function incrementQuantity() {
    var quantityInput = document.getElementById('quantity');
    quantityInput.value = parseInt(quantityInput.value) + 1;
    updateTotal();
}

function decrementQuantity() {
    var quantityInput = document.getElementById('quantity');
    if (parseInt(quantityInput.value) > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
        updateTotal();
    }
}
</script>

</body>
</html>
