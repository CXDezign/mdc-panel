<?php

	session_start();
	require '../models/general.php';
	require '../models/trafficReport.php';
	require '../models/arrestReport.php';
	$g = new General();
	$tr = new TrafficReport();
	$ar = new ArrestReport();

	if (isset($_POST['generatorType'])) {

		// Initialise Common Variables
		$generatorType = $_POST['generatorType'];
		$penal = json_decode(file_get_contents("../resources/penalSearch.json"), true);
		$generatedReportType = "";
		$generatedReport = "";
		$generatedThreadURL = "";
		$generatedThreadTitle = "";

		if ($generatorType == "TrafficReport") {

			// Variables
			$redirectPath = "report";
			$inputDate = strtoupper($_POST['inputDate']);
			$inputTime = $_POST['inputTime'];
			$inputCallsign = $_POST['inputCallsign'];
			setcookie("callSign",$inputCallsign,time()+21960, "/");
			$inputName = $_POST['inputName'];
			setcookie("officerName",$inputName[0],2147483647, "/");
			$inputRank = $_POST['inputRank'];
			setcookie("officerRank",$inputRank[0],2147483647, "/");
			$inputBadge = $_POST['inputBadge'];
			setcookie("officerBadge",$inputBadge[0],2147483647, "/");
			$inputDefName = $_POST['inputDefName'];
			setcookie("defName",$inputDefName,time()+3660, "/");
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

		if ($generatorType == "ArrestReport") {

			// Variables
			$redirectPath = "report";
			$inputDate = $_POST['inputDate'];
			$inputTime = $_POST['inputTime'];
			$inputCallsign = $_POST['inputCallsign'];
			setcookie("callSign",$inputCallsign,time()+21960, "/");
			$inputName = $_POST['inputName'];
			setcookie("officerName",$inputName[0],2147483647, "/");
			$inputRank = $_POST['inputRank'];
			setcookie("officerRank",$inputRank[0],2147483647, "/");
			$inputBadge = $_POST['inputBadge'];
			setcookie("officerBadge",$inputBadge[0],2147483647, "/");
			$inputStreet = $_POST['inputStreet'];
			$inputDistrict = $_POST['inputDistrict'];
			$inputDefName = $_POST['inputDefName'];
			setcookie("defName",$inputDefName,time()+3660, "/");
			$inputNarrative = $_POST['inputNarrative'];
			$inputEvidence = $_POST['inputEvidence'];
			$inputDashcam = $_POST['inputDashcam'];
			$inputWristband = $_POST['inputWristband'];
			$inputBracelet = $_POST['inputBracelet'];
			$inputPlea = $_POST['inputPlea'];


			// Officer Resolver
			$iOfficer = 0;
			$officers = "";
			foreach ($inputName as $inputNameResolved) {
				$officers .= "<b>".$g->getRank($inputRank[$iOfficer])." ".$inputName[$iOfficer]."</b> (<b>#".$inputBadge[$iOfficer]."</b>), ";
				$iOfficer++;
			}


			// Wristband & Bracelet Resolver
			if ($inputWristband != 0 || $inputBracelet != 0) {
				$wristbandBracelet = "<b>".$ar->getBracelet($inputBracelet)." & ".$ar->getWristband($inputWristband)."</b>.<br>";
			} else {
				$wristbandBracelet = "";
			}


			// Evidence Resolver			
			if ($inputEvidence != '') {
				$evidence = '<b>EVIDENCE</b><br>'. nl2br($inputEvidence);
			} else {
				$evidence = '';
			}


			// Report Builder
			$generatedReportType = "Arrest Report";
			$generatedReport = $officers."under the callsign <b>".$inputCallsign."</b>
			 conducted an arrest on <b>".$inputDefName."</b>
			 on the <b>".strtoupper($inputDate)."</b>, <b>".$inputTime."</b>.
			 The suspect apprehension took place on<b> ".$inputStreet.", ".$inputDistrict."</b>.<br><br>"
			 .nl2br($inputNarrative)."<br><br>
			".$wristbandBracelet."
			".$ar->getPlea($inputPlea, $inputDefName)."<br><br>
			".$ar->getDashboardCamera($inputDashcam, $inputCallsign)."<br>".$evidence;
		}

		if ($generatorType == "DeathReport") {

			// Variables
			$redirectPath = "thread";
			$inputDate = (empty($_POST['inputDate'])) ? $g->getDate() : $_POST['inputDate'];
			$inputTime = (empty($_POST['inputTime'])) ? $g->getTime() : $_POST['inputTime'];

			$inputDistrict = (empty($_POST['inputDistrict'])) ? "UNKNOWN DISTRICT" : $_POST['inputDistrict'];
			$inputStreet = (empty($_POST['inputStreet'])) ? "UNKNOWN STREET" : $_POST['inputStreet'];

			$inputDeathName = (empty($_POST['inputDeathName'])) ? "JOHN/JANE DOE" : $_POST['inputDeathName'];
			$inputDeathReason = (empty($_POST['inputDeathReason'])) ? "UNKNOWN CAUSE OF DEATH" : $_POST['inputDeathReason'];

			$inputWitnessName = (empty($_POST['inputWitnessName'])) ? '' : array_values(array_filter($_POST['inputWitnessName']));

			$inputRespondingName = (empty($_POST['inputRespondingName'])) ? "UNKNOWN RESPONDING OFFICER" : $_POST['inputRespondingName'];
			$inputRespondingRank = (empty($_POST['inputRespondingRank'])) ? 0 : $_POST['inputRespondingRank'];

			$inputHandlingName = (empty($_POST['inputHandlingName'])) ? "N/A" : $_POST['inputHandlingName'];
			$inputHandlingRank = (empty($_POST['inputHandlingRank'])) ? 0 : $_POST['inputHandlingRank'];

			$inputCoronerName = (empty($_POST['inputCoronerName'])) ? "N/A" : $_POST['inputCoronerName'];
			$inputCaseNumber = (empty($_POST['inputCaseNumber'])) ? "N/A" : $_POST['inputCaseNumber'];
			$inputRecord = (empty($_POST['inputRecord'])) ? "#" : $_POST['inputRecord'];

			$inputEvidenceImage = (empty($_POST['inputEvidenceImage'])) ? '' : array_values(array_filter($_POST['inputEvidenceImage']));
			$inputEvidenceBox = (empty($_POST['inputEvidenceBox'])) ? '' : array_values(array_filter($_POST['inputEvidenceBox']));


			// Witness Resolver
			$witnesses = "N/A";
			if (empty($inputWitnessName) == false) {

				$witnesses = "";
				$iWitnesses = count($inputWitnessName);

				if ($iWitnesses > 1) {
					$witnesses .= "[list]";
					foreach ($inputWitnessName as $witness) {
						$witnesses .= "[*]".$witness;
					}
					$witnesses .= "[/list]";
				} else {
					foreach ($inputWitnessName as $witness) {
						$witnesses .= $witness;
					}
				}
			}


			// Evidence Resolver
			$evidenceImage = "";
			if (empty($inputEvidenceImage) == false) {

				$evidenceImage = "";
				foreach ($inputEvidenceImage as $eImgID => $image) {
					$evidenceImageCount = $eImgID + 1;
					$evidenceImage .= "[altspoiler=EXHIBIT - Photograph #".$evidenceImageCount."][img]".$image."[/img][/altspoiler]";
				}
			}

			$evidenceBox = "";
			if (empty($inputEvidenceBox) == false) {

				$evidenceBox = "";
				foreach ($inputEvidenceBox as $eBoxID => $box) {
					$evidenceBoxCount = $eBoxID + 1;
					$evidenceBox .= "[altspoiler=EXHIBIT - Description #".$evidenceBoxCount."]".$box."[/altspoiler]";
				}
			}


			// Report Builder
			$generatedReportType = "Death Report";
			$generatedThreadURL = "https://lspd.gta.world/posting.php?mode=post&f=1356";
			$generatedThreadTitle = $inputDeathName." - ".strtoupper($inputDate)." - ".$inputStreet.", ".$inputDistrict;
			$generatedReport = "
				[divbox2=white]
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
				[list=none][b]NAME OF DECEASED:[/b] ".$inputDeathName."
				[b]TIME & DATE OF DEATH:[/b] ".$inputTime." - ".strtoupper($inputDate)."
				[b]LOCATION OF DEATH:[/b] ".$inputStreet.", ".$inputDistrict."
				[b]APPARENT CAUSE OF DEATH:[/b] ".$inputDeathReason."
				[b]WITNESSES:[/b] ".$witnesses."[/list]
				[b]2. ADMINISTRATIVE INFORMATION[/b]
				[hr][/hr]
				[list=none][b]FIRST RESPONDING OFFICER:[/b] ".$g->getRank($inputRespondingRank,1)." ".$inputRespondingName."
				[b]HANDLING DETECTIVE/FORENSIC ANALYST:[/b] ".$g->getRank($inputHandlingRank,1)." ".$inputHandlingName."
				[b]HANDLING CORONER:[/b] ".$inputCoronerName."
				[b]CORONER CASE NUMBER:[/b] ".$inputCaseNumber."
				[b]RELEVANT MDC RECORDS:[/b] [url=".$inputRecord."]LINK[/url][/list]
				[b]3. EVIDENCE[/b]
				".$evidenceImage."
				".$evidenceBox."
				[hr][/hr]
				[/divbox2]";
		}

		if ($generatorType == "EvidenceRegistrationLog") {

			// Variables
			$redirectPath = "thread";
			$inputDate = (empty($_POST['inputDate'])) ? $g->getDate() : $_POST['inputDate'];
			$inputTime = (empty($_POST['inputTime'])) ? $g->getTime() : $_POST['inputTime'];

			$inputName = (empty($_POST['inputName'])) ? "UNKNOWN NAME" : $_POST['inputName'];
			setcookie("officerName",$inputName,2147483647,"/");
			$inputRank = (empty($_POST['inputRank'])) ? 0 : $_POST['inputRank'];
			setcookie("officerRank",$inputRank,2147483647,"/");

			$inputSuspectName = (empty($_POST['inputSuspectName'])) ? "UNKNOWN NAME" : $_POST['inputSuspectName'];
			$inputItemCategory = (empty($_POST['inputItemCategory'])) ? 0 : $_POST['inputItemCategory'];

			$inputItemRegistry = array_map(function($value) {
				return $value === "" ? "UNKNOWN ITEM" : $value;
			}, $_POST['inputItemRegistry']);

			$inputItemAmount = array_map(function($value) {
				return $value === "" ? "?" : $value;
			}, $_POST['inputItemAmount']);

			$inputEvidenceImage = (empty($_POST['inputEvidenceImage'])) ? '' : array_values(array_filter($_POST['inputEvidenceImage']));


			// Evidence Resolver
			$evidence = "N/A";
			if (empty($inputEvidenceImage) == false) {

				$evidence = "";
				foreach ($inputEvidenceImage as $eID => $image) {
					$evidenceCount = $eID + 1;
					$evidence .= "[altspoiler=EXHIBIT #".$evidenceCount."][img]".$image."[/img][/altspoiler]";
				}
			}


			// Item Resolver
			$items = "";
			foreach ($inputItemRegistry as $itemID => $item) {
				$items .= "[*] x".$inputItemAmount[$itemID]." - ".$item;
			}


			// Report Builder
			$generatedReportType = "Evidence Registration Log";
			$generatedThreadURL = "https://lspd.gta.world/posting.php?mode=post&f=388";
			$generatedThreadTitle = "[".$g->getItemCategory($inputItemCategory)."] ".$inputSuspectName." [".strtoupper($inputDate)."]";
			$generatedReport = "
				[divbox2=#fff]
				[center][lspdlogo=150][/lspdlogo]

				[size=120][b]Los Santos Police Department
				Mission Row Station[/b][/size]
				[i]Evidence Registration Log[/i][/center]
				[color=white]...[/color]
				[hr][/hr]
				[color=white]...[/color]
				[b]Name:[/b] ".$inputName."
				[b]Rank:[/b] ".$g->getRank($inputRank,1)."
				[b]Date & Time:[/b] ".strtoupper($inputDate)." - ".$inputTime."

				[b]Suspect Name:[/b] ".$inputSuspectName."
				[b]Items name & amount:[/b]

				[list]".$items."[/list]

				[b]Screenshot:[/b]
				".$evidence."
				[/divbox2]";
		}

		if ($generatorType == "TrafficDivisionPatrolReport") {

			// Variables
			$redirectPath = "thread";
			$inputDateFrom = (empty($_POST['inputDateFrom'])) ? $g->getDate() : $_POST['inputDateFrom'];
			$inputDateTo = (empty($_POST['inputDateTo'])) ? $g->getDate() : $_POST['inputDateTo'];
			$inputTimeFrom = (empty($_POST['inputTimeFrom'])) ? $g->getTime() : $_POST['inputTimeFrom'];
			$inputTimeTo = (empty($_POST['inputTimeTo'])) ? $g->getTime() : $_POST['inputTimeTo'];

			$inputCallsign = (empty($_POST['inputCallsign'])) ? '' : strtoupper($_POST['inputCallsign']);
			setcookie("callSign",$inputCallsign,time()+21960, "/");

			$inputNameTS = (empty($_POST['inputNameTS'])) ? '' : array_filter($_POST['inputNameTS']);
			$inputReasonTS = (empty($_POST['inputReasonTS'])) ? '' : array_filter($_POST['inputReasonTS']);
			$inputCitationsTS = (empty($_POST['inputCitationsTS'])) ? '' : $_POST['inputCitationsTS'];

			$inputVehicleImpounds = (empty($_POST['inputVehicleImpounds'])) ? '0' : $_POST['inputVehicleImpounds'];
			$inputTrafficInvestigations = (empty($_POST['inputTrafficInvestigations'])) ? '0' : $_POST['inputTrafficInvestigations'];
			$inputLicenseSuspensions = (empty($_POST['inputLicenseSuspensions'])) ? '0' : $_POST['inputLicenseSuspensions'];
			$inputArrestsConducted = (empty($_POST['inputArrestsConducted'])) ? '0' : $_POST['inputArrestsConducted'];

			$inputNotes = (empty($_POST['inputNotes'])) ? 'N/A' : $_POST['inputNotes'];
			$inputTDPatrolReportURL = (empty($_POST['inputTDPatrolReportURL'])) ? "https://lspd.gta.world/viewforum.php?f=101" : $_POST['inputTDPatrolReportURL'];
			setcookie("inputTDPatrolReportURL",$inputTDPatrolReportURL,2147483647, "/");


			// Traffic Stop Resolver
			if (empty($inputNameTS) == false) {

				$iTS = count($inputNameTS);
				$iCitations = array_sum($inputCitationsTS);
				$iWarnings = 0;
				$trafficStops = "";

				foreach ($inputNameTS as $TSID => $name) {
					$trafficStops .= "[*]" . $name . " - " . $inputReasonTS[$TSID];
					if (!$inputCitationsTS[$TSID]) {
						$iWarnings++;
					}
				}

				$trafficStopText = "[b]Traffic Stops:[/b] " . $iTS . "[list=circle]" . $trafficStops . "[/list]";

			} else {

				$iTS = 0;
				$iCitations = 0;
				$iWarnings = 0;
				$trafficStopText = "[b]Traffic Stops:[/b] " . $iTS;

			}


			// Report Builder
			$generatedReportType = "Traffic Division: Patrol Report";
			$generatedThreadURL = $g->cookieTrafficPatrolURL();
			$generatedReport = "
				[divbox2=#f7f7f7]
				[center][tedlogo=175][/tedlogo]
				[hr][/hr]
				[img]https://i.imgur.com/7njmZU1.png[/img][size=130] [b]LOS SANTOS POLICE DEPARTMENT[/b][/size][img]https://i.imgur.com/7njmZU1.png[/img]
				[size=100][b]Traffic Division[/b][/size]
				[size=85][color=#012B47][b]TRAFFIC PATROL REPORT[/b][/color][/size][/center]
				[hr][/hr]
				[b]Date:[/b] " . strtoupper($g->dateResolver($inputDateFrom, $inputDateTo)) . "
				[b]Time:[/b] " . $inputTimeFrom . " - " . $inputTimeTo . "
				[b]Call-sign:[/b] " . $inputCallsign . "

				" . $trafficStopText . "
				[b]Warnings issued:[/b] " . $iWarnings . "
				[b]Citations issued:[/b] " . $iCitations . "
				[b]Vehicles impounded:[/b] " . $inputVehicleImpounds . "
				[b]Licenses suspended:[/b] " . $inputLicenseSuspensions . "
				[b]Arrests conducted:[/b] " . $inputArrestsConducted . "
				[b]Traffic investigations:[/b] " . $inputTrafficInvestigations . "

				[b]Notes (Optional):[/b] " . $inputNotes . "
				[/divbox2]";
		}

		if ($generatorType == "PatrolLog") {

			// Variables
			$redirectPath = "thread";
			$inputDate = strtoupper($_POST['inputDate']);
			$inputTime = $_POST['inputTime'];
			$inputTimeEnd = $_POST['inputTimeEnd'];

			$inputCallsign = (empty($_POST['inputCallsign'])) ? '' : strtoupper($_POST['inputCallsign']);
			setcookie("callSign",$inputCallsign,time()+21960, "/");

			$inputPartner = $_POST['inputPartner'];
			$inputRank = $_POST['inputRank'];
			$type = $_POST['type'];
			$inputTimeEvent = $_POST['inputTimeEvent'];
			$inputReasonInfo = $_POST['inputReasonInfo'];
			$inputVeh = $_POST['inputVeh'];
			$inputVehPlate = $_POST['inputVehPlate'];
			$inputDistrict = $_POST['inputDistrict'];
			$inputStreet = $_POST['inputStreet'];
			$inputReasonTS = $_POST['inputReasonTS'];
			$inputArrestee = $_POST['inputArrestee'];
			$inputArrestID = $_POST['inputArrestID'];
			$inputNotes = $_POST['inputNotes'];
		
			if (empty($inputNotes) == false) {
				$notes = "Additional Notes: ".$inputNotes;
			} else {
				$notes = "";
			}
			
			if (empty($inputPartner) == false) {
				$partner = $g->getRank($inputRank)." ".$inputPartner;
			} else {
				$partner = "N/A";
			}
			
			if (empty($type) == false) {
				$i = 0;
				$info = 0;
				$traffic = 0;
				$arrest = 0;
				
				foreach ($type as $eventType) {
					if ($eventType == '1') {
						$events[] = "[*] [b]".$inputTimeEvent[$i]."[/b] - ".$inputReasonInfo[$info];
						$info++;
					} else if ($eventType == '2') {
						$events[] = "[*] [b]".$inputTimeEvent[$i]."[/b] - Performed a [b]Traffic Stop[/b] on a [b]".$inputVeh[$traffic]."[/b] with the plate [b]".$inputVehPlate[$traffic]."[/b] at [b]".$inputStreet[$traffic].", ".$inputDistrict[$traffic]."[/b] - ".$inputReasonTS[$traffic];
						$traffic++;
					} else if ($eventType == '3') {
						$events[] = "[*] [b]".$inputTimeEvent[$i]."[/b] - Performed an [b]arrest[/b] on [url=https://mdc.gta.world/record/".str_replace(' ', '_', $inputArrestee[$arrest])."]".$inputArrestee[$arrest]."[/url] (Arrest Report: [b]#".$inputArrestID[$arrest]."[/b])";
						$arrest++;
					}
					$i++;
				}
				
			} else {
				$events[] = "[*] No details for patrol";
			}
			$events = implode("<br />", $events);

			// Report Builder
			$generatedReportType = "Patrol Log";
			$generatedThreadURL = "https://lspd.gta.world/viewforum.php?f=829";
			$generatedReport = "
				[divbox2=white]
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
		}

		// Report Finalisation
		$_SESSION['generatedReport'] = $generatedReport;
		$_SESSION['generatedReportType'] = $generatedReportType;
		$_SESSION['generatedThreadTitle'] = $generatedThreadTitle;
		$_SESSION['generatedThreadURL'] = $generatedThreadURL;

		// Redirect
		/*
		if ($redirectPath == "report") {
			header('Location: /paperwork-generators/generated-report');
			exit();
		} elseif ($redirectPath == "thread") {
			header('Location: /paperwork-generators/generated-thread');
			exit();
		}

		/**/

	} else {

		// Redirect to previous page and show message on said page.
		$generatedReport = "Fatal Error! Please contact xanx#0001 on Discord and describe the events in detail which occurred prior to this message.";
		$generatedReportType = "Fatal Error";
		$_SESSION['generatedReport'] = $generatedReport;
		$_SESSION['generatedReportType'] = $generatedReportType;
		header('Location: /paperwork-generators/generated-report');
		exit();

	}