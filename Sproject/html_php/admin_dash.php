<?php

// @include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:logout_admin.php');
}

?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Admin Page</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <script src="https://kit.fontawesome.com/076ac70285.js" crossorigin="anonymous"></script>
   <style>
      body {font-family: "Lato", sans-serif;}

      .sidebar {
        height: 100%;
        width: 300px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
/*        padding-top: 16px;*/
      }

      .sidebar a {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 20px;
/*        color: #818181;*/
        color: black;
        display: block;
      }

      .sidebar a:hover {
        color: #f1f1f1;
      }

      .main {
        margin-left: 300px; /* Same as the width of the sidenav */
        padding: 0px 10px;
        background: lightgray;
        height: 100%;
      }

      @media screen and (max-height: 450px) {
        .sidebar {padding-top: 15px;}
        .sidebar a {font-size: 18px;}
      }
      a{
         margin-top: 50px;
         background: gray;
      }
      img{
         height: 150px;
         width: 300px;
      }

      .add_item{
         text-decoration: none;
         color: white;
         border: 1px;
         border-radius: 8px;
         background: crimson;
         padding: 5px 8px;
      }
      .card-img-top{
         height: 250px;
      }
      
   </style>
</head>
<body>
   <?php @include 'admin_nav.php'?>

   <div class="sidebar">
      <img src="../image/logo.png">
      <a href="add_products.php"><i class="fa-solid fa-box"></i> Add Products</a>
      <a href="view_contact.php"><i class="fa-solid fa-file-contract"></i> View Contacts</a>
      <a href="view_user.php"><i class="fa fa-fw fa-user"></i> View Customers</a>
      <a href="view_product.php"><i class="fa-solid fa-boxes-stacked"></i></i> View Items</a>
      <a href="view_order.php"><i class="fa-solid fa-dolly"></i> View Orders</a>
   </div>

   <div class="main">
      <!-- <h2>Sidebar with Icons</h2>
      <p>This side navigation is of full height (100%) and always shown.</p>
      <p>Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
      <p>Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p> -->

      <div style=" display: flex;">
      <div class="card" style="width: 18rem; margin: 5px;">
         <img src="../image/add_item.png" class="card-img-top" alt="...">
         <div class="card-body d-flex justify-content-center">
            <a href="add_products.php" class="add_item">Add Items</a>
         </div>
      </div>

      <div class="card" style="width: 18rem; margin: 5px;">
         <img src="../image/con.png" class="card-img-top" alt="...">
         <div class="card-body d-flex justify-content-center">
            <a href="view_contact.php" class="add_item">View Contact</a>
         </div>
      </div>

      <div class="card" style="width: 18rem; margin: 5px;">
         <img src="../image/view_item.webp" class="card-img-top" alt="...">
         <div class="card-body d-flex justify-content-center">
            <a href="view_product.php" class="add_item">View Items</a>
         </div>
      </div>

      <div class="card" style="width: 18rem; margin: 5px;">
         <img src="../image/user.jpeg" class="card-img-top" alt="...">
         <div class="card-body d-flex justify-content-center">
            <a href="view_user.php" class="add_item">View Customers</a>
         </div>
      </div>

      <div class="card" style="width: 18rem; margin: 5px;">
         <img src="../image/ord.jpeg" class="card-img-top" alt="...">
         <div class="card-body d-flex justify-content-center">
            <a href="view_order.php" class="add_item">View Orders</a>
         </div>
      </div>
   </div>
   
   </div>
</body>
</html>