<?php
	
	session_start();
	require '../models/general.php';
	require '../models/trafficReport.php';
	require '../models/arrestReport.php';
	require '../models/deathReport.php';
	require '../models/evidenceLog.php';
	require '../models/patrolLog.php';
	require '../models/trafficPatrol.php';
	$g = new General();
	$tr = new TrafficReport();
	$ar = new ArrestReport();
	$dr = new DeathReport();
	$el = new EvidenceLog();
	$pl = new PatrolLog();
	$tp = new TrafficPatrol();

	if (isset($_POST['generatorType'])) {

		// Initialise Common Variables
		$generatorType = $_POST['generatorType'];
		$penal = json_decode(file_get_contents("../resources/penalSearch.json"), true);

		if ($generatorType = "TrafficReport") {

			// Variables
			$inputDate = strtoupper($_POST['inputDate']);
			$inputTime = $_POST['inputTime'];
			$inputCallsign = $_POST['inputCallsign'];
			setcookie("callSign",$inputCallsign,time()+21960, "/MDC");
			$inputName = $_POST['inputName'];
			setcookie("officerName",$inputName[0],2147483647, "/MDC");
			$inputRank = $_POST['inputRank'];
			setcookie("officerRank",$inputRank[0],2147483647, "/MDC");
			$inputBadge = $_POST['inputBadge'];
			setcookie("officerBadge",$inputBadge[0],2147483647, "/MDC");
			$inputDefName = $_POST['inputDefName'];
			setcookie("defName",$inputDefName,time()+3660, "/MDC");
			$inputDefLicense = $_POST['inputDefLicense'];
			$inputNarrative = $_POST['inputNarrative'];
			$inputDashcam = $_POST['inputDashcam'];
			$inputStreet = $_POST['inputStreet'];
			$inputDistrict = $_POST['inputDistrict'];
			$inputVeh = $_POST['inputVeh'];
			$inputVehPaint = $_POST['inputVehPaint'];
			$inputVehPlate = $_POST['inputVehPlate'];
			$inputVehTint = $_POST['inputVehTint'];
			$inputCrime = $_POST['inputCrime'];
			$inputCrimeType = $_POST['inputCrimeType'];
			$inputCrimeFine = $_POST['inputCrimeFine'];

			// Officer Resolver
			$iOfficer = 0;
			$officers = "";
			foreach ($inputName as $inputNameResolved) {
				$officers .= "<b>".$g->getRank($inputRank[$iOfficer])." ".$inputName[$iOfficer]."</b> (<b>#".$inputBadge[$iOfficer]."</b>), ";
				$iOfficer++;
			}

			// Crime Resolver
			$iCrime = 0;
			$fines = "";
			foreach ($inputCrime as $inputCrimeResolved) {
				$crimeID = $inputCrime[$iCrime];
				$crime = $penal[$crimeID];
				$crimeTitle = $crime['charge'];
				$crimeClassification = $crime['type'];
				$crimeType = $g->getCrimeType($inputCrimeType[$iCrime]);
				if ($tr->getCrimeFine($inputCrimeFine[$iCrime]) == 0) {
					$fines .= "- Charge for <b>".$g->getCrimeColour($crimeClassification).$crimeClassification.$crimeType." ".$crimeID.". ".$crimeTitle."</span></b>.<br>";
				} else {
					$fines .= "- <b style='color: green;'>$".number_format($inputCrimeFine[$iCrime])."</b> Citation for <b>".$g->getCrimeColour($crimeClassification).$crimeClassification.$crimeType." ".$crimeID.". ".$crimeTitle."</span></b>.<br>";
				}
				$iCrime++;
			}

			// Report Builder
			$generatedReportType = "Traffic Report";
			$generatedReport = $officers."under the call sign <b>".$inputCallsign."</b> on the <b>".$inputDate."</b>, <b>".$inputTime."</b>.<br>Conducted a traffic stop on a <b>".$inputVehPaint." ".$inputVeh."</b> vehicle, ".$tr->getVehiclePlates($inputVehPlate).", on <b>".$inputStreet."</b>, <b>".$inputDistrict."</b>.<br>".$tr->getVehicleTint($inputVehTint)."<br>The defendant was identified as <b>".$inputDefName."</b> and it was found that they had ".$tr->getDefLicense($inputDefLicense)."<br>".$inputNarrative."<br><br>Took action by issuing the following charge(s):<br>".$fines."<br>".$tr->getDashboardCamera($inputDashcam);
		}

		// Report Finalisation
		$_SESSION['generatedReport'] = $generatedReport;
		$_SESSION['generatedReportType'] = $generatedReportType;

		// Redirect
		header('Location: ../index.php?page=generatedResults');
		exit();

	} else {

		// Redirect to previous page and show message on said page.

		$generatedReport = "Error! Contact xanx#0001 on Discord";
		$_SESSION['generatedReport'] = $generatedReport;
		header('Location: ../index.php?page=trafficReportResults');
		exit();

	}
?>