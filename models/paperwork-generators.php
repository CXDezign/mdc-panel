<?php

class PaperworkGenerators
{
	private $penal = null;
	public function __construct()
	{
		$this->penal = json_decode(file_get_contents(dirname(__FILE__, 2) . '/db/penalSearch.json'), true);
	}

	public function penalCode()
	{
		return $this->penal;
	}


	public function processCharges($prefix = "inputCrime")
	{
		$charges = [];
		$penal = $this->penal;

		$crime = $_POST[$prefix . ""];
		$class = $_POST[$prefix . "Class"];
		$offence = $_POST[$prefix . "Offence"];
		$addition = $_POST[$prefix . "Offence"];

		foreach ($crime as $iCharge => $charge) {
			$penal_charge = $penal[$charge];

			$chargeClass = $class[$iCharge];

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

			$chargeType = $penal_charge['type'];
			$chargeTypeFull = '';
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

			switch ($addition) {
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

			$chargePoints = ceil($penal_charge['points'][$chargeClass] / $chargeReduction);


			array_push($charges, [
				//"penal_charge"=> $penal_charge,
				"id"=> $penal_charge["id"],
				"name" => $penal_charge["charge"],
				"chargeOffence" => $offence[$iCharge] ?? 1,
				"addition" => $addition[$iCharge],
				"class"=> $chargeClass,
				"type"=> $chargeType,
				"reduction"=> $chargeReduction,
				"points"=> $chargePoints
				//"type_full"=> $chargeTypeFull

			]);
		}
		return $charges;
	}


	public function dateResolver($date1, $date2)
	{

		if (!$date2) {
			return $date1;
		} elseif ($date1 == $date2) {
			return $date1;
		} else {
			return $date1 . ' - ' . $date2;
		}
	}

	public function calculateCrimeTime($iDays, $iHours, $iMinutes)
	{

		$inputTime = ($iDays + ($iHours / 24 + ($iMinutes / 60 / 24)));

		$seconds = intval(ceil(86400 * $inputTime));

		$days = floor($seconds / 86400);
		$seconds %= 86400;

		$hours = floor($seconds / 3600);
		$seconds %= 3600;

		$minutes = floor($seconds / 60);
		$seconds %= 60;

		if ($days != 0) {
			$days .= $days == 1 ? ' Day' : ' Days';
		} else {
			$days = '';
		}

		if ($hours != 0) {
			$hours = ' ' . $hours . ' Hours';
		} else {
			$hours = '';
		}

		if ($minutes != 0) {
			$minutes = ' ' . $minutes . ' Minutes';
		} else {
			$minutes = '';
		}

		$input = array($days, $hours, $minutes);
		$output = '';

		foreach ($input as $timeElement) {
			$output .= $timeElement;
		}

		return $output;
	}

	public function rankChooser($cookie)
	{

		$ranks = file('resources/ranksList.txt');
		$rankCount = 0;

		$groupCookie = '';
		$groupLSPD = '';
		$groupLSSD = '';
		$groupSFM = '';
		$groupSAPR = '';
		$groupLSPE = '';
		$groupSAAA = '';
		$groupLSDA = '';

		if ($cookie === 1 && isset($_COOKIE['officerRank'])) {
			$officerCookie = htmlspecialchars($_COOKIE['officerRank']);
			$groupCookie .= '
			<optgroup label="Saved Cookie">
				<option selected value="' . $officerCookie . '">
					' . $this->getRank($officerCookie) . '
				</option>
			</optgroup>';
		}
		if ($cookie === 2 && isset($_COOKIE['legalRank'])) {
			$officerCookie = htmlspecialchars($_COOKIE['legalRank']);
			$groupCookie .= '
			<optgroup label="Saved Cookie">
				<option selected value="' . $officerCookie . '">
					' . $this->getRank($officerCookie) . '
				</option>
			</optgroup>';
		}

		$ranksLSPD = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17);
		$ranksLSSD = array(18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29);
		$ranksSFM = array(30, 31, 32, 33, 34);
		$ranksSAPR = array(35, 36, 37, 38, 39, 40, 41, 42, 43, 44);
		$ranksLSPE = array(45, 46, 47);
		$ranksSAAA = array(48, 49, 50);
		$ranksLSDA = array(52, 53, 54, 55);

		foreach ($ranks as $rank) {

			$statement = '<option value="' . $rankCount . '">' . $rank . '</option>';

			if (in_array($rankCount, $ranksLSPD)) {
				$groupLSPD .= $statement;
			}
			if (in_array($rankCount, $ranksLSSD)) {
				$groupLSSD .= $statement;
			}
			if (in_array($rankCount, $ranksSFM)) {
				$groupSFM .= $statement;
			}
			if (in_array($rankCount, $ranksSAPR)) {
				$groupSAPR .= $statement;
			}
			if (in_array($rankCount, $ranksLSPE)) {
				$groupLSPE .= $statement;
			}
			if (in_array($rankCount, $ranksSAAA)) {
				$groupSAAA .= $statement;
			}
			if (in_array($rankCount, $ranksLSDA)) {
				$groupLSDA .= $statement;
			}

			$rankCount++;
		}

		return $groupCookie . '<optgroup label="Los Santos Police Department">' . $groupLSPD . '</optgroup>
							<optgroup label="Los Santos Sheriff&#39s Department">' . $groupLSSD . '</optgroup>
							<optgroup label="State Fire Marshall">' . $groupSFM . '</optgroup>
							<optgroup label="San Andreas Park Rangers">' . $groupSAPR . '</optgroup>
							<optgroup label="Los Santos Parking Enforcement">' . $groupLSPE . '</optgroup>
							<optgroup label="San Andreas Aviation Administration">' . $groupSAAA . '</optgroup>
							<optgroup label="Los Santos District Attorney&#39s Office">' . $groupLSDA . '</optgroup>';
	}

