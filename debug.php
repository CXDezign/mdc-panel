<?php

	/*
	echo '<pre>';
		var_dump($VARIABLE);
	echo '</pre>';
	*/

	$ip = "192.168.1.1";

	$int = ip2long($ip);
	$str = long2ip($int);

	echo $int;
	echo "<br>";
	echo $str;

?>
