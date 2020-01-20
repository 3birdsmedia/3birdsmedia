<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
include("../includes/functions.php");

if (!isset($_SESSION['adminloggedin'])) {
	header('Location: ../index.php');
	exit;
}else{
nukeMagicQuotes();
//print_r($_SESSION);

//once there is no more images in the session then let the user know that there is no more images
if (empty($_SESSION['batch']['name']) ){
	$confirm = "All your images have been cropped and uploaded, you can <a href='prod_input.php'>add a new product<a/>, go back to the <a href='prod_list.php'>Product List or <a href='admin.php'>Control Panel</a>";


}else{
	
	$folder = 'images/products/';
	//assign the filename to a variable
	$filename = $_SESSION['batch']['name'][0];
	//if (!empty($_SESSION['batch']['name'][1])){ $second_file = $_SESSION['batch']['name'][1];}
	$orig_w = 450;
	
	$orig_h = $_SESSION['batch']['height'][0];
	//if (isset($_SESSION['batch']['height'][1])){ $second_height = $_SESSION['batch']['height'][1];}
	
	$targ_w = 200;
	$targ_h = 150;
	
	$ratio = $targ_w / $targ_h;
	
	if( isset($_POST['submit']))
	{	
		$src = imagecreatefromjpeg($folder.$filename);
	
		$tmp = imagecreatetruecolor($targ_w, $targ_h);
		imagecopyresampled($tmp, $src, 0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
		imagejpeg($tmp, $folder.$filename,100);
		
		imagedestroy($tmp);
		imagedestroy($src);
		
		$msg = '<h2>Saved Image</h2><img src="'.$folder.$filename.'"/>';
		array_shift($_SESSION['batch']['name']);
		array_shift($_SESSION['batch']['height']);
		
	}
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta name="generator" content="InstantBlueprint.com - Create a web project framework in seconds." />
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>SA RECYCLING -Product Add</title>
 <meta name="description" content="Add your sites description here" />
 <meta name="keywords" content="Add,your,site,keywords,here" />
  <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
  <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
  <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.Jcrop.pack.js"></script>

<script type="text/javascript">
function updateCoords(c){
	showPreview(c);
	$("#x").val(c.x);
	$("#y").val(c.y);
	$("#w").val(c.w);
	$("#h").val(c.h);
}
		
function showPreview(coords){
	var rx = <?php echo $targ_w;?> / coords.w;
	var ry = <?php echo $targ_h;?> / coords.h;
		
	$("#preview img").css({
		width: Math.round(rx*<?php echo $orig_w;?>)+'px',
		height: Math.round(ry*<?php echo $orig_h;?>)+'px',
		marginLeft:'-'+  Math.round(rx*coords.x)+'px',
		marginTop: '-'+ Math.round(ry*coords.y)+'px'
	});
}

$(function(){
	$('#cropbox').Jcrop({
		aspectRatio: <?php echo $ratio?>,
		setSelect: [0,0,<?php echo $orig_w.','.$orig_h;?>],
		onSelect: updateCoords,
		onChange: updateCoords
	});
});

</script>

<style type="text/css">
#preview{
	width: <?php echo $targ_w ?>px;
	height: <?php echo $targ_h ?>px;
	overflow:hidden;
}
</style>

</head>

<body>
<!-- Start: Center Wrap -->
<div id="wrapper">

<!-- Start: header -->
<div id="header">
	
</div><!-- End: header -->


<!-- Start: content -->
<div id="content">
           <div id="lef-cont">
  
<?php
	//print_r($_SESSION);
		if (isset($confirm)){echo $confirm;}elseif(isset($msg)) {echo $msg;}else{
		echo' Thumb Preview:
					<div id="preview">
						<img src="images/products/'.$filename.'" alt="thumb" />
					</div>';
		
		}
	
	?>
		</div>
    
    <div id="right-cont">


	
<?
if (!isset($msg)){
		
	 if(isset($filename)){
		echo '<table>
			<tr>
				<td>
					<img src="images/products/'.$filename.'" id="cropbox" alt="cropbox" />
					
				</td>
				<td>
					
				</td>
			</tr>
		</table>
		
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<p>
				<input type="hidden" id="x" name="x" />
				<input type="hidden" id="y" name="y" />
				<input type="hidden" id="w" name="w" />
				<input type="hidden" id="h" name="h" />
				<input class="submit" type="submit" id="submit" name="submit" value="Crop Image!" />
			</p>
	</form>';
	 }
}else{
	echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<p>	<input type="submit" id="next" name="next" value="Next Image" />
			</p>
	</form>';
}
?>
	</div>
	
</div>  

<div id="push"></div>
</div><!-- End: content -->


<!-- Start: footer -->
<div id="footer">
	
</div><!-- End: footer -->

</div><!-- End: Center Wrap -->