	public function pClassificationChooser()
	{

		$classifications = file('resources/classificationsList.txt');
		$classificationsCount = 0;
		$group = '';

		foreach ($classifications as $classification) {

			$statement = '<option value="' . $classificationsCount . '">' . $classification . '</option>';

			$group .= $statement;

			$classificationsCount++;
		}

		return '<optgroup label="Classifications">' . $group . '</optgroup>';
	}

	public function sStatusChooser()
	{

		$statuses = file('resources/statusList.txt');
		$statusesCount = 0;
		$group = '';

		foreach ($statuses as $status) {

			$statement = '<option value="' . $statusesCount . '">' . $status . '</option>';

			$group .= $statement;

			$statusesCount++;
		}

		return '<optgroup label="Classifications">' . $group . '</optgroup>';
	}

	public function getRank($input)
	{

		$ranks = file($_SERVER['DOCUMENT_ROOT'] . '/resources/ranksList.txt', FILE_IGNORE_NEW_LINES);

		if (count($ranks) < intval($input)) {
			return "[ERROR]";
		}

		return $ranks[intval($input)];
	}

	public function getClassification($input)
	{

		$classifications = file($_SERVER['DOCUMENT_ROOT'] . '/resources/classificationsList.txt', FILE_IGNORE_NEW_LINES);

		return $classifications[$input];
	}

	public function getStatus($input)
	{

		$statuses = file($_SERVER['DOCUMENT_ROOT'] . '/resources/statusList.txt', FILE_IGNORE_NEW_LINES);

		return $statuses[$input];
	}

	public function chargeChooser($typeChooser)
	{

		$chargeEntries = $this->penal;
		$disabledCharges = [000, 423];
		$trafficCharges = [401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413, 414, 415, 416, 417, 418, 419, 420, 421, 422, 423, 424, 425, 426];
		$drugCharges = [601, 602, 603, 604, 605, 606];

		$charges = '';

		foreach ($chargeEntries as $charge) {

			$chargeID = $charge['id'];
			$chargeName = $charge['charge'];
			$chargeType = $charge['type'];
			$chargeDisabled = '';

			switch ($chargeType) {
				case 'F':
					$chargeColor = 'danger';
					break;
				case 'M':
					$chargeColor = 'warning';
					break;
				case 'I':
					$chargeColor = 'success';
					break;
				default:
					$chargeColor = 'dark';
			}

			if (in_array($chargeID, $disabledCharges)) {
				$chargeDisabled = 'disabled';
				$chargeColor = 'dark';
			}

			$chargeContent = "<span class='mr-2 badge badge-" . $chargeColor . "'>" . $chargeID . "</span>" . $chargeName;
			if ($typeChooser == 'generic' && !in_array($chargeID, $drugCharges)) {
				$charges .= '<option
								data-content="' . $chargeContent . '"
								value="' . $chargeID . '"
								' . $chargeDisabled . '>
							</option>';
			}
			if ($typeChooser == 'traffic' && in_array($chargeID, $trafficCharges)) {
				$charges .= '<option
								data-content="' . $chargeContent . '"
								value="' . $chargeID . '"
								' . $chargeDisabled . '>
							</option>';
			}
			if ($typeChooser == 'drugs' && in_array($chargeID, $drugCharges)) {
				$charges .= '<option
								data-content="' . $chargeContent . '"
								value="' . $chargeID . '"
								' . $chargeDisabled . '>
							</option>';
			}
		}

		return $charges;
	}

