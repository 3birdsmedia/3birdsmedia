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
<script type="text/javascript" language="javascript">
$(document).ready(function() {
 
	  $(".stripeMe tr").mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");});
	  $(".stripeMe tr:even").addClass("alt");

});
</script>

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
        <h2>Templates</h2>	
        
        <p><a href="index.php" title="home">Home: &nbsp;>&nbsp;</a><a href="resources.php" title="Resources"> Resources </a> &nbsp;>&nbsp; Templates</p>
        
			<div id="leftcont">
<h3>About Templates</h3>

<p>Product templates are provided on the product pages for you to easily download. They will allow you to print your artwork easily and efficiently on Blanks/USA products.
</p>

<h3>Find the correct template for your product:</h3>
<p>You will find a download template link next to your product in the “products” section below the image of your chosen product. Once you have found the link, click on the program template you wish to use for your design layout. Once clicked it will automatically start to download your template. Save the template on your Mac or PC and begin to use.
</p>

<p>We offer formats for multiple design levels:</p>
<ul>
	<li>QuarkXPress&reg;</li>
	<li>Microsoft&reg; Word</li>
	<li>Adobe&reg; InDesign&reg;</li>
	<li>Adobe&reg; Illustrator&reg;</li>
    <li>Adobe&reg; Acrobat&reg; (.pdf)</li>
</ul>

<p>Please keep in mind that some templates are not suitable for all jobs. Read about the software below to determine which is best for your print job. You must have the correct software in order to open the template.</p>

<p>If you do not see the template you need please contact us at artwork@digiprintproducts.com with the  product name, item number, and format you would like and we will do our best to assist you.</p>

<h4>QuarkXPress&reg;</h4>
<p>Available as a .qxp file. Versions 7 or 8</p>

<h4>Microsoft&reg; Word</h4>
<p>Available as a .doc file, and can be used on Windows 97 and newer or Mac 2008 Version.</p>

<h4>Adobe&reg; InDesign&reg;</h4>
<p>Available as an .inx file, and can be used on versions CS3-CS5</p>

<h4>Adobe&reg; Illustrator&reg;</h4>
<p>Available as an .ai file, can be used on versions 10-CS5</p>

<h4>Adobe&reg; Acrobat&reg;</h4>
<p>Available as a .pdf file. This is not a fillable form type template.</p>

<p>Used with programs such as Adobe Illustrator, InDesign, and QuarkXPress, these templates can be placed on documents similar to images. These are designed to preview the product and dimensions.
</p>           	
            </div>
            
            <div id="right">
            <h3>DOWNLOAD TEMPLATES</h3>
            
            <p>Find the product you want to purchase and
download the file format you prefer for the design
of your project.</p> 
            
            <table class="stripeMe">
                <tr>
                	<th>Products</th><th colspan="5">File Formats</th>
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
						echo "<td><a href='downloads/illustrator/".$prod_number."_temp.eps' title='illustrator_download' class='ai' id='download'>&nbsp;</a></td>";
						echo "<td><a href='downloads/indesign/$prod_number.indd' title='inDesign_download' class='id' id='download'>&nbsp;</a></td>";
						echo "<td><a href='downloads/acrobat/".$prod_number."_temp.pdf' title='acrobat_download' class='pdf' id='download'>&nbsp;</a></td>";
						echo "<td><a href='downloads/quark/$prod_number.qxp' title='quark_download' class='qk' id='download'>&nbsp;</a></td>";
						echo "<td><a href='downloads/word/$prod_number.doc' title='word_download' class='word' id='download'>&nbsp;</a></td>";
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