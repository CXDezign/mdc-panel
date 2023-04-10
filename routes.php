<?php

	$request = rtrim($_SERVER['REQUEST_URI'], "/");

	switch ($request) {
		case '/paperwork-generators/error':
			$url = "/templates/error.php";
			break;
		case '/paperwork-generators/form-processor':
			$url = "/controllers/form-processor.php";
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
			$url = "/templates/generators/form-arrest-charges.php";
			break;
		case '/test':
			$url = "/templates/generators/charges-test.php";
			break;
		case '/paperwork-generators/arrest-report':
			$url = "/templates/generators/form-arrest-report.php";
			break;
		case '/paperwork-generators/traffic-report':
			$url = "/templates/generators/form-traffic-report.php";
			break;
		case '/paperwork-generators/lspd/death-report':
			$url = "/templates/generators/lspd/form-death-report.php";
			break;
		case '/paperwork-generators/lspd/traffic-division-patrol-report':
			$url = "/templates/generators/lspd/form-traffic-division-patrol-report.php";
			break;
		case '/paperwork-generators/parking-ticket':
			$url = "/templates/generators/form-parking-ticket.php";
			break;
		case '/paperwork-generators/generated-thread':
			$url = "/templates/generated-thread.php";
			break;
		case '/paperwork-generators/generated-report':
			$url = "/templates/generated-report.php";
			break;
		case '/paperwork-generators/impound-report':
			$url = "/templates/generators/form-impound-report.php";
			break;
		case '/paperwork-generators/profiling-samples':
			$url = "/templates/form-profiling-samples.php";
			break;
		case '/paperwork-generators/lssd/incident-report':
			$url = "/templates/generators/lssd/form-incident-report.php";
			break;
		case '/paperwork-generators/lssd/uof-report':
			$url = "/templates/generators/lssd/form-uof-report.php";
			break;
		case '/paperwork-generators/lsda/bail-petition':
			$url = "/templates/generators/lsda/form-bail-petition.php";
			break;
		case '/paperwork-generators/lsda/dismissal-petition':
			$url = "/templates/generators/lsda/form-dismissal-petition.php";
			break;
		case '/paperwork-generators/jsa/speedy-trial':
			$url = "/templates/generators/judicial/form-speedy-trial.php";
			break;
		case '/paperwork-generators/trespass-notice':
			$url = "/templates/generators/form-trespass-notice.php";
			break;
		case '/paperwork-generators/interview-card':
			$url = "/templates/generators/form-interview-card.php";
			break;
		case '':
		case '/':
		case '/dashboard':
		default:
			$url = "/templates/page-dashboard.php";
	}

	return require_once __DIR__ . $url;