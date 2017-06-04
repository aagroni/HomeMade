<?php

	function validateFormData($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}
	
	function formaturl($data)
	{
		$data = str_replace(' ', '-', $data);
		$data = str_replace("'", '-', $data);
		$data = str_replace('?', '', $data);
		return $data;
	}

	function gjinia($data)
	{
		if ($data == 'M') {
			return 'Male';
		} else {
			return 'Female';
		}
	}

	function dateFormat ($date) {
		$data = date("F D, Y", strtotime($date));
		$time = date("H:i", strtotime($date));

		echo "<span class='glyphicon glyphicon-time'></span> Posted on $data at $time";
	}

	//I Largon ' ( ) e i ruhen si entitente ne db p.sh &#039
	// function validateFormData($data){
	// 	$data = trim( stripslashes( htmlspecialchars( strip_tags( str_replace( array(
	// 		'(',')'), '', $data)), ENT_QUOTES )));
	// 	return $data;
	// }

	// function setActive($name) {
	// 	global $pageName;
	// 	if ($pageName == $name) {
	// 		echo "class='active'";
	// 	}
	// }	


?>