	public function getCrimeClass($input)
	{

		switch ($input) {
			case 1:
				$type = 'C';
				break;
			case 2:
				$type = 'B';
				break;
			case 3:
				$type = 'A';
				break;
			default:
				$type = '?';
				break;
		}
		return $type;
	}

	public function getCrimeClass2($input)
	{

		$options = '';

		foreach ($input as $crimeClass => $bool) {
			if ($bool) {
				$crimeClass++;
				$class = $this->getCrimeClass($crimeClass);
				$options .= '<option value="' . $crimeClass . '">Class ' . $class . '</option>';
			}
		}

		return $options;
	}

	public function getCrimeDrugSubstanceCategory($input)
	{

		$options = '';

		foreach ($input as $crimeDrugSubstanceCategory => $category) {
			if ($category) {
				$crimeDrugSubstanceCategory++;
				$options .= '<option value="' . $category . '">Category ' . $category . '</option>';
			}
		}

		return $options;
	}

	public function getCrimeOffence($input)
	{

		$options = '';

		foreach ($input as $crimeOffence => $bool) {
			if ($bool) {
				$crimeOffence++;
				$options .= '<option value="' . $crimeOffence . '">Offence #' . $crimeOffence . '</option>';
			}
		}

		return $options;
	}

	public function getCrimeSentencing($input)
	{

		$sentences = file($_SERVER['DOCUMENT_ROOT'] . '/resources/sentencingAdditionsList.txt', FILE_IGNORE_NEW_LINES);

		return $sentences[$input - 1];
	}

	public function getCrimeColour($input)
	{

		switch ($input) {
			case 'I':
				$colour = '#27ae60';
				break;
			case 'M':
				$colour = '#f39c12';
				break;
			case 'F':
				$colour = '#e74c3c';
				break;
			case '':
			default:
				$colour = '#000';
				break;
		}
		return '<strong style="color: ' . $colour . '!important;">';
	}

	public function listChooser($list, $plea = null)
	{

		$listEntries = file('resources/' . $list . '.txt');
		$entriesCount = 1;
		$optionValue = true;

		switch ($list) {
			case 'braceletList':
			case 'wristbandList':
				$output = '';
				$entriesCount = 0;
				break;
			case 'vehiclesList':
			case 'districtsList':
			case 'streetsList':
				$output = '';
				$optionValue = false;
				break;
			default:
				$output = '';
		}
		if ($plea) {
			foreach ($listEntries as $listItem) {
				if ($entriesCount == $plea) {
					$output .= '<option selected value="' . $entriesCount . '">' . $listItem . '</option>';
				} else {
					$output .= '<option value="' . $entriesCount . '">' . $listItem . '</option>';
				}
				$entriesCount++;
			}
		} else {
			foreach ($listEntries as $listItem) {
				if ($optionValue) {
					$output .= '<option value="' . $entriesCount . '">' . $listItem . '</option>';
				} elseif (!$optionValue) {
					$output .= '<option>' . $listItem . '</option>';
				}
				$entriesCount++;
			}
		}



		return $output;
	}

	public function getDashboardCamera($input)
	{

		if (empty($input)) {
			$dashboardCamera = 'No dashboard camera video or audio footage attached.';
		} else {
			$dashboardCamera = $input;
		}
		return '<strong style="color: #9944dd!important;">*</strong> ' . $dashboardCamera . ' <strong style="color: #9944dd!important;">*</strong>';
	}

