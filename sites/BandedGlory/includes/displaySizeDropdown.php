<?php
session_start();
ob_start();
include 'functions.php';
$conn = dbConnect('query');
$color = $_GET['color'];
$prod_id = $_GET['prod_id'];
$arraySizes = array();
  $getColorID = "SELECT color_id FROM ring_colors WHERE color = '$color'";
  //submit the SQL query to the database and get the result for product name
  $resultColorID = $conn->query($getColorID) or die(mysqli_error());
  $rowColorId = $resultColorID->fetch_assoc();
  //assign product name to variable that we can use to display
  $colorId = $rowColorId['color_id'];
  //free result of product name query
  $resultColorID->free_result();
//print_r($_SESSION);
  $sizeSql = "SELECT DISTINCT size, inventory
              FROM prod_color_size_lookup, ring_sizes
              WHERE prod_color_size_lookup.prod_id = $prod_id
              AND prod_color_size_lookup.color_id = $colorId
              AND prod_color_size_lookup.size_id = ring_sizes.size_id";

        //submit the SQL query to the database and get the result
        $sizes_result = $conn->query($sizeSql) or die(mysqli_error());
        $sizecount="0";
        //loop through the result to get the id, product and description
        while ($row_size = $sizes_result->fetch_assoc()) {
            $arraySizes[$row_size['size']] = $row_size['inventory'];
        }

        //free result of product name query
        $sizes_result->free_result();

		  $return = json_encode($arraySizes);
  		echo $return;

?>
