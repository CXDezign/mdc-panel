<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/initialise.php';

$penal = $pg->penalCode();

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

		if (in_array($crimeID, $pg->chargesDrug) && $crime['drugs']) {
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

	if ($getType == 'hideSpecialNotification') {

		setCookiePost('specialNotification', $g->getSettings('special-notification'));
	}

	/*
		if ($getType == 'setChargeTable') {

			$_SESSION['showGeneratedArrestChargeTables'] = false;

		}
		*/
}


if (isset($_POST['openStatus'])) {
	$guidelineDropdownStatus = $_POST['openStatus'] ?? 0;
	setCookiePost('openStatus', $guidelineDropdownStatus);
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


	if ($generatorType == 'ArrestChargesTest') {
		echo json_encode($pg->processCharges(), JSON_PRETTY_PRINT);
		die();
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
			$registered = 'The vehicle was <strong>registered</strong> to ' . textBold(1, $inputVehRO) . ', with the identification plate reading ' . textBold(2, $postInputVehPlate) . '.<br>';
		} else {
			$registered = 'The vehicle was <strong>unregistered</strong> at the time of the traffic stop.<br>';
		}

		// Vehicle Insurance Resolver
		$insurance = '';
		if ($inputVehInsurance) {
			$insurance = 'The vehicle was uninsured at the time of the conducted traffic stop, having expired on the ' . textBold(2, $inputVehInsuranceDate) . ', ' . textBold(1, $inputVehInsuranceTime) . '.<br>';
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
				$fines .= '<li><strong class="style-underline chargeCopy" data-clipboard-target="#charge-' . $crime . '" data-toggle="tooltip" title="Copied!"><span id="charge-' . $crime . '">' . $pg->getCrimeColour($chargeType) . $chargeType . $chargeClass . ' ' . $crime . '. ' . $chargeTitle . '</strong></span></strong></li>';
			} else {
				$fines .= '<li><strong class="style-underline chargeCopy" data-clipboard-target="#charge-' . $crime . '" data-toggle="tooltip" title="Copied!"><span id="charge-' . $crime . '">' . $pg->getCrimeColour($chargeType) . $chargeType . $chargeClass . ' ' . $crime . '. ' . $chargeTitle . '</strong></span></strong> - <strong style="color: green!important;">$' . number_format($inputCrimeFine[$iCrime]) . '</strong> Citation</li>';
			}
		}

		// Report Builder
		$redirectPath = redirectPath(1);
		$generatedReportType = 'Traffic Report';
		$generatedReport = $officers . 'under the call sign ' . textBold(2, $postInputCallsign) . ' on the ' . textBold(2, $postInputDate) . ', ' . textBold(1, $postInputTime) . '.<br>Conducted a traffic stop on a ' . textBold(1, $postInputVeh) . ', on ' . textBold(1, $postInputStreet) . ', ' . textBold(1, $postInputDistrict) . '.<br>' . $registered . $insurance . $pg->getVehicleTint($inputVehTint) . '<br>The driver was identified as ' . textBold(1, $postInputDefName) . ', possessing ' . $pg->getDefLicense($inputDefLicense) . '<br>' . $inputNarrative . '<br><br>Following charge(s) were issued:<ul>' . $fines . '</ul>' . $pg->getDashboardCamera($inputDashcam);
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
		$datetime = textBold(2, $postInputDate) . ', ' . textBold(1, $postInputTime);
		$suspect = textBold(1, $postInputDefName);
		$location = textBold(1, $postInputStreet) . ', ' . textBold(1, $postInputDistrict) . '.';

		// Officer Resolver
		$officers = '';
		foreach ($postInputNameArray as $iOfficer => $officer) {
			$officers .= resolverOfficer($officer, $postInputRankArray[$iOfficer], $postInputBadgeArray[$iOfficer]);
		}

		// Section Resolver
		$narrative = (empty($inputNarrative)) ? '' : '<br><br><u><strong>Arrest Narrative:</strong></u><br>' . nl2br($inputNarrative);
		$evidence = (empty($inputEvidence)) ? '' : '<br><br><u><strong>Supporting Evidence:</strong></u><br>' . nl2br($inputEvidence);
		$evidence2 = (empty($inputEvidence)) ? 'N/A' : '[b]Supporting Evidence[/b]: ' . ($inputEvidence);
		$dashboard = (empty($inputDashcam)) ? '' : '<br><br><u><strong>Dashboard Camera:</strong></u><br>' . $pg->getDashboardCamera($inputDashcam);

		// Wristband & Bracelet Resolver
		$wristbandBracelet = '';
		if ($inputWristband != 0 || $inputBracelet != 0) {
			$wristbandBracelet = '<u><strong>Processing Details:</strong></u><br><strong>' . $ar->getBracelet($inputBracelet) . ' & ' . $ar->getWristband($inputWristband) . '</strong>.';
		}
		$processingBands = '<br><br>' . $wristbandBracelet . '<br>';

		// Plea Resolver
		$plea = $ar->getPlea($inputPlea, $postInputDefName);
		$plea2 = $ar->getPleaRaw($inputPlea);
		$plea3 = $ar->getPleaRawShort($inputPlea);

		// Crime Resolver
		$charges = '';
		foreach ($arrestChargeList as $iCharge => $charge) {
			$charges .= '[*]' . strip_tags($charge);
		}

		// Report Builder
		$redirectPath = redirectPath(1);
		$generatedReportType = 'Arrest Report';
		$generatedReport = $officers . 'under the callsign ' . $callsign . ' on the ' . $datetime . '. Conducted an arrest on ' . $suspect . ', the apprehension took place on ' . $location . $narrative . $evidence . $dashboard . $processingBands . $plea;
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
					$witnesses .= '[*]' . $witness;
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
				$evidenceImage .= '[altspoiler=EXHIBIT - Photograph #' . $evidenceImageCount . '][img]' . $image . '[/img][/altspoiler]';
			}
		}

		$evidenceBox = '';
		if (!empty($inputEvidenceBox)) {

			$evidenceBox = '';
			foreach ($inputEvidenceBox as $eBoxID => $box) {
				$evidenceBoxCount = $eBoxID + 1;
				$evidenceBox .= '[altspoiler=EXHIBIT - Description #' . $evidenceBoxCount . ']' . $box . '[/altspoiler]';
			}
		}

		// Report Builder
		$redirectPath = redirectPath(2);
		$generatedReportType = 'Death Report';
		$generatedThreadURL = 'https://lspd.gta.world/posting.php?mode=post&f=1356';
		$generatedThreadTitle = $inputDeathName . ' - ' . strtoupper($postInputDate) . ' - ' . $postInputStreet . ', ' . $postInputDistrict;
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
				[list=none][b]NAME OF DECEASED:[/b] ' . $inputDeathName . '
				[b]TIME & DATE OF DEATH:[/b] ' . $postInputTime . ' - ' . strtoupper($postInputDate) . '
				[b]LOCATION OF DEATH:[/b] ' . $postInputStreet . ', ' . $postInputDistrict . '
				[b]APPARENT CAUSE OF DEATH:[/b] ' . $inputDeathReason . '
				[b]WITNESSES:[/b] ' . $witnesses . '[/list]
				[b]2. ADMINISTRATIVE INFORMATION[/b]
				[hr][/hr]
				[list=none][b]FIRST RESPONDING OFFICER:[/b] ' . $pg->getRank($inputRespondingRank) . ' ' . $inputRespondingName . '
				[b]HANDLING DETECTIVE/FORENSIC ANALYST:[/b] ' . $pg->getRank($inputHandlingRank) . ' ' . $inputHandlingName . '
				[b]HANDLING CORONER:[/b] ' . $inputCoronerName . '
				[b]CORONER CASE NUMBER:[/b] ' . $inputCaseNumber . '
				[b]RELEVANT MDC RECORDS:[/b] [url=' . $inputRecord . ']LINK[/url][/list]
				[b]3. EVIDENCE[/b]
				' . $evidenceImage . '
				' . $evidenceBox . '
				[hr][/hr]
				[/divbox2]';
		$generatedReport = str_replace('				', '', $generatedReport);
	}

	if ($generatorType == 'IncidentReport') {

		// Variables
		$inputPersonName = $_POST['inputPersonName'] ?: array();
		$inputPersonName = array_values(array_filter($inputPersonName));
		$inputClassification = $_POST['inputClassification'] ?: array();
		$inputClassification = array_values(array_filter($inputClassification));
		$inputClassificationArray = arrayMap($_POST['inputClassification'], 0);
		$inputDoB = $_POST['inputDoB'] ?: array();
		$inputDoB = array_values(array_filter($inputDoB));
		$inputPhone = $_POST['inputPhone'] ?: array();
		$inputPhone = array_values(array_filter($inputPhone));
		$inputResidence = $_POST['inputResidence'] ?: array();
		$inputResidence = array_values(array_filter($inputResidence));
		$inputRelation = $_POST['inputRelation'] ?: array();
		$inputRelation = array_values(array_filter($inputRelation));
		$inputEvidenceBox = $_POST['inputEvidenceBox'] ?? array();
		$inputEvidenceBox = array_values(array_filter($inputEvidenceBox));
		$inputNarrative = $_POST['inputNarrative'] ?: '';
		$inputIncidentTitle = $_POST['inputIncidentTitle'] ?: '';

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
			$officers .= resolverOfficerBB($officer, $postInputRankArray[$iOfficer], $postInputBadgeArray[$iOfficer]);
		}

		// Person Resolver
		$persons = '';
		if (!empty($inputPersonName)) {
			foreach ($inputPersonName as $indPerson => $person) {
				$persons .= '[u]Person #' .	$index + 1	. ' - ' . $person . '[/u]
[b]Classification:[/b] ' . $pg->getClassification($inputClassificationArray[$indPerson]) . '
[b]Date of Birth:[/b] ' . strtoupper($inputDoB[$indPerson]) . '
[b]Phone Number:[/b] ' . $inputPhone[$indPerson] . '
[b]Residence:[/b] ' . $inputResidence[$indPerson] . '
[b]Relation to Incident:[/b] ' . $inputRelation[$indPerson] . '

';
				$index++;
			}
		}

		// Evidence Resolver
		$evidenceImage = '';
		if (!empty($postInputEvidenceImageArray)) {

			$evidenceImage = '';
			foreach ($postInputEvidenceImageArray as $eImgID => $image) {
				$evidenceImageCount = $eImgID + 1;
				$evidenceImage .= '[altspoiler="EXHIBIT - Photograph #' . $evidenceImageCount . '"][img]' . $image . '[/img][/altspoiler]';
			}
		}

		$evidenceBox = '';
		if (!empty($inputEvidenceBox)) {

			$evidenceBox = '';
			foreach ($inputEvidenceBox as $eBoxID => $box) {
				$evidenceBoxCount = $eBoxID + 1;
				$evidenceBox .= '[altspoiler="EXHIBIT - Description #' . $evidenceBoxCount . '"]' . $box . '[/altspoiler]';
			}
		}

		if ($evidenceImage == '' && $evidenceBox == '') {
			$evidenceImage = 'No Evidence Submitted.';
		}

		// Report Builder
		$redirectPath = redirectPath(2);
		$generatedReportType = 'Incident Report';
		$generatedThreadURL = 'https://lssd.gta.world/posting.php?mode=post&f=1188';
		$generatedThreadTitle = '[IR] ' . $inputIncidentTitle . ' - ' . $postInputStreet . ', ' . $postInputDistrict . ' - ' . strtoupper($postInputDate);
		$generatedReport = '
