
<style type="text/css">
	.container{

	}
	.container img{
		height: 300px;
	}
</style>


<?php
$con = mysqli_connect('localhost', 'root', '', 'summer_project') or die('Unable to connect');

$sql = "SELECT * FROM products";
$result = mysqli_query($con, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='container'>";
        echo "<img src='{$row['image_url']}'/>";
        echo "<p>{$row['name']}</p>";
        echo "<p>{$row['price']}</p>";
        echo "</div>";
    }
} else {
    echo "Error in query: " . mysqli_error($con);
}
?>

