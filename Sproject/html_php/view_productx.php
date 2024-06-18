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

        .container {
            width: auto;
            height: auto;
            text-align: left;
            overflow-x: auto;
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

        img {
            height: 100%;
            width: 100%;
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
/*            margin-top: 30px;*/
            margin-bottom: 35px;
        }

        .tb-heading {
/*            position: fixed;*/
/*            top: 0;*/
            color: white;
            width: 100%;
            height: 35px;
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

        .search-form {
            margin-top: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-input {
            padding: 5px;
            width: 70%;
        }

        .search-button {
            padding: 5px;
            background-color: #212529;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 25%;
        }
    </style>

</head>

<body>

    <div class="container">
        <!-- Table Header -->
        <table class="tb-heading">
            <tr>
                <th style='width: 50px;'>ID</th>
                <th style='width: 40px; height: 30px'>Image</th>
                <th style='width: 400px;'>Name</th>
                <th style='width: 100px;'>Price</th>
                <th style='width: 100px;'>Stock</th>
                <th style='width: 200px;'>Category</th>
                <th>Action</th>
                <th>
                    <!-- Search Form in th -->
                    <form class="search-form" method="GET">
                        <input class="search-input" type="text" name="search" placeholder="Search by Product Name or Category">
                        <button class="search-button" type="submit">Search</button>
                    </form>
                </th>
            </tr>
        </table>

        <!-- Search Results Table -->
        <!-- <div class="scrollable-table"> -->
            <?php
            $con = mysqli_connect('localhost', 'root', '', 'summer_project') or die('Unable to connect');

            $records_per_page = 5;
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page']: 1;
            $offset = ($page-1) * $records_per_page;

            $search_query = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
            $sql = "SELECT product_id, product_name, price, stock, category_name, image_url
        FROM products
        INNER JOIN category ON products.category_id = category.category_id
        WHERE product_name LIKE '%$search_query%' OR category_name LIKE '%$search_query%'
        LIMIT $offset, $records_per_page";
            $result = mysqli_query($con, $sql);

            echo "<table>";

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td style='width: 50px;'>{$row['product_id']}</td>";
                    echo "<td style='width: 40px; height: 60px'><img src='{$row['image_url']}'/></td>";
                    echo "<td style='width: 400px;'>{$row['product_name']}</td>";
                    echo "<td style='width: 100px;'>{$row['price']}</td>";
                    echo "<td style='width: 100px;'>{$row['stock']}</td>";
                    echo "<td style='width: 150px;'>{$row['category_name']}</td>";
                    echo "<td><a href='update_product.php?product_id={$row['product_id']}'>Update</a>
                    <a href='javascript:void(0);' onclick='confirmRemove({$row['product_id']})'>Remove</a></td>";
                    echo "</tr>";
                }
                echo "</table><br>";
            } else {
                echo "Error in query: " . mysqli_error($con);
            }

            mysqli_close($con);
            ?>
        <!-- </div> -->
        <?php 
            $sql_pagination = "SELECT COUNT(*) AS total FROM products INNER JOIN category ON products.category_id = category.category_id WHERE product_name LIKE '%$search_query%' OR category_name LIKE '%$search_query%'";
            $result_pagination = mysqli_query($con, $sql_pagination);
            $row_pagination = mysqli_fetch_assoc($result_pagination);
            $total_pages = ceil($row_pagination['total'] / $records_per_page);

            echo "<ul class='pagination justify-content-center'>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<li class='page-item'><a class='page-link' href='?page=".$i."'>".$i."</a></li>";
            }
            echo "</ul>";
            ?>

        <!-- Bottom Navigation -->
        <div class="tb-bottom">
            <a href='admin_page.php' >Back to Home Page</a>
            <a href='add_products.php' >Add Product</a>
        </div>
    </div>

    <script>
        function confirmRemove(product_id) {
            var confirmDelete = confirm("Are you sure you want to remove this product?");
            if (confirmDelete) {
                window.location.href = "remove_product.php?product_id=" + product_id;
            }
        }
    </script>
</body>

</html>
