<?php
	
	session_start();
	require '../models/general.php';
	require '../models/trafficPatrol.php';
	$g = new General();
	$tp = new TrafficPatrol();

	function errorPage() {
		header('Location: ../index.php?page=TDpatrolReport&message=missing');
		exit();
	}

	if (isset($_POST['submit'])) {

		if (isset($_POST['inputDateFrom'])) {
			$inputDateFrom = $_POST['inputDateFrom'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputDateTo'])) {
			$inputDateTo = $_POST['inputDateTo'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputTimeFrom'])) {
			$inputTimeFrom = $_POST['inputTimeFrom'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputTimeTo'])) {
			$inputTimeTo = $_POST['inputTimeTo'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputCallsign'])) {
			$inputCallsign = $_POST['inputCallsign'];
			setcookie("callSign",$inputCallsign,time()+21960, "/MDC");
		} else {
			errorPage();
		}

		if (isset($_POST['inputNameTS'])) {
			$inputNameTS = $_POST['inputNameTS'];
			$inputNameTS = array_filter($inputNameTS);
		}

		if (isset($_POST['inputReasonTS'])) {
			$inputReasonTS = $_POST['inputReasonTS'];
			$inputReasonTS = array_filter($inputReasonTS);
		}

		if (isset($_POST['inputCitationsTS'])) {
			$inputCitationsTS = $_POST['inputCitationsTS'];
		}

		if (isset($_POST['inputVehicleImpounds'])) {
			$inputVehicleImpounds = $_POST['inputVehicleImpounds'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputTrafficInvestigations'])) {
			$inputTrafficInvestigations = $_POST['inputTrafficInvestigations'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputLicenseSuspensions'])) {
			$inputLicenseSuspensions = $_POST['inputLicenseSuspensions'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputArrestsConducted'])) {
			$inputArrestsConducted = $_POST['inputArrestsConducted'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputNotes'])) {
			$inputNotes = $_POST['inputNotes'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputTDPatrolReportURL'])) {
			$inputTDPatrolReportURL = $_POST['inputTDPatrolReportURL'];
			setcookie("inputTDPatrolReportURL",$inputTDPatrolReportURL,2147483647, "/MDC");
		} else {
			errorPage();
		}

		if (empty($inputNameTS) == false) {

			$iTS = 0;
			$iCitations = 0;
			$iWarnings = 0;

			foreach ($inputNameTS as $trafficStop) {
				$trafficStops[] = "[*]" . $trafficStop . " - " . $inputReasonTS[$iTS];
				if ($inputCitationsTS[$iTS]) {
					$iCitations += $inputCitationsTS[$iTS];
				} else {
					$iWarnings++;
				}
				$iTS++;
			}

			$trafficStops = implode("", $trafficStops);

			$trafficStopText = "[b]Traffic Stops:[/b] " . $iTS . "
[list=circle]" . $trafficStops . "
[/list]";
		} else {
			$iTS = 0;
			$iCitations = 0;
			$iWarnings = 0;

			$trafficStopText = "[b]Traffic Stops:[/b] " . $iTS;
		}

		if (!$inputVehicleImpounds) {
			$inputVehicleImpounds = 0;
		}
		if (!$inputLicenseSuspensions) {
			$inputLicenseSuspensions = 0;
		}
		if (!$inputArrestsConducted) {
			$inputArrestsConducted = 0;
		}
		if (!$inputTrafficInvestigations) {
			$inputTrafficInvestigations = 0;
		}

$trafficPatrol = "[divbox2=#f7f7f7]
[center][tedlogo=175][/tedlogo]
[hr][/hr]
[img]https://i.imgur.com/7njmZU1.png[/img][size=130] [b]LOS SANTOS POLICE DEPARTMENT[/b][/size][img]https://i.imgur.com/7njmZU1.png[/img]
[size=100][b]Traffic Division[/b][/size]
[size=85][color=#012B47][b]TRAFFIC PATROL REPORT[/b][/color][/size][/center]
[hr][/hr]
[b]Date:[/b] " . strtoupper($tp->dateResolver($inputDateFrom, $inputDateTo)) . "
[b]Time:[/b] " . $inputTimeFrom . " - " . $inputTimeTo . "
[b]Call-sign:[/b] " . $inputCallsign . "

" . $trafficStopText . "
[b]Warnings issued:[/b] " . $iWarnings . "
[b]Citations issued:[/b] " . $iCitations . "
[b]Vehicles impounded:[/b] " . $inputVehicleImpounds . "
[b]Licenses suspended:[/b] " . $inputLicenseSuspensions . "
[b]Arrests conducted:[/b] " . $inputArrestsConducted . "
[b]Traffic investigations:[/b] " . $inputTrafficInvestigations . "

[b]Notes (Optional):[/b] " . $tp->noteResolver($inputNotes) . "
[/divbox2]";

		$_SESSION['trafficPatrol'] = $trafficPatrol;

		header('Location: ../index.php?page=tdPatrolReportResults');
		exit();

	} else {

		$trafficPatrol = "Error! Contact xanx#0001 on Discord";
		$_SESSION['trafficPatrol'] = $trafficPatrol;
		header('Location: ../index.php?page=tdPatrolReportResults');
		exit();

	}
?>