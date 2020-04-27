<?php

class General {

	public function getVersion() {

		return '1.9.0';
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

	public function sessionGeneratedReportType() {

		if (isset($_SESSION['generatedReportType'])) {
			return $_SESSION['generatedReportType'];
		} else {
			return "";
		}
	}

	public function sessionGeneratedReport() {

		if (isset($_SESSION['generatedReport'])) {
			return $_SESSION['generatedReport'];
		} else {
			return "";
		}
	}

	public function sessionGeneratedThreadTitle() {

		if (isset($_SESSION['generatedThreadTitle'])) {
			return $_SESSION['generatedThreadTitle'];
		} else {
			return "";
		}
	}

	public function sessionShowGeneratedThreadTitle() {

		if (isset($_SESSION['showGeneratedThreadTitle'])) {
			return $_SESSION['showGeneratedThreadTitle'];
		} else {
			return false;
		}
	}

	public function sessionGeneratedThreadURL() {

		if (isset($_SESSION['generatedThreadURL'])) {
			return $_SESSION['generatedThreadURL'];
		} else {
			return "";
		}
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