<?php include('includes/functions.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <link rel="stylesheet" href="styles/styles.css" />
<style type="css/text">
#itemsUL {
    float:none !important;
}
</style>


<title>Digiprint Products LLC <?php echo "&#8212; {$title}"; ?></title>
</head>

<body>

<div class='wrapper'>
    <div id="bg"><img class="resizeBG" src="images/bg.jpg" /></div>
    <div class="content">
            <div class="transparency">

    <?php
    //CONNECTING TO MYSQL WITH QUERY RIGHTS
                    $conn = dbConnect('query');

                    //preparing the sql query
                    $sql = "SELECT * FROM products
                            LEFT JOIN images
                            ON products.img_id = images.img_id
                            LEFT JOIN brands
                            ON products.brand_id = products.brand_id
                            WHERE products.brand_id = brands.brand_id";



                    // submit the query and capture the result or die in the process jajaja!!!
                    $result = $conn->query($sql) or die(mysqli_error());
                   //echo ($result);
                    //
                    // Lets count the results
                    $numRows = $result->num_rows;


                    while ($row = $result->fetch_assoc()) {
                                    //this will loop through the table made by the left joins and spit out
                                    //the info needed
                                    //print_r($result);

                                    echo '<ul id="itemsUL"><a href="item_detail.php?product_id='.$row['product_id'] .' "> ' . $row['product'] . '</a>
                                                    <li><img  src="images/DB_images/' . $row['img'] . '" width="300" /></li>
                                                    <li>Price: ' . $row['price'] . '</li>
                                                    <li>Brand: ' . $row['brand'] . '</li>';
                                                    //'<li>Wheelset: ' . $row['wheel_id'] .'</li>' .
                                                    //'<li>Grips: '.$row['grip'].'</li>';


                                    //set a variable for the product_id of the current row we are looping in
                                    $selectedProduct_id = $row['product_id'];


                                    echo '</ul></li>' . '</ul> ';



                            } //end of the while loop

                            //now that we are finished with the results set, release the db resources to allow a new query.
                            $result->free_result();


                            //now that we're done, we want to close our database connection.  call the dbClose() connection function
                            //dbClose($conn);








    ?>
</div>
<?php
	if (isset($_SESSION['cart'])) {
		include('includes/displayCart.php');
	}else{}
     ?>

</div><!--END OF CONTENT-->

<?php include('includes/navBar.php');?>
 <div class="push"></div>

</div><!--end of wrapper-->
<div class="footer">
<?php include('includes/footer.php');?>
</body>
</html>
