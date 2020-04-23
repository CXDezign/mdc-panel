<?php
	
	session_start();
	require '../models/general.php';
	$g = new General();

	// Initialise Variables
	$formType = $_POST['type'];

	if ($formType == "settingsToggleMode") {

		$toggleMode = $g->cookieToggleMode();

		if ($toggleMode == false) {
			$toggleMode = true;
			setcookie("toggleMode",$toggleMode,2147483647,"/");
		} else {
			$toggleMode = false;
			setcookie("toggleMode",$toggleMode,2147483647,"/");
		}

	}

	if ($formType == "settingsToggleClock") {

		$toggleClock = $g->cookieToggleClock();

		if ($toggleClock == false) {
			$toggleClock = true;
			setcookie("toggleClock",$toggleClock,2147483647,"/");
		} else {
			$toggleClock = false;
			setcookie("toggleClock",$toggleClock,2147483647,"/");
		}
	}

	if ($formType == "settingsToggleBreadcrumb") {

		$toggleBreadcrumb = $g->cookieToggleBreadcrumb();

		if ($toggleBreadcrumb == false) {
			$toggleBreadcrumb = true;
			setcookie("toggleBreadcrumb",$toggleBreadcrumb,2147483647,"/");
		} else {
			$toggleBreadcrumb = false;
			setcookie("toggleBreadcrumb",$toggleBreadcrumb,2147483647,"/");
		}
	}

	if ($formType == "settingsCharacter") {

		$name = $_POST['name'];
		$rank = $_POST['rank'];
		$badge = $_POST['badge'];
		setcookie("officerName",$name,2147483647,"/");
		setcookie("officerRank",$rank,2147483647,"/");
		setcookie("officerBadge",$badge,2147483647,"/");
	}

?>