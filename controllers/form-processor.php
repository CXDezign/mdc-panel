<?php

	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/initialise.php';

	$penal = json_decode(file_get_contents('../db/penalSearch.json'), true);

	// GET Types

	if (isset($_REQUEST['getType'])) {

		$getType = $_REQUEST['getType'];

		if ($getType == 'getCrime') {

			$crimeID = $_REQUEST['crimeID'];

			$crime = $penal[$crimeID];
			$crimeClasses = $crime['class'];
			$crimeOffences = $crime['offence'];
			$outputClass = array();
			$outputOffence = array();

			foreach ($crimeClasses as $crimeClass => $crimeClassBool) {
				$outputClass[] .= $crimeClassBool;
			}

			foreach ($crimeOffences as $crimeOffence => $crimeOffenceBool) {
				$outputOffence[] .= $crimeOffenceBool;
			}

			$classes = $pg->getCrimeClass2(array_reverse($outputClass));
			$offences = $pg->getCrimeOffence($outputOffence);

			echo json_encode(array($classes, $offences));

		}

		if ($getType == 'getUNIX') {

			$typeUNIX = $_REQUEST['typeUNIX'];

			echo $g->getUNIX($typeUNIX);

		}

		if ($getType == 'setChargeTable') {

			$_SESSION['showGeneratedArrestChargeTables'] = false;

		}

	}

	// Generator Types

	if (isset($_POST['generatorType'])) {

		// Initialise Constant Variables
		$generatorType = $_POST['generatorType'];

		// Default Values
		$defaultName = 'UNKNOWN NAME';
		$defaultSuspectName = 'UNKNOWN SUSPECT NAME';
		$defaultDistrict = 'UNKNOWN DISTRICT';
		$defaultStreet = 'UNKNOWN STREET';
		$defaultVehicle = 'UNKNOWN VEHICLE';
		$defaultRegisteredOwner = 'UNKNOWN REGISTERED OWNER';

		// Common Post Values
		$postInputDate = $_POST['inputDate'] ?? $g->getUNIX('date');
		$postInputTime = $_POST['inputTime'] ?? $g->getUNIX('time');
		$postInputCallsign = $_POST['inputCallsign'] ?? 'N/A';
		$postInputName = $_POST['inputName'] ?? $defaultName;
		$postInputNameArray = $_POST['inputName'] ?? array();
		$postInputRank = $_POST['inputRank'] ?? 0;
		$postInputRankArray = $_POST['inputRank'] ?? array();
		$postInputBadge = $_POST['inputBadge'] ?? 0;
		$postInputBadgeArray = $_POST['inputBadge'] ?? array();
		$postInputDefName = $_POST['inputDefName'] ?? $defaultSuspectName;
		$postInputDistrict = $_POST['inputDistrict'] ?? $defaultDistrict;
		$postInputDistrictArray = $_POST['inputDistrict'] ?? array();
		$postInputStreet = $_POST['inputStreet'] ?? $defaultStreet;
		$postInputStreetArray = $_POST['inputStreet'] ?? array();
		$postInputVeh = $_POST['inputVeh'] ?? $defaultVehicle;
		$postInputVehArray = $_POST['inputVeh'] ?? array();
		$postInputVehPlate = $_POST['inputVehPlate'] ?? '';
		$postInputVehPlateArray = $_POST['inputVehPlate'] ?? array();
		$postInputEvidenceImageArray = $_POST['inputEvidenceImage'] ?? array();
		$postInputEvidenceImageArray = array_values(array_filter($postInputEvidenceImageArray));
		$postInputVehRO = $_POST['inputVehRO'] ?? $defaultRegisteredOwner;

		// Session Variables
		$generatedReportType = '';
		$generatedReport = '';
		$generatedThreadURL = '';
		$generatedThreadTitle = '';
		$showGeneratedThreadTitle = false;
		$showGeneratedArrestChargeTables = false;
		$generatedArrestChargeList = '';
		$generatedArrestChargeTotals = '';

		if ($generatorType == 'TrafficReport') {

			// Variables
			$redirectPath = redirectPath(1);

			$postInputNameArray = array_map(function($value) {
				global $defaultName;
				return $value === '' ? $defaultName : $value;
			}, $postInputNameArray);

			$postInputRankArray = array_map(function($value) {
				return $value === '' ? 0 : $value;
			}, $postInputRankArray);

			$postInputBadgeArray = array_map(function($value) {
				return $value === '' ? '' : $value;
			}, $postInputBadgeArray);

			setCookiePost('callSign', $postInputCallsign);
			setCookiePost('officerNameArray', $postInputNameArray[0]);
			setCookiePost('officerRankArray', $postInputRankArray[0]);
			setCookiePost('officerBadgeArray', $postInputBadgeArray[0]);
			setCookiePost('defName', $postInputDefName);

			$inputDefLicense = $_POST['inputDefLicense'] ?: 0;
			$inputNarrative = $_POST['inputNarrative'] ?: '';
			$inputDashcam = $_POST['inputDashcam'] ?: '';

			$inputVehRO = $_POST['inputVehRO'] ?: $postInputDefName;
			$inputVehTint = $_POST['inputVehTint'] ?? -1;

			$inputCrime = $_POST['inputCrime'] ?? array();
			$inputCrime = array_map(function($value) {
				return $value === '' ? 'UNKNOWN CHARGE' : $value;
			}, $inputCrime);

			$inputCrimeClass = $_POST['inputCrimeClass'] ?? array();
			$inputCrimeClass = array_map(function($value) {
				return $value === '' ? 0 : $value;
			}, $inputCrimeClass);

			$inputCrimeFine = $_POST['inputCrimeFine'] ?? array();
			$inputCrimeFine = array_map(function($value) {
				return $value === '' ? 0 : $value;
			}, $inputCrimeFine);

			// Officer Resolver
			$officers = '';
			foreach ($postInputNameArray as $iOfficer => $officer) {
				$officerRank = $pg->getRank(0,1);
				if (!empty($postInputRankArray[$iOfficer])) {
					$officerRank = $pg->getRank($postInputRankArray[$iOfficer],1);
				}
				$officers .= '<strong>'.$officerRank.' '.$officer.'</strong> (<strong>#'.$postInputBadgeArray[$iOfficer].'</strong>), ';
			}

			// Crime Resolver
			$fines = '';
			foreach ($inputCrime as $iCrime => $crime) {
				$charge = $penal[$crime];
				$chargeTitle = $charge['charge'];
				$chargeType = $charge['type'];
				$chargeClass = '?';
				if (!empty($inputCrimeClass[$iCrime])) {
					$chargeClass = $pg->getCrimeClass($inputCrimeClass[$iCrime]);
				}
				if ($inputCrimeFine[$iCrime] == 0) {
					$fines .= '- <strong>'.$pg->getCrimeColour($chargeType).$chargeType.$chargeClass.' '.$crime.'. '.$chargeTitle.'</span></strong>.<br>';
				} else {
					$fines .= '- <strong>'.$pg->getCrimeColour($chargeType).$chargeType.$chargeClass.' '.$crime.'. '.$chargeTitle.'</span></strong> - <strong style="color: green;">$'.number_format($inputCrimeFine[$iCrime]).'</strong> Citation.<br>';
				}
			}

			// Report Builder
			$generatedReportType = 'Traffic Report';
			$generatedReport = $officers.'under the call sign <strong>'.strtoupper($postInputCallsign).'</strong> on the <strong>'.strtoupper($postInputDate).'</strong>, <strong>'.$postInputTime.'</strong>.<br>Conducted a traffic stop on a <strong>'.$postInputVeh.'</strong>, '.$pg->getVehiclePlates($postInputVehPlate,0).', registered to <strong>'.$inputVehRO.'</strong>, on <strong>'.$postInputStreet.'</strong>, <strong>'.$postInputDistrict.'</strong>.<br>'.$pg->getVehicleTint($inputVehTint).'<br>The defendant was identified as <strong>'.$postInputDefName.'</strong>, possessing '.$pg->getDefLicense($inputDefLicense).'<br>'.$inputNarrative.'<br><br>Following charge(s) were issued:<br>'.$fines.'<br>'.$pg->getDashboardCamera($inputDashcam);
		}

		if ($generatorType == 'ArrestReport') {

			// Variables
			$redirectPath = redirectPath(1);

			$postInputNameArray = array_map(function($value) {
				global $defaultName;
				return $value === '' ? $defaultName : $value;
			}, $postInputNameArray);

			$postInputRankArray = array_map(function($value) {
				return $value === '' ? 0 : $value;
			}, $postInputRankArray);

			$postInputBadgeArray = array_map(function($value) {
				return $value === '' ? '' : $value;
			}, $postInputBadgeArray);

			$inputNarrative = $_POST['inputNarrative'] ?: 'UNKNOWN NOTES';
			$inputEvidence = $_POST['inputEvidence'] ?: '';
			$inputDashcam = $_POST['inputDashcam'] ?: '';

			$inputWristband = $_POST['inputWristband'] ?: 0;
			$inputBracelet = $_POST['inputBracelet'] ?: 0;
			$inputPlea = $_POST['inputPlea'] ?: 0;

			// Set Cookies
			setCookiePost('callSign', $postInputCallsign);
			setCookiePost('officerNameArray', $postInputNameArray[0]);
			setCookiePost('officerRankArray', $postInputRankArray[0]);
			setCookiePost('officerBadgeArray', $postInputBadgeArray[0]);
			setCookiePost('defName', $postInputDefName);
			setCookiePost('defNameURL', $postInputDefName);

			// Officer Resolver
			$officers = '';
			foreach ($postInputNameArray as $iOfficer => $officer) {
				$officerRank = $pg->getRank(0,1);
				if (!empty($postInputRankArray[$iOfficer])) {
					$officerRank = $pg->getRank($postInputRankArray[$iOfficer],1);
				}
				$officers .= '<strong>'.$officerRank.' '.$officer.'</strong> (<strong>#'.$postInputBadgeArray[$iOfficer].'</strong>), ';
			}

			// Wristband & Bracelet Resolver
			$wristbandBracelet = '';
			if ($inputWristband != 0 || $inputBracelet != 0) {
				$wristbandBracelet = '<strong>'.$ar->getBracelet($inputBracelet).' & '.$ar->getWristband($inputWristband).'</strong>.';
			}

			// Evidence Resolver
			$evidence = '';
			if (!empty($inputEvidence)) {
				$evidence = '<br><br><strong>Evidence:</strong><br>'.nl2br($inputEvidence);
			}

			// Report Builder
			$generatedReportType = 'Arrest Report';
			$generatedReport = $officers.'under the callsign <strong>'.strtoupper($postInputCallsign).'</strong>
			 conducted an arrest on <strong>'.$postInputDefName.'</strong>
			 on the <strong>'.strtoupper($postInputDate).'</strong>, <strong>'.$postInputTime.'</strong>.
			 The suspect apprehension took place on <strong>'.$postInputStreet.', '.$postInputDistrict.'</strong>.<br>'
			 .$wristbandBracelet.'<br>'.$ar->getPlea($inputPlea, $postInputDefName).'<br><br>'
			 .nl2br($inputNarrative).$evidence.'<br><br>'.$pg->getDashboardCamera($inputDashcam);
			$showGeneratedArrestChargeTables = $_SESSION['showGeneratedArrestChargeTables'];
			$generatedArrestChargeList = $_SESSION['generatedArrestChargeList'];
			$generatedArrestChargeTotals = $_SESSION['generatedArrestChargeTotals'];
		}

		if ($generatorType == 'DeathReport') {

			// Variables
			$redirectPath = redirectPath(2);

			$inputDeathName = $_POST['inputDeathName'] ?: 'JOHN/JANE DOE';
			$inputDeathReason = $_POST['inputDeathReason'] ?: 'UNKNOWN CAUSE OF DEATH';

			$inputWitnessName = $_POST['inputWitnessName'] ?: array();
			$inputWitnessName = array_values(array_filter($inputWitnessName));

			$inputRespondingName = $_POST['inputRespondingName'] ?: 'UNKNOWN RESPONDING OFFICER';
			$inputRespondingRank = $_POST['inputRespondingRank'] ?: 0;

			$inputHandlingName = $_POST['inputHandlingName'] ?: 'N/A';
			$inputHandlingRank = $_POST['inputHandlingRank'] ?: 0;

			$inputCoronerName = $_POST['inputCoronerName'] ?: 'N/A';
			$inputCaseNumber = $_POST['inputCaseNumber'] ?: 'N/A';
			$inputRecord = $_POST['inputRecord'] ?: '#';

			$inputEvidenceBox = $_POST['inputEvidenceBox'] ?? array();
			$inputEvidenceBox = array_values(array_filter($inputEvidenceBox));

			// Witness Resolver
			$witnesses = 'N/A';
			if (!empty($inputWitnessName)) {

				$witnesses = '';
				$iWitnesses = count($inputWitnessName);

				if ($iWitnesses > 1) {
					$witnesses .= '[list]';
					foreach ($inputWitnessName as $witness) {
						$witnesses .= '[*]'.$witness;
					}
					$witnesses .= '[/list]';
				} else {
					foreach ($inputWitnessName as $witness) {
						$witnesses .= $witness;
					}
				}
			}

			// Evidence Resolver
			$evidenceImage = '';
			if (!empty($postInputEvidenceImageArray)) {

				$evidenceImage = '';
				foreach ($postInputEvidenceImageArray as $eImgID => $image) {
					$evidenceImageCount = $eImgID + 1;
					$evidenceImage .= '[altspoiler=EXHIBIT - Photograph #'.$evidenceImageCount.'][img]'.$image.'[/img][/altspoiler]';
				}
			}

			$evidenceBox = '';
			if (!empty($inputEvidenceBox)) {

				$evidenceBox = '';
				foreach ($inputEvidenceBox as $eBoxID => $box) {
					$evidenceBoxCount = $eBoxID + 1;
					$evidenceBox .= '[altspoiler=EXHIBIT - Description #'.$evidenceBoxCount.']'.$box.'[/altspoiler]';
				}
			}

			// Report Builder
			$generatedReportType = 'Death Report';
			$showGeneratedThreadTitle = true;
			$generatedThreadURL = 'https://lspd.gta.world/posting.php?mode=post&f=1356';
			$generatedThreadTitle = $inputDeathName.' - '.strtoupper($postInputDate).' - '.$postInputStreet.', '.$postInputDistrict;
			$generatedReport = '
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
				[list=none][b]NAME OF DECEASED:[/b] '.$inputDeathName.'
				[b]TIME & DATE OF DEATH:[/b] '.$postInputTime.' - '.strtoupper($postInputDate).'
				[b]LOCATION OF DEATH:[/b] '.$postInputStreet.', '.$postInputDistrict.'
				[b]APPARENT CAUSE OF DEATH:[/b] '.$inputDeathReason.'
				[b]WITNESSES:[/b] '.$witnesses.'[/list]
				[b]2. ADMINISTRATIVE INFORMATION[/b]
				[hr][/hr]
				[list=none][b]FIRST RESPONDING OFFICER:[/b] '.$pg->getRank($inputRespondingRank,1).' '.$inputRespondingName.'
				[b]HANDLING DETECTIVE/FORENSIC ANALYST:[/b] '.$pg->getRank($inputHandlingRank,1).' '.$inputHandlingName.'
				[b]HANDLING CORONER:[/b] '.$inputCoronerName.'
				[b]CORONER CASE NUMBER:[/b] '.$inputCaseNumber.'
				[b]RELEVANT MDC RECORDS:[/b] [url='.$inputRecord.']LINK[/url][/list]
				[b]3. EVIDENCE[/b]
				'.$evidenceImage.'
				'.$evidenceBox.'
				[hr][/hr]
				[/divbox2]';
			$generatedReport = str_replace('				', '', $generatedReport);
		}

		if ($generatorType == 'EvidenceRegistrationLog') {

			// Variables
			$redirectPath = redirectPath(2);

			$inputSuspectName = $_POST['inputSuspectName'] ?: $defaultName;
			$inputItemCategory = $_POST['inputItemCategory'] ?: 0;

			$inputItemRegistry = $_POST['inputItemRegistry'] ?? array();
			$inputItemRegistry = array_map(function($value) {
				return $value === '' ? 'UNKNOWN ITEM' : $value;
			}, $inputItemRegistry);

			$inputItemAmount = $_POST['inputItemAmount'] ?? array();
			$inputItemAmount = array_map(function($value) {
				return $value === '' ? '?' : $value;
			}, $inputItemAmount);

			// Set Cookies
			setCookiePost('officerName', $postInputName);
			setCookiePost('officerRank', $postInputRank);

			// Evidence Resolver
			$evidence = 'N/A';
			if (!empty($postInputEvidenceImageArray)) {

				$evidence = '';
				foreach ($postInputEvidenceImageArray as $eID => $image) {
					$evidenceCount = $eID + 1;
					$evidence .= '[altspoiler=EXHIBIT #'.$evidenceCount.'][img]'.$image.'[/img][/altspoiler]';
				}
			}

			// Item Resolver
			$items = '';
			foreach ($inputItemRegistry as $itemID => $item) {
				$items .= '[*] x'.$inputItemAmount[$itemID].' - '.$item;
			}

			// Report Builder
			$generatedReportType = 'Evidence Registration Log';
			$showGeneratedThreadTitle = true;
			$generatedThreadURL = 'https://lspd.gta.world/posting.php?mode=post&f=388';
			$generatedThreadTitle = '['.$er->getItemCategory($inputItemCategory).'] '.$inputSuspectName.' ['.strtoupper($postInputDate).']';
			$generatedReport = '
				[divbox2=#fff]
				[center][lspdlogo=150][/lspdlogo]

				[size=120][b]Los Santos Police Department
				Mission Row Station[/b][/size]
				[i]Evidence Registration Log[/i][/center]
				[color=white]...[/color]
				[hr][/hr]
				[color=white]...[/color]
				[b]Name:[/b] '.$postInputName.'
				[b]Rank:[/b] '.$pg->getRank($postInputRank,1).'
				[b]Date & Time:[/b] '.strtoupper($postInputDate).' - '.$postInputTime.'

				[b]Suspect Name:[/b] '.$inputSuspectName.'
				[b]Items name & amount:[/b]

				[list]'.$items.'[/list]

				[b]Screenshot:[/b]
				'.$evidence.'
				[/divbox2]';
			$generatedReport = str_replace('				', '', $generatedReport);
		}

		if ($generatorType == 'TrafficDivisionPatrolReport') {

			// Variables
			$redirectPath = redirectPath(2);
			$inputDateFrom = $_POST['inputDateFrom'] ?: $g->getUNIX('date');
			$inputDateTo = $_POST['inputDateTo'] ?: $g->getUNIX('date');
			$inputTimeFrom = $_POST['inputTimeFrom'] ?: $g->getUNIX('time');
			$inputTimeTo = $_POST['inputTimeTo'] ?: $g->getUNIX('time');

			$inputNameTS = $_POST['inputNameTS'] ?? array();
			$inputNameTS = array_map(function($value) {
				global $defaultName;
				return $value === '' ? $defaultName : $value;
			}, $inputNameTS);

			$inputCitationsTS = $_POST['inputCitationsTS'] ?? array();
			$inputCitationsTS = array_map(function($value) {
				return $value === '' ? 0 : $value;
			}, $inputCitationsTS);

			$inputVehicleImpounds = $_POST['inputVehicleImpounds'] ?: '0';
			$inputTrafficAssists = $_POST['inputTrafficAssists'] ?: '0';
			$inputTrafficInvestigations = $_POST['inputTrafficInvestigations'] ?: '0';

			$inputNotes = $_POST['inputNotes'] ?: 'N/A';
			$inputTDPatrolReportURL = $_POST['inputTDPatrolReportURL'] ?: 'https://lspd.gta.world/viewforum.php?f=101';
			setCookiePost('inputTDPatrolReportURL', $inputTDPatrolReportURL);

			// Traffic Stop Resolver
			if (!empty($inputNameTS)) {

				$iTS = count($inputNameTS);
				$iCitations = array_sum($inputCitationsTS);
				$trafficStops = '';

				foreach ($inputNameTS as $TSID => $name) {
					$trafficStops .= '[*]' . $name;
				}

				$trafficStopText = '[b]Traffic Stops:[/b] ' . $iTS . '[list=circle]' . $trafficStops . '[/list]';

			} else {

				$iTS = 0;
				$iCitations = 0;
				$trafficStopText = '[b]Traffic Stops:[/b] ' . $iTS;

			}

			// Report Builder
			$generatedReportType = 'Traffic Division: Patrol Report';
			$generatedThreadURL = $inputTDPatrolReportURL;
			$generatedReport = '
				[divbox2=#f7f7f7]
				[center][tedlogo=175][/tedlogo]
				[hr][/hr]
				[img]https://i.imgur.com/7njmZU1.png[/img][size=130] [b]LOS SANTOS POLICE DEPARTMENT[/b][/size][img]https://i.imgur.com/7njmZU1.png[/img]
				[size=100][b]Traffic Division[/b][/size]
				[size=85][color=#012B47][b]TRAFFIC PATROL REPORT[/b][/color][/size][/center]
				[hr][/hr]
				[b]Date:[/b] '.strtoupper($pg->dateResolver($inputDateFrom, $inputDateTo)).'
				[b]Time:[/b] '.$inputTimeFrom.' - '.$inputTimeTo.'

				'.$trafficStopText.'
				[b]Citations Issued:[/b] '.$iCitations.'
				[b]Vehicles Impounded:[/b] '.$inputVehicleImpounds.'
				[b]Traffic Assists:[/b] '.$inputTrafficAssists.'
				[b]Traffic Investigations:[/b] '.$inputTrafficInvestigations.'

				[b]Notes (Optional):[/b] ' . $inputNotes . '
				[/divbox2]';
			$generatedReport = str_replace('				', '', $generatedReport);
		}

		if ($generatorType == 'PatrolLog') {

			// Variables
			$redirectPath = redirectPath(2);
			$inputTimeEnd = $_POST['inputTimeEnd'] ?: $g->getUNIX('time');

			// Set Cookies
			setCookiePost('callSign', $postInputCallsign);

			$inputPartner = $_POST['inputPartner'] ?: '';
			$inputNotes = $_POST['inputNotes'] ?: '';

			$type = $_POST['type'] ?? array();
			$type = array_map(function($value) {
				return $value === '' ? '0' : $value;
			}, $type);

			$inputTimeEvent = $_POST['inputTimeEvent'] ?? array();
			$inputTimeEvent = array_map(function($value) {
				return $value === '' ? '??:??' : $value;
			}, $inputTimeEvent);

			$inputReasonInfo = $_POST['inputReasonInfo'] ?? array();
			$inputReasonInfo = array_map(function($value) {
				return $value === '' ? 'UNKNOWN GENERIC EVENT' : $value;
			}, $inputReasonInfo);

			$postInputVehArray = array_map(function($value) {
				global $defaultVehicle;
				return $value === '' ? $defaultVehicle : $value;
			}, $postInputVehArray);

			$postInputVehPlateArray = array_map(function($value) {
				return $value === '' ? '' : $value;
			}, $postInputVehPlateArray);

			$postInputDistrictArray = array_map(function($value) {
				global $defaultDistrict;
				return $value === '' ? $defaultDistrict : $value;
			}, $postInputDistrictArray);
			
			$postInputStreetArray = array_map(function($value) {
				global $defaultStreet;
				return $value === '' ? $defaultStreet : $value;
			}, $postInputStreetArray);

			$inputReasonTS = $_POST['inputReasonTS'] ?? array();
			$inputReasonTS = array_map(function($value) {
				return $value === '' ? 'UNKNOWN REASON' : $value;
			}, $inputReasonTS);

			$inputArrestee = $_POST['inputArrestee'] ?? array();
			$inputArrestee = array_map(function($value) {
				return $value === '' ? 'UNKNOWN ARRESTEE' : $value;
			}, $inputArrestee);

			$inputArrestID = $_POST['inputArrestID'] ?? array();
			$inputArrestID = array_map(function($value) {
				return $value === '' ? 'UNKNOWN ARREST REPORT ID' : $value;
			}, $inputArrestID);

			// Notes Resolver
			$notes = '[list][*]No additional notes.';
			if (!empty($inputNotes)) {
				$notes = '[b]Additional Notes[/b]: [list][*]'.$inputNotes;
			}
		
			// Partner Resolver
			if (!empty($inputPartner)) {
				$partner = $pg->getRank($postInputRank,1).' '.$inputPartner;
			} else {
				$partner = 'N/A';
			}
			
			// Events Resolver
			$events = '[*] No patrol events occurred.';
			if (!empty($type)) {

				$events = '';
				$info = 0;
				$traffic = 0;
				$arrest = 0;
				
				foreach ($type as $iEvent => $eventType) {

					if ($eventType == '1') {
						$events .= '[*] [b]'.$inputTimeEvent[$iEvent].'[/b] - '.$inputReasonInfo[$info];
						$info++;
					}

					if ($eventType == '2') {
						$events .= '[*] [b]'.$inputTimeEvent[$iEvent].'[/b] - Conducted a [b]Traffic Stop[/b] on a [b]'.$postInputVehArray[$traffic].'[/b], '.$pg->getVehiclePlates($postInputVehPlateArray[$traffic],1).'. Located on [b]'.$postInputStreetArray[$traffic].', '.$postInputDistrictArray[$traffic].'[/b] - '.$inputReasonTS[$traffic];
						$traffic++;
					}

					if ($eventType == '3') {
						$events .= '[*] [b]'.$inputTimeEvent[$iEvent].'[/b] - Conducted an [b]arrest[/b] on [url=https://mdc.gta.world/record/'.str_replace(' ', '_', $inputArrestee[$arrest]).']'.$inputArrestee[$arrest].'[/url] (Arrest Report: [b]#'.$inputArrestID[$arrest].'[/b])';
						$arrest++;
					}

				}
			}

			// Report Builder
			$generatedReportType = 'Patrol Log';
			$generatedThreadURL = 'https://lspd.gta.world/viewforum.php?f=829';
			$generatedReport = '
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
				[b]Date:[/b] '.strtoupper($postInputDate).'
				[b]Start time:[/b] '.$postInputTime.'
				[b]End time:[/b] '.$inputTimeEnd.'
				[color=white]...[/color]
				[b]Callsign:[/b] '.strtoupper($postInputCallsign).'
				[b]Partner:[/b] '.$partner.'
				[color=white]...[/color]
				[hr][/hr]
				[color=white]...[/color]
				[b][u]Details[/u][/b]
				[list]
				'.$events.'
				[/list]
				'.$notes.'
				[/list]
				[/divbox2]';
			$generatedReport = str_replace('				', '', $generatedReport);
		}

		if ($generatorType == 'ArrestCharges') {

			// Variables
			$redirectPath = redirectPath(3);
			$rowBuilder = '';
			$rowBuilderTotals = '';

			if (isset($_POST['inputCrime'])) {

				$charges = $_POST['inputCrime'];

				// Charge List Builder
				foreach ($charges as $iCharge => $charge) {

					// Charge Base
					$charge = $penal[$charge];
					$chargeID = $charge['id'];
					$chargeName = $charge['charge'];
					$chargeOffence = $_POST['inputCrimeOffence'][$iCharge];
					$chargeAddition = $_POST['inputCrimeAddition'][$iCharge];
					$chargeFine[] = $charge['fine'][$chargeOffence];
					$chargeFineFull = '$'.number_format($chargeFine[$iCharge]);

					// Charge Sentencing Additions
					switch ($chargeAddition) {
						case 3:
							$chargeReduction = 2;
							break;
						case 4:
							$chargeReduction = 4;
							break;
						default:
							$chargeReduction = 1;
					}

					// Charge Type Builder
					$chargeType = $charge['type'];
					$chargeTypeFull = '';

					// 412 Charge
					if ($chargeID == 412 && $chargeOffence == 3 ) {
						$chargeType = 'F';
					}

					// Charge Class Builder
					$chargeClass = $_POST['inputCrimeClass'][$iCharge];

					switch ($chargeClass) {
						case 1:
							$chargeClass = 'C';
							break;
						case 2:
							$chargeClass = 'B';
							break;
						case 3:
							$chargeClass = 'A';
							break;
						default:
							$chargeClass = '?';
							break;
					}

					// 402 Charge
					if (($chargeID == 402) && ($chargeClass == 'B' || $chargeClass == 'A')) {
						$chargeType = 'F';
					}

					switch ($chargeType) {
						case 'F':
							$chargeTypeFull = '<strong class="text-danger">Felony</strong>';
							break;
						case 'M':
							$chargeTypeFull = '<strong class="text-warning">Misdemeanor</strong>';
							break;
						case 'I':
							$chargeTypeFull = '<strong class="text-success">Infraction</strong>';
							break;
						default:
							$chargeTypeFull = '<strong class="text-danger">UNKNOWN</strong>';
							break;
					}

					// Points Builder
					$chargePoints[] = ceil($charge['points'][$chargeClass] / $chargeReduction);

					// Impound Builder
					$chargeImpound[] = $charge['impound'][$chargeOffence];
					if ($chargeImpound[$iCharge] == 0) {
						$chargeImpoundColour = 'dark';
						$chargeImpoundQuestion = 'No';
						$chargeImpoundTime = '';
					} else {
						$chargeImpoundColour = 'success';
						$chargeImpoundQuestion = 'Yes';
						$chargeImpoundString = $chargeImpound[$iCharge] == 1 ? ' Day' : ' Days';
						$chargeImpoundTime = ' | '.number_format($chargeImpound[$iCharge]).$chargeImpoundString;
					}
					$chargeImpoundFull = '<span class="badge badge-'.$chargeImpoundColour.'">'.$chargeImpoundQuestion.$chargeImpoundTime.'</span>';

					// Suspension Builder
					$chargeSuspension[] = $charge['suspension'][$chargeOffence];
					if ($chargeSuspension[$iCharge] == 0) {
						$chargeSuspensionColour = 'dark';
						$chargeSuspensionQuestion = 'No';
						$chargeSuspensionTime = '';
					} else {
						$chargeSuspensionColour = 'success';
						$chargeSuspensionQuestion = 'Yes';
						$chargeSuspensionString = $chargeSuspension[$iCharge] == 1 ? ' Day' : ' Days';
						$chargeSuspensionTime = ' | '.number_format($chargeSuspension[$iCharge]).$chargeSuspensionString;
					}
					$chargeSuspensionFull = '<span class="badge badge-'.$chargeSuspensionColour.'">'.$chargeSuspensionQuestion.$chargeSuspensionTime.'</span>';

					// Court Builder
					$chargeCourt[] = $charge['court'];
					if ($chargeCourt[$iCharge]) {
						$chargeCourtColour = 'success';
						$chargeCourtIcon = 'check-circle';
					} else {
						$chargeCourtColour = 'dark';
						$chargeCourtIcon = 'times-circle';
					}
					$chargeCourtFull = '<span class="badge badge-'.$chargeCourtColour.'"><i class="fas fa-fw fa-'.$chargeCourtIcon.'"></i></span>';

					// Time Builder
					$multiDimensionalCrimeTimes = array('412');
					if (in_array($chargeID, $multiDimensionalCrimeTimes)) {
						$days[] = ($charge['time'][$chargeOffence]['days'] / $chargeReduction);
						$hours[] = ($charge['time'][$chargeOffence]['hours'] / $chargeReduction);
						$mins[] = ($charge['time'][$chargeOffence]['min'] / $chargeReduction);
					} else {
						$days[] = ($charge['time']['days'] / $chargeReduction);
						$hours[] = ($charge['time']['hours'] / $chargeReduction);
						$mins[] = ($charge['time']['min'] / $chargeReduction);
					}

					// Time Calculation
					$chargeTimeFull = $pg->calculateCrimeTime($days[$iCharge], $hours[$iCharge], $mins[$iCharge]);

					// Finalisation Builders
					$chargeTitle[] = $chargeType.$chargeClass.' '.$chargeID.'. '.$chargeName;

					// Rows Builder
					$rowBuilder .= '<tr>
						<td>'.$chargeTitle[$iCharge].'</td>
						<td class="text-center">'.$pg->getCrimeSentencing($chargeAddition).'</td>
						<td class="text-center">'.$chargeOffence.'</td>
						<td>'.$chargeTypeFull.'</td>
						<td>'.$chargeTimeFull.'</td>
						<td class="text-center">'.$chargePoints[$iCharge].'</td>
						<td>'.$chargeFineFull.'</td>
						<td class="text-center">'.$chargeImpoundFull.'</td>
						<td class="text-center">'.$chargeSuspensionFull.'</td>
						<td class="text-center">'.$chargeCourtFull.'</td>
					</tr>';

				}

				// Total Time
				$chargeTimeTotalDays = array_sum($days);
				$chargeTimeTotalHours = array_sum($hours);
				$chargeTimeTotalMinutes = array_sum($mins);
				$chargeTimeTotal = $pg->calculateCrimeTime($chargeTimeTotalDays,$chargeTimeTotalHours,$chargeTimeTotalMinutes);

				// Total Points
				$chargePointsTotal = array_sum($chargePoints);
				$chargePointsTotal .= $chargePointsTotal == 1 ? ' Point' : ' Points';

				// Total Fines
				$chargeFineTotal = '$'.number_format(array_sum($chargeFine));

				// Total Impound Time
				$chargeImpoundTotal = number_format(array_sum($chargeImpound));
				if ($chargeImpoundTotal != 0) {
					$chargeImpoundTotal .= $chargeImpoundTotal == 1 ? ' Day' : ' Days';
				} else {
					$chargeImpoundTotal = 'No Impounds';
				}

				// Total Suspension Time
				$chargeSuspensionTotal = number_format(array_sum($chargeSuspension));
				if ($chargeSuspensionTotal != 0) {
					$chargeSuspensionTotal .= $chargeSuspensionTotal == 1 ? ' Day' : ' Days';
				} else {
					$chargeSuspensionTotal = 'No Suspensions';
				}

				// Totals Row Builder
				$rowBuilderTotals = '
					<tr>
						<td>'.$chargeTimeTotal.'</td>
						<td>'.$chargePointsTotal.'</td>
						<td>'.$chargeFineTotal.'</td>
						<td>'.$chargeImpoundTotal.'</td>
						<td>'.$chargeSuspensionTotal.'</td>
					</tr>';

				// Session Builder
				$showGeneratedArrestChargeTables = true;
				$generatedArrestChargeList = $rowBuilder;
				$generatedArrestChargeTotals = $rowBuilderTotals;

			} else {
				$showGeneratedArrestChargeTables = false;
			}
		}

		if ($generatorType == 'ParkingTicket') {

			// Variables
			$redirectPath = redirectPath(1);

			$inputReason = $_POST['inputReason'] ?: 0;
			$inputFine = $_POST['inputFine'] ?: 0;

			// Set Cookies
			setCookiePost('officerName', $postInputName);
			setCookiePost('officerRank', $postInputRank);
			setCookiePost('officerBadge', $postInputBadge);
			setCookiePost('defNameVehRO', $postInputVehRO);

			// Evidence Resolver
			$evidence = 'N/A';
			if (!empty($postInputEvidenceImageArray)) {

				$evidence = '';
				foreach ($postInputEvidenceImageArray as $image) {
					$evidence .= '<img src="'.$image.'" width="100%" />';
				}
			}

			// Officer Resolver
			$officers = '<strong>'.$pg->getRank($postInputRank,1).' '.$postInputName.'</strong> (<strong>#'.$postInputBadge.'</strong>), ';

			// Parking Ticket Resolver
			$reason = $pt->getIllegalParking($inputReason);
			$statement = '';

			// Report Builder
			$generatedReportType = 'Parking Ticket';
			$generatedReport = $generatedReport = $officers.' on the <strong>'.strtoupper($postInputDate).'</strong>, <strong>'.$postInputTime.'</strong>.<br>Cited a <strong>'.$postInputVeh.'</strong>, '.$pg->getVehiclePlates($postInputVehPlate,0).', '.$pg->getVehicleRO($postInputVehRO).', on <strong>'.$postInputStreet.'</strong>, <strong>'.$postInputDistrict.'</strong>.<br>

				<strong>Citation Reason:</strong>
				<ul><li><span style="color: #27ae60">IC 406. Illegal Parking</span> - <strong style="color: green;">$'.$inputFine.'</strong> - '.$pt->getIllegalParking($inputReason).'</li></ul>
				<strong>Evidence:</strong><br>'.$evidence;
		}

		if ($generatorType == 'ImpoundReport') {

			// Variables
			$redirectPath = redirectPath(1);

			$inputDuration = $_POST['inputDuration'] ?: 0;
			$inputReason = $_POST['inputReason'] ?: 'UNKNOWN REASON';

			// Set Cookies
			setCookiePost('officerName', $postInputName);
			setCookiePost('officerRank', $postInputRank);
			setCookiePost('officerBadge', $postInputBadge);
			setCookiePost('defNameVehRO', $postInputVehRO);

			// Officer Resolver
			$officers = '<strong>'.$pg->getRank($postInputRank,1).' '.$postInputName.'</strong> (<strong>#'.$postInputBadge.'</strong>), ';


			// Report Builder
			$generatedReportType = 'Impound Report';
			$generatedReport = $officers.' on the <strong>'.strtoupper($postInputDate).'</strong>, <strong>'.$postInputTime.'</strong>.<br>Impounded a <strong>'.$postInputVeh.'</strong>, '.$pg->getVehiclePlates($postInputVehPlate,0).', for '.$inputDuration.' days, '.$pg->getVehicleRO($postInputVehRO).', on <strong>'.$postInputStreet.'</strong>, <strong>'.$postInputDistrict.'</strong>.<br>

				<strong>Impound Reason:</strong>
				<ul><li>'.$inputReason.'</li></ul>';
		}

		if ($generatorType == 'MetroDeploymentLog') {

			// Variables
			$redirectPath = redirectPath(2);

			// SECTION I

			$inputInvolvedPlatoons = $_POST['inputInvolvedPlatoons'] ?? array();
			$inputInvolvedPlatoons = array_map(function($value) {
				return $value === '' ? '?' : $value;
			}, $inputInvolvedPlatoons);

			$inputIncidentCommander = $_POST['inputIncidentCommander'] ?: '';
			$inputIncidentCommanderRank = $_POST['inputIncidentCommanderRank'] ?: '';

			$inputCrisisNegotiator = $_POST['inputCrisisNegotiator'] ?: '';
			$inputCrisisNegotiatorRank = $_POST['inputCrisisNegotiatorRank'] ?: '';

			$inputPlatoonTeamLeaderName = $_POST['inputPlatoonTeamLeaderName'] ?? array();
			$inputPlatoonTeamLeaderName = array_map(function($value) {
				return $value === '' ? 'UNKNOWN NAME' : $value;
			}, $inputPlatoonTeamLeaderName);

			$inputPlatoonTeamLeaderRank = $_POST['inputPlatoonTeamLeaderRank'] ?? array();
			$inputPlatoonTeamLeaderRank = array_map(function($value) {
				return $value === '' ? 'UNKNOWN RANK' : $value;
			}, $inputPlatoonTeamLeaderRank);

			$inputMetroMemberName = $_POST['inputMetroMemberName'] ?? array();
			$inputMetroMemberName = array_map(function($value) {
				return $value === '' ? 'UNKNOWN NAME' : $value;
			}, $inputMetroMemberName);

			$inputMetroMemberRank = $_POST['inputMetroMemberRank'] ?? array();
			$inputMetroMemberRank = array_map(function($value) {
				return $value === '' ? 'UNKNOWN RANK' : $value;
			}, $inputMetroMemberRank);

			// SECTION II

			$inputDeploymentType = $_POST['inputDeploymentType'] ?: 11;

			$inputDeploymentTimeStart = $_POST['inputDeploymentTimeStart'] ?: $g->getUNIX('time');
			$inputDeploymentTimeEnd = $_POST['inputDeploymentTimeEnd'] ?: $g->getUNIX('time');
			$inputLocation = $_POST['inputLocation'] ?: 'UNKNOWN LOCATION';

			$inputDeploymentEvent = $_POST['inputDeploymentEvent'] ?? array();
			$inputDeploymentEvent = array_map(function($value) {
				return $value === '' ? 'UNKNOWN EVENT' : $value;
			}, $inputDeploymentEvent);

			// SECTION III

			$inputInjuredTeamName = $_POST['inputInjuredTeamName'] ?? array();
			$inputInjuredTeamName = array_map(function($value) {
				return $value === '' ? 'UNKNOWN NAME' : $value;
			}, $inputInjuredTeamName);

			$inputInjuredTeamRank = $_POST['inputInjuredTeamRank'] ?? array();
			$inputInjuredTeamRank = array_map(function($value) {
				return $value === '' ? 'UNKNOWN RANK' : $value;
			}, $inputInjuredTeamRank);

			$inputCasualtiesSuspect = $_POST['inputCasualtiesSuspect'] ?: 0;
			$inputCasualtiesCivilian = $_POST['inputCasualtiesCivilian'] ?: 0;

			$inputSignature = $_POST['inputSignature'] ?: 'UNKNOWN SIGNATURE';

			// Involved Platoon Resolver
			$involvedPlatoons = '';
			foreach ($inputInvolvedPlatoons as $platoon) {
				$platoon = $md->getMetroPlatoon($platoon);
				$involvedPlatoons .= '[*] '.$platoon.'';
			}

			// Incident Commander Resolver
			$incidentCommanderFull = null;
			if ($inputIncidentCommander == '' || $inputIncidentCommanderRank == '') {
				$incidentCommanderFull = 'N/A';
			} else {
				$incidentCommanderFull = $pg->getRank($inputIncidentCommanderRank, 1).' '.$inputIncidentCommander;
			}

			// Crisis Negotiator Resolver
			$crisisNegotiatorFull = null;
			if ($inputCrisisNegotiator == '' || $inputCrisisNegotiatorRank == '') {
				$crisisNegotiatorFull = 'N/A';
			} else {
				$crisisNegotiatorFull = $pg->getRank($inputCrisisNegotiatorRank, 1).' '.$inputCrisisNegotiator;
			}
			
			// Team Leader Resolver
			$teamLeaderFull = null;
			foreach ($inputPlatoonTeamLeaderName as $iTeamLeader => $teamLeader) {
				$teamLeaderFull .= '[*] '.$md->getMetroDivisionalRankPlatoon($inputPlatoonTeamLeaderRank[$iTeamLeader]).' '.$md->getMetroDivisionalRankShort($inputPlatoonTeamLeaderRank[$iTeamLeader]).' '.$teamLeader;
			}

			// Metropolitan Member Resolver
			$metroMemberFull = null;
			foreach ($inputMetroMemberName as $iMetroMember => $metroMember) {
				$metroMemberFull .= '[*] '.$md->getMetroDivisionalRankPlatoon($inputMetroMemberRank[$iMetroMember]).' '.$md->getMetroDivisionalRankShort($inputMetroMemberRank[$iMetroMember]).' '.$metroMember;
			}

			// Injured Team Member Resolver
			$injuredTeamMemberFull = null;
			foreach ($inputInjuredTeamName as $iInjuredMember => $injuredMember) {
				$injuredTeamMemberFull .= '[*] '.$md->getMetroDivisionalRankPlatoon($inputInjuredTeamRank[$iInjuredMember]).' '.$md->getMetroDivisionalRankShort($inputInjuredTeamRank[$iInjuredMember]).' '.$injuredMember;
			}

			if (empty($inputInjuredTeamName)) {
				$injuredTeamMemberFull = 'N/A';
			}

			// Deployment Event Resolver
			$deploymentEventFull = null;
			foreach ($inputDeploymentEvent as $event) {
				$deploymentEventFull .= '[*] '.$event;
			}

			// Report Builder
			$generatedReportType = 'Metropolitan Division: Deployment Log';
			$showGeneratedThreadTitle = true;
			$generatedThreadURL = 'https://lspd.gta.world/viewforum.php?f=646';
			$generatedThreadTitle = strtoupper($postInputDate);
			$generatedReport = '[divbox2=white][center]
				[lspdlogo=200][/lspdlogo][metrologo=200][/metrologo]

				[img]https://i.imgur.com/7njmZU1.png[/img][size=130] [b]LOS SANTOS POLICE DEPARTMENT[/b][/size][img]https://i.imgur.com/7njmZU1.png[/img]
				[size=100][b]Metropolitan Division[/b][/size]
				[size=75][color=#012B47][b]METROPOLITAN DIVISION — DEPLOYMENT REPORT[/b][/color][/size][/center]
				[hr][/hr]

				[b][size=150][color=#012B47]SECTION I — GENERAL INFORMATION[/color][/size][/b]
				[hr][/hr]
				[list=none][u]1.1[/u] [b]INVOLVED PLATOONS: [/b]
				[list]'.$involvedPlatoons.'[/list]

				[u]1.2[/u] [b]INCIDENT COMMAND:[/b]
				[list][*] [b]INCIDENT COMMANDER:[/b] '.$incidentCommanderFull.'
				[*] [b]CRISIS NEGOTIATOR:[/b] '.$crisisNegotiatorFull.'
				[*] [b]TEAM LEADER(S):[/b]
				[list]'.$teamLeaderFull.'[/list][/list]

				[u]1.3[/u] [b]INVOLVED METROPOLITAN MEMBERS: [/b]
				[list]'.$metroMemberFull.'[/list]

				[u]1.4[/u] [b]DEPLOYMENT TYPE:[/b] '.$md->getMetroDeploymentType($inputDeploymentType).'[/list]
				[hr][/hr]
				[b][size=150][color=#012B47]SECTION II — DEPLOYMENT TIMELINE[/color][/size][/b]
				[hr][/hr]
				[list=none][u]2.1[/u] [b]DATE: [/b] '.strtoupper($postInputDate).'
				[u]2.2[/u] [b]LOCATION: [/b] '.$inputLocation.'
				[u]2.3[/u] [b]TIMELINE:[/b]
				[list][*][b]START OF DEPLOYMENT:[/b] '.$inputDeploymentTimeStart.'
				'.$deploymentEventFull.'
				[*][b]END OF DEPLOYMENT:[/b] '.$inputDeploymentTimeEnd.'[/list][/list]
				[hr][/hr]
				[b][size=150][color=#012B47]SECTION III — CASUALTY & INJURY INFORMATION[/color][/size][/b]
				[hr][/hr]
				[list=none][u]3.1[/u] [b]INJURED TEAM MEMBERS: [/b]
				[list]'.$injuredTeamMemberFull.'[/list]

				[u]3.3[/u] [b]SUSPECT CASUALTIES:[/b] '.$inputCasualtiesSuspect.'
				[u]3.4[/u] [b]CIVILIAN CASUALTIES:[/b] '.$inputCasualtiesCivilian.'[/list]
				[hr][/hr]
				[b]SIGNATURE:[/b] '.$inputSignature.'
				[hr][/hr]
				[b]REVIEWED & SIGNED BY:[/b]
				[/divbox2]';
			$generatedReport = str_replace('				', '', $generatedReport);
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
			case 'report':
				header('Location: /paperwork-generators/generated-report');
				break;
			case 'thread':
				header('Location: /paperwork-generators/generated-thread');
				break;
			case 'arrest':
				header('Location: /paperwork-generators/arrest-report');
				break;
			case 'error':
			default:
				header('Location: /paperwork-generators/error');
				break;
		}

	}

	// Functions

	function redirectPath($input) {

		$output = '';

		switch($input) {
			case 1:
				$output = 'report';
				break;
			case 2:
				$output = 'thread';
				break;
			case 3:
				$output = 'arrest';
				break;
			default:
				$output = 'error';
		}

		return $output;

	}

	function setCookiePost($inputCookie, $inputVariable) {

		global	$g;

		$cPath = '/';
		$iTime = 2147483647;
		$tTime = time()+21960;
		$dTime = time()+3660;

		switch($inputCookie) {
			case 'callSign':
				$cookie = 'callSign';
				$time = $tTime;
				break;
			case 'officerName':
			case 'officerNameArray':
				$cookie = 'officerName';
				$time = $iTime;
				break;
			case 'officerRank':
			case 'officerRankArray':
				$cookie = 'officerRank';
				$time = $iTime;
				break;
			case 'officerBadge':
			case 'officerBadgeArray':
				$cookie = 'officerBadge';
				$time = $iTime;
				break;
			case 'defName':
			case 'defNameVehRO':
				$cookie = 'defName';
				$time = $dTime;
				break;
			case 'defNameURL':
				$cookie = 'defNameURL';
				$time = $dTime;
				break;
			case 'inputTDPatrolReportURL':
				$cookie = 'inputTDPatrolReportURL';
				$time = $iTime;
			default:
				break;
		}

		return setcookie($cookie,$inputVariable,$time,$cPath,$g->getSettings('site-url'),$g->getSettings('site-live'));

	}