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

<title>Banded Glory, LLC <?php echo "&#8212; {$title}"; ?></title>
</head>

<body>

<div class='wrapper'>

  <div class='center_wrapper'>
        <div id='header'><div id="headerPhone">Toll Free: (877) 421-2155</div>
	<div id='logo'><a href='index.php'><h1>Banded Glory, LLC</h1></a></div>
    </div>
	<div class="content">
	    <div id="sideNav">
		<?php include('includes/sidenav.php');?>
	    <!--END OF SID EBAR-->

	    	    <div class="cont" id="resources">
        <h2>DigiPrint Products Artwork Guidlines</h2>

        <p><a href="index.php" title="home">Home: &nbsp;>&nbsp;</a><a href="resources.php" title="Resources"> Resources </a> &nbsp;>&nbsp; Artwork Guidlines</p>

			<div id="">

<p>Please read and follow the artwork specifications listed below; this will allow our Pre-Press department to print and deliver your project at the highest quality and on time.
</p>

<h3>Electronic Artwork File Formats:</h3>

<p class="bold">Submit all digital artwork using one of the following preferred formats:</p>

<table width="300">
    <tbody>
        <tr>
            <th>Program Software</th><th>File Type(s)</th>
        </tr>
        <tr>
            <td>Adobe InDesign CS4</td><td>.indd</td>
        </tr>
        <tr>
            <td>Adobe Illustrator CS4</td><td>.ai, .eps</td>
        </tr>
        <tr>
            <td>Adobe Acrobat (PDF)</td><td>.pdf</td>
        </tr>
        <tr>
            <td>Adobe PhotoShop CS4</td><td>.tif, .psd, .eps</td>
        </tr>
        <tr>
            <td>Quark Xpress</td><td>.qxp</td>
        </tr>
	</tbody>
</table>
<br/>

<p>If these options are not available to you, please contact us for additional options.</p>

<h3>File specs:</h3>

<p class="bold">Include Fonts and Images:</p>
<p>Fonts: Include all fonts used in your project; both screen and printer fonts are needed when using postscript fonts or if your using illustrator or indesign convert your text to outlines to prevent any defaults.</p>

<p>Linked Graphics: Be sure to include all of your placed / imported images when you send your artwork.  Missing graphics and fonts can cause your job to be delayed.</p>

<h3>Resolution:</h3>
<ul>
<li>Rasterized art should be at least 300 dpi.</li>
<li>Final resolution of scanned color or grayscale images should be 400 dpi. </li>
<li>Line art should be 1200 dpi.</li>
</ul>

<h3>Document Size / Printable Areas:</h3>
<ul>
    <li>Set your document page size to the final size of your printed page.  Avoid manually drawn crop marks.</li>
    <li>Extend bleeds at least 1/8” past page edges.</li>
    <li>It is recommended to keep non-bleeding items at least 1/4" from any edge or folding area.</li>
	<li>Please refer to the  <a href="templates.php" title="templates">templates section</a></li>
</ul>
<h3>Color Management:</h3>
<ul>
	<li>All files should be set up as CMYK color (not RGB as RGB color may drastically change).</li>
</ul>

<h3>Spot Color Documents:</h3>
<ul>
	<li>Specify Pantone Matching System (PMS) colors.</li>
	<li>Delete all unused colors in your documents; be sure the rest are defined as spot colors.</li>
	<li>Be sure the colors defined in your graphic files match those in the document.</li>
</ul>

<h3>Process Color Documents:</h3>

<ul>
	<li>Delete all unused colors in your documents; be sure the rest are defined as process colors.</li>
	<li>Be sure all placed graphics are CMYK.  Double check any embedded bitmaps.</li>
</ul>

<h3>Halftones and Tints:</h3>
<ul>
    <li>Attempting to achieve a color with halftones or gradients is not recommended (screening back PMS colors by changing the opacity or transparency).  Selecting a solid spot color will result in more accurate printing.</li>
    <li>Gradients will result in banding.  Avoid gradients if banding is not acceptable.</li>
    <li>Avoid using halftone fonts; the print quality is much cleaner if solid colors are applied.</li>
</ul>

<h3>Sending DigiPrint Your Artwork:</h3>
<p>DigiPrint Products offers an online ordering system where you can preview your artwork on the product you are choosing to order. Once you approve the layout and position of your artwork follow the directions to complete your online order.</p>
<ul>
	<li>Please use your company name and order number to identify your file.</li>
	<li>Upload your files to our site using the “file upload” feature on our website.</li>
	<li>E-mail attachments may be compressed/zipped using Stuffit or other compression software.</li>
	<li>Total size of all attachments per e-mail should be under 10 MB.  Files larger than 35 MB should be delivered via optical media (CD-R or DVD) or USB drive.</li>
</ul>

<p>Please e-mail artwork and/or copy to:  <a href="mailto:artwork@digiprintproducts.com" title="Mail Artwork">artwork@digiprintproducts.com</a></p>

<h3>Questions?</h3>

<p>If you have further questions, please contact the DigiPrint Products Artwork department at 877-215-2155 .</p>

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