[font=Arial][color=black]

[center][img]https://i.imgur.com/LEWTXbL.png[/img]

[size=125][b]SHERIFF\'S DEPARTMENT
COUNTY OF LOS SANTOS[/b]
[i]"A Tradition of Service Since 1850"[/i][/size]

[size=110][u]INCIDENT REPORT[/u][/size][/center][hr][/hr]

[font=arial][color=black][indent][size=105][b]Filing Information[/b][/size]

[indent]
[b]Time & Date:[/b] ' . $postInputTime . ', ' . strtoupper($postInputDate) . '
[b]Penal Code (if Criminal):[/b] N/A
[b]Location:[/b] ' . $postInputStreet . ', ' . $postInputDistrict . '

[b]Filed By:[/b] ' . $officers . '
[b]Unit Number:[/b] ' . $postInputCallsign . '
[/indent]

[size=105][b]Involved Persons[/b][/size]
[indent]' . $persons . '[/indent]
[size=105][b]Narrative[/b][/size]
[indent]' . $inputNarrative . '[/indent]

[size=105][b]Evidence[/b][/size]
' . $evidenceBox . '
' . $evidenceImage;
		$generatedReport = str_replace('				', '', $generatedReport);
	}

	if ($generatorType == 'UOFReport') {

		// Variables
		$inputSuspectName = $_POST['inputSuspectName'] ?: array();
		$inputSuspectName = array_values(array_filter($inputSuspectName));
		$inputSuspectStatus = $_POST['inputSuspectStatus'] ?: array();
		$inputSuspectStatus = array_values(array_filter($inputSuspectStatus));
		$inputSuspectStatusArray = arrayMap($_POST['inputSuspectStatus'], 0);
		$inputEvidenceBox = $_POST['inputEvidenceBox'] ?? array();
		$inputEvidenceBox = array_values(array_filter($inputEvidenceBox));
		$inputNarrative = $_POST['inputNarrative'] ?: '';

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
			$officers .= resolverOfficerBB($officer, $postInputRankArray[$iOfficer], $postInputBadgeArray[$iOfficer]);
		}

		// Person Resolver
		$suspects = 'Unknown';
		if (!empty($inputSuspectName)) {

			foreach ($inputSuspectName as $indSuspect => $suspect) {
				$suspects .= '[indent][u]Person #1 - ' . $inputSuspectName[$indSuspect] . '[/u]
[b]Status:[/b] ' . $pg->getStatus($inputSuspectStatusArray[$indSuspect]) . '[/indent]

';
				$index++;
			}
		}

		// Evidence Resolver
		$evidenceImage = '';
		if (!empty($postInputEvidenceImageArray)) {

			$evidenceImage = '';
			foreach ($postInputEvidenceImageArray as $eImgID => $image) {
				$evidenceImageCount = $eImgID + 1;
				$evidenceImage .= '[altspoiler="EXHIBIT - Photograph #' . $evidenceImageCount . '"][img]' . $image . '[/img][/altspoiler]';
			}
		}

		$evidenceBox = '';
		if (!empty($inputEvidenceBox)) {

			$evidenceBox = '';
			foreach ($inputEvidenceBox as $eBoxID => $box) {
				$evidenceBoxCount = $eBoxID + 1;
				$evidenceBox .= '[altspoiler="EXHIBIT - Description #' . $evidenceBoxCount . '"]' . $box . '[/altspoiler]';
			}
		}

		if ($evidenceImage == '' && $evidenceBox == '') {
			$evidenceImage = 'No Evidence Submitted.';
		}

		// Report Builder
		$redirectPath = redirectPath(2);
		$generatedReportType = 'Use of Force Report';
		$generatedThreadURL = 'https://lssd.gta.world/posting.php?mode=post&f=469';
		$generatedThreadTitle = 'UOF - ' . $postInputStreet . ', ' . $postInputDistrict . ' - ' . strtoupper($postInputDate);
		$generatedReport = '