	public function tintChooser()
	{

		$tints = file('resources/tintsList.txt');

		$groupTintLegal = '';
		$groupTintIllegal = '';

		$legalTintLevels = array(0, 3, 4, 5);
		$illegalTintLevels = array(1, 2);

		foreach ($tints as $iTint => $tint) {

			$statement = '<option value="' . $iTint . '">' . $tint . '</option>';

			if (in_array($iTint, $legalTintLevels)) {
				$groupTintLegal .= $statement;
			}
			if (in_array($iTint, $illegalTintLevels)) {
				$groupTintIllegal .= $statement;
			}
		}

		return '<option value="10">Uninspected</option>
		<optgroup label="Legal">' . $groupTintLegal . '</optgroup>
		<optgroup label="Illegal">' . $groupTintIllegal . '</optgroup>';
	}

	public function getDefLicense($input)
	{

		switch ($input) {
			case 1:
				$defLicense = 'a <strong>valid drivers license</strong>.';
				break;
			case 2:
				$defLicense = '<strong>no drivers license</strong>.';
				break;
			case 3:
				$defLicense = 'an <strong>expired drivers license</strong>.';
				break;
			case 4:
				$defLicense = 'a <strong>suspended drivers license</strong>.';
				break;
			case 5:
				$defLicense = 'a <strong>revoked drivers license</strong>.';
				break;
			default:
				$defLicense = 'a <strong>valid drivers license</strong>.';
				break;
		}

		return $defLicense;
	}

	public function getVehicleTint($input)
	{

		$string = '';

		switch ($input) {
			case '1':
			case '2':
				$string = ' an <strong>illegal</strong> ';
				break;
			case '0':
			case '3':
			case '4':
			case '5':
				$string = ' a <strong>legal</strong> ';
				break;
			default:
				return 'The vehicle was not inspected with the tint meter device.';
		}

		return 'The vehicle was inspected with the tint meter device, resulting with ' . $string . ' tint level (<strong>Level ' . $input . '</strong>).';
	}

	public function getVehicleRO($input)
	{

		if (empty($input)) {
			return '<strong>unknown registered owner</strong>';
		} else {
			return 'registered to <strong>' . $input . '</strong>';
		}
	}

	public function getVehiclePlates($input, $type)
	{

		$b = '';
		$bb = '';

		// HTML
		if ($type == 0) {
			$b = '<strong>';
			$bb = '</strong>';
		}

		// BBCode
		if ($type == 1) {
			$b = '[b]';
			$bb = '[/b]';
		}

		if (empty($input)) {
			return $b . 'unregistered' . $bb;
		} else {
			return 'identification plate reading ' . $b . $input . $bb;
		}
	}
}

class ArrestReportGenerator extends PaperworkGenerators
{

	public function getBracelet($input)
	{

		switch ($input) {
			case 1:
				$bracelet = 'White';
				$color = '#808080';
				break;
			case 2:
				$bracelet = 'Orange';
				$color = '#FF8000';
				break;
			default:
				$bracelet = 'UNKNOWN';
				$color = 'inherit';
				break;
		}
		return '<span style="color: ' . $color . '!important;">' . $bracelet . '</span> Bracelet';
	}

	public function getWristband($input)
	{

		switch ($input) {
			case 1:
				$wristband = 'Red';
				$color = '#C80000';
				break;
			case 2:
				$wristband = 'Blue';
				$color = '#0000C8';
				break;
			case 3:
				$wristband = 'Yellow';
				$color = '#ffbf40';
				break;
			default:
				$wristband = 'UNKNOWN';
				$color = 'inherit';
				break;
		}
		return '<span style="color: ' . $color . '!important;">' . $wristband . '</span> Wristband';
	}

	public function getPlea($input, $suspect)
	{

		switch ($input) {
			case 1:
				$plead = 'Guilty';
				break;
			case 2:
				$plead = 'Not Guilty';
				break;
			case 3:
				$plead = 'No Contest';
				break;
			case 4:
				return '<strong>(( <span style="color: #9944dd!important;">* ' . $suspect . ' - Required Case *</span> ))</strong>';
			default:
				$plead = 'UNKNOWN PLEA';
				break;
		}
		return '<strong style="color: #9944dd!important;">(( *</strong> <strong>' . $suspect . '</strong> pleads <strong>' . $plead . '</strong> <strong style="color: #9944dd!important;">* ))</strong>';
	}

