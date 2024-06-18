<?php
    session_start();
    $product_id = $_GET['product_id'];

    $conn = mysqli_connect('localhost','root','','summer_project');
    if(isset($_POST['submit'])){
        $cid = $_POST['cid'];
        $pid = $_POST['pid'];
        $pname = $data['product_name'];
        $price = $data['price'];
        $quantity = $_POST['quantity'];
        $total = $_POST['total'];

        $insert = "INSERT INTO order(product_name,quantity,price,sub_total,product_id,cutomer) VALUES ('$pname','$quantity','$price','$total','$pid','$cid')";
        if (mysqli_query($conn, $insert)) {
                header("location:user_page.php");
                 echo '<script>alert("Data inserted successfully!");</script>';
                exit();
            } else {
                $error[] = 'Error inserting data: ' . mysqli_error($conn);
            }
    }

    $select = "SELECT * FROM products WHERE product_id = '$product_id' ";
    $res = mysqli_query($conn, $select);
    $data = mysqli_fetch_assoc($res);
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style type="text/css">
        body{
            font-family: ;
        }
        .item img{
            height: 200px;
            width: 150px;
        }
        .inpt{
            width: 80px;
        }
        
    </style>
</head>
<body>
<form method="post" action="#">
    <div class="item">
        <?php 
            echo "<img src='{$data['image_url']}'/>";
            echo "<p>{$data['product_name']}</p>";
            echo "<p>RS. {$data['price']}</p>";
        ?>
    </div>

    <label>Quantity</label><br>
    <div class="quantity-controls">
        <button type="button" onclick="decrementQuantity()">-</button>
        <input class="inpt" type="text" name="quantity" id="quantity" value="1" oninput="updateTotal()">
        <button type="button" onclick="incrementQuantity()">+</button>
    </div>

    <input type="hidden" name="cid" value="<?php echo $_SESSION['id']?>">
    <input type="hidden" name="pid" value="<?php echo $data['product_id']?>"><br>
    <label>Total</label><br>
    <input class="inpt" type="text" name="total" id="total" value="<?php echo $data['price']; ?>" readonly><br><br>

    <input type="submit" name="submit" value="Order">
</form>

<script>
  function updateTotal() {
    // Get the quantity input value
    var quantity = document.getElementById('quantity').value;

    // Get the initial price from PHP variable
    var initialPrice = <?php echo $data['price']; ?>;

    // Calculate the total based on quantity and initial price
    var total = quantity * initialPrice;

    // Update the total input value
    document.getElementById('total').value = total;
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




