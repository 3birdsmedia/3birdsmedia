<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page

include('../includes/functions.php');


if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;
}else{
nukeMagicQuotes();
//print_r($_POST);
	if (isset($_GET['prod_id']) && !$_POST) {



			$conn = dbConnect('query');
			$prod_id = $_GET['prod_id'];
			
			//prepare first SQL query, category_id not included
			$sql = "SELECT *
				FROM prod_cat_lookup, products, categories
				WHERE products.prod_id = ?
				AND prod_cat_lookup.prod_id = products.prod_id
				AND prod_cat_lookup.cat_id = categories.cat_id
				ORDER BY products.prod_id";
					
			//initialize statement
			$stmt = $conn->stmt_init();
			
			if ($stmt->prepare($sql)) {
				//bind the query parameters
				$stmt->bind_param('i', $_GET['prod_id']);
				
				//bind the results to variables
				$stmt->bind_result($prod_id, $cat_id, $prod_id, $prod_name, $prod_desc,  $price, $disk, $cat_id, $cat_name, $cat_desc);
				
				//execute the query, and get the result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
				
			}
			
			$sql2 = "SELECT *
				FROM prod_img_lookup, products, images
				WHERE products.prod_id = ?
				AND prod_img_lookup.prod_id = products.prod_id
				AND prod_img_lookup.img_id = images.img_id
				ORDER BY products.prod_id";
					
			//initialize statement
			$stmt2 = $conn->stmt_init();
			
			if ($stmt2->prepare($sql2)) {
				//bind the query parameters
				$stmt2->bind_param('i', $_GET['prod_id']);
				
				//bind the results to variables
				$stmt2->bind_result($prod_id, $img_id, $prod_id, $prod_name, $prod_desc,  $price, $disk, $img_id, $img_name, $img_url);
				
				//execute the query, and get the result
				$done = $stmt2->execute();
				$stmt2->fetch();
				//free the result to get ready for the next query
				$stmt2->free_result();
			}
			
			
		} //end of if isset() for $_GET
	
//START THE LOOP FOR UPDATE!
		
		//print_r ($_POST);
		//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  
		//and it will be changed to 1 if an errro occures.  
		//If the error occures the file will not be uploaded.
		 $errors=0;
		 

		//checks if the form has been submitted
		 if(isset($_POST['submit'])) {
			$prod_id = $_POST['prod_id'];
			$prod_name = stripcslashes($_POST['prod_name']);
			$price = $_POST['price'];
			$prod_desc = stripcslashes($_POST['prod_desc']);
			$disks = $_POST['disks'];
			$cat_id = $_POST['cat_id'];
		//	$img_id = $_POST['img_id'];
			
				 
				$conn = dbConnect('admin');
				//FLagg it up!
				$done = false;
				$price = str_replace('$', '', $_POST['price']);		
				//create database connection ADMIN		
				//create SQL 
				$sql3 = 'UPDATE products
					SET prod_name = ?, price = ?, prod_desc =?, disks =?
					WHERE prod_id = ?';
				
				//initialize prepared statement
				$stmt = $conn->stmt_init();
				$stmt->prepare($sql3);
					//bind parameters and execute statement
					
					$stmt->bind_param('sisii', $prod_name, $price, $prod_desc, $disks, $prod_id);
					$done = $stmt->execute();
					// free the statement for the next query
					$stmt->free_result();
					
				$lookupSql = 'UPDATE prod_cat_lookup
					SET cat_id = ?
					WHERE prod_id = ?';
				
				//initialize prepared statement
				$stmt = $conn->stmt_init();
				$stmt->prepare($lookupSql);
					//bind parameters and execute statement
					
					$stmt->bind_param('ii', $_POST['cat_id'], $prod_id);
					$done = $stmt->execute();
					// free the statement for the next query
			
				$stmt->free_result();
	//		echo $prod_id;
			$dltSql = "DELETE FROM prod_chain_lookup WHERE prod_id = ?";
			//initialize statement
			$stmt1 = $conn->stmt_init();
			if ($stmt1->prepare($dltSql)) {
				$stmt1->bind_param('i', $prod_id);
				$deleted = $stmt1->execute();
	//			echo $deleted.'hola';

			}
			
		if (isset($_POST['chain'])){	
			foreach ($_POST['chain'] as $key => $value) {
	//		echo '<br />key'.$key;
	//		echo $value.' value';
			
	
			$chainSql = 'INSERT INTO prod_chain_lookup (prod_id, chain_id)
						VALUES (?,?)';
				
				//initialize statement       
				$stmt = $conn->stmt_init();
					
				if ($stmt->prepare($chainSql)) {
				//bind the perameters
				$stmt->bind_param('ii', $prod_id, $value);
				$OK = $stmt->execute();
		//		if ($OK){echo "inserted";}else{echo "fail";}
				}
			}
		}
				
	}
	
	//If no errors registred, print the success message
	if(isset($_POST['submit']) && !$errors) {
				$msg = "<h2>The updates have been saved!</h2>
				<h3>Go Back to the <a href='admin.php'>Control Panel</a> or the <a href='prod_list.php'>Product List</a><h3>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="stylesheet.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="../js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript">
$().ready(function() {
	// validate the comment form when it is submitted
	$("#insert").validate();
});
</script>
<title>Update <?php echo $prod_name; ?></title>
</head>

<body>

<div id='wrap'>
    <a href="admin.php"><div id="header">
    </div></a>
    <span class="logout"><a href="logout.php">Logout</a></span>
    
<?php
	//if the form has been submitted, display result
        if (isset($msg)) {
        echo "<div id='msg'>$msg</div>";
        }else{
		echo "<h2>Update $prod_name</h2>";
	}
?>
    <form id="insert" name="insert" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">    
					<p><label for="prod_name">Name:</label></p>
					<p><input name="prod_name" id="prod_name" type="text" size="50" maxlength="50" class="required" value='<?php if (isset($prod_name)){echo ucfirst($prod_name);} ?>' /></p>

<!-- dynamically build the drop down list for categories-->
					<?php						
						$sql = "SELECT * FROM categories";  //select only those fields we need
					
						//submit the SQL query to the database and get the result
						$result = $conn->query($sql) or die(mysqli_error());
					?>
					<label for="cat_id">Select a new category for the product</label>
					<select name="cat_id" id="cat_id">
           			 <?php
					while ($row = $result->fetch_assoc()) {
						$cat_folder = $row['folder'];
						if ($cat_id == $row['cat_id']) {
							$cat_name = $row['cat_name'];
							echo  '<option selected value="'.$row['cat_id'] .'">' . $row['cat_name'] .'</option>';
						}else{
							$cat_name = $row['cat_name'];
							echo '<option value="'.$row['cat_id'] .'">' . $row['cat_name'] .'</option>';
						}
					}	//now that we are finished with the resuls set, release the db resources to allow a new query.
					$result->free_result();
				?>
					</select></p>
					<p><label for="price">Can you upgrade the disks?:</label></p>
					<p><select name="disks" id="disks">
						<?php if ($disks == 0){
							echo 	'<option value="0"> NO </option>
								<option value="1"> YES </option>';
						}else{
							echo	'<option value="1"> YES </option>
								<option value="0"> NO </option>';
						}?>
					</select>
					
					
					<p><label for="price">Price: <span style="font-style:italic;font-size:12px;">(numeric value only i.e. '60.66')</span></label></p>
					<p><input name="price" id="price" type="text" size="50" maxlength="6" class="required" value="<?php if (isset($price)){echo $price;} ?>" />	
                    </p>
					<p><label for="prod_desc">Describe the product:</label></p>
					<p><textarea cols="60" rows="25" name="prod_desc" id="prod_desc" class="required"><?php if (isset($prod_desc)){echo $prod_desc;} ?></textarea>    
			</p>		
					<label>Select what chain lengths apply to this product</label>
					<?php $sql3 = "SELECT length
							FROM prod_chain_lookup, products, chains
							WHERE products.prod_id = $prod_id
							AND prod_chain_lookup.prod_id = products.prod_id
							AND prod_chain_lookup.chain_id = chains.chain_id
							ORDER BY products.prod_id";
				
						$result = $conn->query($sql3) or die(mysqli_error());
						$lenghts = array();
						while ($row = $result->fetch_assoc()) {
								array_push($lenghts, $row['length']);
						}
					//print_r ($lenghts);
						$chainSql = "SELECT * FROM chains";
						$resultChain = $conn->query($chainSql) or die(mysqli_error());
					while ($row = $resultChain->fetch_assoc()) {
						if (in_array($row['length'], $lenghts)){
						echo '<label class="checkLabel">'.$row['length'].'</label><input class="check" type="checkbox" value="'.$row['chain_id'].'" name="chain[]" checked/>';
					}else{
						echo '<label class="checkLabel">'.$row['length'].'</label><input class="check" type="checkbox" value="'.$row['chain_id'].'" name="chain[]" />';
						}	
					}
					
					?>
					
					
					<input type="hidden" id="prod_id" name="prod_id" value="<?php if (isset($prod_id)){echo $prod_id;} ?>" />
					<p><input class="submit" id="submit" type="submit" name="submit" value="Save Changes" /></p>
				</form> 
						

				
				    
				<?php dbClose($conn);?>
				
				
				

<!--END CONTENT-->		
  

         </div>   
</body>
</html>
