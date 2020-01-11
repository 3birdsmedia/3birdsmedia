<?php
session_start();
ob_start();
include('includes/functions.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="styles/reset.css" />
<link rel="stylesheet" href="styles/styles.css" />

<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.10.custom.min.js"></script>

<title>DigiPrint Products Corp. <?php echo "&#8212; {$title}"; ?></title>
</head>

<body>

<div class='wrapper'>

  <div class='center_wrapper'>
        <div id='header'><div id="headerPhone">Toll Free: (877) 421-2155</div>
	<div id='logo'><a href='index.php'><h1>DigiPrint Products Corp.</h1></a></div>
    </div>
	<div class="content">
	    <div id="sideNav">
		<?php include('includes/sidenav.php');?>
	    <!--END OF SID EBAR-->
	    
	    <div class="cont" id="resources">
        <h2>Tips & Instructions</h2>	
        
        <p><a href="index.php" title="home">Home: &nbsp;>&nbsp;</a><a href="resources.php" title="Resources"> Resources </a> &nbsp;>&nbsp; Tips & Instructions</p>
            
			<div id="leftcont">
<h3>About Tips and Instructions</h3>

<p>Please download or open our general printing tips and instructions for the product you wish to purchase on the right side of this page buy clicking the PDF symbol and the download will automatically start.</p>

<p>For further information and tips about how to produce the best looking product you can, please contact us at <a href="mailto:artwork@digiprintproducts.com" title="Mail Artwork">artwork@digiprintproducts.com</a> or call 1.877.421.2155 and someone will assist you.</p>
          	
            </div>
            
            <div id="right">
            <h3>DOWNLOAD TIPS & INSTRUCTIONS</h3>
            
            <p>Find the product you want to purchase and download the pdf file for tips and instructions.</p> 
            
            <table class="stripeMe">
                <tr>
                	<th>Products</th><th width="75">File Formats</th>
                </tr>
                
                <?php
				$conn = dbConnect('query');
                
                $tempsql ="SELECT prod_name, prod_number FROM products ORDER BY prod_name ASC";
                //echo "$tempsql : Tempsql<br /><br />";
				
                $tempresult = $conn->query($tempsql) or die(mysqli_error());
            	//print_r($tempresult);
				//.echo ' : Tempresult<br /><br />';
			
                $temprows = $tempresult->num_rows;
                //echo $temprows.': Temprows<br /><br />';
				
                while ($temprow = $tempresult->fetch_assoc()) {
               	//print_r($temprow);
				//echo "<br/><br/>";
				$prod_name = $temprow['prod_name'];
				$prod_number = $temprow['prod_number'];
				
					echo "<tr>";
						echo "<td><span class='bold'>Style: </span>$prod_name <br/> <span class='bold'>Product: </span>$prod_number</td>";
						echo "<td><a href='tips/".$prod_number."_Layout.pdf' title='acrobat_download' class='pdf tips' id='download'>&nbsp;</a></td>";
					echo "</tr>";
				
				}
				dbClose($conn);
				?>
            </table>
            
            
            </div>
		</div><!--END OF CONT-->
	</div><!--END OF CONT-->		
		
		<?php
		    if (isset($_SESSION['cart'])) {
			    include('includes/displayCart.php');
		    }
	    
		 ?>

	    <?php include('includes/navBar.php');?>
	</div><!--END OF CONTENT-->
	
	<div class="push"></div>
  </div><!--end of center_wrapper-->
</div><!--end of wrapper-->
<div class="footer">
<?php include('includes/footer.php');?>
</body>
</html>