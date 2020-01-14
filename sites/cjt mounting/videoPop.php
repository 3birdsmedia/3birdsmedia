<?php
include ('includes/functions.php');
    $conn = dbConnect('query');
$prod_id = $_GET['prod_id'];
	   $sql3 = "SELECT *
		    FROM videos_products_lookup, videos
		    WHERE videos_products_lookup.prod_id = $prod_id
		    AND videos_products_lookup.video_id = videos.video_id
		   ORDER BY videos.video_id";
         	   //submit the SQL query to the database and get the result
		   $result3 = $conn->query($sql3); //or die(mysqli_error());
                   $length3 = $result3->num_rows;
		   //$row = $result->fetch_assoc();
		   
		    $videos = array();
	            while ($row3 = $result3->fetch_assoc()) {
		 	   //loop through the sql result, add each product_id and type_id to array to use later 
				   $videos[] = array(
						   'prod_id'  => $row3['prod_id'],
						   'video_id' => $row3['video_id'] ,
						   'youtube_url'=> $row3['youtube_url'],
						   'teachertube_url'=> $row3['teachertube_url'],
						   'video_name' => $row3['video_name']
 						   );
				   }
	   //now that we are finished with results, release the db resources to allow a new query.
		   $result3->free_result();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/reset.css" />
<link rel="stylesheet" href="css/popUp.css" />

<style type="text/css">
</style>


<title>CJT <?php echo "&#8212;{$title}"; ?></title>
</head>
<body>
<!-- Start: Center Wrap -->
<div id="wrapper">

        <!-- Start: header -->
       <div id="header">
	     <span id="logo"><h1>CJT MOUNTING</h1></span>
              <span class='slogan'><h1>Products For Real Life</h1></span>
               
	</div><!--End Header-->
<!-- Start: content -->
       <div id="popcontent">
<?php
if (!empty($videos)){
	 
	 $sql2 = "SELECT * FROM products
	 	  WHERE prod_id = $prod_id";
				 
				 //submit the SQL query to the database and get the result
			$result2 = $conn->query($sql2) or die(mysqli_error());
			
			while ($row2 = $result2->fetch_assoc()) {
			 echo "<h2>".$row2['prod_name']."</h2>";
				
			} //end of the while loop
			$result2->free_result();
	 
  
	 $length3 = count($videos);
	 
	 
	    //loop through the results of the types query Part 2
	    for ($row3 = 0; $row3 < $length3; $row3++) {	
		if ($prod_id == $videos[$row3]['prod_id']) {
						
			
				$video_id = $videos[$row3]['video_id'];
			     	$youtube_url = $videos[$row3]['youtube_url'];
				$video_name = $videos[$row3]['video_name'];
			
					 echo "<div id='left' class='video'><h4>".$video_name."</h4><a href='".$youtube_url."' target='_blank'><div id='youtube_link' class='video_link'></div></a>";
					  if($videos[$row3]['teachertube_url'] !== ""){
					    	  echo "<a href='".$videos[$row3]['teachertube_url']."' target='_blank' ><div id='teachertube_link' class='video_link'></div></a></div>";

					  }
		      } else {
			    echo "Sorry no Videos were found for this product";
		    }

	   }
}
?>

<!--END CONTENT-->					
			</div>  
		</div><!--END OF Main-->
	</div><!--END OF WRAP-->


</body>
</html>