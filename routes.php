<?php

	$request = rtrim($_SERVER['REQUEST_URI'], "/");

	switch ($request) {
		case '/paperwork-generators/error':
			return require __DIR__ . "/templates/error.php";
		case '/settings':
			return require __DIR__ . "/templates/page-settings.php";
		case '/changelogs':
			return require __DIR__ . "/templates/page-changelogs.php";
		case '/street-guide':
			return require __DIR__ . "/map/index.php";
		case '/paperwork-generators':
			return require __DIR__ . "/templates/page-generators.php";
		case '/useful-resources':
			return require __DIR__ . "/templates/page-resources.php";
		case '/paperwork-generators/arrest-charges':
			return require __DIR__ . "/templates/form-arrest-charges.php";
		case '/paperwork-generators/arrest-report':
			return require __DIR__ . "/templates/form-arrest-report.php";
		case '/paperwork-generators/traffic-report':
			return require __DIR__ . "/templates/form-traffic-report.php";
		case '/paperwork-generators/evidence-registration-log':
			return require __DIR__ . "/templates/form-evidence-registration-log.php";
		case '/paperwork-generators/death-report':
			return require __DIR__ . "/templates/form-death-report.php";
		case '/paperwork-generators/traffic-division-patrol-report':
			return require __DIR__ . "/templates/form-traffic-division-patrol-report.php";
		case '/paperwork-generators/patrol-log':
			return require __DIR__ . "/templates/form-patrol-log.php";
		case '/paperwork-generators/parking-ticket':
			return require __DIR__ . "/templates/form-parking-ticket.php";
		case '/paperwork-generators/generated-thread':
			return require __DIR__ . "/templates/generated-thread.php";
		case '/paperwork-generators/generated-report':
			return require __DIR__ . "/templates/generated-report.php";
		case '/paperwork-generators/impound-report':
			return require __DIR__. "/templates/form-impound-report.php";
		case '':
		case '/':
		case '/dashboard':
		default:
			return require __DIR__ . "/templates/page-dashboard.php";
	}