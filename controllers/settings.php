<?php
	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/initialise.php';

	// Initialise Variables
	$formType = $_POST['type'];

	if ($formType == "settingsClearCookies") {

		$g->clearCookies();
		
	}

	if ($formType == "settingsToggleMode") {

		$toggleMode = $g->findCookie('toggleMode');

		if (!$toggleMode) {
			$toggleMode = true;
		} else {
			$toggleMode = false;
		}

		setCookiePost('toggleMode', $toggleMode);

	}

	if ($formType == "settingsToggleClock") {

		$toggleClock = $g->findCookie('toggleClock');

		if (!$toggleClock) {
			$toggleClock = true;
		} else {
			$toggleClock = false;
		}

		setCookiePost('toggleClock', $toggleClock);

	}

	if ($formType == "settingsToggleBreadcrumb") {

		$toggleBreadcrumb = $g->findCookie('toggleBreadcrumb');

		if (!$toggleBreadcrumb) {
			$toggleBreadcrumb = true;
		} else {
			$toggleBreadcrumb = false;
		}

		setCookiePost('toggleBreadcrumb', $toggleBreadcrumb);

	}

	if ($formType == "settingsToggleBackgroundLogo") {

		$toggleBackgroundLogo = $g->findCookie('toggleBackgroundLogo');

		if (!$toggleBackgroundLogo) {
			$toggleBackgroundLogo = true;
		} else {
			$toggleBackgroundLogo = false;
		}

		setCookiePost('toggleBackgroundLogo', $toggleBackgroundLogo);

	}

	if ($formType == "settingsToggleHints") {

		$toggleHints = $g->findCookie('toggleHints');

		if (!$toggleHints) {
			$toggleHints = true;
		} else {
			$toggleHints = false;
		}

		setCookiePost('toggleHints', $toggleHints);

	}

	if ($formType == "settingsToggleFooter") {

		$toggleFooter = $g->findCookie('toggleFooter');

		if (!$toggleFooter) {
			$toggleFooter = true;
		} else {
			$toggleFooter = false;
		}

		setCookiePost('toggleFooter', $toggleFooter);

	}

	if ($formType == "settingsToggleLiveVisitorCounter") {

		$toggleLiveVisitorCounter = $g->findCookie('toggleLiveVisitorCounter');

		if (!$toggleLiveVisitorCounter) {
			$toggleLiveVisitorCounter = true;
		} else {
			$toggleLiveVisitorCounter = false;
		}

		setCookiePost('toggleLiveVisitorCounter', $toggleLiveVisitorCounter);

	}

	if ($formType == "settingsCharacter") {

		setCookiePost('officerName', $_POST['name']);
		setCookiePost('officerRank', $_POST['rank']);
		setCookiePost('officerBadge', $_POST['badge']);

	}

	function setCookiePost($inputCookie, $inputVariable) {

		global	$g;

		return setcookie($inputCookie,$inputVariable,2147483647,"/",$g->getSettings('site-url'),$g->getSettings('site-live'));

	}

