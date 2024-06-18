<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product List</title>
  <style type="text/css">
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background-color: #f9f9f9;
    }

    .container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 1rem;
      width: 100%;
      max-width: 1200px;
      padding: 1rem;
      margin: 0 auto;
      box-sizing: border-box;
    }

    .item {
      border-radius: 15px;
      background-color: #ffffff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .item:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .item img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-bottom: 1px solid #f3f3f3;
    }

    .item p {
      margin: 10px;
      font-size: 16px;
      color: #333;
    }

    .item p.price {
      font-weight: bold;
      color: crimson;
    }

    .item a {
      font-size: 14px;
      text-decoration: none;
      color: white;
      background: crimson;
      padding: 10px 20px;
      border-radius: 5px;
      margin: 10px 0;
      display: inline-block;
      transition: background 0.3s;
    }

    .item a:hover {
      background: darkred;
    }

    .item form {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      margin: 10px;
    }

    .item form input[type="number"] {
      width: 50px;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .item form input[type="submit"] {
      background-color: crimson;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .item form input[type="submit"]:hover {
      background-color: darkred;
    }

  </style>
</head>
<body>
  <?php @include 'navbar.php' ?>

  <div class="container">
    <?php
    $con = mysqli_connect('localhost', 'root', '', 'summer_project') or die('Unable to connect');

    $sql = "SELECT * FROM products WHERE category_id = 4";
    $result = mysqli_query($con, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='item'>";
            echo "<img src='{$row['image_url']}'/>";
            echo "<p>{$row['product_name']}</p>";
            echo "<p class='price'>RS. {$row['price']}</p>";
            if ($row['stock'] > 0){
              echo "<p>Stock: {$row['stock']}</p>";
              ?>
              <form method="post" action="order2.php">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" min="1" max="<?php echo $row['stock'];?>" value="1" required>
                <input type="submit" name="submit" value="Buy Now">
              </form>
              <?php
            } else {
              echo "<p>Out of Stock</p>";
            }
            echo "</div>";
        }
    } else {
        echo "Error in query: " . mysqli_error($con);
    }
    mysqli_close($con);
    ?>
  </div>
</body>
</html>
