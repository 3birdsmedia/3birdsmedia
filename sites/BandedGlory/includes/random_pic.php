<?php function randPicture(){
	include ('connection.php');
	//connecting to database
	$conn= dbConnect('query');
	
	//preparing sql statement
	$sql= 'SELECT * FROM images
		ORDER by RAND()
		LIMIT 1';
	       
	//adding the result to a variable
	$result= $conn->query($sql) or die(mysqli_error());
	
		while ($numPics = $result->fetch_assoc()){
			echo $numPics['image_name'];
		}
	};
?>
	
	<img src="images/<?php randPicture();?>" width="500"/>
			       
<?php 
	
	
/*
 
 PHP + XML randomize pic tutorial
 
 //Assings a variable to the file name
$xmlName = "adds/adds.xml";
//looking for the xml file
if ( file_exists ($xmlName) ) {
	$xml = simplexml_load_file($xmlName);
} else {
	//if not there, echos this message
	exit ("File Not Found");
}

//Assingnig a variable to the file folder inside the xml file
$folder = $xml["folder"];
//how many adds are there?
$adds = count($xml);
//this is to randomize the order of adds
			//minimun number, -1 cause the count starts at zero
$rand = rand(0,&adds -1);

//Var for the id
$id = $xml->ad[$random]["id"];
//Var for the .format
$format = $xml->ad[$random]["format"];
//Var for the webaddres where the link will lead us
$link = $xml->ad[$random]["link"];

//Load the image based on the XML file
$image = "adds/".$folder."/".$id."_".$folder.".$format";
*/

?>