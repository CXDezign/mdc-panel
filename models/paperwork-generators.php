<?php

class PaperworkGenerators {

	public function dateResolver($date1, $date2) {

		if (!$date2) {
			return $date1;
		} elseif ($date1 == $date2) {
			return $date1;
		} else {
			return $date1 . ' - ' . $date2;
		}

	}

	public function calculateCrimeTime($iDays, $iHours, $iMinutes) {

		$inputTime = ($iDays+($iHours/24+($iMinutes/60/24)));

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
			$hours = ' '.$hours.' Hours';
		} else {
			$hours = '';
		}

		if ($minutes != 0) {
			$minutes = ' '.$minutes.' Minutes';
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

	public function rankChooser($cookie) {

		$ranks = file('resources/ranksList.txt');
		$rankCount = 0;

		$groupCookie = '';
		$groupLSPD = '';
		$groupLSSD = '';

		if ($cookie === 1 && isset($_COOKIE['officerRank'])) {
			$officerCookie = htmlspecialchars($_COOKIE['officerRank']);
			$groupCookie .= '
			<optgroup label="Saved Cookie">
				<option selected value="'.$officerCookie.'">
					'.$this->getRank($officerCookie).'
				</option>
			</optgroup>';
		}

		$ranksLSPD = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17);
		$ranksLSSD = array(18,19,20,21,22,23,24,25,26);

		foreach ($ranks as $rank) {

			$statement = '<option value="'.$rankCount.'">'.$rank.'</option>';

			if (in_array($rankCount, $ranksLSPD)) {
				$groupLSPD .= $statement;
			}
			if (in_array($rankCount, $ranksLSSD)) {
				$groupLSSD .= $statement;
			}

			$rankCount++;
		}

		return $groupCookie.'<optgroup label="Los Santos Police Department">'.$groupLSPD.'</optgroup>
							<optgroup label="Los Santos Sheriff&#39s Department">'.$groupLSSD.'</optgroup>';
	}
	
	public function divisionalRankChooser() {

		$ranks = file('resources/divisionalRanksList.txt');
		$rankCount = 0;

		$groupB = '';
		$groupC = '';
		$groupD = '';
		$groupK9 = '';

		$ranksB = array(0,1,2,3,4);
		$ranksC = array(5,6,7,8,9);
		$ranksD = array(10,11,12,13,14);
		$ranksK9 = array(15,16,17,18,19);

		foreach ($ranks as $rank) {

			$statement = '<option value="'.$rankCount.'">'.$rank.'</option>';

			if (in_array($rankCount, $ranksB)) {
				$groupB .= $statement;
			}
			if (in_array($rankCount, $ranksC)) {
				$groupC .= $statement;
			}
			if (in_array($rankCount, $ranksD)) {
				$groupD .= $statement;
			}
			if (in_array($rankCount, $ranksK9)) {
				$groupK9 .= $statement;
			}

			$rankCount++;
		}

		return '<optgroup label="B Platoon">'.$groupB.'</optgroup>
				<optgroup label="C Platoon">'.$groupC.'</optgroup>
				<optgroup label="D Platoon">'.$groupD.'</optgroup>
				<optgroup label="K9 Platoon">'.$groupK9.'</optgroup>';
	}


	public function getRank($input) {

		$ranks = file($_SERVER['DOCUMENT_ROOT'].'/resources/ranksList.txt', FILE_IGNORE_NEW_LINES);

		return $ranks[$input];

	}

	public function chargeChooser() {

		$chargeEntries = json_decode(file_get_contents('db/penalSearch.json'), true);
		$disabledCharges = array(000,423);

		$charges = '';

		foreach ($chargeEntries as $charge) {

			$chargeType = $charge['type'];
			$chargeID = $charge['id'];
			$charge = $charge['charge'];
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

			$chargeContent = "<span class='mr-2 badge badge-".$chargeColor."'>".$chargeID."</span>".$charge;
			$charges .= '<option
				data-content="'.$chargeContent.'"
				value="'.$chargeID.'"
				'.$chargeDisabled.'>
			</option>';

		}

		return $charges;

	}

