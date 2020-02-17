<?php
	
	session_start();
	require '../models/general.php';
	require '../models/trafficReport.php';
	$g = new General();
	$tr = new TrafficReport();

	function errorPage() {
		header('Location: ../index.php?page=trafficReport&message=missing');
		exit();
	}

	if (isset($_POST['submit'])) {

		if (isset($_POST['inputDate'])) {
			$inputDate = $_POST['inputDate'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputTime'])) {
			$inputTime = $_POST['inputTime'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputCallsign'])) {
			$inputCallsign = $_POST['inputCallsign'];
			setcookie("callSign",$inputCallsign,time()+21960, "/MDC");
		} else {
			errorPage();
		}

		if (isset($_POST['inputName'])) {
			$inputName = $_POST['inputName'];
			setcookie("officerName",$inputName[0],2147483647, "/MDC");
		} else {
			errorPage();
		}

		if (isset($_POST['inputRank'])) {
			$inputRank = $_POST['inputRank'];
			setcookie("officerRank",$inputRank[0],2147483647, "/MDC");
		} else {
			errorPage();
		}

		if (isset($_POST['inputBadge'])) {
			$inputBadge = $_POST['inputBadge'];
			setcookie("officerBadge",$inputBadge[0],2147483647, "/MDC");
		} else {
			errorPage();
		}

		if (isset($_POST['inputDefName'])) {
			$inputDefName = $_POST['inputDefName'];
			setcookie("defName",$inputDefName,time()+3660, "/MDC");
		} else {
			errorPage();
		}

		if (isset($_POST['inputDefLicense'])) {
			$inputDefLicense = $_POST['inputDefLicense'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputNarrative'])) {
			$inputNarrative = $_POST['inputNarrative'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputDashcam'])) {
			$inputDashcam = $_POST['inputDashcam'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputStreet'])) {
			$inputStreet = $_POST['inputStreet'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputDistrict'])) {
			$inputDistrict = $_POST['inputDistrict'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputVeh'])) {
			$inputVeh = $_POST['inputVeh'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputVehPaint'])) {
			$inputVehPaint = $_POST['inputVehPaint'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputVehPlate'])) {
			$inputVehPlate = $_POST['inputVehPlate'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputVehTint'])) {
			$inputVehTint = $_POST['inputVehTint'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputCrime'])) {
			$inputCrime = $_POST['inputCrime'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputCrimeType'])) {
			$inputCrimeType = $_POST['inputCrimeType'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputCrimeFine'])) {
			$inputCrimeFine = $_POST['inputCrimeFine'];
		} else {
			errorPage();
		}

		for ($i=0;$i<count($inputName);$i++) {
			$officers[$i] = "<b>".$g->getRank($inputRank[$i])." ".$inputName[$i]."</b> (<b>#".$inputBadge[$i]."</b>)";
		}

		$officers = implode(", ", $officers);

		for ($i=0;$i<count($inputCrime);$i++) {
			if ($tr->getCrimeFine($inputCrimeFine[$i]) == 0) {
				$fines[$i] = "- Charge for ".$tr->getCrimeColour($inputCrime[$i])."<b>".$tr->getCrimeClass($inputCrime[$i])."".$tr->getCrimeType($inputCrimeType[$i])." ".$tr->getCrime($inputCrime[$i])."</b></span>.<br>";
			} else {
				$fines[$i] = "- <b style='color: green;'>$".number_format($inputCrimeFine[$i])."</b> Citation for ".$tr->getCrimeColour($inputCrime[$i])."<b>".$tr->getCrimeClass($inputCrime[$i])."".$tr->getCrimeType($inputCrimeType[$i])." ".$tr->getCrime($inputCrime[$i])."</b></span>.<br>";
			}
		}

		$fines = implode("", $fines);

		$trafficReport = $officers.", under the call sign <b>".$inputCallsign."</b> on the <b>".$inputDate."</b>, <b>".$inputTime."</b>.<br>Conducted a traffic stop on a <b>".$inputVehPaint." ".$inputVeh."</b> vehicle, ".$tr->getVehiclePlates($inputVehPlate).", on <b>".$inputStreet."</b>, <b>".$inputDistrict."</b>.<br>".$tr->getVehicleTint($inputVehTint)."<br>The defendant was identified as <b>".$inputDefName."</b> and it was found that they had ".$tr->getDefLicense($inputDefLicense)."<br>".$inputNarrative."<br><br>Took action by issuing the following charge(s):<br>".$fines."<br>".$tr->getDashboardCamera($inputDashcam);

		$_SESSION['trafficReport'] = $trafficReport;

		header('Location: ../index.php?page=trafficReportResults');
		exit();

	} else {

		$trafficReport = "Error! Contact xanx#0001 on Discord";
		$_SESSION['trafficReport'] = $trafficReport;
		header('Location: ../index.php?page=trafficReportResults');
		exit();

	}
?>