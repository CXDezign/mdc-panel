<?php

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
		switch ($page) {
			default:
			case '':
				include ("./templates/main.php");
				break;
			case 'map':
				include("./map/index.php");
				break;
			case 'generators':
				include("./templates/page-generators.php");
				break;
			case 'resources':
				include("./templates/page-resources.php");
				break;
			case 'trafficReport':
				include("./templates/trafficReportForm.php");
				break;
			case 'trafficReportResults':
				include("./templates/trafficReportResults.php");
				break;
			case 'deathReport':
				include("./templates/deathReport.php");
				break;
			case 'deathReportResults':
				include("./templates/deathReportResults.php");
				break;
			case 'evidenceLog':
				include("./templates/evidenceLog.php");
				break;
			case 'evidenceLogResults':
				include("./templates/evidenceLogResults.php");
				break;
			case 'tdPatrolReport':
				include("./templates/tdPatrolReport.php");
				break;
			case 'tdPatrolReportResults':
				include("./templates/tdPatrolReportResults.php");
				break;
			case 'arrestCharges':
				include("./templates/arrestChargesForm.php");
				break;
			case 'arrestReport':
				include("./templates/arrestReportForm.php");
				break;
			case 'arrestReportResults':
				include ("./templates/arrestReportResults.php");
				break; 
			case 'patrolLog':
				include ("./templates/patrolLogForm.php");
				break; 
			case 'patrolLogResults':
				include ("./templates/patrolLogResults.php");
				break; 
		}
	} else {
		include ("./templates/main.php");
	}

	if (isset($_GET['message'])) {
		$message = $_GET['message'];
		switch ($message) {
			default:
			case '':
				$message = "";
				break;
			case 'missing':
				$message = "Missing form values.";
				break;
		}
	}
	
?>