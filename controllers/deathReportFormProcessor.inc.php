<?php
	
	session_start();
	require '../models/general.php';
	require '../models/deathReport.php';
	$g = new General();
	$dr = new DeathReport();

	function errorPage() {
		header('Location: ../index.php?page=deathReport&message=missing');
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

		if (isset($_POST['inputDistrict'])) {
			$inputDistrict = $_POST['inputDistrict'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputStreet'])) {
			$inputStreet = $_POST['inputStreet'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputDeathName'])) {
			$inputDeathName = $_POST['inputDeathName'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputDeathReason'])) {
			$inputDeathReason = $_POST['inputDeathReason'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputWitnessName'])) {
			$inputWitnessName = $_POST['inputWitnessName'];
			$inputWitnessName = array_filter($inputWitnessName);
		} else {
			errorPage();
		}

		if (isset($_POST['inputRespondingName'])) {
			$inputRespondingName = $_POST['inputRespondingName'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputRespondingRank'])) {
			$inputRespondingRank = $_POST['inputRespondingRank'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputHandlingName'])) {
			$inputHandlingName = $_POST['inputHandlingName'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputHandlingRank'])) {
			$inputHandlingRank = $_POST['inputHandlingRank'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputCoronerName'])) {
			$inputCoronerName = $_POST['inputCoronerName'];
		} else {
			errorPage();	
		}

		if (isset($_POST['inputCaseNumber'])) {
			$inputCaseNumber = $_POST['inputCaseNumber'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputRecord'])) {
			$inputRecord = $_POST['inputRecord'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputEvidenceImage'])) {
			$inputEvidenceImage = $_POST['inputEvidenceImage'];
			$inputEvidenceImage = array_filter($inputEvidenceImage);
		}

		if (isset($_POST['inputEvidenceBox'])) {
			$inputEvidenceBox = $_POST['inputEvidenceBox'];
			$inputEvidenceBox = array_filter($inputEvidenceBox);
		}

		if (empty($inputEvidenceImage) == false) {
			$i = 1;
			foreach ($inputEvidenceImage as $inputEvidenceImg) {
				$evidenceImage[] = "[altspoiler=EXHIBIT - Photograph #0".$i."][img]".$inputEvidenceImg."[/img][/altspoiler]";
				$i++;
			}
			$evidenceImage = implode("", $evidenceImage);
		} else {
			$evidenceImage = "";
		}

		if (empty($inputEvidenceBox) == false) {
			$i = 1;
			foreach ($inputEvidenceBox as $inputEvidenceB) {
				$evidenceBox[] = "[altspoiler=EXHIBIT - Description #0".$i."]".$inputEvidenceB."[/altspoiler]";
				$i++;
			}
			$evidenceBox = implode("", $evidenceBox);
		} else {
			$evidenceBox = "";
		}

		if (empty($inputWitnessName) == false) {
			$i = 1;
			foreach ($inputWitnessName as $witnessName) {
				$witnesses[] = $witnessName;
				$i++;
			}
			$witnesses = implode(", ", $witnesses);
		} else {
			$witnesses = "N/A";
		}

		$deathReportTitle = $dr->getDeceasedName($inputDeathName)." - ".$inputDate." - ".$inputStreet.", ".$inputDistrict;

		$deathReport = "[divbox2=white]
[aligntable=right,0,0,15,0,0,transparent]LOS SANTOS POLICE DEPT.
RECORDS AND INFORMATION ARCHIVES
VESPUCCI POLICE HEADQUARTERS
LOS SANTOS, SAN ANDREAS

[/aligntable][aligntable=left,0,15,0,0,0,transparent][lspdlogo=130][/lspdlogo][/aligntable]
[color=transparent]tt[/color]
[color=transparent]tt[/color]
[color=transparent]tt[/color]
[hr][/hr]
[b]1. GENERAL INFORMATION[/b]
[hr][/hr]
[list=none][b]NAME OF DECEASED:[/b] ".$dr->getDeceasedName($inputDeathName)."
[b]TIME & DATE OF DEATH:[/b] ".$inputTime." - ".strtoupper($inputDate)."
[b]LOCATION OF DEATH:[/b] ".$inputStreet.", ".$inputDistrict."
[b]APPARENT CAUSE OF DEATH:[/b] ".$inputDeathReason."
[b]WITNESSES:[/b] ".$witnesses."[/list]
[b]2. ADMINISTRATIVE INFORMATION[/b]
[hr][/hr]
[list=none][b]FIRST RESPONDING OFFICER:[/b] ".$g->getRank($inputRespondingRank)." ".$inputRespondingName."
[b]HANDLING DETECTIVE/FORENSIC ANALYST:[/b] ".$g->getRank($inputHandlingRank)." ".$dr->getHandlingName($inputHandlingName)."
[b]HANDLING CORONER:[/b] ".$dr->getHandlingCoroner($inputCoronerName)."
[b]CORONER CASE NUMBER:[/b] ".$dr->getCoronerCaseNumber($inputCaseNumber)."
[b]RELEVANT MDC RECORDS:[/b] [url=".$dr->getMDCRecord($inputRecord)."]LINK[/url][/list]
[b]3. EVIDENCE[/b]
".$evidenceImage."
".$evidenceBox."
[hr][/hr]
[/divbox2]";

		$_SESSION['deathReport'] = $deathReport;
		$_SESSION['deathReportTitle'] = strtoupper($deathReportTitle);

		header('Location: ../index.php?page=deathReportResults');
		exit();

	} else {

		$deathReport = "Error! Contact xanx#0001 on Discord";
		$_SESSION['deathReport'] = $deathReport;
		$_SESSION['deathReportTitle'] = $deathReport;
		header('Location: ../index.php?page=deathReportResults');
		exit();

	}
?>