<?php

	/*echo '<pre>';
		var_dump($VARIABLE);
	echo '</pre>';*/

	$inputNotes = "Hi World";
	$notes = (empty($inputNotes)) ? 'N/A' : $inputNotes;

	$inputNotes2 = null;
	$notes2 = (empty($inputNotes2)) ? 'N/A' : $inputNotes2;

	echo $notes;
	echo "<br>";
	echo $notes2;

?>
