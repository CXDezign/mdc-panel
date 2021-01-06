<?php

class General {

	public function getSettings($setting) {
		
		switch ($setting) {
			case 'site-live':					return false;
			case 'site-name':					return 'MDC Panel';
			case 'site-version':				return '1.18.4';
			case 'site-url':					return $_SERVER['SERVER_NAME'];
			case 'site-logo':					return '/images/MDC-Panel.svg';
			case 'site-favicon':				return '/images/MDC-Panel-Favicon.svg';
			case 'site-image':					return '/images/MDC-Panel-OG.png';
			case 'site-description':			return 'MDC Panel - Multi-functional tools, generators, and resources for official government use.';
			case 'site-discord-contact':		return 'xanx#0001';
			case 'url-github':					return 'https://github.com/xanxTV/MDC-Panel';
			case 'url-mdc':						return 'https://mdc.gta.world';
			case 'url-cad':						return 'https://cad.gta.world';
			case 'url-bbcoderip':				return 'https://bbcode.rip';
			case 'url-lspd':					return 'https://lspd.gta.world';
			case 'url-lssd':					return 'https://lssd.gta.world';
			case 'url-lsfd':					return 'https://lsfd.gta.world';
			case 'url-penal-code':				return 'https://forum.gta.world/en/index.php?/topic/26513-san-andreas-penal-code';
			case 'url-court-laws':				return 'https://lspd.gta.world/viewtopic.php?f=665&t=12522&p=60722';
			case 'url-lspd-manual':				return 'https://lspd.gta.world/viewforum.php?f=218';
			case 'url-lspd-reports-records':	return 'https://lspd.gta.world/viewforum.php?f=434';
			case 'url-post-arrest-submission':	return 'https://lspd.gta.world/viewtopic.php?f=1228&t=22822';
			case 'url-warrant-service':			return 'https://lspd.gta.world/viewforum.php?f=806';
			default: break;
		}
	}

	public function getUNIX($format) {

		date_default_timezone_set('GMT');
		$unix = time();

		switch($format) {
			case 'year':
				return date('Y', $unix);
			case 'date':
				return date('d/M/Y', $unix);
			case 'time':
				return date('H:i', $unix);
			default:
				return $unix;
		}

	}

	public function clearCookies() {

		$cookieToggles = array('toggleMode', 'toggleClock', 'toggleBreadcrumb', 'toggleBackgroundLogo', 'toggleHints', 'toggleFooter', 'toggleLiveVisitorCounter', 'notificationVersion');
		$cookieUserDetails = array('officerName', 'officerRank', 'officerBadge', 'callSign', 'defName', 'inputTDPatrolReportURL');

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

		switch ($cookie) {
			case 'notificationVersion':			return $_COOKIE['notificationVersion'] ?? false;
			case 'toggleMode':					return $_COOKIE['toggleMode'] ?? false;
			case 'toggleClock':					return $_COOKIE['toggleClock'] ?? false;
			case 'toggleBreadcrumb':			return $_COOKIE['toggleBreadcrumb'] ?? false;
			case 'toggleBackgroundLogo':		return $_COOKIE['toggleBackgroundLogo'] ?? false;
			case 'toggleHints':					return $_COOKIE['toggleHints'] ?? false;
			case 'toggleFooter':				return $_COOKIE['toggleFooter'] ?? false;
			case 'toggleLiveVisitorCounter':	return $_COOKIE['toggleLiveVisitorCounter'] ?? false;
			case 'officerName':					return $_COOKIE['officerName'] ?? '';
			case 'officerRank':					return $_COOKIE['officerRank'] ?? '';
			case 'officerBadge':				return $_COOKIE['officerBadge'] ?? '';
			case 'callSign':					return $_COOKIE['callSign'] ?? '';
			case 'defName':						return $_COOKIE['defName'] ?? '';
			case 'defNameURL':					return str_replace(' ', '_', $_COOKIE['defName'] ?? '');
			case 'inputTDPatrolReportURL':		return $_COOKIE['inputTDPatrolReportURL'] ?? 'https://lspd.gta.world/viewforum.php?f=101';
			default: break;
		}
	}

}