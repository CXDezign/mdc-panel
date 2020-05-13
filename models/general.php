<?php

class General {

	public function getVersion() {

		return '1.9.7';
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

		$cookie = $_COOKIE['toggleMode'] ?? false;
		return $cookie;
	}

	public function cookieToggleClock() {

		$cookie = $_COOKIE['toggleClock'] ?? false;
		return $cookie;
	}

	public function cookieToggleBreadcrumb() {

		$cookie = $_COOKIE['toggleBreadcrumb'] ?? false;
		return $cookie;
	}

	public function cookieToggleBackgroundLogo() {

		$cookie = $_COOKIE['toggleBackgroundLogo'] ?? false;
		return $cookie;
	}

	public function cookieToggleHints() {

		$cookie = $_COOKIE['toggleHints'] ?? false;
		return $cookie;
	}

	public function cookieToggleFooter() {

		$cookie = $_COOKIE['toggleFooter'] ?? false;
		return $cookie;
	}

	public function cookieToggleLiveVisitorCounter() {

		$cookie = $_COOKIE['toggleLiveVisitorCounter'] ?? false;
		return $cookie;
	}

	public function cookieName() {

		$cookie = $_COOKIE['officerName'] ?? "";
		return $cookie;
	}

	public function cookieRank() {

		$cookie = $_COOKIE['officerRank'] ?? "";
		return $cookie;
	}

	public function cookieBadge() {

		$cookie = $_COOKIE['officerBadge'] ?? "";
		return $cookie;
	}

	public function cookieCallSign() {

		$cookie = $_COOKIE['callSign'] ?? "";
		return $cookie;
	}

	public function cookieDefName() {

		$cookie = $_COOKIE['defName'] ?? "";
		return $cookie;
	}

	public function cookieDefNameURL() {

		$cookie = $_COOKIE['defName'] ?? "";
		$cookie = str_replace(" ", "_", $cookie);
		return $cookie;
	}

	public function cookieTrafficPatrolURL() {

		$cookie = $_COOKIE['inputTDPatrolReportURL'] ?? "";
		return $cookie;
	}

}

?>