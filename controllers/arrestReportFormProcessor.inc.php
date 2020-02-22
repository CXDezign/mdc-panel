<?php
    session_start();
	require '../models/general.php';
	require '../models/arrestReport.php';
	$g = new General();
	$ar = new ArrestReport();
	
	function errorPage() {
		header('Location: ../index.php?page=arrestReport&message=missing');
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
		
		if (isset($_POST['inputDefName'])) {
			$inputDefName = $_POST['inputDefName'];
			setcookie("defName",$inputDefName,time()+3660, "/MDC");
		} else {
			errorPage();
		}
		
		if (isset($_POST['inputNarrative'])) {
			$inputNarrative = $_POST['inputNarrative'];
		} else {
			errorPage();
		}
		
		if (isset($_POST['inputEvidence'])) {
			$inputEvidence = $_POST['inputEvidence'];
		} else {
			errorPage();
		}
		
		if (isset($_POST['inputDashcam'])) {
			$inputDashcam = $_POST['inputDashcam'];
		} else {
			errorPage();
		}
		
		if (isset($_POST['inputWristband'])) {
			$inputWristband = $_POST['inputWristband'];
		} else {
			$inputWristband = '';
		}
		
		if (isset($_POST['inputBracelet'])) {
			$inputBracelet = $_POST['inputBracelet'];
		} else {
			$inputBracelet = '';
		}
		
		if (isset($_POST['inputPlea'])) {
			$inputPlea = $_POST['inputPlea'];
		} else {
			errorPage();
		}
		
		for ($i=0;$i<count($inputName);$i++) {
			$officers[$i] = "<b>".$g->getRank($inputRank[$i])." ".$inputName[$i]."</b> (<b>#".$inputBadge[$i]."</b>)";
		}
		
		$officers = implode(", ", $officers);
		
		if ($inputWristband != 0 || $inputBracelet != 0) {
			$wristbandBracelet = "<b>".$ar->getBracelet($inputBracelet)." & ".$ar->getWristband($inputWristband)"</b>.";
		} else {
			$wristbandBracelet = "";
		}
		
		if ($inputEvidence != '') {
			$evidence = '<b>EVIDENCE</b><br>'. nl2br($inputEvidence);
		} else {
			$evidence = '';
		}
		
		$arrestReport = $officers.", under the callsign <b>".$inputCallsign."</b>
		 conducted an arrest on <b>".$inputDefName."</b>
		 on the <b>".strtoupper($inputDate)."</b>, <b>".$inputTime."</b>.
		 The suspect apprehension took place on<b> ".$inputStreet.", ".$inputDistrict."</b>.<br><br>"
		 .nl2br($inputNarrative)."<br><br>
		".$wristbandBracelet."<br>
		".$ar->getPlea($inputPlea, $inputDefName)."<br><br>
		".$ar->getDashboardCamera($inputDashcam, $inputCallsign)."<br>".$evidence;
		
		$_SESSION['arrestReport'] = $arrestReport;
		
		header('Location: ../index.php?page=arrestReportResults');
		exit();

	} else {

		$arrestReport = "Error! Contact xanx#0001 or Skent#8307 on Discord";
		$_SESSION['arrestReport'] = $arrestReport;
		header('Location: ../index.php?page=arrestReportResults');
		exit();

	}
?>