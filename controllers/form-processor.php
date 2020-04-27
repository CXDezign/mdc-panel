<?php

	session_start();

	// Required Models
	require '../models/general.php';
	require '../models/paperwork-generators.php';
	$g = new General();
	$pg = new PaperworkGenerators();

	if (isset($_POST['generatorType'])) {

		// Initialise Common Variables
		$generatorType = $_POST['generatorType'];
		$penal = json_decode(file_get_contents("../resources/penalSearch.json"), true);
		$generatedReportType = "";
		$generatedReport = "";
		$generatedThreadURL = "";
		$generatedThreadTitle = "";
		$showGeneratedThreadTitle = false;
		$showGeneratedArrestChargeTables = false;
		$generatedArrestChargeList = "";
		$generatedArrestChargeTotals = "";

		if ($generatorType == "TrafficReport") {

			// Variables
			$redirectPath = "report";
			$inputDate = (empty($_POST['inputDate'])) ? $g->getDate() : $_POST['inputDate'];
			$inputTime = (empty($_POST['inputTime'])) ? $g->getTime() : $_POST['inputTime'];

			$inputCallsign = (empty($_POST['inputCallsign'])) ? 'N/A' : strtoupper($_POST['inputCallsign']);
			setcookie("callSign",$inputCallsign,time()+21960,"/");

			$inputName = (empty($_POST['inputName'])) ? array() : $_POST['inputName'];
			$inputName = array_map(function($value) {
				return $value === "" ? "UNKNOWN NAME" : $value;
			}, $inputName);
			setcookie("officerName",$inputName[0],2147483647,"/");

			$inputRank = (empty($_POST['inputRank'])) ? array() : $_POST['inputRank'];
			$inputRank = array_map(function($value) {
				return $value === "" ? 0 : $value;
			}, $inputRank);
			setcookie("officerRank",$inputRank[0],2147483647,"/");

			$inputBadge = (empty($_POST['inputBadge'])) ? array() : $_POST['inputBadge'];
			$inputBadge = array_map(function($value) {
				return $value === "" ? "" : $value;
			}, $inputBadge);
			setcookie("officerBadge",$inputBadge[0],2147483647,"/");

			$inputDefName = (empty($_POST['inputDefName'])) ? 'UNKNOWN SUSPECT NAME' : $_POST['inputDefName'];
			setcookie("defName",$inputDefName,time()+3660,"/");

			$inputDefLicense = (empty($_POST['inputDefLicense'])) ? 0 : $_POST['inputDefLicense'];
			$inputNarrative = (empty($_POST['inputNarrative'])) ? "" : $_POST['inputNarrative'];
			$inputDashcam = (empty($_POST['inputDashcam'])) ? "" : $_POST['inputDashcam'];

			$inputDistrict = (empty($_POST['inputDistrict'])) ? "UNKNOWN DISTRICT" : $_POST['inputDistrict'];
			$inputStreet = (empty($_POST['inputStreet'])) ? "UNKNOWN STREET" : $_POST['inputStreet'];

			$inputVeh = (empty($_POST['inputVeh'])) ? "UNKNOWN VEHICLE" : $_POST['inputVeh'];
			$inputVehPaint = (empty($_POST['inputVehPaint'])) ? "UNKNOWN PAINT" : $_POST['inputVehPaint'];
			$inputVehPlate = (empty($_POST['inputVehPlate'])) ? "" : $_POST['inputVehPlate'];
			$inputVehTint = (empty($_POST['inputVehTint'])) ? "" : $_POST['inputVehTint'];

			$inputCrime = (empty($_POST['inputCrime'])) ? array() : $_POST['inputCrime'];
			$inputCrime = array_map(function($value) {
				return $value === "" ? "UNKNOWN CHARGE" : $value;
			}, $inputCrime);

			$inputCrimeType = (empty($_POST['inputCrimeType'])) ? array() : $_POST['inputCrimeType'];
			$inputCrimeType = array_map(function($value) {
				return $value === "" ? 0 : $value;
			}, $inputCrimeType);

			$inputCrimeFine = (empty($_POST['inputCrimeFine'])) ? array() : $_POST['inputCrimeFine'];
			$inputCrimeFine = array_map(function($value) {
				return $value === "" ? 0 : $value;
			}, $inputCrimeFine);


			// Officer Resolver
			$officers = "";
			foreach ($inputName as $iOfficer => $officer) {
				$officerRank = $pg->getRank(0,1);
				if (empty($inputRank[$iOfficer]) == false) {
					$officerRank = $pg->getRank($inputRank[$iOfficer],1);
				}
				$officers .= "<b>".$officerRank." ".$officer."</b> (<b>#".$inputBadge[$iOfficer]."</b>), ";
			}


			// Crime Resolver
			$fines = "";
			foreach ($inputCrime as $iCrime => $crime) {
				$charge = $penal[$crime];
				$chargeTitle = $charge['charge'];
				$chargeClassification = $charge['classification'];
				$chargeType = "?";
				if (empty($inputCrimeType[$iCrime]) == false) {
					$chargeType = $pg->getCrimeType($inputCrimeType[$iCrime]);
				}
				if ($inputCrimeFine[$iCrime] == 0) {
					$fines .= "- <b>".$pg->getCrimeColour($chargeClassification).$chargeClassification.$chargeType." ".$crime.". ".$chargeTitle."</span></b>.<br>";
				} else {
					$fines .= "- <b>".$pg->getCrimeColour($chargeClassification).$chargeClassification.$chargeType." ".$crime.". ".$chargeTitle."</span></b> - <b style='color: green;'>$".number_format($inputCrimeFine[$iCrime])."</b> Citation.<br>";
				}
			}


			// Report Builder
			$generatedReportType = "Traffic Report";
			$generatedReport = $officers."under the call sign <b>".$inputCallsign."</b> on the <b>".strtoupper($inputDate)."</b>, <b>".$inputTime."</b>.<br>Conducted a traffic stop on a <b>".$inputVehPaint." ".$inputVeh."</b>, ".$pg->getVehiclePlates($inputVehPlate,0).", on <b>".$inputStreet."</b>, <b>".$inputDistrict."</b>.<br>".$pg->getVehicleTint($inputVehTint)."<br>The defendant was identified as <b>".$inputDefName."</b>, possessing ".$pg->getDefLicense($inputDefLicense)."<br>".$inputNarrative."<br><br>Following charge(s) were issued:<br>".$fines."<br>".$pg->getDashboardCamera($inputDashcam);
		}

		if ($generatorType == "ArrestReport") {

			// Variables
			$redirectPath = "report";
			$inputDate = (empty($_POST['inputDate'])) ? $g->getDate() : $_POST['inputDate'];
			$inputTime = (empty($_POST['inputTime'])) ? $g->getTime() : $_POST['inputTime'];

			$inputCallsign = (empty($_POST['inputCallsign'])) ? 'N/A' : strtoupper($_POST['inputCallsign']);
			setcookie("callSign",$inputCallsign,time()+21960,"/");

			$inputName = (empty($_POST['inputName'])) ? array() : $_POST['inputName'];
			$inputName = array_map(function($value) {
				return $value === "" ? "UNKNOWN NAME" : $value;
			}, $inputName);
			setcookie("officerName",$inputName[0],2147483647,"/");

			$inputRank = (empty($_POST['inputRank'])) ? array() : $_POST['inputRank'];
			$inputRank = array_map(function($value) {
				return $value === "" ? 0 : $value;
			}, $inputRank);
			setcookie("officerRank",$inputRank[0],2147483647,"/");

			$inputBadge = (empty($_POST['inputBadge'])) ? array() : $_POST['inputBadge'];
			$inputBadge = array_map(function($value) {
				return $value === "" ? "" : $value;
			}, $inputBadge);
			setcookie("officerBadge",$inputBadge[0],2147483647,"/");

			$inputDistrict = (empty($_POST['inputDistrict'])) ? "UNKNOWN DISTRICT" : $_POST['inputDistrict'];
			$inputStreet = (empty($_POST['inputStreet'])) ? "UNKNOWN STREET" : $_POST['inputStreet'];

			$inputDefName = (empty($_POST['inputDefName'])) ? 'UNKNOWN SUSPECT NAME' : $_POST['inputDefName'];
			setcookie("defName",$inputDefName,time()+3660,"/");

			$inputNarrative = (empty($_POST['inputNarrative'])) ? "UNKNOWN NOTES" : $_POST['inputNarrative'];
			$inputEvidence = (empty($_POST['inputEvidence'])) ? '' : '<b>Evidence:</b><br>'.nl2br($_POST['inputEvidence'])."<br>";
			$inputDashcam = (empty($_POST['inputDashcam'])) ? '' : $_POST['inputDashcam'];

			$inputWristband = (empty($_POST['inputWristband'])) ? 0 : $_POST['inputWristband'];
			$inputBracelet = (empty($_POST['inputBracelet'])) ? 0 : $_POST['inputBracelet'];
			$inputPlea = (empty($_POST['inputPlea'])) ? 0 : $_POST['inputPlea'];


			// Officer Resolver
			$officers = "";
			foreach ($inputName as $iOfficer => $officer) {
				$officerRank = $pg->getRank(0,1);
				if (empty($inputRank[$iOfficer]) == false) {
					$officerRank = $pg->getRank($inputRank[$iOfficer],1);
				}
				$officers .= "<b>".$officerRank." ".$officer."</b> (<b>#".$inputBadge[$iOfficer]."</b>), ";
			}


			// Wristband & Bracelet Resolver
			$wristbandBracelet = "";
			if ($inputWristband != 0 || $inputBracelet != 0) {
				$wristbandBracelet = "<b>".$pg->getBracelet($inputBracelet)." & ".$pg->getWristband($inputWristband)."</b>.";
			}


			// Report Builder
			$generatedReportType = "Arrest Report";
			$generatedReport = $officers."under the callsign <b>".$inputCallsign."</b>
			 conducted an arrest on <b>".$inputDefName."</b>
			 on the <b>".strtoupper($inputDate)."</b>, <b>".$inputTime."</b>.
			 The suspect apprehension took place on<b> ".$inputStreet.", ".$inputDistrict."</b>.<br>"
			 .$wristbandBracelet."<br>".$pg->getPlea($inputPlea, $inputDefName)."<br><br>"
			 .nl2br($inputNarrative)."<br><br>".$inputEvidence."<br>".$pg->getDashboardCamera($inputDashcam);
			$showGeneratedArrestChargeTables = $_SESSION['showGeneratedArrestChargeTables'];
			$generatedArrestChargeList = $_SESSION['generatedArrestChargeList'];
			$generatedArrestChargeTotals = $_SESSION['generatedArrestChargeTotals'];
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
			$showGeneratedThreadTitle = true;
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
				[list=none][b]FIRST RESPONDING OFFICER:[/b] ".$pg->getRank($inputRespondingRank,1)." ".$inputRespondingName."
				[b]HANDLING DETECTIVE/FORENSIC ANALYST:[/b] ".$pg->getRank($inputHandlingRank,1)." ".$inputHandlingName."
				[b]HANDLING CORONER:[/b] ".$inputCoronerName."
				[b]CORONER CASE NUMBER:[/b] ".$inputCaseNumber."
				[b]RELEVANT MDC RECORDS:[/b] [url=".$inputRecord."]LINK[/url][/list]
				[b]3. EVIDENCE[/b]
				".$evidenceImage."
				".$evidenceBox."
				[hr][/hr]
				[/divbox2]";
			$generatedReport = str_replace("				", "", $generatedReport);
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

			$inputItemRegistry = (empty($_POST['inputItemRegistry'])) ? array() : $_POST['inputItemRegistry'];
			$inputItemRegistry = array_map(function($value) {
				return $value === "" ? "UNKNOWN ITEM" : $value;
			}, $inputItemRegistry);

			$inputItemAmount = (empty($_POST['inputItemAmount'])) ? array() : $_POST['inputItemAmount'];
			$inputItemAmount = array_map(function($value) {
				return $value === "" ? "?" : $value;
			}, $inputItemAmount);

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
			$showGeneratedThreadTitle = true;
			$generatedThreadURL = "https://lspd.gta.world/posting.php?mode=post&f=388";
			$generatedThreadTitle = "[".$pg->getItemCategory($inputItemCategory)."] ".$inputSuspectName." [".strtoupper($inputDate)."]";
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
				[b]Rank:[/b] ".$pg->getRank($inputRank,1)."
				[b]Date & Time:[/b] ".strtoupper($inputDate)." - ".$inputTime."

				[b]Suspect Name:[/b] ".$inputSuspectName."
				[b]Items name & amount:[/b]

				[list]".$items."[/list]

				[b]Screenshot:[/b]
				".$evidence."
				[/divbox2]";
			$generatedReport = str_replace("				", "", $generatedReport);
		}

		if ($generatorType == "TrafficDivisionPatrolReport") {

			// Variables
			$redirectPath = "thread";
			$inputDateFrom = (empty($_POST['inputDateFrom'])) ? $g->getDate() : $_POST['inputDateFrom'];
			$inputDateTo = (empty($_POST['inputDateTo'])) ? $g->getDate() : $_POST['inputDateTo'];
			$inputTimeFrom = (empty($_POST['inputTimeFrom'])) ? $g->getTime() : $_POST['inputTimeFrom'];
			$inputTimeTo = (empty($_POST['inputTimeTo'])) ? $g->getTime() : $_POST['inputTimeTo'];

			$inputCallsign = (empty($_POST['inputCallsign'])) ? 'N/A' : strtoupper($_POST['inputCallsign']);
			setcookie("callSign",$inputCallsign,time()+21960, "/");

			$inputNameTS = (empty($_POST['inputNameTS'])) ? array() : $_POST['inputNameTS'];
			$inputNameTS = array_map(function($value) {
				return $value === "" ? "UNKNOWN NAME" : $value;
			}, $inputNameTS);

			$inputReasonTS = (empty($_POST['inputReasonTS'])) ? array() : $_POST['inputReasonTS'];
			$inputReasonTS = array_map(function($value) {
				return $value === "" ? "UNKNOWN REASON" : $value;
			}, $inputReasonTS);

			$inputCitationsTS = (empty($_POST['inputCitationsTS'])) ? array() : $_POST['inputCitationsTS'];
			$inputCitationsTS = array_map(function($value) {
				return $value === "" ? 0 : $value;
			}, $inputCitationsTS);

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
					if ($inputCitationsTS[$TSID] == 0) {
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
			$showGeneratedThreadTitle = false;
			$generatedThreadURL = $g->cookieTrafficPatrolURL();
			$generatedReport = "
				[divbox2=#f7f7f7]
				[center][tedlogo=175][/tedlogo]
				[hr][/hr]
				[img]https://i.imgur.com/7njmZU1.png[/img][size=130] [b]LOS SANTOS POLICE DEPARTMENT[/b][/size][img]https://i.imgur.com/7njmZU1.png[/img]
				[size=100][b]Traffic Division[/b][/size]
				[size=85][color=#012B47][b]TRAFFIC PATROL REPORT[/b][/color][/size][/center]
				[hr][/hr]
				[b]Date:[/b] " . strtoupper($pg->dateResolver($inputDateFrom, $inputDateTo)) . "
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
			$generatedReport = str_replace("				", "", $generatedReport);
		}

		if ($generatorType == "PatrolLog") {

			// Variables
			$redirectPath = "thread";
			$inputDate = (empty($_POST['inputDate'])) ? $g->getDate() : $_POST['inputDate'];
			$inputTime = (empty($_POST['inputTime'])) ? $g->getTime() : $_POST['inputTime'];
			$inputTimeEnd = (empty($_POST['inputTimeEnd'])) ? $g->getTime() : $_POST['inputTimeEnd'];

			$inputCallsign = (empty($_POST['inputCallsign'])) ? 'N/A' : strtoupper($_POST['inputCallsign']);
			setcookie("callSign",$inputCallsign,time()+21960, "/");

			$inputPartner = (empty($_POST['inputPartner'])) ? "" : $_POST['inputPartner'];
			$inputRank = (empty($_POST['inputRank'])) ? 0 : $_POST['inputRank'];
			$inputNotes = (empty($_POST['inputNotes'])) ? "[list][*]No additional notes." : "<b><u>Additional Notes</b>: [list][*]".$_POST['inputNotes'];

			$type = (empty($_POST['type'])) ? array() : $_POST['type'];
			$type = array_map(function($value) {
				return $value === "" ? "0" : $value;
			}, $type);

			$inputTimeEvent = (empty($_POST['inputTimeEvent'])) ? array() : $_POST['inputTimeEvent'];
			$inputTimeEvent = array_map(function($value) {
				return $value === "" ? "??:??" : $value;
			}, $inputTimeEvent);

			$inputReasonInfo = (empty($_POST['inputReasonInfo'])) ? array() : $_POST['inputReasonInfo'];
			$inputReasonInfo = array_map(function($value) {
				return $value === "" ? "UNKNOWN GENERIC EVENT" : $value;
			}, $inputReasonInfo);

			$inputVeh = (empty($_POST['inputVeh'])) ? array() : $_POST['inputVeh'];
			$inputVeh = array_map(function($value) {
				return $value === "" ? "UNKNOWN VEHICLE" : $value;
			}, $inputVeh);

			$inputVehPlate = (empty($_POST['inputVehPlate'])) ? array() : $_POST['inputVehPlate'];
			$inputVehPlate = array_map(function($value) {
				return $value === "" ? "" : $value;
			}, $inputVehPlate);

			$inputDistrict = (empty($_POST['inputDistrict'])) ? array() : $_POST['inputDistrict'];
			$inputDistrict = array_map(function($value) {
				return $value === "" ? "UNKNOWN DISTRICT" : $value;
			}, $inputDistrict);
			
			$inputStreet = (empty($_POST['inputStreet'])) ? array() : $_POST['inputStreet'];
			$inputStreet = array_map(function($value) {
				return $value === "" ? "UNKNOWN STREET" : $value;
			}, $inputStreet);

			$inputReasonTS = (empty($_POST['inputReasonTS'])) ? array() : $_POST['inputReasonTS'];
			$inputReasonTS = array_map(function($value) {
				return $value === "" ? "UNKNOWN REASON" : $value;
			}, $inputReasonTS);

			$inputArrestee = (empty($_POST['inputArrestee'])) ? array() : $_POST['inputArrestee'];
			$inputArrestee = array_map(function($value) {
				return $value === "" ? "UNKNOWN ARRESTEE" : $value;
			}, $inputArrestee);

			$inputArrestID = (empty($_POST['inputArrestID'])) ? array() : $_POST['inputArrestID'];
			$inputArrestID = array_map(function($value) {
				return $value === "" ? "UNKNOWN ARREST REPORT ID" : $value;
			}, $inputArrestID);

		
			// Partner Resolver
			if (empty($inputPartner) == false) {
				$partner = $pg->getRank($inputRank,1)." ".$inputPartner;
			} else {
				$partner = "N/A";
			}
			

			// Events Resolver
			$events = "[*] No patrol events occurred.";
			if (empty($type) == false) {

				$events = "";
				$info = 0;
				$traffic = 0;
				$arrest = 0;
				
				foreach ($type as $iEvent => $eventType) {

					if ($eventType == '1') {
						$events .= "[*] [b]".$inputTimeEvent[$iEvent]."[/b] - ".$inputReasonInfo[$info];
						$info++;
					}

					if ($eventType == '2') {
						$events .= "[*] [b]".$inputTimeEvent[$iEvent]."[/b] - Conducted a [b]Traffic Stop[/b] on a [b]".$inputVeh[$traffic]."[/b], ".$pg->getVehiclePlates($inputVehPlate[$traffic],1).". Located on [b]".$inputStreet[$traffic].", ".$inputDistrict[$traffic]."[/b] - ".$inputReasonTS[$traffic];
						$traffic++;
					}

					if ($eventType == '3') {
						$events .= "[*] [b]".$inputTimeEvent[$iEvent]."[/b] - Conducted an [b]arrest[/b] on [url=https://mdc.gta.world/record/".str_replace(' ', '_', $inputArrestee[$arrest])."]".$inputArrestee[$arrest]."[/url] (Arrest Report: [b]#".$inputArrestID[$arrest]."[/b])";
						$arrest++;
					}

				}
			}


			// Report Builder
			$generatedReportType = "Patrol Log";
			$showGeneratedThreadTitle = false;
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
				[b]Date:[/b] ".strtoupper($inputDate)."
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
				".$inputNotes."
				[/list]
				[/divbox2]";
			$generatedReport = str_replace("				", "", $generatedReport);
		}

		if ($generatorType == "ArrestCharges") {

			// Variables
			$redirectPath = "arrest";
			$rowBuilder = "";
			$rowBuilderTotals = "";
			$charges = $_POST['inputCrime'];


			// Charge List Builder
			foreach ($charges as $iCharge => $charge) {

				// Charge Base
				$charge = $penal[$charge];
				$chargeID = $charge['id'];
				$chargeName = $charge['charge'];
				$chargeOffence = $_POST['inputCrimeOffence'][$iCharge];
				$chargeFine[] = $charge['fine'][$chargeOffence];
				$chargeFineFull = "$".number_format($chargeFine[$iCharge]);


				// Charge Classification Builder
				$chargeClassification = $charge['classification'];
				$chargeClassificationFull = "";
				switch ($chargeClassification) {
					case "F":
						$chargeClassificationFull = '<b class="text-danger">Felony</b>';
						break;
					case "M":
						$chargeClassificationFull = '<b class="text-warning">Misdemeanor</b>';
						break;
					case "I":
						$chargeClassificationFull = '<b class="text-success">Infraction</b>';
						break;
				}


				// Charge Type Builder
				$chargeType = $_POST['inputCrimeType'][$iCharge];
				switch ($chargeType) {
					case 1:
						$chargeType = "C";
						break;
					case 2:
						$chargeType = "B";
						break;
					case 3:
						$chargeType = "A";
						break;
					default:
						$chargeType = "?";
						break;
				}


				// Impound Builder
				$chargeImpound[] = $charge['impound'][$chargeOffence];
				if ($chargeImpound[$iCharge] == 0) {
					$chargeImpoundColour = "dark";
					$chargeImpoundQuestion = "No";
					$chargeImpoundTime = "";
				} else {
					$chargeImpoundColour = "success";
					$chargeImpoundQuestion = "Yes";
					$chargeImpoundTime = " | ".$chargeImpound[$iCharge]." Day(s)";
				}
				$chargeImpoundFull = '<span class="badge badge-'.$chargeImpoundColour.'">'.$chargeImpoundQuestion.$chargeImpoundTime.'</span>';


				// Suspension Builder
				$chargeSuspension[] = $charge['suspension'][$chargeOffence];
				if ($chargeSuspension[$iCharge] == 0) {
					$chargeSuspensionColour = "dark";
					$chargeSuspensionQuestion = "No";
					$chargeSuspensionTime = "";
				} else {
					$chargeSuspensionColour = "success";
					$chargeSuspensionQuestion = "Yes";
					$chargeSuspensionTime = " | ".$chargeSuspension[$iCharge]." Day(s)";
				}
				$chargeSuspensionFull = '<span class="badge badge-'.$chargeSuspensionColour.'">'.$chargeSuspensionQuestion.$chargeSuspensionTime.'</span>';


				// Court Builder
				$chargeCourt[] = $charge['court'];
				if ($chargeCourt[$iCharge] == true) {
					$chargeCourtColour = "success";
					$chargeCourtIcon = "check-circle";
				} else {
					$chargeCourtColour = "dark";
					$chargeCourtIcon = "times-circle";
				}
				$chargeCourtFull = '<span class="badge badge-'.$chargeCourtColour.'"><i class="fas fa-fw fa-'.$chargeCourtIcon.'"></i></span>';


				// Time Builder
				$multiDimensionalCrimeTimes = array(412);
				if (in_array($charge, $multiDimensionalCrimeTimes)) {
					$days[] = $charge['time'][$chargeOffence]['days'];
					$hours[] = $charge['time'][$chargeOffence]['hours'];
					$mins[] = $charge['time'][$chargeOffence]['min'];
				} else {
					$days[] = $charge['time']['days'];
					$hours[] = $charge['time']['hours'];
					$mins[] = $charge['time']['min'];
				}

				if ($days[$iCharge] == 0) {
					$chargeDays = '';
				} else {
					$chargeDays = number_format($days[$iCharge]).' Day(s)';
				}
				if ($hours[$iCharge] == 0) {
					$chargeHours = '';
				} else {
					$chargeHours = $hours[$iCharge]. ' Hour(s)';
				}
				if ($mins[$iCharge] == 0) {
					$chargeMinutes = '';
				} else {
					$chargeMinutes = $mins[$iCharge].' Minute(s)';
				}

				$chargeTimeFull = $chargeDays.$chargeHours.$chargeMinutes;


				// Finalisation Builders
				$chargeTitle[] = $chargeClassification.$chargeType.' '.$chargeID.'. '.$chargeName;


				// Rows Builder
				$rowBuilder .= '
					<tr>
						<td>'.$chargeTitle[$iCharge].'</td>
						<td>'.$chargeClassificationFull.'</td>
						<td>'.$chargeTimeFull.'</td>
						<td>'.$chargeFineFull.'</td>
						<td>'.$chargeImpoundFull.'</td>
						<td>'.$chargeSuspensionFull.'</td>
						<td>'.$chargeCourtFull.'</td>
					</tr>';

			}

			// Total Time
			$chargeTimeTotalDays = number_format(array_sum($days)).' Day(s) ';
			$chargeTimeTotalHours = array_sum($hours).' Hour(s) ';
			$chargeTimeTotalMinutes = array_sum($mins).' Minute(s) ';
			$chargeTimeTotal = $chargeTimeTotalDays.$chargeTimeTotalHours.$chargeTimeTotalMinutes;


			// Total Fines
			$chargeFineTotal = "$".number_format(array_sum($chargeFine));


			// Total Impound Time
			if (array_sum($chargeImpound) != 0) {
				$chargeImpoundTotal = number_format(array_sum($chargeImpound))." Day(s)";
			} else {
				$chargeImpoundTotal = "No Impounds";
			}


			// Total Suspension Time
			if (array_sum($chargeSuspension) != 0) {
				$chargeSuspensionTotal = number_format(array_sum($chargeSuspension))." Day(s)";
			} else {
				$chargeSuspensionTotal = "No Suspensions";
			}


			// Totals Row Builder
			$rowBuilderTotals = '
				<tr>
					<td>'.$chargeTimeTotal.'</td>
					<td>'.$chargeFineTotal.'</td>
					<td>'.$chargeImpoundTotal.'</td>
					<td>'.$chargeSuspensionTotal.'</td>
				</tr>';


			// Session Builder
			$showGeneratedArrestChargeTables = true;
			$generatedArrestChargeList = $rowBuilder;
			$generatedArrestChargeTotals = $rowBuilderTotals;
		}






		// Generator Finalisation
		$_SESSION['generatedReport'] = $generatedReport;
		$_SESSION['generatedReportType'] = $generatedReportType;
		$_SESSION['generatedThreadTitle'] = $generatedThreadTitle;
		$_SESSION['showGeneratedThreadTitle'] = $showGeneratedThreadTitle;
		$_SESSION['generatedThreadURL'] = $generatedThreadURL;
		$_SESSION['showGeneratedArrestChargeTables'] = $showGeneratedArrestChargeTables;
		$_SESSION['generatedArrestChargeList'] = $generatedArrestChargeList;
		$_SESSION['generatedArrestChargeTotals'] = $generatedArrestChargeTotals;


		// Redirect
		switch ($redirectPath) {
			case "report":
				header('Location: /paperwork-generators/generated-report');
				break;
				exit();
			case "thread":
				header('Location: /paperwork-generators/generated-thread');
				break;
				exit();
			case "arrest":
				header('Location: /paperwork-generators/arrest-report');
				break;
				exit();
		}

	} else {

		// Redirect to error page
		header('Location: /paperwork-generators/error');
		exit();

	}