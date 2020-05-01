<?php

class General {

	public function getVersion() {

		return '1.9.5';
	}

	public function getDate() {

		$unix = time();
		$date = date("d/M/Y", $unix);
		return $date;
	}

	public function getTime() {

		$unix = time();
		$time = date("H:i", $unix);
		return $time;
	}

	// COOKIES

	public function clearCookies() {

		unset($_COOKIE['toggleMode']);
		unset($_COOKIE['toggleClock']);
		unset($_COOKIE['toggleBreadcrumb']);
		unset($_COOKIE['toggleBackgroundLogo']);
		unset($_COOKIE['toggleHints']);
		unset($_COOKIE['toggleFooter']);
		unset($_COOKIE['toggleLiveVisitorCounter']);
		unset($_COOKIE['officerName']);
		unset($_COOKIE['officerRank']);
		unset($_COOKIE['officerBadge']);
		unset($_COOKIE['callSign']);
		unset($_COOKIE['defName']);
		unset($_COOKIE['inputTDPatrolReportURL']);
		setcookie('toggleMode', false, -1, '/');
		setcookie('toggleClock', false, -1, '/');
		setcookie('toggleBreadcrumb', false, -1, '/');
		setcookie('toggleBackgroundLogo', false, -1, '/');
		setcookie('toggleHints', false, -1, '/');
		setcookie('toggleFooter', false, -1, '/');
		setcookie('toggleLiveVisitorCounter', false, -1, '/');
		setcookie('officerName', null, -1, '/');
		setcookie('officerRank', null, -1, '/');
		setcookie('officerBadge', null, -1, '/');
		setcookie('callSign', null, -1, '/');
		setcookie('defName', null, -1, '/');
		setcookie('inputTDPatrolReportURL', null, -1, '/');

	}

	public function cookieToggleMode() {

		if (isset($_COOKIE['toggleMode'])) {
			return $_COOKIE['toggleMode'];
		} else {
			return false;
		}

	}

	public function cookieToggleClock() {

		if (isset($_COOKIE['toggleClock'])) {
			return $_COOKIE['toggleClock'];
		} else {
			return false;
		}

	}

	public function cookieToggleBreadcrumb() {

		if (isset($_COOKIE['toggleBreadcrumb'])) {
			return $_COOKIE['toggleBreadcrumb'];
		} else {
			return false;
		}

	}

	public function cookieToggleBackgroundLogo() {

		if (isset($_COOKIE['toggleBackgroundLogo'])) {
			return $_COOKIE['toggleBackgroundLogo'];
		} else {
			return false;
		}

	}

	public function cookieToggleHints() {

		if (isset($_COOKIE['toggleHints'])) {
			return $_COOKIE['toggleHints'];
		} else {
			return false;
		}

	}

	public function cookieToggleFooter() {

		if (isset($_COOKIE['toggleFooter'])) {
			return $_COOKIE['toggleFooter'];
		} else {
			return false;
		}

	}

	public function cookieToggleLiveVisitorCounter() {

		if (isset($_COOKIE['toggleLiveVisitorCounter'])) {
			return $_COOKIE['toggleLiveVisitorCounter'];
		} else {
			return false;
		}

	}

	public function cookieName() {

		if (isset($_COOKIE['officerName'])) {
			return $_COOKIE['officerName'];
		} else {
			return "";
		}		

	}

	public function cookieRank() {

		if (isset($_COOKIE['officerRank'])) {
			return $_COOKIE['officerRank'];
		} else {
			return "";
		}
	}

	public function cookieBadge() {

		if (isset($_COOKIE['officerBadge'])) {
			return $_COOKIE['officerBadge'];
		} else {
			return "";
		}		
	}

	public function cookieCallSign() {

		if (isset($_COOKIE['callSign'])) {
			return $_COOKIE['callSign'];
		} else {
			return "";
		}

	}

	public function cookieDefName() {

		if (isset($_COOKIE['defName'])) {
			return $_COOKIE['defName'];
		} else {
			return "";
		}		

	}

	public function cookieDefNameURL() {

		if (isset($_COOKIE['defName'])) {
			$nameURL = $_COOKIE['defName'];
			$nameURL = str_replace(" ", "_", $nameURL);
			return $nameURL;
		} else {
			return "";
		}		
	}

	public function cookieTrafficPatrolURL() {

		if (isset($_COOKIE['inputTDPatrolReportURL'])) {
			return $_COOKIE['inputTDPatrolReportURL'];
		} else {
			return "";
		}
	}

}

?>