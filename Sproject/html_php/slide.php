<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'summer_project') or die('Unable to connect');
$cus_id = $_SESSION['id'];

$sql = "SELECT * FROM customer WHERE customer_id = '$cus_id'";
$sql1 = "SELECT * FROM orders WHERE customer_id = '$cus_id'";

$result = mysqli_query($con, $sql);
$orders_result = mysqli_query($con, $sql1);
$orders = [];
if ($orders_result) {
    while ($order_row = mysqli_fetch_assoc($orders_result)) {
        $orders[] = $order_row;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Dashboard</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        #slidingPanel {
            position: fixed;
            top: 56px; /* Adjusted to be below the navbar */
            right: -500px;
            width: 500px;
            height: calc(100% - 56px); /* Adjusted to be below the navbar */
            background-color: white;
            box-shadow: -2px 0px 5px rgba(0,0,0,0.5);
            z-index: 1000;
            transition: right 0.3s;
        }
        #slidingPanelContent {
            padding: 20px;
            overflow-y: auto;
            height: 100%;
        }
        .sliding-panel-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5em;
            cursor: pointer;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background: crimson;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: darkred;
        }
        .details, .orders {
            display: none; /* Hide sections by default */
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination button {
            margin: 0 5px;
        }
        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
<div id="slidingPanel">
    <div id="slidingPanelContent">
        <span class="sliding-panel-close" onclick="closeSlidingPanel()">&times;</span>
        <h2>User Dashboard</h2>
        <p>Welcome, <?php echo $_SESSION['customer_name']; ?>!</p>
        <button id="detailButton">Detail</button>
        <button id="ordersButton">Orders</button>
        <div id="details" class="details">
            <?php
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<p>Name: {$row['customer_name']}</p>";
                    echo "<p>Email: {$row['email']}</p>";
                    echo "<p>Address: {$row['address']}</p>";
                    echo "<p>Phone: {$row['phone']}</p>";
                }
            } else {
                echo "Error in query: " . mysqli_error($con);
            }
            ?>
        </div>
        <div id="orders" class="orders">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="ordersTableBody">
                    <!-- Orders data will be inserted here by JavaScript -->
                </tbody>
            </table>
            <div class="pagination" id="pagination">
                <!-- Pagination buttons will be inserted here by JavaScript -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function closeSlidingPanel() {
        document.getElementById('slidingPanel').style.right = '-500px';
    }

    document.getElementById('detailButton').addEventListener('click', function() {
        var details = document.getElementById('details');
        var orders = document.getElementById('orders');
        if (details.style.display === 'none' || details.style.display === '') {
            details.style.display = 'block';
            orders.style.display = 'none';
        } else {
            details.style.display = 'none';
        }
    });

    document.getElementById('ordersButton').addEventListener('click', function() {
        var orders = document.getElementById('orders');
        var details = document.getElementById('details');
        if (orders.style.display === 'none' || orders.style.display === '') {
            orders.style.display = 'block';
            details.style.display = 'none';
        } else {
            orders.style.display = 'none';
        }
    });

    // Pagination functionality
    var orders = <?php echo json_encode($orders); ?>;
    var currentPage = 1;
    var rowsPerPage = 5;

    function displayOrders(page) {
        var start = (page - 1) * rowsPerPage;
        var end = start + rowsPerPage;
        var paginatedOrders = orders.slice(start, end);

        var tableBody = document.getElementById('ordersTableBody');
        tableBody.innerHTML = '';

        paginatedOrders.forEach(function(order) {
            var row = `<tr>
                        <td>${order.order_id}</td>
                        <td>${order.product_name}</td>
                        <td>${order.quantity}</td>
                        <td>${order.price}</td>
                        <td>${order.sub_total}</td>
                        <td>${order.status}</td>
                       </tr>`;
            tableBody.innerHTML += row;
        });
    }

    function setupPagination() {
        var pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        var pageCount = Math.ceil(orders.length / rowsPerPage);

        for (var i = 1; i <= pageCount; i++) {
            var button = document.createElement('button');
            button.innerText = i;
            button.addEventListener('click', function() {
                currentPage = parseInt(this.innerText);
                displayOrders(currentPage);
            });
            pagination.appendChild(button);
        }
    }

    displayOrders(currentPage);
    setupPagination();
</script>
</body>
</html>
