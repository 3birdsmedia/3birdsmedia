<?php

function create_pagination($start_number = 0, $item_per_page = 2, $count){
	//Creates the pagination
	$current_page = $_SERVER["PHP_SELF"];
	
		if (($start_number < 0) || (is_numeric($start_number))){
			$start_number = 0;
		}
		
		$pagination
}





?>