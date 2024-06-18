<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Products</title>

    <style type="text/css">
        * {
            font-family: 'Poppins', sans-serif;
        }
        a {
            font-size: 12px;
            text-decoration: none;
            color: white;
            background: #212529;
            padding: 10px 15px;
            border-radius: 5px;
            margin: 2px;
        }

        a:hover {
            text-decoration: underline;
        }

        .container {
            width: auto;
            height: auto;
            text-align: left;
            overflow-x: auto;
        }

        .search-form {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .search-input {
            padding: 5px;
        }

        .search-button {
            padding: 5px;
            background-color: #212529;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background: crimson;
            padding: 8px;
            text-align: left;
        }

        td {
            border-bottom: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .scrollable-table {
            overflow-y: auto;
            max-height: 690px;
            margin-top: 38px;
            margin-bottom: 35px;
        }

        .tb-heading {
            position: fixed;
            top: 0;
            color: white;
            width: 100%;
        }

        .tb-bottom {
            position: fixed;
            bottom: 0;
            background: crimson;
            width: 100%;
            height: 40px;
            display: flex;
            justify-content: center;
        }
    </style>

</head>

<body>

    <div class="container">

        <!-- Table Header -->
        <table class="tb-heading">
            <tr>
                <th style='width: 50px;'>ID</th>
                <th style='width: 300px; height: 40px;'>Product Name</th>
                <th style='width: 200px;'>date</th>
                <th style='width: 50px;'>Quantity</th>
                <th style='width: 100px;'>Price</th>
                <th style='width: 100px;'>Total</th>
                <th style='width: 100px;'>Status</th>
                <th style='width: 100px;'>Customer Name</th>

            </tr>
        </table>

        <!-- Search Results Table -->
        <div class="scrollable-table">
            <?php
            $con = mysqli_connect('localhost', 'root', '', 'summer_project') or die('Unable to connect');

            $sql = "SELECT order_id, order_date, status, product_name, quantity, price, sub_total, customer_name
                    FROM orders 
                    INNER JOIN customer ON orders.customer_id = customer.customer_id";

            $result = mysqli_query($con, $sql);

            echo "<table style='text-align: center;'>";

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td style='width: 50px; height: 40px;'>{$row['order_id']}</td>";
                    echo "<td style='width: 300px;'>{$row['product_name']}</td>";
                    echo "<td style='width: 200px;'>{$row['order_date']}</td>";
                    echo "<td style='width: 50px;'>{$row['quantity']}</td>";
                    echo "<td style='width: 50px;'>{$row['price']}</td>";
                    echo "<td style='width: 100px;'>{$row['sub_total']}</td>";
                    echo "<td style='width: 100px;'>{$row['status']}</td>";
                    echo "<td style='width: 100px;'>{$row['customer_name']}</td>";

                    echo "</tr>";
                }
                echo "</table><br>";
            } else {
                echo "Error in query: " . mysqli_error($con);
            }

            mysqli_close($con);
            ?>
        </div>

        <!-- Bottom Navigation -->
        <div class="tb-bottom">
            <a href='admin_dash.php'>Back to Home Page</a>
        </div>
    </div>

    <!-- <script>
        function confirmRemove(product_id) {
            var confirmDelete = confirm("Are you sure you want to remove this product?");
            if (confirmDelete) {
                window.location.href = "remove_product.php?product_id=" + product_id;
            }
        }
    </script> -->
</body>

</html>
