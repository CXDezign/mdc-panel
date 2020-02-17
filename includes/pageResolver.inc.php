<?php

	function navigation() {
		include ("./templates/navigation.php");
	}

	function main() {
		include ("./templates/main.php");
	}

	function homePage() {
		navigation();
		main();
	}

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
		switch ($page) {
			default:
			case '':
				homePage();
				break;
			case 'resources':
				navigation();
				include("./templates/resources.php");
				break;
			case 'trafficReport':
				navigation();
				include("./templates/trafficReportForm.php");
				break;
			case 'trafficReportResults':
				navigation();
				include("./templates/trafficReportResults.php");
				break;
			case 'deathReport':
				navigation();
				include("./templates/deathReport.php");
				break;
			case 'deathReportResults':
				navigation();
				include("./templates/deathReportResults.php");
				break;
			case 'evidenceLog':
				navigation();
				include("./templates/evidenceLog.php");
				break;
			case 'evidenceLogResults':
				navigation();
				include("./templates/evidenceLogResults.php");
				break;
			case 'tdPatrolReport':
				navigation();
				include("./templates/tdPatrolReport.php");
				break;
			case 'tdPatrolReportResults':
				navigation();
				include("./templates/tdPatrolReportResults.php");
				break;
		}
	} else {
		homePage();
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