<?php
	$cat = $_GET['cat'];
	$folder = '../images/';
	$filename = $_GET['filename'];
	$orig_w = 530;
	$orig_h = $_GET['height'];
	
	$targ_w = 530;
	$targ_h = 169;
	
	$ratio = $targ_w / $targ_h;
	
	if( isset($_POST['submit']))
	{	
		$src = imagecreatefromjpeg($folder.$filename);
	
		$tmp = imagecreatetruecolor($targ_w, $targ_h);
		imagecopyresampled($tmp, $src, 0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
		imagejpeg($tmp, $folder.$filename,100);
		
		//imagedestroy($tmp);
		//imagedestroy($src);
		
		$msg = '<h1>Saved Thumbnail</h1><img src="../images/'.$filename.'"/><h2><a href="home_list.php">Go back to the Home Update Page</a></h2>' ;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Crop your image to the desired look</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	

<link href="stylesheet.css" rel="stylesheet" type="text/css" media="screen">
	<script type="text/javascript" src="../js/jquery-1.5.1.js"></script>
	<script type="text/javascript" src="../js/jquery.Jcrop.pack.js"></script>
	<link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />
	<script type="text/javascript">
		$(function(){
			$('#cropbox3').Jcrop({
				aspectRatio: <?php echo $ratio?>,
				setSelect: [0,0,<?php echo $orig_w.','.$orig_h;?>],
				onSelect: updateCoords,
				onChange: updateCoords,
				boxWidth: 570
			});
		});
		
		function updateCoords(c)
		{
			showPreview(c);
			$("#x").val(c.x);
			$("#y").val(c.y);
			$("#w").val(c.w);
			$("#h").val(c.h);
		}
		
		function showPreview(coords)
		{
			var rx = <?php echo $targ_w;?> / coords.w;
			var ry = <?php echo $targ_h;?> / coords.h;
			
			$("#preview img").css({
				width: Math.round(rx*<?php echo $orig_w;?>)+'px',
				height: Math.round(ry*<?php echo $orig_h;?>)+'px',
				marginLeft:'-'+  Math.round(rx*coords.x)+'px',
				marginTop: '-'+ Math.round(ry*coords.y)+'px'
			});
		}
	</script>
	<style type="text/css">
		#preview
		{
			width: <?php echo $targ_w?>px;
			height: <?php echo $targ_h?>px;
			overflow:hidden;
		}
	</style>
</head>

<body>

<div id='wrap'>
    <a href="admin.php"><div id="header">
    </div></a>

<?php
	//if the form has been submitted, display result
        if (isset($msg)) {
        echo "<div id='msg'>$msg</div>";
        }else{
		echo "<h2>Update your Headshot</h2>
			<table>
			<tr>
				<td>
					<img src='../images/$filename'  id='cropbox3' alt='cropbox3' />
					
				</td>
				<td>
					Thumb Preview:
					<div id='preview'>
						<img src='../images/$filename' alt='thumb' />
					</div>
				</td>
			</tr>
		</table>
		
		<form action='";echo $_SERVER['REQUEST_URI'];echo "' method='post'>
			<p>
				<input type='hidden' id='x' name='x' />
				<input type='hidden' id='y' name='y' />
				<input type='hidden' id='w' name='w' />
				<input type='hidden' id='h' name='h' />
				<input class='submit' type='submit' id='submit' name='submit' value='Crop Image!' />
			</p>
		</form>";
	} ?>
	</body>
</html>