	public function getPleaRaw($input)
	{

		switch ($input) {
			case 1:
				return 'Guilty';
			case 2:
				return 'Not Guilty';
			case 3:
				return 'No Contest';
			case 4:
				return 'Required Case';
			default:
				return 'UNKNOWN PLEA';
		}
	}

	public function getPleaRawShort($input)
	{

		switch ($input) {
			case 1:
				return 'G';
			case 2:
				return 'NG';
			case 3:
				return 'NC';
			case 4:
				return 'RC';
			default:
				return 'UNKNOWN PLEA';
		}
	}
}

class LSDAGenerator extends PaperworkGenerators
{
	public function bailReasonsChooser()
	{

		$bailReasons = file('resources/bailReasonsList.txt');
		$bailReasonsCount = 0;

		$groupCondition = '';
		$groupDenial = '';
		$groupRestrictive = '';



		foreach ($bailReasons as $bailReason) {

			$statement = '<option value="' . $bailReasonsCount . '">' . substr($bailReason, 1) . '</option>';
			$statement_selected = '<option selected class="standardCondition" value="' . $bailReasonsCount . '">' . substr($bailReason, 1) . '</option>';

			if (str_starts_with($bailReason, "C")) {
				$groupCondition .= $statement;
			} else if (str_starts_with($bailReason, "D")) {
				$groupDenial .= $statement;
			} else if (str_starts_with($bailReason, "S")) {
				$groupCondition .= $statement_selected;
			} else if (str_starts_with($bailReason, "R")) {
				$groupRestrictive .= $statement;
			}

			$bailReasonsCount++;
		}

		return '<optgroup label="Bail Conditions">' . $groupCondition . '</optgroup>
		<optgroup label="Bail Denial Reasons">' . $groupDenial . '</optgroup>
		<optgroup label="Restrictive Bail Conditions">' . $groupRestrictive . '</optgroup>';
	}

	public function getBailReason($input)
	{

		$illegalParkingReasons = file('../resources/bailReasonsList.txt', FILE_IGNORE_NEW_LINES);

		return $illegalParkingReasons[$input];
	}
}
class ParkingTicketGenerator extends PaperworkGenerators
{

	public function illegalParkingChooser()
	{

		$illegalParkingReasons = file('resources/illegalParkingList.txt');
		$illegalParkingReasonsCount = 0;

		$groupVehicleStatus = '';
		$groupParkingRelated = '';
		$groupObstruction = '';
		$groupSidewalk = '';

		$reasonsVS = array(0);
		$reasonsPR = array(1, 2, 3, 4, 5);
		$reasonsOS = array(6, 7, 8, 9, 10, 11, 12, 13);
		$reasonsSW = array(14, 15, 16, 17);

		foreach ($illegalParkingReasons as $illegalParkingReason) {

			$statement = '<option value="' . $illegalParkingReasonsCount . '">' . $illegalParkingReason . '</option>';

			if (in_array($illegalParkingReasonsCount, $reasonsVS)) {
				$groupVehicleStatus .= $statement;
			}
			if (in_array($illegalParkingReasonsCount, $reasonsPR)) {
				$groupParkingRelated .= $statement;
			}
			if (in_array($illegalParkingReasonsCount, $reasonsOS)) {
				$groupObstruction .= $statement;
			}
			if (in_array($illegalParkingReasonsCount, $reasonsSW)) {
				$groupSidewalk .= $statement;
			}

			$illegalParkingReasonsCount++;
		}

		return '<optgroup label="Vehicle Status">' . $groupVehicleStatus . '</optgroup>
		<optgroup label="Parking">' . $groupParkingRelated . '</optgroup>
		<optgroup label="Obstruction">' . $groupObstruction . '</optgroup>
		<optgroup label="Pedestrian">' . $groupSidewalk . '</optgroup>';
	}

	public function getIllegalParking($input)
	{

		$illegalParkingReasons = file('../resources/illegalParkingList.txt', FILE_IGNORE_NEW_LINES);

		return $illegalParkingReasons[$input];
	}
}
