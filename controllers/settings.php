<?php
	
	session_start();
	require '../models/general.php';
	$g = new General();

	// Initialise Variables
	$formType = $_POST['type'];

	if ($formType == "settingsClearCookies") {

		$g->clearCookies();
		
	}

	if ($formType == "settingsToggleMode") {

		$toggleMode = $g->findCookie('toggleMode');

		if ($toggleMode == false) {
			$toggleMode = true;
			setcookie("toggleMode",$toggleMode,2147483647,"/");
		} else {
			$toggleMode = false;
			setcookie("toggleMode",$toggleMode,2147483647,"/");
		}

	}

	if ($formType == "settingsToggleClock") {

		$toggleClock = $g->findCookie('toggleClock');

		if ($toggleClock == false) {
			$toggleClock = true;
			setcookie("toggleClock",$toggleClock,2147483647,"/");
		} else {
			$toggleClock = false;
			setcookie("toggleClock",$toggleClock,2147483647,"/");
		}
	}

	if ($formType == "settingsToggleBreadcrumb") {

		$toggleBreadcrumb = $g->findCookie('toggleBreadcrumb');

		if ($toggleBreadcrumb == false) {
			$toggleBreadcrumb = true;
			setcookie("toggleBreadcrumb",$toggleBreadcrumb,2147483647,"/");
		} else {
			$toggleBreadcrumb = false;
			setcookie("toggleBreadcrumb",$toggleBreadcrumb,2147483647,"/");
		}
	}

	if ($formType == "settingsToggleBackgroundLogo") {

		$toggleBackgroundLogo = $g->findCookie('toggleBackgroundLogo');

		if ($toggleBackgroundLogo == false) {
			$toggleBackgroundLogo = true;
			setcookie("toggleBackgroundLogo",$toggleBackgroundLogo,2147483647,"/");
		} else {
			$toggleBackgroundLogo = false;
			setcookie("toggleBackgroundLogo",$toggleBackgroundLogo,2147483647,"/");
		}
	}

	if ($formType == "settingsToggleHints") {

		$toggleHints = $g->findCookie('toggleHints');

		if ($toggleHints == false) {
			$toggleHints = true;
			setcookie("toggleHints",$toggleHints,2147483647,"/");
		} else {
			$toggleHints = false;
			setcookie("toggleHints",$toggleHints,2147483647,"/");
		}
	}

	if ($formType == "settingsToggleFooter") {

		$toggleFooter = $g->findCookie('toggleFooter');

		if ($toggleFooter == false) {
			$toggleFooter = true;
			setcookie("toggleFooter",$toggleFooter,2147483647,"/");
		} else {
			$toggleFooter = false;
			setcookie("toggleFooter",$toggleFooter,2147483647,"/");
		}
	}

	if ($formType == "settingsToggleLiveVisitorCounter") {

		$toggleLiveVisitorCounter = $g->findCookie('toggleLiveVisitorCounter');

		if ($toggleLiveVisitorCounter == false) {
			$toggleLiveVisitorCounter = true;
			setcookie("toggleLiveVisitorCounter",$toggleLiveVisitorCounter,2147483647,"/");
		} else {
			$toggleLiveVisitorCounter = false;
			setcookie("toggleLiveVisitorCounter",$toggleLiveVisitorCounter,2147483647,"/");
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