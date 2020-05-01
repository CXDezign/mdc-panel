<?php

	/*
	echo '<pre>';
		var_dump($VARIABLE);
	echo '</pre>';
	*/

	$var = "Success!";

	$message = $var ?: "Empty!";
	echo $message;

?>
