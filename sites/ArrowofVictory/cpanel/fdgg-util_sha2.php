<?php 
	$storename = "1909308895";
	// Replace with your Storenumber here 
	$sharedSecret = "31323038383737303036343738313438323039313734303135373334323330383737303435363032333938303333313733323037393736373230333939303637"; 
	//Replace with your Shared Secret here
	/* If you have below PHP version 5.1 OR Don't want to set the Default TimeZone, then you have to do the following changes to set
	 your server timeZone: Example: If your server is in "PST" timezone, here are the changes: 
	 //date_default_timezone_set("Asia/Calcutta"); 
	 // Comment this line $timezone = "PST" 
	 // change to your server timeZone */
	 
	 date_default_timezone_set("America/Los_Angeles"); 
	 $timezone = "PST"; 
	 /* ---- */ 
	 $dateTime = date("Y:m:d-H:i:s"); 
	 function getDateTime() { 
	 	global $dateTime; 
		return $dateTime; 
	} 
	
	function getTimezone() { 
		global $timezone; 
		return $timezone; 
	} 
	
	function getStorename() { 
		global $storename; 
		return $storename; 
	} 
	function createHash($chargetotal) { 
		global $storename, 
		$sharedSecret; 
		$str = $storename . getDateTime() . $chargetotal . $sharedSecret;
		for ($i = 0; $i < strlen($str); $i++){
			$hex_str.=dechex(ord($str[$i]));
		} return hash('sha256', $hex_str); 
	} 
?>