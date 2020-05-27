<?php

class General {

	// PAGE SETTINGS

	public function getSettings($setting) {

		switch ($setting) {
			case 'site-live':
				return false;
			case 'site-name':
				return "MDC Panel";
			case 'site-version':
				return "1.10.1";
			case 'site-url':
				return $_SERVER['SERVER_NAME'];
			case 'site-logo':
				return "http://mdc.xanx.co.uk/images/Logo-MDC.png";
			case 'site-description':
				return "MDC Panel - Multi-functional tools, generators, and resources for official government use.";
			case 'url-penal-code':
				return "https://forum.gta.world/en/index.php?/topic/25393-san-andreas-penal-code/";
			default:
				break;
		}
	}

	public function getUNIX($format) {

		date_default_timezone_set('GMT');
		$unix = time();

		switch($format) {
			case 'year':
				return date("Y", $unix);
			case 'date':
				return date("d/M/Y", $unix);
			case 'time':
				return date("H:i", $unix);
			default:
				return $unix;
		}
	}

	// COOKIES

	public function clearCookies() {

		$cookieToggles = array("toggleMode", "toggleClock", "toggleBreadcrumb", "toggleBackgroundLogo", "toggleHints", "toggleFooter", "toggleLiveVisitorCounter");
		$cookieUserDetails = array("officerName", "officerRank", "officerBadge", "callSign", "defName", "inputTDPatrolReportURL");

		$cookiesAll = array_merge($cookieToggles, $cookieUserDetails);

		foreach ($cookiesAll as $cookie) {
			unset($_COOKIE[$cookie]);
		}

		foreach ($cookieToggles as $cookie) {
			setcookie($cookie, false, -1, '/', $this->getSettings('site-url'), $this->getSettings('site-live'));
		}

		foreach ($cookieUserDetails as $cookie) {
			setcookie($cookie, null, -1, '/', $this->getSettings('site-url'), $this->getSettings('site-live'));
		}

	}

	public function findCookie($cookie) {

		switch($cookie) {
			case 'toggleMode':
				return $_COOKIE['toggleMode'] ?? false;
			case 'toggleClock':
				return $_COOKIE['toggleClock'] ?? false;
			case 'toggleBreadcrumb':
				return $_COOKIE['toggleBreadcrumb'] ?? false;
			case 'toggleBackgroundLogo':
				return $_COOKIE['toggleBackgroundLogo'] ?? false;
			case 'toggleHints':
				return $_COOKIE['toggleHints'] ?? false;
			case 'toggleFooter':
				return $_COOKIE['toggleFooter'] ?? false;
			case 'toggleLiveVisitorCounter':
				return $_COOKIE['toggleLiveVisitorCounter'] ?? false;
			case 'officerName':
				return $_COOKIE['officerName'] ?? "";
			case 'officerBadge':
				return $_COOKIE['officerBadge'] ?? "";
			case 'callSign':
				return $_COOKIE['callSign'] ?? "";
			case 'defName':
				return $_COOKIE['defName'] ?? "";
			case 'defNameURL':
				return str_replace(" ", "_", $_COOKIE['defName'] ?? "");
			case 'inputTDPatrolReportURL':
				return $_COOKIE['inputTDPatrolReportURL'] ?? "https://lspd.gta.world/viewforum.php?f=101";
			default:
				break;
		}
	}

}