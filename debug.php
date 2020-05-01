<?php

	/*
	echo '<pre>';
		var_dump($VARIABLE);
	echo '</pre>';
	*/

	$var = "Success!";

	$message = $var ?: "Empty!";
	echo $message;

	$test = array();
	$test = array_values(array_filter($test));

	if (empty($test) == false) {
		var_dump($test);
	}

?>
