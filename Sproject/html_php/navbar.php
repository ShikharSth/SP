<?php
session_start();

$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin page</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/076ac70285.js" crossorigin="anonymous"></script>
    <style type="text/css">
        *{
            font-family: 'Poppins', sans-serif; 
            margin:0; 
            padding:0; 
            box-sizing: border-box;
            outline: none;
            border :none;
            text-decoration: none;
        }
        .btn{
            border: 1px solid crimson;
            color: crimson;
            border-radius: 15px;
        }
        .btn:hover{
            color: white;
            background: crimson;
            border: 1px solid crimson;
        }
        .nav-link{
            margin-left: 40px;
        }
        
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: red;">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <img src="../image/logo.png" alt="##" width="60" height="40" style="margin-right: 15px;">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="user_page.php">Home</a>
                    </li>
                    <li class="nav-item dropdown" onclick="toggleSearchBar()">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Products</a>
                        <ul class="dropdown-menu" >
                            <li><a class="dropdown-item" href="book.php">Book</a></li>
                            <li><a class="dropdown-item" href="copy.php">Copy</a></li>
                            <li><a class="dropdown-item" href="pen.php">Pen</a></li>
                            <li><a class="dropdown-item" href="pencil.php">Pencil</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="contact.php">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav d-flex flex-row-reverse">
                    <?php if (isset($_SESSION['customer_name']) && $_SESSION['customer_name'] > 0): ?>
                        <li><a class="nav-link-btn" aria-current="page" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a></li>
                        <li><a class="nav-link-btn" aria-current="page" href="#" onclick="openSlidingPanel()"><i class="fa-solid fa-user"></i></a></li>
                        <li class="nav-item">
                            <h3>welcome <span><?php echo $_SESSION['customer_name'] ?></span></h3> 
                        </li>
                    <?php else: ?>
                        <li><a class="nav-link-btn" aria-current="page" href="register_test.php">Register</a></li>
                        <li><a class="nav-link-btn" aria-current="page" href="login_form.php">Login</a></li>
                    <?php endif; ?>
                    <?php if ($currentPage !== 'user_page.php' AND $currentPage !== 'contact.php' AND $currentPage !== 'order2.php'): ?>
                        <form class="d-flex" action="book.php" method="GET">
                            <input id="searchBar" class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php @include 'slide.php' ?>
    

    <script>
        function toggleSearchBar() {
            var searchBar = document.getElementById("searchBar");
            searchBar.style.display = (searchBar.style.display === 'none' || searchBar.style.display === '') ? 'block' : 'none';
        }

        function openSlidingPanel() {
            document.getElementById("slidingPanel").style.right = "0";
        }

        function closeSlidingPanel() {
            document.getElementById("slidingPanel").style.right = "-500px";
        }
    </script>
</body>
</html>