[font=Arial][color=black]

[center][img]https://i.imgur.com/LEWTXbL.png[/img]

[size=125][b]SHERIFF\'S DEPARTMENT
COUNTY OF LOS SANTOS[/b]
[i]"A Tradition of Service Since 1850"[/i][/size]

[size=110][u]USE OF FORCE REPORT[/u][/size][/center][hr][/hr]

[font=arial][color=black][indent][size=105][b]Filing Information[/b][/size]

[indent]
[b]Time & Date:[/b] ' . $postInputTime . ', ' . strtoupper($postInputDate) . '
[b]Location:[/b] ' . $postInputStreet . ', ' . $postInputDistrict . '

[b]Filed By:[/b] ' . $pg->getRank($postInputRankArray[0]) . ' ' . $postInputNameArray[0] . '
[b]Unit Number:[/b] ' . $postInputCallsign . '
[/indent]

[size=105][b]Suspects[/b][/size]
' . $suspects . '[size=105][b]Employees Involved (Only include employees who used lethal force)[/b][/size]
[list]' . $officers . '[/list]

[size=105][b]Narrative[/b][/size]
[indent]' . $inputNarrative . '[/indent]

[size=105][b]Evidence[/b][/size]
' . $evidenceBox . '
' . $evidenceImage;
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
			$patrolVehicle = '[*]Unmarked: [cbc][/cbc] - Model: ' . $inputVehicleModel;
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
				[b]Date:[/b] ' . strtoupper($pg->dateResolver($inputDateFrom, $inputDateTo)) . '
				[b]Time:[/b] ' . $inputTimeFrom . ' - ' . $inputTimeTo . '

				[b]Type of patrol vehicle:[/b]
				[list=circle]' . $patrolVehicle . '[/list]

				[b]Traffic Stops:[/b] ' . $trafficStopCount . '
				[b]Citations Issued:[/b] ' . $citationCount . '
				[b]Vehicles Impounded:[/b] ' . $inputVehicleImpounds . '
				[b]Traffic Assists:[/b] ' . $inputTrafficAssists . '
				[b]Traffic Investigations:[/b] ' . $inputTrafficInvestigations . '

				[b]Targeted Enforcement Undertaken:[/b][list][*]' . $enforcementSpeed . ' SPEED
				[*]' . $enforcementParking . ' PARKING
				[*]' . $enforcementMoving . ' MOVING VIOLATIONS
				[*]' . $enforcementRegistration . ' REGISTRATION[/list]
				[b]Location Enforcement Undertaken[/b]: ' . $postInputDistrict . '

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

			$multiDimensionalCrimeTimes = [412];
			$bailArray = [];
			// Charge List Builder
			foreach ($charges as $iCharge => $charge) {

				// Charge Base
				$charge = $penal[$charge];
				$chargeID = $charge['id'];
				$chargeName = $charge['charge'];
				$chargeOffence = $_POST['inputCrimeOffence'][$iCharge] ?? 1;
				$chargeAddition = $_POST['inputCrimeAddition'][$iCharge];
				$chargeSubstanceCategory = $_POST['inputCrimeSubstanceCategory'][$iCharge];
				$bailCost = [];

				if (in_array($chargeID, $pg->chargesDrug)) {
					$chargeFine[] = $charge['fine'][$chargeSubstanceCategory];
					$chargeFineFull = '$' . number_format($chargeFine[$iCharge]);
					$drugChargeTitle = ' (Category ' . $chargeSubstanceCategory . ')';
				} else {
					$chargeFine[] = $charge['fine'][$chargeOffence];
					$chargeFineFull = '$' . number_format($chargeFine[$iCharge]);
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
					case 5:
						$chargeReduction = 2;
						break;
					case 6:
						$chargeReduction = 4;
						break;
					default:
						$chargeReduction = 1;
				}

				// Charge Type Builder
				$chargeType = $charge['type'];
				$chargeTypeFull = '';

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
					$chargeImpoundTime = ' | ' . number_format($chargeImpound[$iCharge]) . $chargeImpoundString;
				}
				$chargeImpoundFull = '<span class="badge badge-' . $chargeImpoundColour . '">' . $chargeImpoundQuestion . $chargeImpoundTime . '</span>';

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
					$chargeSuspensionTime = ' | ' . number_format($chargeSuspension[$iCharge]) . $chargeSuspensionString;
				}
				$chargeSuspensionFull = '<span class="badge badge-' . $chargeSuspensionColour . '">' . $chargeSuspensionQuestion . $chargeSuspensionTime . '</span>';

				// Extra Builder
				$chargeExtra[] = $charge['extra'];
				if ($chargeExtra[$iCharge] == 'N/A') {
					$chargeExtraColour = 'muted';
					$chargeExtraIcon = 'minus-circle';
				} else {
					$chargeExtraColour = 'success';
					$chargeExtraIcon = 'check-circle';
				}
				$chargeExtraFull = '<span class="badge badge-' . $chargeExtraColour . '"><i class="fas fa-fw fa-' . $chargeExtraIcon . ' mr-1"></i>' . $chargeExtra[$iCharge] . '</span>';

				// Plea for maxtime
				$pleaPre = $_POST['inputPleaPre'] ?: '';

				// Time Builder
				if (in_array($chargeID, $pg->chargesDrug)) {
					$days[] = ($charge['time'][$chargeSubstanceCategory]['days'] / $chargeReduction);
					$hours[] = ($charge['time'][$chargeSubstanceCategory]['hours'] / $chargeReduction);
					$mins[] = ($charge['time'][$chargeSubstanceCategory]['min'] / $chargeReduction);
				} elseif (in_array($chargeID, $multiDimensionalCrimeTimes)) {
					$days[] = ($charge['time'][$chargeOffence]['days'] / $chargeReduction);
					$hours[] = ($charge['time'][$chargeOffence]['hours'] / $chargeReduction);
					$mins[] = ($charge['time'][$chargeOffence]['min'] / $chargeReduction);
				} elseif ($pleaPre == 3 && $charge['maxtime']) {
					$days[] = ($charge['maxtime']['days'] / $chargeReduction);
					$hours[] = ($charge['maxtime']['hours'] / $chargeReduction);
					$mins[] = ($charge['maxtime']['min'] / $chargeReduction);
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
					$chargeOffenceFull = ' (Offence #' . $chargeOffence . ')';
				}
				$chargeTitle[] = '<span class="style-underline chargeCopy" data-clipboard-target="#charge-' . $chargeID . '" data-toggle="tooltip" title="Copied!"><span id="charge-' . $chargeID . '">' . $chargeType . $chargeClass . ' ' . $chargeID . '. ' . $chargeName . $chargeOffenceFull . $drugChargeTitle . '</span></span>';

				//Auto bail
				if (in_array($chargeID, $pg->chargesDrug) && $pleaPre == 2) {
					$autoBailCost = $charge['bail']['cost'][$chargeSubstanceCategory];
					$autoBailRaw = $charge['bail']['auto'][$chargeSubstanceCategory];
				} elseif ($pleaPre == 2) {
					$autoBailRaw = $charge['bail']['auto'];
					$autoBailCost = $charge['bail']['cost'];
					array_push($bailArray, $autoBailRaw);

					switch ($autoBailRaw) {
						case 0:
							$autoBail = 'NO BAIL';
							$autoBailIcon = 'minus-circle';
							$autoBailColour = 'danger';
							break;
						case 1:
							$autoBail = 'AUTO BAIL';
							$autoBailIcon = 'check-circle';
							$autoBailColour = 'success';
							break;
						case 2:
							$autoBail = 'DISCRETIONARY';
							$autoBailIcon = 'check-circle';
							$autoBailColour = 'warning';
							break;
						default:
							$autoBail = 'ERROR';
							break;
					}

					if (!is_string($autoBailCost)) {
						if ($autoBailCost > 0) {
							$bailCost[$iCharge] = $autoBailCost;
							$autoBailCost = '$' . number_format($autoBailCost);
						} else {
							$autoBailCost = 'N/A';
						}
					}
				} else {
					array_push($bailArray, 5);
					$autoBail = 'N/A';
					$autoBailIcon = 'minus-circle';
					$autoBailColour = 'muted';
					$autoBailCost = "$0";
				}
				$autoBailFull = '<span class="badge badge-' . $autoBailColour . '"><i class="fas fa-fw fa-' . $autoBailIcon . ' mr-1"></i>' . $autoBail . '</span>';
				$bailStatusFull = '<span class="badge badge-' . $bailArray[$iCharge] . '"><i class="fas fa-fw fa-' . $autoBailIcon . ' mr-1"></i>' . $autoBail . '</span>';

				// Rows Builder
				$rowBuilder .= '<tr>
						<td>' . $chargeTitle[$iCharge] . '</td>
						<td class="text-center">' . $pg->getCrimeSentencing($chargeAddition) . '</td>
						<td class="text-center">' . $chargeOffence . '</td>
						<td>' . $chargeTypeFull . '</td>
						<td>' . $chargeTimeFull . '</td>
						<td class="text-center">' . $chargePoints[$iCharge] . '</td>
						<td>' . $chargeFineFull . '</td>
						<td class="text-center">' . $chargeImpoundFull . '</td>
						<td class="text-center">' . $chargeSuspensionFull . '</td>
						<td class="text-center">' . $chargeExtraFull . '</td>
						<td class="text-center">' . $autoBailFull . '</td>
						<td class="text-center">' . $autoBailCost . '</td>
					</tr>';
			}

			// Total Time
			$chargeTimeTotalDays = array_sum($days);
			$chargeTimeTotalHours = array_sum($hours);
			$chargeTimeTotalMinutes = array_sum($mins);
			$chargeTimeTotal = $pg->calculateCrimeTime($chargeTimeTotalDays, $chargeTimeTotalHours, $chargeTimeTotalMinutes);

			// Total Points
			$chargePointsTotal = array_sum($chargePoints);
			$chargePointsTotal .= $chargePointsTotal == 1 ? ' Point' : ' Points';

			// Total Fines
			$chargeFineTotal = '$' . number_format(array_sum($chargeFine));

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
			};

			//Total Bail
			$bailCostTotal = '$' . number_format(array_sum($bailCost));
			if (in_array(0, $bailArray)) {
				$bailState = "NOT ELIGIBLE";
				$bailStateColour = "danger";
				$bailStateIcon = 'minus-circle';
			} elseif (in_array(2, $bailArray)) {
				$bailState = "DISCRETIONARY";
				$bailStateColour = "warning";
				$bailStateIcon = 'check-circle';
			} elseif ($pleaPre == 2) {
				$bailState = "ELIGIBLE";
				$bailStateColour = "success";
				$bailStateIcon = 'check-circle';
			} else {
				$bailState = "N/A";
				$bailStateColour = "muted";
				$bailStateIcon = 'minus-circle';
			};
			$bailStatusFull = '<span class="badge badge-' . $bailStateColour . '"><i class="fas fa-fw fa-' . $bailStateIcon . ' mr-1"></i>' . $bailState . '</span>';

			// Totals Row Builder
			$rowBuilderTotals = '<tr>
					<td>' . $chargeTimeTotal . '</td>
					<td>' . $chargePointsTotal . '</td>
					<td>' . $chargeFineTotal . '</td>
					<td>' . $chargeImpoundTotal . '</td>
					<td>' . $chargeSuspensionTotal . '</td>
					<td>' . $bailCostTotal . '</td>
					<td>' . $bailStatusFull . '</td>
				</tr>';

			// Session Builder
			$showGeneratedArrestChargeTables = true;
			$generatedArrestChargeList = $rowBuilder;
			$generatedArrestChargeTotals = $rowBuilderTotals;
			$arrestChargeList = $chargeTitle;
		} else {
			$showGeneratedArrestChargeTables = false;
		}
		$_SESSION['plea'] = $pleaPre;
	
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
			$insurance = 'The vehicle was uninsured at the time of writing the parking ticket, having expired on the ' . textBold(2, $inputVehInsuranceDate) . ', ' . textBold(1, $inputVehInsuranceTime) . '.<br>';
		}

		// Evidence Resolver
		$evidence = 'N/A';
		if (!empty($postInputEvidenceImageArray)) {

			$evidence = '';
			foreach ($postInputEvidenceImageArray as $image) {
				$evidence .= '<img src="' . $image . '" style="max-width: 100%" />';
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
				$fines .= '<li><strong class="style-underline chargeCopy" data-clipboard-target="#charge-' . $crime . '" data-toggle="tooltip" title="Copied!"><span id="charge-' . $crime . '">' . $pg->getCrimeColour($chargeType) . $chargeType . $chargeClass . ' ' . $crime . '. ' . $chargeTitle . '</strong></span></strong>.</li>';
			} else {
				$fines .= '<li><strong class="style-underline chargeCopy" data-clipboard-target="#charge-' . $crime . '" data-toggle="tooltip" title="Copied!"><span id="charge-' . $crime . '">' . $pg->getCrimeColour($chargeType) . $chargeType . $chargeClass . ' ' . $crime . '. ' . $chargeTitle . '</strong></span></strong> - <strong style="color: green!important;">$' . number_format($inputCrimeFine[$iCrime]) . '</strong> Citation.</li>';
			}
		}

		// Parking Ticket Resolver
		$statementReason = '';
		foreach ($inputReason as $reason) {
			$statementReason .= '<li>' . $pt->getIllegalParking($reason) . '</li>';
		}

		// Report Builder
		$redirectPath = redirectPath(1);
		$generatedReportType = 'Parking Ticket';
		$generatedReport = $generatedReport = $officers . ' on the ' . textBold(2, $postInputDate) . ', ' . textBold(1, $postInputTime) . '.<br>Cited a ' . textBold(1, $postInputVeh) . ', ' . $pg->getVehiclePlates($postInputVehPlate, 0) . ', ' . $pg->getVehicleRO($postInputVehRO) . ', on ' . textBold(1, $postInputStreet) . ', ' . textBold(1, $postInputDistrict) . '.<br>' . $insurance . '
				<br>
				<strong>Citation(s):</strong>
				<ul>' . $fines . '</ul>
				<strong>Citation Reason(s):</strong>
				<ul>' . $statementReason . '</ul>
				<strong>Evidence:</strong><br>' . $evidence;
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
		$generatedThreadTitle = $postInputVeh . ' - ' . $postInputVehPlate;
		$generatedReportType = 'Impound Report';
		$generatedReport = $officers . ' on the ' . textBold(2, $postInputDate) . ', ' . textBold(1, $postInputTime) . '.<br>Impounded a ' . textBold(1, $postInputVeh) . ', ' . $pg->getVehiclePlates($postInputVehPlate, 0) . ', for ' . textBold(1, $inputDuration) . ' days, ' . $pg->getVehicleRO($postInputVehRO) . ', on ' . textBold(1, $postInputStreet) . ', ' . textBold(1, $postInputDistrict) . '.<br>

				<strong>Impound Reason:</strong>
				<ul><li>' . $inputReason . '</li></ul>';
	}

	if ($generatorType == 'TrespassNotice') {

		// Variables
		$inputDuration = $_POST['inputDuration'] ?: 0;
		$inputProperty = $_POST['inputProperty'] ?: 'UNKNOWN PROPERTY';
		$inputManagerName = $_POST['inputManagerName'] ?: 'Unknown Manager';
		$inputPhone = $_POST['inputPhone'] ?: '###-###-###';

		// Set Cookies
		setCookiePost('officerName', $postInputName);
		setCookiePost('officerRank', $postInputRank);
		setCookiePost('officerBadge', $postInputBadge);
		setCookiePost('defName', $postInputDefName);

		// Officer Resolver
		$officers = resolverOfficer($postInputName, $postInputRank, $postInputBadge);

		$durationResolver = null;
		if ($inputDuration != 0) {
			$durationResolver = ', for ' . textBold(1, $inputDuration) . ' days. ';
		} else $durationResolver = ', permanently. ';

		// Report Builder
		$redirectPath = redirectPath(1);
		$generatedThreadTitle = 'TRESPASS NOTICE - ' . $inputProperty;
		$generatedReportType = 'Trespass Notice';
		$generatedReport = $officers . ' on the ' . textBold(2, $postInputDate) . ' operating under ' . textBold(1, $postInputCallsign) . ', ' . textBold(1, $postInputTime) . '.<br>Issued trespass notice to ' . textBold(1, $postInputDefName) . $durationResolver . 'At ' . textBold(1, $postInputStreet) . ', ' . textBold(1, $postInputDistrict) . '.<br>

				<strong>Property:</strong>
				<ul><li>' . $inputProperty . '</li></ul>
				
				<strong>Manager Information:</strong>
				<ul><li>' . $inputManagerName . '</li>
				<li>PH #: ' . $inputPhone . '</li></ul>';
	}


	//[LSDA:] Petition for bail
	if ($generatorType == 'BailPetition') {
		$generatedThreadTitle = '[CFXXX-' . date("y") . '] State of San Andreas v. ' . $_POST["inputDefName"];
		$internalCharges = "";
		$chargesGroup = "";
		$action = $_POST["inputApproveBail"];
		$bond = 0;
		$defendant = $_POST["inputDefName"];

		// Charge List Builder
		foreach ($pg->processCharges() as $iCharge => $charge) {

			$chargeClass = $charge['class'];
			$chargeType = $charge['type'];
			$chargeName = $charge['name'];
			$chargeID = $charge['id'];

			if ($action == 1) {
				$chargesGroup .= '<li style="color:#555555;font-size:14px;">
			<strong>' . $charge['type'] . $charge['class'] . ' ' . $charge['id'] . '. ' . $charge["name"] . $charge["chargeOffence"] . $charge["drugChargeTitle"] . ' - $' . number_format($charge['autoBailCost'] * 10, 0, '.', ',') . ' ($' . number_format($charge['autoBailCost'], 0, '.', ',') . ')</strong>
			</li>';

				$bond += $charge['autoBailCost'];
			} else
				$chargesGroup .= '<li style="color:#555555;font-size:14px;">
			<strong>' . $charge['type'] . $charge['class'] . ' ' . $charge['id'] . '. ' . $chargeName .  ' - ' . ($action == 0 ? "ROR" : "NO BAIL") . '</strong>
			</li>';


			$internalCharges .="[*]".$charge['type'] . $charge['class'] . ' ' . $charge['id'] . '. ' . $charge["name"] . "
";
		}


		$conditionsGroup = '';
		foreach (arrayMap($_POST["inputReason"], "") as $value) {
			if (!empty($value)) {
				$conditionsGroup .= '<li style="color:#555555;font-size:14px;">
				<strong>' . substr($da->getBailReason($value), 1) . '</strong>
				</li>';
			}
		}

		switch ($action) {
			case 1:
				$total = '<strong>Bail Total: ' . ($bond == 0 ? "ROR" : "$" . number_format($bond * 10, 0, '.', ',')) . ' | Total for Bond: ' . ($bond == 0 ? "ROR" : "$" . number_format($bond, 0, '.', ','));
				break;
			case 0:
				$total = '<strong>Bail Total: ROR</strong>';
				break;
			case 2:
				$total = '<strong>Bail NOT Recommended</strong>';
				break;
		}

		$generatedReport = $c->form('templates/generators/lsda/formats/bail', '', [
			"conditionsGroup" => $conditionsGroup,
			"defendant" => $defendant,
			"total" => $total,
			"chargesGroup" => $chargesGroup,
			"action" => $action,

			"pg" => $pg
		], false);

		$extra = "[divbox=white]
[center][b]CASE INFORMATION:[/b][/center]

[b]Defendant Name:[/b] " . $defendant . "
[b]Docket Number:[/b] [url=INSERT THE URL TO THE CASE ON GTAW FORUMS HERE]XXX-XX[/url]

[b]Trial Deputy:[/b] " . $_POST["employeeName"] . " 
[hr]
[center][b][u]CHARGES BROUGHT AGAINST THE DEFENDANT:[/u][/b][/center]
[list]
"
. $internalCharges ."
[/list]
[hr]
[center][b][u]TRIAL INFORMATION:[/u][/b][/center]
[b]Strategy (Optional):[/b] Briefly explain your trial strategy or seek advice from senior prosecutors.
[/divbox]";

		$redirectPath = "court";
	}


	//LSDA Dismissal Petition
	if ($generatorType == 'DA_DismissalPetition') {
		$generatedThreadTitle = '[' . date("y") . 'GJCR' . str_pad($_POST["petitionNumber"], 5, "0", STR_PAD_LEFT) . '] People of the State of San Andreas v. ' . $_POST["inputDefName"];
		$chargesGroup = "";
		$defendant = $_POST["inputDefName"];

		$generatedReport = $c->form('templates/generators/lsda/formats/dismissal', '', [
			"charges" => $pg->processCharges(),
			"defendant" => $defendant,
			"pg" => $pg,
			"motion_name" => "<strong>MOTION TO DISMISS</strong>",
			"filler"=> $pg->getRank($_POST["inputRank"]). " ". $_POST["employeeName"]

		], false);
		$redirectPath = "court";
	}
	//LSDA Dismissal Petition - Speedy Trial
	if ($generatorType == 'JSA_SpeedyTrial') {
		$generatedThreadTitle = '[' . date("y") . 'GJCR' . str_pad($_POST["petitionNumber"], 5, "0", STR_PAD_LEFT) . '] People of the State of San Andreas v. ' . $_POST["inputDefName"];
		$chargesGroup = "";
		$defendant = $_POST["inputDefName"];

		$generatedReport = $c->form('templates/generators/lsda/formats/dismissal', '', [
			"charges" => $pg->processCharges(),
			"defendant" => $defendant,
			"pg" => $pg,
			"motion_name" => "<strong>MOTION TO DISMISS</strong><br>SPEEDY TRIAL<br>VIOLATION",
			"filler"=> $_POST["employeeName"]

		], false);
		$redirectPath = "court";
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

	// Redirect
	switch ($redirectPath) {
		case 'court':
			//header('Location: /paperwork-generators/generated-court');
			echo $c->form("templates/generated-court", "", [
				"courtURL" => "https://forum.gta.world/en/forum/389-criminal-division/",
				"extra" => empty($extra)?null:$extra,
				"g"=> $g,
				"type"=> $type,
				"title"=> $generatedThreadTitle,
				"report"=> $generatedReport,
			], false);
			return;
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
function redirectPath($input)
{

	$output = '';

	switch ($input) {
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

function setCookiePost($inputCookie, $inputVariable)
{

	global	$g;

	$cPath = '/';
	$iTime = 2147483647;
	$tTime = time() + 21960;
	$dTime = time() + 3660;

	switch ($inputCookie) {
		case 'notificationVersion':
			$cookie = 'notificationVersion';
			$time = $iTime;
			break;
		case 'specialNotification':
			$cookie = 'specialNotification';
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
		case 'openStatus':
			$cookie = 'openStatus';
			break;
		case 'inputTDPatrolReportURL':
			$cookie = 'inputTDPatrolReportURL';
			$time = $iTime;
			break;
		default:
			break;
	}

	return setcookie($cookie, $inputVariable, $time, $cPath, $g->getSettings('site-url'), $g->getSettings('site-live'));
}

function arrayMap($input, $default)
{

	$input = $input ?? array();
	return array_map(function ($value) use ($default) {
		return $value === '' ? $default : $value;
	}, $input);
}


function textBold($option, $input)
{

	switch ($option) {
		case 1:
			return '<strong>' . $input . '</strong>';
		case 2:
			return '<strong>' . strtoupper($input) . '</strong>';
		default:
			return '<strong>' . $input . '</strong>';
	}
}

function textRP($option)
{

	switch ($option) {
		case 1:
			return '<strong style="color: #9944dd!important;">*</strong>';
		case 2:
			break;
		default:
			return '<strong style="color: #9944dd!important;">?</strong>';
	}
}

function resolverOfficer($name, $rank, $badge)
{

	global $pg;

	return '<strong>' . $pg->getRank($rank) . ' ' . $name . '</strong> (<strong>#' . $badge . '</strong>), ';
}

function resolverOfficerBB($name, $rank, $badge)
{

	global $pg;

	return '[b]' . $pg->getRank($rank) . ' ' . $name . '[/b] ([b]#' . $badge . '[/b]), ';
}
