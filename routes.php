<?php

	$request = rtrim($_SERVER['REQUEST_URI'], "/");
	switch ($request) {
		
		case '/paperwork-generators/error':
			require __DIR__ . "/templates/error.php";
			break;
		case '/settings':
			require __DIR__ . "/templates/page-settings.php";
			break;
		case '/changelogs':
			require __DIR__ . "/templates/page-changelogs.php";
			break;
		case '/street-guide':
			require __DIR__ . "/map/index.php";
			break;
		case '/paperwork-generators':
			require __DIR__ . "/templates/page-generators.php";
			break;
		case '/useful-resources':
			require __DIR__ . "/templates/page-resources.php";
			break;
		case '/paperwork-generators/arrest-charges':
			require __DIR__ . "/templates/form-arrest-charges.php";
			break;
		case '/paperwork-generators/arrest-report':
			require __DIR__ . "/templates/form-arrest-report.php";
			break;
		case '/paperwork-generators/traffic-report':
			require __DIR__ . "/templates/form-traffic-report.php";
			break;
		case '/paperwork-generators/evidence-registration-log':
			require __DIR__ . "/templates/form-evidence-registration-log.php";
			break;
		case '/paperwork-generators/death-report':
			require __DIR__ . "/templates/form-death-report.php";
			break;
		case '/paperwork-generators/traffic-division-patrol-report':
			require __DIR__ . "/templates/form-traffic-division-patrol-report.php";
			break;
		case '/paperwork-generators/patrol-log':
			require __DIR__ . "/templates/form-patrol-log.php";
			break;
		case '/paperwork-generators/parking-ticket':
			require __DIR__ . "/templates/form-parking-ticket.php";
			break;
		case '/paperwork-generators/generated-thread':
			require __DIR__ . "/templates/generated-thread.php";
			break;
		case '/paperwork-generators/generated-report':
			require __DIR__ . "/templates/generated-report.php";
			break;
		case '/paperwork-generators/impound-report':
			require __DIR__. "/templates/form-impound-report.php";
			break;
		case '':
		case '/':
		case '/dashboard':
		default:
			require __DIR__ . "/templates/page-dashboard.php";
			break;

	}