	public function getCrimeClass($input) {

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

	public function getCrimeClass2($input) {

		$options = '';

		foreach ($input as $crimeClass => $bool) {

			if ($bool) {
				$crimeClass++;
				$class = $this->getCrimeClass($crimeClass);
				$options .= '<option value="'.$crimeClass.'">Class '.$class.'</option>';
			}

		}

		return $options;

	}

	public function getCrimeOffence($input) {

		$options = '';

		foreach ($input as $crimeOffence => $bool) {

			if ($bool) {

				$crimeOffence++;
				$options .= '<option value="'.$crimeOffence.'">Offence #'.$crimeOffence.'</option>';

			}

		}

		return $options;

	}

	public function getCrimeSentencing($input) {

		$sentences = file($_SERVER['DOCUMENT_ROOT'] . '/resources/sentencingAdditionsList.txt', FILE_IGNORE_NEW_LINES);

		return $sentences[$input-1];

	}

	public function getCrimeColour($input) {

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
		return '<span style="color: '.$colour.';">';
	}

	public function listChooser($list) {

		$listEntries = file('resources/'.$list.'.txt');
		$entriesCount = 1;
		$optionValue = true;

		switch ($list) {
			case 'braceletList':
			case 'wristbandList':
			case 'itemCategoryList':
			case 'metroPlatoonList':
				$output = '';
				$entriesCount = 0;
				break;
			case 'vehiclesList':
			case 'districtsList':
			case 'streetsList':
			case 'buildingsList':
				$output = '';
				$optionValue = false;
				break;
			default:
				$output = '';
		}

		foreach ($listEntries as $listItem) {
			if ($optionValue) {
				$output .= '<option value="'.$entriesCount.'">'.$listItem.'</option>';
			} elseif (!$optionValue) {
				$output .= '<option>'.$listItem.'</option>';
			}
			$entriesCount++;
		}

		return $output;

	}

	public function getDashboardCamera($input) {

		if (empty($input)) {
			$dashboardCamera = 'No dashboard camera video or audio footage attached.';
		} else {
			$dashboardCamera = $input;
		}
		return '<strong style="color: #9944dd;">*</strong> '.$dashboardCamera.' <strong style="color: #9944dd;">*</strong>';
	}

	public function tintChooser() {

		$tints = file('resources/tintsList.txt');

		$groupTintLegal = '';
		$groupTintIllegal = '';

		$legalTintLevels = array(0,3,4,5);
		$illegalTintLevels = array(1,2);

		foreach ($tints as $iTint => $tint) {

			$statement = '<option value="'.$iTint.'">'.$tint.'</option>';

			if (in_array($iTint, $legalTintLevels)) {
				$groupTintLegal .= $statement;
			}
			if (in_array($iTint, $illegalTintLevels)) {
				$groupTintIllegal .= $statement;
			}

		}

		return '<option value="10">Uninspected</option>
		<optgroup label="Legal">'.$groupTintLegal.'</optgroup>
		<optgroup label="Illegal">'.$groupTintIllegal.'</optgroup>';

	}

	public function getDefLicense($input) {

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

	public function getVehicleTint($input) {

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

		return 'The vehicle was inspected with the tint meter device, resulting with '.$string.' tint level (<strong>Level '.$input.'</strong>).';

	}

	public function getVehicleRO($input) {

		if (empty($input)) {
			return '<strong>unknown registered owner</strong>';
		} else {
			return 'registered to <strong>'.$input.'</strong>';
		}

	}

	public function getVehiclePlates($input, $type) {

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
			return $b.'unregistered'.$bb;
		} else {
			return 'identification plate reading '.$b.$input.$bb;
		}

	}

}

class ArrestReportGenerator extends PaperworkGenerators {

	public function getBracelet($input) {

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
		return '<span style="color: '.$color.';">'.$bracelet.'</span> Bracelet';
	}

	public function getWristband($input) {

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
		return '<span style="color: '.$color.';">'.$wristband.'</span> Wristband';
	}

