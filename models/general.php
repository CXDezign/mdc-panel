<?php

class General {

	// PAGE SETTINGS

	public function getSettings($setting) {

		$output = '';

		switch ($setting) {

			case 'site-name':
				$output = "MDC Panel";
				break;
			case 'site-url':
				$output = "http://mdc.xanx.co.uk";
				break;
			case 'site-logo':
				$output = "http://xanx.co.uk/images/Logo-MDC.png";
				break;
			case 'site-version':
				$output = "1.9.9";
				break;
			case 'site-description':
				$output = "MDC Panel - Multi-functional tools, generators, and resources for official government use.";
				break;
			case 'url-penal-code':
				$output = "https://forum.gta.world/en/index.php?/topic/25393-san-andreas-penal-code/";
				break;
			default:
				$output = "UNKNOWN SITE SETTING";
				break;

		}

		return $output;

	}

	public function getUNIX($format) {

		$unix = time();

		switch($format) {

			case 'year':
				$output = date("Y", $unix);
				break;
			case 'date':
				$output = date("d/M/Y", $unix);
				break;
			case 'time':
				$output = date("H:i", $unix);
				break;
			default:
				$output = $unix;
				break;
		}

		return $output;

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

	public function findCookie($cookie) {

		$output = false;

		switch($cookie) {

			case 'toggleMode':
				$output = $_COOKIE['toggleMode'] ?? false;
				break;
			case 'toggleClock':
				$output = $_COOKIE['toggleClock'] ?? false;
				break;
			case 'toggleBreadcrumb':
				$output = $_COOKIE['toggleBreadcrumb'] ?? false;
				break;
			case 'toggleBackgroundLogo':
				$output = $_COOKIE['toggleBackgroundLogo'] ?? false;
				break;
			case 'toggleHints':
				$output = $_COOKIE['toggleHints'] ?? false;
				break;
			case 'toggleFooter':
				$output = $_COOKIE['toggleFooter'] ?? false;
				break;
			case 'toggleLiveVisitorCounter':
				$output = $_COOKIE['toggleLiveVisitorCounter'] ?? false;
				break;
			case 'officerName':
				$output = $_COOKIE['officerName'] ?? "";
				break;
			case 'officerBadge':
				$output = $_COOKIE['officerBadge'] ?? "";
				break;
			case 'callSign':
				$output = $_COOKIE['callSign'] ?? "";
				break;
			case 'defName':
				$output = $_COOKIE['defName'] ?? "";
				break;
			case 'defNameURL':
				$output = $_COOKIE['defName'] ?? "";
				$output = str_replace(" ", "_", $output);
				break;
			case 'inputTDPatrolReportURL':
				$output = $_COOKIE['inputTDPatrolReportURL'] ?? "https://lspd.gta.world/viewforum.php?f=101";
				break;
			default:
				$output = "UNKNOWN FIND COOKIE";
				break;
		}

		return $output;

	}

}

?>