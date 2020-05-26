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

		if (!$toggleMode) {
			$toggleMode = true;
			setCookiePost('toggleMode');
		} else {
			$toggleMode = false;
			setCookiePost('toggleMode');
		}

	}

	if ($formType == "settingsToggleClock") {

		$toggleClock = $g->findCookie('toggleClock');

		if (!$toggleClock) {
			$toggleClock = true;
			setCookiePost('toggleClock');
		} else {
			$toggleClock = false;
			setCookiePost('toggleClock');
		}
	}

	if ($formType == "settingsToggleBreadcrumb") {

		$toggleBreadcrumb = $g->findCookie('toggleBreadcrumb');

		if (!$toggleBreadcrumb) {
			$toggleBreadcrumb = true;
			setCookiePost('toggleBreadcrumb');
		} else {
			$toggleBreadcrumb = false;
			setCookiePost('toggleBreadcrumb');
		}
	}

	if ($formType == "settingsToggleBackgroundLogo") {

		$toggleBackgroundLogo = $g->findCookie('toggleBackgroundLogo');

		if (!$toggleBackgroundLogo) {
			$toggleBackgroundLogo = true;
			setCookiePost('toggleBackgroundLogo');
		} else {
			$toggleBackgroundLogo = false;
			setCookiePost('toggleBackgroundLogo');
		}
	}

	if ($formType == "settingsToggleHints") {

		$toggleHints = $g->findCookie('toggleHints');

		if (!$toggleHints) {
			$toggleHints = true;
			setCookiePost('toggleHints');
		} else {
			$toggleHints = false;
			setCookiePost('toggleHints');
		}
	}

	if ($formType == "settingsToggleFooter") {

		$toggleFooter = $g->findCookie('toggleFooter');

		if (!$toggleFooter) {
			$toggleFooter = true;
			setCookiePost('toggleFooter');
		} else {
			$toggleFooter = false;
			setCookiePost('toggleFooter');
		}
	}

	if ($formType == "settingsToggleLiveVisitorCounter") {

		$toggleLiveVisitorCounter = $g->findCookie('toggleLiveVisitorCounter');

		if (!$toggleLiveVisitorCounter) {
			$toggleLiveVisitorCounter = true;
			setCookiePost('toggleLiveVisitorCounter');
		} else {
			$toggleLiveVisitorCounter = false;
			setCookiePost('toggleLiveVisitorCounter');
		}
	}

	if ($formType == "settingsCharacter") {

		$name = $_POST['name'];
		$rank = $_POST['rank'];
		$badge = $_POST['badge'];
		setCookiePost('officerName');
		setCookiePost('officerRank');
		setCookiePost('officerBadge');

	}

	function setCookiePost($input) {

		global	$toggleMode,
				$toggleClock,
				$toggleBreadcrumb,
				$toggleBackgroundLogo,
				$toggleHints,
				$toggleFooter,
				$toggleLiveVisitorCounter,
				$name,
				$rank,
				$badge;

		$cPath = "/";
		$iTime = 2147483647;

		switch($input) {
			case 'toggleMode':
				$cookie = $toggleMode;
				break;
			case 'toggleClock':
				$cookie = $toggleClock;
				break;
			case 'toggleBreadcrumb':
				$cookie = $toggleBreadcrumb;
				break;
			case 'toggleBackgroundLogo':
				$cookie = $toggleBackgroundLogo;
				break;
			case 'toggleHints':
				$cookie = $toggleHints;
				break;
			case 'toggleFooter':
				$cookie = $toggleFooter;
				break;
			case 'toggleLiveVisitorCounter':
				$cookie = $toggleLiveVisitorCounter;
				break;
			case 'officerName':
				$cookie = $name;
				break;
			case 'officerRank':
				$cookie = $rank;
				break;
			case 'officerBadge':
				$cookie = $badge;
				break;
			default:
				break;

		}

		return setcookie($input,$cookie,$iTime,$cPath);

	}







?>