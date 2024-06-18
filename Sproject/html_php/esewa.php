<?php
session_start();

if (!isset($_SESSION['customer_name'])) {
    header('location:login_form.php');
    exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'summer_project');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$product_id = $_GET['product_id'];
$s = hash_hmac('sha256', 'Message', 'secret', true);

// Using prepared statements to prevent SQL Injection
$stmt = $conn->prepare('SELECT * FROM products WHERE product_id = ?');
$stmt->bind_param('s', $product_id);
$stmt->execute();
$res = $stmt->get_result();

if (!$res) {
    die("Error retrieving data: " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Detail</title>
    <style type="text/css">
        body{
            font-family: Arial, sans-serif;
        }
        .item img{
            height: 200px;
            width: 150px;
        }
        .inpt{
            width: 80px;
        }
        form{
            margin-left: 20px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="item">
    <?php 
        echo "<img src='" . htmlspecialchars($data['image_url']) . "'/>";
        echo "<p>" . htmlspecialchars($data['product_name']) . "</p>";
    ?>
</div>

<form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
    <label>Quantity</label><br>
    <div class="quantity-controls">
        <button type="button" onclick="decrementQuantity()">-</button>
        <input class="inpt" type="text" name="quantity" id="quantity" value="1" oninput="updateTotal()">
        <button type="button" onclick="incrementQuantity()">+</button>
    </div>

    <input type="hidden" name="cid" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
    <input type="hidden" name="pid" value="<?php echo htmlspecialchars($product_id); ?>"><br>

    <input type="text" id="amount" name="amount" value="<?php echo htmlspecialchars($data['price']); ?>" required>
    <input type="text" id="tax_amount" name="tax_amount" value="0" required>
    <input type="text" id="total_amount" name="total_amount" value="<?php echo htmlspecialchars($data['price']); ?>" required>
    <input type="text" id="transaction_uuid" name="transaction_uuid" value="1234565" required>
    <input type="text" id="product_code" name="product_code" value="EPAYTEST" required>
    <input type="text" id="product_service_charge" name="product_service_charge" value="0" required>
    <input type="text" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
    <input type="text" id="success_url" name="success_url" value="https://esewa.com.np" required hidden>
    <input type="text" id="failure_url" name="failure_url" value="https://google.com" required hidden>
    <input type="text" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
    <input type="text" id="signature" name="signature" value="<?php echo $s; ?>" required>
    <input value="Submit" type="submit">
</form>

<script>
    function updateTotal() {
        var quantity = parseInt(document.getElementById('quantity').value);
        var initialPrice = <?php echo $data['price']; ?>;
        var total = quantity * initialPrice;
        document.getElementById('total_amount').value = total;
    }

    function incrementQuantity() {
        var quantityInput = document.getElementById('quantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;
        updateTotal(); // Recalculate total after increment
    }

    function decrementQuantity() {
        var quantityInput = document.getElementById('quantity');
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            updateTotal(); // Recalculate total after decrement
        }
    }
</script>


</body>
</html>
