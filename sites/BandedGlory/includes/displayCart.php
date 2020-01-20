<?php
session_start();
ob_start();

//print_r($_SESSION);
  if (isset($_SESSION)) { //Checks if action value exists
      $return = $_SESSION;
      $return["items"] = $_SESSION["items"];
		  //Do what you need to do with the info. The following are some examples.
		  //if ($return["favorite_beverage"] == ""){
		  //  $return["favorite_beverage"] = "Coke";
		  //}
		  //$return["favorite_restaurant"] = "McDonald's";

		  $return["json"] = json_encode($return["items"]);
  		echo json_encode($return["items"]);
	}
?>