	public function getPlea($input, $suspect) {

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
				return '<strong>(( <span style="color: #9944dd;">* '.$suspect.' - Required Case *</span> ))</strong>';
			default:
				$plead = 'UNKNOWN PLEA';
				break;
		}
		return '<strong style="color: #9944dd;">(( *</strong> <strong>'.$suspect.'</strong> pleads <strong>'.$plead.'</strong> at the district attorney office. <strong style="color: #9944dd;">* ))</strong>';
	}

}


class EvidenceRegistrationLogGenerator extends PaperworkGenerators {

	public function getItemCategory($input) {

		$items = file('../resources/itemCategoryList.txt', FILE_IGNORE_NEW_LINES);
		return $items[$input];

	}

}

class ParkingTicketGenerator extends PaperworkGenerators {

	public function illegalParkingChooser() {

		$illegalParkingReasons = file ('resources/illegalParkingList.txt');
		$illegalParkingReasonsCount = 0;

		$groupVehicleStatus = '';
		$groupParkingRelated = '';
		$groupObstruction = '';
		$groupSidewalk = '';

		$reasonsVS = array(0);
		$reasonsPR = array(1,2,3,4,5);
		$reasonsOS = array(6,7,8,9,10,11,12);
		$reasonsSW = array(13,14,15,16);

		foreach ($illegalParkingReasons as $illegalParkingReason) {

			$statement = '<option value="'.$illegalParkingReasonsCount.'">'.$illegalParkingReason.'</option>';

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

		return '<optgroup label="Vehicle Status">'.$groupVehicleStatus.'</optgroup>
		<optgroup label="Parking">'.$groupParkingRelated.'</optgroup>
		<optgroup label="Obstruction">'.$groupObstruction.'</optgroup>
		<optgroup label="Pedestrian">'.$groupSidewalk.'</optgroup>';

	}
	
	public function getIllegalParking($input) {

		$illegalParkingReasons = file('../resources/illegalParkingList.txt', FILE_IGNORE_NEW_LINES);

		return $illegalParkingReasons[$input];

	}

}

class MetroGenerator extends PaperworkGenerators {

	public function getMetroPlatoon($input) {

		$metroPlatoonList = file('../resources/metroPlatoonList.txt', FILE_IGNORE_NEW_LINES);

		return $metroPlatoonList[$input];

	}

	public function getMetroDeploymentType($input) {

		$metroDeploymentTypes = file('../resources/metroDeploymentTypes.txt', FILE_IGNORE_NEW_LINES);

		return $metroDeploymentTypes[$input-1];

	}

	public function getMetroDivisionalRank($input) {

		$metroDivisionalRank = file('../resources/divisionalRanksList.txt', FILE_IGNORE_NEW_LINES);

		return $metroDivisionalRank[$input];

	}

	public function getMetroDivisionalRankPlatoon($input) {

		switch ($input) {
			case 0:
			case 1:
			case 2:
			case 3:
			case 4:
				return 'B';
			case 5:
			case 6:
			case 7:
			case 8:
			case 9:
				return 'C';
			case 10:
			case 11:
			case 12:
			case 13:
			case 14:
				return 'D';
			case 15:
			case 16:
			case 17:
			case 18:
			case 19:
				return 'K9';
			default:
				return '?';
		}

	}

	public function getMetroDivisionalRankShort($input) {

		switch ($input) {
			case 0:
			case 5:
			case 10:
			case 15:
				return 'OIC';
			case 1:
			case 6:
				return 'TL';
			case 2:
			case 7:
				return 'ATL';
			case 3:
			case 8:
				return 'TSO';
			case 4:
			case 9:
				return 'PTSO';
			case 11:
				return 'SL';
			case 12:
				return 'EL';
			case 13:
				return 'SO';
			case 14:
				return 'PSO';
			case 16:
				return 'CHS';
			case 17:
				return 'CS';
			case 18:
				return 'CH';
			case 19:
				return 'PCH';
			default:
				return '?';
		}

	}

}