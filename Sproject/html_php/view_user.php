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
                <th style='width: 400px; height: 40px;'>Name</th>
                <th style='width: 200px;'>Email</th>
                <th style='width: 200px;'>Address</th>
                <th style='width: 200px;'>Phone</th>
            </tr>
        </table>

        <!-- Search Results Table -->
        <div class="scrollable-table">
            <?php
            $con = mysqli_connect('localhost', 'root', '', 'summer_project') or die('Unable to connect');

            // $search_query = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
            $sql = "SELECT customer_id, customer_name, email, address, phone
                    FROM customer";

            $result = mysqli_query($con, $sql);

            echo "<table>";

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td style='width: 50px; height: 40px;'>{$row['customer_id']}</td>";
                    echo "<td style='width: 400px;'>{$row['customer_name']}</td>";
                    echo "<td style='width: 250px;'>{$row['email']}</td>";
                    echo "<td style='width: 200px;'>{$row['address']}</td>";
                    echo "<td style='width: 200px;'>{$row['phone']}</td>";
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
