
<?php
	$conn = mysqli_connect('localhost', 'root', '', 'summer_project');

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	$product_id = $_GET['product_id'];

	$sql = "DELETE FROM products WHERE product_id='$product_id'";
	$result = mysqli_query($conn, $sql);

	if ($result) {
	    if (mysqli_affected_rows($conn) == 1) {
	        header('location: view_product.php');
	        exit;
	    } else {
	        echo "No records were deleted.";
	    }
	} else {
	    echo "Error: " . mysqli_error($conn);
	}

	mysqli_close($conn);
?>

 
