<?php
	
	session_start();
	require '../models/general.php';
	require '../models/patrolLog.php';
	$g = new General();
	$pl = new PatrolLog();

	function errorPage() {
		header('Location: ../index.php?page=patrolLog&message=missing');
		exit();
	}

	if (isset($_POST['submit'])) {

		if (isset($_POST['inputDate'])) {
			$inputDate = strtoupper($_POST['inputDate']);
		} else {
			errorPage();
		}

		if (isset($_POST['inputTime'])) {
			$inputTime = $_POST['inputTime'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputTimeEnd'])) {
			$inputTimeEnd = $_POST['inputTimeEnd'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputCallsign'])) {
			$inputCallsign = $_POST['inputCallsign'];
			setcookie("callSign",$inputCallsign,time()+21960, "/MDC");
		} else {
			errorPage();
		}

		if (isset($_POST['inputPartner'])) {
			$inputPartner = $_POST['inputPartner'];
		}

		if (isset($_POST['inputRank'])) {
			$inputRank = $_POST['inputRank'];
		}
		
		if (isset($_POST['type'])) {
			$type = $_POST['type'];
		}
		
		if (isset($_POST['inputTimeEvent'])) {
			$inputTimeEvent = $_POST['inputTimeEvent'];
		}
		
		if (isset($_POST['inputReasonInfo'])) {
			$inputReasonInfo = $_POST['inputReasonInfo'];
		}

		if (isset($_POST['inputVeh'])) {
			$inputVeh = $_POST['inputVeh'];
		}

		if (isset($_POST['inputVehPlate'])) {
			$inputVehPlate = $_POST['inputVehPlate'];
		}
		
		if (isset($_POST['inputDistrict'])) {
			$inputDistrict = $_POST['inputDistrict'];
		}
		
		if (isset($_POST['inputStreet'])) {
			$inputStreet = $_POST['inputStreet'];
		}
		
		if (isset($_POST['inputReasonTS'])) {
			$inputReasonTS = $_POST['inputReasonTS'];
		}
		
		if (isset($_POST['inputArrestee'])) {
			$inputArrestee = $_POST['inputArrestee'];
		}
		
		if (isset($_POST['inputArrestID'])) {
			$inputArrestID = $_POST['inputArrestID'];
		}
		
		if (isset($_POST['inputNotes'])) {
			$inputNotes = $_POST['inputNotes'];
		}
		
		if(empty($inputNotes) == false)
		{
			$notes = "Additional Notes: ".$inputNotes;
		} else {
			$notes = "";
		}
		
		if(empty($inputPartner) == false)
		{
			$partner = $g->getRank($inputRank)." ".$inputPartner;
		} else {
			$partner = "N/A";
		}
		
		if(empty($type) == false)
		{
			$i = 0;
			$info = 0;
			$traffic = 0;
			$arrest = 0;
			
			foreach ($type as $eventType) {
				if ($eventType == '1')
				{
					$events[] = "[*] [b]".$inputTimeEvent[$i]."[/b] - ".$inputReasonInfo[$info];
					$info++;
				} else if ($eventType == '2')
				{
					$events[] = "[*] [b]".$inputTimeEvent[$i]."[/b] - Performed a [b]Traffic Stop[/b] on a [b]".$inputVeh[$traffic]."[/b] with the plate [b]".$inputVehPlate[$traffic]."[/b] at [b]".$inputStreet[$traffic].", ".$inputDistrict[$traffic]."[/b] - ".$inputReasonTS[$traffic];
					$traffic++;
				} else if ($eventType == '3')
				{
					$events[] = "[*] [b]".$inputTimeEvent[$i]."[/b] - Performed an [b]arrest[/b] on [url=https://mdc.gta.world/record/".str_replace(' ', '_', $inputArrestee[$arrest])."]".$inputArrestee[$arrest]."[/url] (Arrest Report: [b]#".$inputArrestID[$arrest]."[/b])";
					$arrest++;
				}
				$i++;
			}
			
		} else {
			$events[] = "[*] No details for patrol";
		}
		
		$events = implode("<br />", $events);

$patrolLog = "[divbox2=white]
[center][lspdlogo=200][/lspdlogo]
[color=white]...[/color]
[size=120][b]Los Santos Police Department
Mission Row Station[/b][/size]
[i]Patrol Log Entry[/i][/center]
[color=white]...[/color]
[hr][/hr]
[color=white]...[/color]
[b][u]Patrol Information[/u][/b]
[color=white]...[/color]
[b]Date:[/b] ".$inputDate."
[b]Start time:[/b] ".$inputTime."
[b]End time:[/b] ".$inputTimeEnd."
[color=white]...[/color]
[b]Callsign:[/b] ".$inputCallsign."
[b]Partner:[/b] ".$partner."
[color=white]...[/color]
[hr][/hr]
[color=white]...[/color]
[b][u]Details[/u][/b]
[list]
".$events."
[/list]
".$notes."
[/divbox2]";

		$_SESSION['patrolLog'] = $patrolLog;

		header('Location: ../index.php?page=patrolLogResults');
		exit();

	} else {

		$patrolLog = "Error! Contact xanx#0001 on Discord";
		$_SESSION['patrolLog'] = $patrolLog;
		header('Location: ../index.php?page=patrolLogResults');
		exit();

	}
?>