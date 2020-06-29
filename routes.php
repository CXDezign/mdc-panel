<?php

	$request = rtrim($_SERVER['REQUEST_URI'], "/");

	switch ($request) {
		case '/paperwork-generators/error':
			$url = "/templates/error.php";
			break;
		case '/settings':
			$url = "/templates/page-settings.php";
			break;
		case '/changelogs':
			$url = "/templates/page-changelogs.php";
			break;
		case '/street-guide':
			$url = "/map/index.php";
			break;
		case '/paperwork-generators':
			$url = "/templates/page-generators.php";
			break;
		case '/useful-resources':
			$url = "/templates/page-resources.php";
			break;
		case '/paperwork-generators/arrest-charges':
			$url = "/templates/form-arrest-charges.php";
			break;
		case '/paperwork-generators/arrest-report':
			$url = "/templates/form-arrest-report.php";
			break;
		case '/paperwork-generators/traffic-report':
			$url = "/templates/form-traffic-report.php";
			break;
		case '/paperwork-generators/evidence-registration-log':
			$url = "/templates/form-evidence-registration-log.php";
			break;
		case '/paperwork-generators/death-report':
			$url = "/templates/form-death-report.php";
			break;
		case '/paperwork-generators/traffic-division-patrol-report':
			$url = "/templates/form-traffic-division-patrol-report.php";
			break;
		case '/paperwork-generators/patrol-log':
			$url = "/templates/form-patrol-log.php";
			break;
		case '/paperwork-generators/parking-ticket':
			$url = "/templates/form-parking-ticket.php";
			break;
		case '/paperwork-generators/generated-thread':
			$url = "/templates/generated-thread.php";
			break;
		case '/paperwork-generators/generated-report':
			$url = "/templates/generated-report.php";
			break;
		case '/paperwork-generators/impound-report':
			$url = "/templates/form-impound-report.php";
			break;
		case '/paperwork-generators/metropolitan-division-deployment-log':
			$url = "/templates/form-metropolitan-division-deployment-log.php";
			break;
		case '/paperwork-generators/profiling-samples':
			$url = "/templates/form-profiling-samples.php";
			break;
		case '':
		case '/':
		case '/dashboard':
		default:
			$url = "/templates/page-dashboard.php";
	}

	return require_once __DIR__ . $url;