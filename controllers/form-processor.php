<?php

	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/initialise.php';

	$penal = json_decode(file_get_contents('../db/penalSearch.json'), true);

	// GET Types

	if (isset($_REQUEST['getType'])) {

		$getType = $_REQUEST['getType'];

		if ($getType == 'getCrime') {

			$chargesDrug = [505,506,507,508,509];

			$crimeID = $_REQUEST['crimeID'];

			$crime = $penal[$crimeID];
			$crimeClasses = $crime['class'];
			$crimeOffences = $crime['offence'];
			$outputClass = array();
			$outputOffence = array();
			$outputDrugSubstanceCategories = array();
			$classes = null;
			$offences = null;
			$categories = null;

			foreach ($crimeClasses as $crimeClass => $crimeClassBool) {
				$outputClass[] .= $crimeClassBool;
			}

			foreach ($crimeOffences as $crimeOffence => $crimeOffenceBool) {
				$outputOffence[] .= $crimeOffenceBool;
			}

			if (in_array($crimeID, $chargesDrug) && $crime['drugs']) {
					$crimeDrugSubstanceCategories = $crime['drugs'];
					foreach ($crimeDrugSubstanceCategories as $crimeDrugSubstanceCategory => $crimeDrug) {
						$outputDrugSubstanceCategories[] .= $crimeDrug;
					}
					$categories = $pg->getCrimeDrugSubstanceCategory($outputDrugSubstanceCategories);
			}

			$classes = $pg->getCrimeClass2(array_reverse($outputClass));
			$offences = $pg->getCrimeOffence($outputOffence);

			echo json_encode(array($classes, $offences, $categories));

		}

		if ($getType == 'getUNIX') {

			echo $g->getUNIX($_REQUEST['typeUNIX']);

		}

		if ($getType == 'setNotificationVersion') {

			setCookiePost('notificationVersion', $g->getSettings('site-version'));

		}

		/*
		if ($getType == 'setChargeTable') {

			$_SESSION['showGeneratedArrestChargeTables'] = false;

		}
		*/

	}

	// Generator Types

	if (isset($_POST['generatorType'])) {

		// Initialise Constant Variables
		$generatorType = $_POST['generatorType'];
		$checked = '[cbc][/cbc]';
		$unchecked = '[cb][/cb]';

		// Default Values
		$defaultName = 'UNKNOWN NAME';
		$defaultSuspectName = 'UNKNOWN SUSPECT NAME';
		$defaultDistrict = 'UNKNOWN DISTRICT';
		$defaultStreet = 'UNKNOWN STREET';
		$defaultBuilding = 'UNKNOWN BUILDING';
		$defaultVehicle = 'UNKNOWN VEHICLE';
		$defaultVehiclePlate = 'UNKNOWN VEHICLE IDENTIFICATION PLATE';
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
		$postInputStreet = $_POST['inputStreet'] ?? $defaultStreet;
		$postInputBuilding = $_POST['inputBuilding'] ?? $defaultBuilding;
		$postInputVeh = $_POST['inputVeh'] ?? $defaultVehicle;
		$postInputVehPlate = $_POST['inputVehPlate'] ?? $defaultVehiclePlate;
		$postInputEvidenceImageArray = $_POST['inputEvidenceImage'] ?? array();
		$postInputEvidenceImageArray = array_values(array_filter($postInputEvidenceImageArray));
		$postInputVehRO = $_POST['inputVehRO'] ?? $defaultRegisteredOwner;

		// Session Variables
		$generatedReportType = '';
		$generatedReport = '';
		$generatedThreadURL = '';
		$generatedThreadTitle = '';
		$showGeneratedArrestChargeTables = false;
		$generatedArrestChargeList = '';
		$generatedArrestChargeTotals = '';
		$generatedArrestSubmissionTitle = '';
		$generatedArrestSubmissionURL = '';
		$generatedArrestSubmission = '';

		if ($generatorType == 'ProfilingSamples') {

			// Formatters
			$officers = resolverOfficer($postInputName, $postInputRank, $postInputBadge);
			$location = textBold(1, $postInputBuilding);
			$suspect = textBold(1, $postInputDefName);
			$datetime = textBold(2, $postInputDate).', '.textBold(1, $postInputTime);

			// Set Cookies
			setCookiePost('officerName', $postInputName);
			setCookiePost('officerRank', $postInputRank);
			setCookiePost('officerBadge', $postInputBadge);
			setCookiePost('defName', $postInputDefName);

			function statement($input) {
				global $officers, $suspect, $datetime, $location;
				return $input.' Sample Attached<br>'.textRP(1).' '.$officers.' sampled '.$suspect.'&#39;s '.$input.' on the '.$datetime.'. At the '.$location.' processing unit. '.textRP(1);
			}

			// Report Builder
			$redirectPath = redirectPath(1);
			$generatedReportType = 'Profiling Samples';
			$generatedReport = statement('Fingerprints').'<br><br>'.statement('DNA');

		}

		if ($generatorType == 'TrafficReport') {

			// Array Maps
			$postInputNameArray = arrayMap($_POST['inputName'], $defaultName);
			$postInputRankArray = arrayMap($_POST['inputRank'], 0);
			$postInputBadgeArray = arrayMap($_POST['inputBadge'], '');
			$inputCrime = arrayMap($_POST['inputCrime'], 'UNKNOWN CHARGE');
			$inputCrimeClass = arrayMap($_POST['inputCrimeClass'], 0);
			$inputCrimeFine = arrayMap($_POST['inputCrimeFine'], 0);

			// Variables
			$inputDefLicense = $_POST['inputDefLicense'] ?: 0;
			$inputNarrative = $_POST['inputNarrative'] ?: '';
			$inputDashcam = $_POST['inputDashcam'] ?: '';
			$inputVehRegistered = $_POST['inputVehRegistered'] ?: false;
			$inputVehRO = $_POST['inputVehRO'] ?: $postInputDefName;
			$inputVehTint = $_POST['inputVehTint'] ?? -1;
			$inputVehInsurance = $_POST['inputVehInsurance'] ?: false;
			$inputVehInsuranceDate = $_POST['inputVehInsuranceDate'] ?? $g->getUNIX('date');
			$inputVehInsuranceTime = $_POST['inputVehInsuranceTime'] ?? $g->getUNIX('time');

			// Cookies
			setCookiePost('callSign', $postInputCallsign);
			setCookiePost('officerNameArray', $postInputNameArray[0]);
			setCookiePost('officerRankArray', $postInputRankArray[0]);
			setCookiePost('officerBadgeArray', $postInputBadgeArray[0]);
			setCookiePost('defName', $postInputDefName);

			// Officer Resolver
			$officers = '';
			foreach ($postInputNameArray as $iOfficer => $officer) {
				$officers .= resolverOfficer($officer, $postInputRankArray[$iOfficer], $postInputBadgeArray[$iOfficer]);
			}

			// Vehicle Registered Resolver
			$registered = '';
			if (!$inputVehRegistered) {
				$registered = 'The vehicle was <strong>registered</strong> to '.textBold(1, $inputVehRO).', with the identification plate reading '.textBold(2, $postInputVehPlate).'.<br>';
			} else {
				$registered = 'The vehicle was <strong>unregistered</strong> at the time of the traffic stop.<br>';
			}

			// Vehicle Insurance Resolver
			$insurance = '';
			if ($inputVehInsurance) {
				$insurance = 'The vehicle was uninsured at the time of the conducted traffic stop, having expired on the '.textBold(2, $inputVehInsuranceDate).', '.textBold(1, $inputVehInsuranceTime).'.<br>';
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
					$fines .= '<li><strong class="style-underline chargeCopy" data-clipboard-target="#charge-'.$crime.'" data-toggle="tooltip" title="Copied!"><span id="charge-'.$crime.'">'.$pg->getCrimeColour($chargeType).$chargeType.$chargeClass.' '.$crime.'. '.$chargeTitle.'</strong></span></strong></li>';
				} else {
					$fines .= '<li><strong class="style-underline chargeCopy" data-clipboard-target="#charge-'.$crime.'" data-toggle="tooltip" title="Copied!"><span id="charge-'.$crime.'">'.$pg->getCrimeColour($chargeType).$chargeType.$chargeClass.' '.$crime.'. '.$chargeTitle.'</strong></span></strong> - <strong style="color: green!important;">$'.number_format($inputCrimeFine[$iCrime]).'</strong> Citation</li>';
				}
			}

			// Report Builder
			$redirectPath = redirectPath(1);
			$generatedReportType = 'Traffic Report';
			$generatedReport = $officers.'under the call sign '.textBold(2, $postInputCallsign).' on the '.textBold(2, $postInputDate).', '.textBold(1, $postInputTime).'.<br>Conducted a traffic stop on a '.textBold(1, $postInputVeh).', on '.textBold(1, $postInputStreet).', '.textBold(1, $postInputDistrict).'.<br>'.$registered.$insurance.$pg->getVehicleTint($inputVehTint).'<br>The driver was identified as '.textBold(1, $postInputDefName).', possessing '.$pg->getDefLicense($inputDefLicense).'<br>'.$inputNarrative.'<br><br>Following charge(s) were issued:<ul>'.$fines.'</ul>'.$pg->getDashboardCamera($inputDashcam);

		}

		if ($generatorType == 'ArrestReport') {

			// Array Maps
			$postInputNameArray = arrayMap($_POST['inputName'], $defaultName);
			$postInputRankArray = arrayMap($_POST['inputRank'], 0);
			$postInputBadgeArray = arrayMap($_POST['inputBadge'], '');

			// Variables
			$inputNarrative = $_POST['inputNarrative'] ?: 'UNKNOWN NARRATIVE';
			$inputEvidence = $_POST['inputEvidence'] ?: '';
			$inputDashcam = $_POST['inputDashcam'] ?: '';
			$inputWristband = $_POST['inputWristband'] ?: 0;
			$inputBracelet = $_POST['inputBracelet'] ?: 0;
			$inputPlea = $_POST['inputPlea'] ?: 0;

			$suspectURL = str_replace(' ', '_', $postInputDefName);

			// Set Cookies
			setCookiePost('callSign', $postInputCallsign);
			setCookiePost('officerNameArray', $postInputNameArray[0]);
			setCookiePost('officerRankArray', $postInputRankArray[0]);
			setCookiePost('officerBadgeArray', $postInputBadgeArray[0]);
			setCookiePost('defName', $postInputDefName);
			setCookiePost('defNameURL', $postInputDefName);

			// Formatting
			$callsign = textBold(2, $postInputCallsign);
			$datetime = textBold(2, $postInputDate).', '.textBold(1, $postInputTime);
			$suspect = textBold(1, $postInputDefName);
			$location = textBold(1, $postInputStreet).', '.textBold(1, $postInputDistrict).'.';

			// Officer Resolver
			$officers = '';
			foreach ($postInputNameArray as $iOfficer => $officer) {
				$officers .= resolverOfficer($officer, $postInputRankArray[$iOfficer], $postInputBadgeArray[$iOfficer]);
			}

			// Section Resolver
			$narrative = (empty($inputNarrative)) ? '' : '<br><br><u><strong>Arrest Narrative:</strong></u><br>'.nl2br($inputNarrative);
			$evidence = (empty($inputEvidence)) ? '' : '<br><br><u><strong>Supporting Evidence:</strong></u><br>'.nl2br($inputEvidence);
			$evidence2 = (empty($inputEvidence)) ? 'N/A' : '[b]Supporting Evidence[/b]: '.($inputEvidence);
			$dashboard = (empty($inputDashcam)) ? '' : '<br><br><u><strong>Dashboard Camera:</strong></u><br>'.$pg->getDashboardCamera($inputDashcam);

			// Wristband & Bracelet Resolver
			$wristbandBracelet = '';
			if ($inputWristband != 0 || $inputBracelet != 0) {
				$wristbandBracelet = '<u><strong>Processing Details:</strong></u><br><strong>'.$ar->getBracelet($inputBracelet).' & '.$ar->getWristband($inputWristband).'</strong>.';
			}
			$processingBands = '<br><br>'.$wristbandBracelet.'<br>';

			// Plea Resolver
			$plea = $ar->getPlea($inputPlea, $postInputDefName);
			$plea2 = $ar->getPleaRaw($inputPlea);
			$plea3 = $ar->getPleaRawShort($inputPlea);

			// Crime Resolver
			$charges = '';
			foreach ($arrestChargeList as $iCharge => $charge) {
				$charges .= '[*]'.strip_tags($charge);
			}

			// Report Builder
			$redirectPath = redirectPath(1);
			$generatedReportType = 'Arrest Report';
			$generatedReport = $officers.'under the callsign '.$callsign.' on the '.$datetime.'. Conducted an arrest on '.$suspect.', the apprehension took place on '.$location.$narrative.$evidence.$dashboard.$processingBands.$plea;

			if ($inputPlea == 3) {
				$generatedArrestSubmissionURL = 'https://lspd.gta.world/posting.php?mode=post&f=1674';
			} else {
				$generatedArrestSubmissionURL = 'https://lspd.gta.world/posting.php?mode=post&f=1228';
			}

			$generatedArrestSubmissionTitle = $postInputDefName. ' ['.$plea3.']';
			$generatedArrestSubmission = '[divbox2=#fff]
[aligntable=right,0,0,50,0,0,0][img]https://i.imgur.com/pWXsgcX.png[/img]
[color=transparent]Generated by mdc.xanx.co.uk[/color][/aligntable]
[aligntable=left,0,100,0,0,0,0]
[color=transparent]spacer[/color]
[color=transparent]spacer[/color]
[center][size=130][b]Post-Arrest Submission[/b][/size][/center][/aligntable]
[hr][/hr]
[color=transparent]spacer[/color]
[b]Arresting Officer[/b]: '.$pg->getRank($postInputRankArray[0]).' '.$postInputNameArray[0].'
[b]Arrestee[/b]: '.$postInputDefName.'
[b]Arrestee - MDC File[/b]: [url=https://mdc.gta.world/record/'.$suspectURL.']ACCESS[/url]
[b]Arrest Report Number[/b]: #XXXXX
[b]Charges[/b]:
[list]'.$charges.'[/list]
[b]Plea Entered[/b]: '.$plea2.'
[b]Additional Relevant Evidence[/b]: '.$evidence2.'
[ooc] [b]Arrestee - GTAW Forum Name[/b]: username [/ooc]

[/divbox2]';

			$showGeneratedArrestChargeTables = $_SESSION['showGeneratedArrestChargeTables'];
			$generatedArrestChargeList = $_SESSION['generatedArrestChargeList'];
			$generatedArrestChargeTotals = $_SESSION['generatedArrestChargeTotals'];

		}

		if ($generatorType == 'DeathReport') {

			// Variables
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
			$redirectPath = redirectPath(2);
			$generatedReportType = 'Death Report';
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
				[list=none][b]FIRST RESPONDING OFFICER:[/b] '.$pg->getRank($inputRespondingRank).' '.$inputRespondingName.'
				[b]HANDLING DETECTIVE/FORENSIC ANALYST:[/b] '.$pg->getRank($inputHandlingRank).' '.$inputHandlingName.'
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

		if ($generatorType == 'TrafficDivisionPatrolReport') {

			// Variables
			$inputDateFrom = $_POST['inputDateFrom'] ?: $g->getUNIX('date');
			$inputDateTo = $_POST['inputDateTo'] ?: $g->getUNIX('date');
			$inputTimeFrom = $_POST['inputTimeFrom'] ?: $g->getUNIX('time');
			$inputTimeTo = $_POST['inputTimeTo'] ?: $g->getUNIX('time');
			$inputPatrolVehicle = $_POST['inputPatrolVehicle'] ?: false;
			$inputVehicleModel = $_POST['inputVehicleModel'] ?? $defaultVehicle;
			$inputTrafficStops = $_POST['inputTrafficStops'] ?: '0';
			$inputCitations = $_POST['inputCitations'] ?: '0';
			$inputVehicleImpounds = $_POST['inputVehicleImpounds'] ?: '0';
			$inputTrafficAssists = $_POST['inputTrafficAssists'] ?: '0';
			$inputTrafficInvestigations = $_POST['inputTrafficInvestigations'] ?: '0';
			$inputEnforcementSpeed = $_POST['inputEnforcementSpeed'] ?: false;
			$inputEnforcementParking = $_POST['inputEnforcementParking'] ?: false;
			$inputEnforcementRegistration = $_POST['inputEnforcementRegistration'] ?: false;
			$inputEnforcementMoving = $_POST['inputEnforcementMoving'] ?: false;

			$inputNotes = $_POST['inputNotes'] ?: 'N/A';
			$inputTDPatrolReportURL = $_POST['inputTDPatrolReportURL'] ?: 'https://lspd.gta.world/viewforum.php?f=101';

			// Set Cookies
			setCookiePost('inputTDPatrolReportURL', $inputTDPatrolReportURL);

			// Patrol Vehicle Resolver
			$patrolVehicle = '';
			if (!$inputPatrolVehicle) {
				$patrolVehicle = '[*]Marked: [cbc][/cbc]';
			} else {
				$patrolVehicle = '[*]Unmarked: [cbc][/cbc] - Model: '.$inputVehicleModel;
			}

			// Counts Resolver
			$trafficStopCount = (empty($inputTrafficStops)) ? 0 : $inputTrafficStops;
			$citationCount = (empty($inputCitations)) ? 0 : $inputCitations;

			// Enforcement Resolver
			$enforcementSpeed = (empty($inputEnforcementSpeed)) ? $unchecked : $checked;
			$enforcementParking = (empty($inputEnforcementParking)) ? $unchecked : $checked;
			$enforcementMoving = (empty($inputEnforcementMoving)) ? $unchecked : $checked;
			$enforcementRegistration = (empty($inputEnforcementRegistration)) ? $unchecked : $checked;

			// Report Builder
			$redirectPath = redirectPath(2);
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

				[b]Type of patrol vehicle:[/b]
				[list=circle]'.$patrolVehicle.'[/list]

				[b]Traffic Stops:[/b] '.$trafficStopCount.'
				[b]Citations Issued:[/b] '.$citationCount.'
				[b]Vehicles Impounded:[/b] '.$inputVehicleImpounds.'
				[b]Traffic Assists:[/b] '.$inputTrafficAssists.'
				[b]Traffic Investigations:[/b] '.$inputTrafficInvestigations.'

				[b]Targeted Enforcement Undertaken:[/b][list][*]'.$enforcementSpeed.' SPEED
				[*]'.$enforcementParking.' PARKING
				[*]'.$enforcementMoving.' MOVING VIOLATIONS
				[*]'.$enforcementRegistration.' REGISTRATION[/list]
				[b]Location Enforcement Undertaken[/b]: '.$postInputDistrict.'

				[b]Notes (Optional):[/b] ' . $inputNotes . '
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

				$chargesDrug = [505,506,507,508,509];
				$multiDimensionalCrimeTimes = [412];

				// Charge List Builder
				foreach ($charges as $iCharge => $charge) {

					// Charge Base
					$charge = $penal[$charge];
					$chargeID = $charge['id'];
					$chargeName = $charge['charge'];
					$chargeOffence = $_POST['inputCrimeOffence'][$iCharge] ?? 1;
					$chargeAddition = $_POST['inputCrimeAddition'][$iCharge];
					$chargeSubstanceCategory = $_POST['inputCrimeSubstanceCategory'][$iCharge];

					if (in_array($chargeID, $chargesDrug)) {
						$chargeFine[] = $charge['fine'][$chargeSubstanceCategory];
						$chargeFineFull = '$'.number_format($chargeFine[$iCharge]);
						$drugChargeTitle = ' (Category '.$chargeSubstanceCategory.')';

					} else {
						$chargeFine[] = $charge['fine'][$chargeOffence];
						$chargeFineFull = '$'.number_format($chargeFine[$iCharge]);
						$drugChargeTitle = null;
					}

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

					// Extra Builder
					$chargeExtra[] = $charge['extra'];
					if ($chargeExtra[$iCharge] == 'N/A') {
						$chargeExtraColour = 'muted';
						$chargeExtraIcon = 'minus-circle';
					} else {
						$chargeExtraColour = 'success';
						$chargeExtraIcon = 'check-circle';
					}
					$chargeExtraFull = '<span class="badge badge-'.$chargeExtraColour.'"><i class="fas fa-fw fa-'.$chargeExtraIcon.' mr-1"></i>'.$chargeExtra[$iCharge].'</span>';

					// Time Builder
					if (in_array($chargeID, $chargesDrug)) {
						$days[] = ($charge['time'][$chargeSubstanceCategory]['days'] / $chargeReduction);
						$hours[] = ($charge['time'][$chargeSubstanceCategory]['hours'] / $chargeReduction);
						$mins[] = ($charge['time'][$chargeSubstanceCategory]['min'] / $chargeReduction);
					} elseif (in_array($chargeID, $multiDimensionalCrimeTimes)) {
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
					$chargeOffenceFull = null;
					if ($chargeOffence > 1) {
						$chargeOffenceFull = ' (Offence #'.$chargeOffence.')';
					}
					$chargeTitle[] = '<span class="style-underline chargeCopy" data-clipboard-target="#charge-'.$chargeID.'" data-toggle="tooltip" title="Copied!"><span id="charge-'.$chargeID.'">'.$chargeType.$chargeClass.' '.$chargeID.'. '.$chargeName.$chargeOffenceFull.$drugChargeTitle.'</span></span>';

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
						<td class="text-center">'.$chargeExtraFull.'</td>
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
				$rowBuilderTotals = '<tr>
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
				$arrestChargeList = $chargeTitle;

			} else {
				$showGeneratedArrestChargeTables = false;
			}
		}

		if ($generatorType == 'ParkingTicket') {

			// Variables
			$inputVehInsurance = $_POST['inputVehInsurance'] ?: false;
			$inputVehInsuranceDate = $_POST['inputVehInsuranceDate'] ?? $g->getUNIX('date');
			$inputVehInsuranceTime = $_POST['inputVehInsuranceTime'] ?? $g->getUNIX('time');
			$inputReason = $_POST['inputReason'] ?? array();
			$inputReason = array_values($inputReason);
			$inputCrime = arrayMap($_POST['inputCrime'], 'UNKNOWN CHARGE');
			$inputCrimeClass = arrayMap($_POST['inputCrimeClass'], 0);
			$inputCrimeFine = arrayMap($_POST['inputCrimeFine'], 0);

			// Set Cookies
			setCookiePost('officerName', $postInputName);
			setCookiePost('officerRank', $postInputRank);
			setCookiePost('officerBadge', $postInputBadge);
			setCookiePost('defNameVehRO', $postInputVehRO);

			// Vehicle Insurance Resolver
			$insurance = '';
			if ($inputVehInsurance) {
				$insurance = 'The vehicle was uninsured at the time of writing the parking ticket, having expired on the '.textBold(2, $inputVehInsuranceDate).', '.textBold(1, $inputVehInsuranceTime).'.<br>';
			}

			// Evidence Resolver
			$evidence = 'N/A';
			if (!empty($postInputEvidenceImageArray)) {

				$evidence = '';
				foreach ($postInputEvidenceImageArray as $image) {
					$evidence .= '<img src="'.$image.'" style="max-width: 100%" />';
				}
			}

			// Officer Resolver
			$officers = resolverOfficer($postInputName, $postInputRank, $postInputBadge);

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
					$fines .= '<li><strong class="style-underline chargeCopy" data-clipboard-target="#charge-'.$crime.'" data-toggle="tooltip" title="Copied!"><span id="charge-'.$crime.'">'.$pg->getCrimeColour($chargeType).$chargeType.$chargeClass.' '.$crime.'. '.$chargeTitle.'</strong></span></strong>.</li>';
				} else {
					$fines .= '<li><strong class="style-underline chargeCopy" data-clipboard-target="#charge-'.$crime.'" data-toggle="tooltip" title="Copied!"><span id="charge-'.$crime.'">'.$pg->getCrimeColour($chargeType).$chargeType.$chargeClass.' '.$crime.'. '.$chargeTitle.'</strong></span></strong> - <strong style="color: green!important;">$'.number_format($inputCrimeFine[$iCrime]).'</strong> Citation.</li>';
				}
			}

			// Parking Ticket Resolver
			$statementReason = '';
			foreach ($inputReason as $reason) {
				$statementReason .= '<li>'.$pt->getIllegalParking($reason).'</li>';
			}

			// Report Builder
			$redirectPath = redirectPath(1);
			$generatedReportType = 'Parking Ticket';
			$generatedReport = $generatedReport = $officers.' on the '.textBold(2, $postInputDate).', '.textBold(1, $postInputTime).'.<br>Cited a '.textBold(1, $postInputVeh).', '.$pg->getVehiclePlates($postInputVehPlate,0).', '.$pg->getVehicleRO($postInputVehRO).', on '.textBold(1, $postInputStreet).', '.textBold(1, $postInputDistrict).'.<br>'.$insurance.'
				<br>
				<strong>Citation(s):</strong>
				<ul>'.$fines.'</ul>
				<strong>Citation Reason(s):</strong>
				<ul>'.$statementReason.'</ul>
				<strong>Evidence:</strong><br>'.$evidence;

		}

		if ($generatorType == 'ImpoundReport') {

			// Variables
			$inputDuration = $_POST['inputDuration'] ?: 0;
			$inputReason = $_POST['inputReason'] ?: 'UNKNOWN REASON';

			// Set Cookies
			setCookiePost('officerName', $postInputName);
			setCookiePost('officerRank', $postInputRank);
			setCookiePost('officerBadge', $postInputBadge);
			setCookiePost('defNameVehRO', $postInputVehRO);

			// Officer Resolver
			$officers = resolverOfficer($postInputName, $postInputRank, $postInputBadge);

			// Report Builder
			$redirectPath = redirectPath(1);
			$generatedThreadTitle = $postInputVeh.' - '.$postInputVehPlate;
			$generatedReportType = 'Impound Report';
			$generatedReport = $officers.' on the '.textBold(2, $postInputDate).', '.textBold(1, $postInputTime).'.<br>Impounded a '.textBold(1, $postInputVeh).', '.$pg->getVehiclePlates($postInputVehPlate,0).', for '.textBold(1, $inputDuration).' days, '.$pg->getVehicleRO($postInputVehRO).', on '.textBold(1, $postInputStreet).', '.textBold(1, $postInputDistrict).'.<br>

				<strong>Impound Reason:</strong>
				<ul><li>'.$inputReason.'</li></ul>';

		}

		// Generator Finalisation
		$_SESSION['generatedReport'] = $generatedReport;
		$_SESSION['generatedReportType'] = $generatedReportType;
		$_SESSION['generatedThreadTitle'] = $generatedThreadTitle;
		$_SESSION['generatedThreadURL'] = $generatedThreadURL;
		$_SESSION['showGeneratedArrestChargeTables'] = $showGeneratedArrestChargeTables;
		$_SESSION['generatedArrestChargeList'] = $generatedArrestChargeList;
		$_SESSION['generatedArrestChargeTotals'] = $generatedArrestChargeTotals;
		$_SESSION['arrestChargeList'] = $arrestChargeList;
		if ($inputPlea != 1) {
			$_SESSION['generatedArrestSubmissionTitle'] = $generatedArrestSubmissionTitle;
			$_SESSION['generatedArrestSubmission'] = $generatedArrestSubmission;
		} else {
			$generatedArrestSubmissionTitle = '';
			$generatedArrestSubmission = '';
		}
		$_SESSION['generatedArrestSubmissionURL'] = $generatedArrestSubmissionURL;

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
		//*/
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
			case 'notificationVersion':
				$cookie = 'notificationVersion';
				$time = $iTime;
				break;
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
				break;
			default:
				break;
		}

		return setcookie($cookie,$inputVariable,$time,$cPath,$g->getSettings('site-url'),$g->getSettings('site-live'));

	}

	function arrayMap($input, $default) {

		$input = $input ?? array();
		return array_map(function($value) use($default) {
			return $value === '' ? $default : $value;
		}, $input);

	}


	function textBold($option, $input) {

		switch ($option) {
			case 1:
				return '<strong>'.$input.'</strong>';
			case 2:
				return '<strong>'.strtoupper($input).'</strong>';
			default:
				return '<strong>'.$input.'</strong>';
		}

	}

	function textRP($option) {

		switch ($option) {
			case 1:
				return '<strong style="color: #9944dd!important;">*</strong>';
			case 2:
				break;
			default:
				return '<strong style="color: #9944dd!important;">?</strong>';
		}

	}

	function resolverOfficer($name, $rank, $badge) {

		global $pg;

		return '<strong>'.$pg->getRank($rank).' '.$name.'</strong> (<strong>#'.$badge.'</strong>), ';

	}