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

	public function rankChooser($cookie) {

		$ranks = file('resources/ranksList.txt');
		$rankCount = 0;

		$groupNA = "";
		$groupCookie = "";
		$groupLSPD = "";
		$groupLSSD = "";

		if ($cookie === 1) {
			if (isset($_COOKIE['officerRank'])) {
				$groupCookie .= '<optgroup label="Saved Cookie">
									<option selected value="'.$_COOKIE['officerRank'].'">
									'.$this->getRank($_COOKIE['officerRank'],0).'
									</option>
								</optgroup>';
			}
		}

		$ranksLSPD = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18);
		$ranksLSSD = array(19,20,21,22,23,24,25,26,27);

		foreach ($ranks as $rank) {

			$statement = '<option value="'.$rankCount.'">'.$rank.'</option>';

			if ($rankCount === 0) {
				$groupNA .= $statement;
			}

			if (in_array($rankCount, $ranksLSPD)) {
				$groupLSPD .= $statement;
			}
			if (in_array($rankCount, $ranksLSSD)) {
				$groupLSSD .= $statement;
			}

			$rankCount++;
		}

		echo $groupNA.$groupCookie.'<optgroup label="Los Santos Police Department">'.$groupLSPD.'</optgroup><optgroup label="Los Santos Sheriff&#39s Department">'.$groupLSSD.'</optgroup>';
	}

	public function getRank($input, $path) {

		switch ($path) {
			case 0:
				$path = "";
				break;
			case 1:
				$path = "../";
				break;
		}
		$ranks = file($path.'resources/ranksList.txt', FILE_IGNORE_NEW_LINES);

		return $ranks[$input];

	}

	public function streetChooser() {

		$streets = file ('resources/streetsList.txt');
		$streetCount = 1;

		foreach ($streets as $street) {
			echo "<option>".$street."</option>";
			$streetCount++;
		}
	}

	public function districtChooser() {

		$districts = file ('resources/districtsList.txt');
		$districtCount = 1;

		foreach ($districts as $district) {
			echo "<option>".$district."</option>";
			$districtCount++;
		}
	}

	public function vehicleChooser() {

		$vehicles = file ('resources/vehiclesList.txt');
		$vehicleCount = 1;

		foreach ($vehicles as $vehicle) {
			echo "<option>".$vehicle."</option>";
			$vehicleCount++;
		}
	}

	public function chargeChooser() {

		$charges = json_decode(file_get_contents("db/penalSearch.json"), true);
		$chargeCount = 0;

		foreach ($charges as $charge) {
			if ($chargeCount != 0) {
				$chargeClassification = $charge['classification'];
				switch ($chargeClassification) {
					case "F":
						$chargeContent = "<span class='badge badge-danger'>";
						break;
					case "M":
						$chargeContent = "<span class='badge badge-warning'>";
						break;
					case "I":
						$chargeContent = "<span class='badge badge-success'>";
						break;
				}
				echo '<option
						data-content="'.$chargeContent.$charge['id'].'</span> '.$charge['charge'].'"
						value="'.$charge['id'].'">
						</option>';
			}
			$chargeCount++;
		}
	}

	public function crimeTypeChooser() {

		$crimeTypes = file('resources/crimeTypeList.txt');
		$crimeTypeCount = 1;

		foreach ($crimeTypes as $crimeType) {
			echo "<option value=".$crimeTypeCount.">".$crimeType."</option>";
			$crimeTypeCount++;
		}
	}
	
	public function offenceChooser() {

		$crimeOffence = file('resources/offenceList.txt');
		$crimeOffenceCount = 1;

		foreach ($crimeOffence as $offence) {
			echo "<option value=".$crimeOffenceCount.">".$offence."</option>";
			$crimeOffenceCount++;
		}
	}

	public function getCrimeType($input) {

		$type = "?";

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
		}
		return $type;
	}

	public function getCrimeColour($input) {

		switch ($input) {
			case "I":
				$colour = "#27ae60";
				break;
			case "M":
				$colour = "#f39c12";
				break;
			case "F":
				$colour = "#e74c3c";
				break;
			case "":
			default:
				$colour = "#000";
				break;
		}
		return '<span style="color: '.$colour.';">';
	}

	public function getDashboardCamera($input) {

		$dashboardCamera = "";

		switch ($input) {
			case '':
				$dashboardCamera = 'No dashboard camera video or audio footage attached.';
				break;
			default:
				$dashboardCamera = $input;
				break;
		}
		return '<b style="color: #9944dd;">* '.$dashboardCamera.' *</b>';
	}	

	public function itemCategoryChooser() {

		$items = file('resources/itemCategoryList.txt', FILE_IGNORE_NEW_LINES);
		$itemCount = 0;

		foreach ($items as $item) {
			echo "<option value=".$itemCount.">".$item."</option>";
			$itemCount++;
		}

	}

	public function getItemCategory($input) {

		$items = file('../resources/itemCategoryList.txt', FILE_IGNORE_NEW_LINES);
		return $items[$input];

	}

	public function licenseChooser() {

		$licenses = file('resources/licensesList.txt');
		$licenseCount = 1;

		foreach ($licenses as $license) {
			echo "<option value=".$licenseCount.">".$license."</option>";
			$licenseCount++;
		}

	}

	public function paintChooser() {

		$paints = file('resources/paintsList.txt');
		$paintCount = 1;

		foreach ($paints as $paint) {
			echo "<option value=".$paintCount.">".$paint."</option>";
			$paintCount++;
		}

	}

	public function tintChooser() {

		$tints = file('resources/tintsList.txt');
		$tintCount = 0;

		$groupTintLegal = "";
		$groupTintIllegal = "";

		$legalTintLevels = array(0,3,4,5);

		foreach ($tints as $tint) {

			$statement = '<option value="'.$tintCount.'">'.$tint.'</option>';

			if (in_array($tint, $legalTintLevels)) {
				$groupTintLegal .= $statement;
			} else {
				$groupTintIllegal .= $statement;
			}
			$tintCount++;

		}

		echo '<optgroup label="Legal">'.$groupTintLegal.'</optgroup> <optgroup label="Illegal">'.$groupTintIllegal.'</optgroup>';

	}

	public function illegalParkingChooser() {

		$illegalParkingReasons = file ('resources/illegalParkingList.txt');
		$illegalParkingReasonsCount = 0;

		$groupTrafficRelated = "";
		$groupParkingRelated = "";
		$groupTransportRelated = "";
		$groupPropertyRelated = "";
		$groupPedestrianTraffic = "";

		$reasonsTR = array(1,2,3,4);
		$reasonsPR = array(5,6,7);
		$reasonsTrR = array(8,9,10);
		$reasonsPrR = array(11,12,13);
		$reasonsPT = array(14,15,16);

		foreach ($illegalParkingReasons as $illegalParkingReason) {

			$statement = '<option value="'.$illegalParkingReasonsCount.'">'.$illegalParkingReason.'</option>';

			if ($illegalParkingReasonsCount == 0) {
				$groupDisabled = '<option value="" selected disbaled>'.$illegalParkingReason.'</option>';
			}

			if (in_array($illegalParkingReasonsCount, $reasonsTR)) {
				$groupTrafficRelated .= $statement;
			}
			if (in_array($illegalParkingReasonsCount, $reasonsPR)) {
				$groupParkingRelated .= $statement;
			}
			if (in_array($illegalParkingReasonsCount, $reasonsTrR)) {
				$groupTransportRelated .= $statement;
			}
			if (in_array($illegalParkingReasonsCount, $reasonsPrR)) {
				$groupPropertyRelated .= $statement;
			}
			if (in_array($illegalParkingReasonsCount, $reasonsPT)) {
				$groupPedestrianTraffic .= $statement;
			}

			$illegalParkingReasonsCount++;
		}

		echo $groupDisabled.'
		<optgroup label="Traffic Related">'.$groupTrafficRelated.'</optgroup>
		<optgroup label="Parking Related">'.$groupParkingRelated.'</optgroup>
		<optgroup label="Transport Related">'.$groupTransportRelated.'</optgroup>
		<optgroup label="Property Related">'.$groupPropertyRelated.'</optgroup>
		<optgroup label="Pedestrian Traffic">'.$groupPedestrianTraffic.'</optgroup>';

	}
	
	public function getIllegalParking($input) {

		$illegalParkingReasons = file('../resources/illegalParkingList.txt', FILE_IGNORE_NEW_LINES);

		return $illegalParkingReasons[$input];

	}

	public function getDefLicense($input) {

		$defLicense = 'an <b>UNKNOWN DRIVERS LICENSE STATUS</b>.';

		switch ($input) {
			case 1:
				$defLicense = 'a <b>valid drivers license</b>.';
				break;
			case 2:
				$defLicense = '<b>no drivers license</b>.';
				break;
			case 3:
				$defLicense = 'an <b>expired drivers license</b>.';
				break;
			case 4:
				$defLicense = 'a <b>suspended drivers license</b>.';
				break;
			case 5:
				$defLicense = 'a <b>revoked drivers license</b>.';
				break;
		}

		return $defLicense;

	}

	public function getVehicleTint($input) {

		$vehicleTint = "";

		switch ($input) {
			case 0:
				$vehicleTint = 'a legal tint level after visual inspection.';
				break;
			case 1:
			case 2:
				$vehicleTint = 'an illegal tint level (<b>'.$input.'</b>) after inspection with the tint meter device.';
				break;
			case 3:
			case 4:
			case 5:
				$vehicleTint = 'a legal tint level (<b>'.$input.'</b>) after inspection with the tint meter device.';
				break;
			default:
				$vehicleTint = 'a legal tint level after a visual inspection.';
				break;
		}

		return 'The vehicle had '.$vehicleTint;

	}

	public function getVehicleRO($input) {

		$RO = "";

		switch ($input) {
			case '':
				$RO = '<b>unknown registered owner</b>';
				break;
			default:
				$RO = 'registered to <b>'.$input.'</b>';
				break;
		}

		return $RO;

	}

	public function getVehiclePlates($input, $type) {

		$plates = "";
		$b = "";
		$bb = "";

		// HTML
		if ($type == 0) {
			$b = "<b>";
			$bb = "</b>";
		}

		// BBCode
		if ($type == 1) {
			$b = "[b]";
			$bb = "[/b]";
		}

		switch ($input) {
			case '':
				$plates = $b.'unregistered'.$bb;
				break;
			default:
				$plates = 'identification plate reading '.$b.$input.$bb;
				break;
		}

		return $plates;

	}

	public function braceletChooser() {

		$bracelets = file ('resources/braceletList.txt');
		$braceletCount = 1;

		foreach ($bracelets as $bracelet) {
			echo "<option value=".$braceletCount.">".$bracelet."</option>";
			$braceletCount++;
		}
	}

	public function wristbandChooser() {

		$wristbands = file ('resources/wristbandList.txt');
		$wristbandCount = 1;

		foreach ($wristbands as $wristband) {
			echo "<option value=".$wristbandCount.">".$wristband."</option>";
			$wristbandCount++;
		}
	}

	public function pleaChooser() {

		$pleas = file ('resources/pleaList.txt');
		$pleaCount = 1;

		foreach ($pleas as $plea) {
			echo "<option value=".$pleaCount.">".$plea."</option>";
			$pleaCount++;
		}
	}

	public function getBracelet($input) {

		$bracelet = 'UNKNOWN BRACELET';
		$color = 'inherit';

		switch ($input) {
			case 1:
				$bracelet = 'White Bracelet';
				$color = '#808080';
				break;
			case 2:
				$bracelet = 'Orange Bracelet';
				$color = '#FF8000';
				break;
		}
		return '<span style="color: '.$color.';">'.$bracelet.'</span>';
	}

	public function getWristband($input) {

		$wristband = 'UNKNOWN WRISTBAND';
		$color = 'inherit';

		switch ($input) {
			case 1:
				$wristband = 'Red Wristband';
				$color = '#C80000';
				break;
			case 2:
				$wristband = 'Blue Wristband';
				$color = '#0000C8';
				break;
			case 3:
				$wristband = 'Yellow Wristband';
				$color = '#ffbf40';
				break;
		}
		return '<span style="color: '.$color.';">'.$wristband.'</span>';
	}

	public function getPlea($input, $suspect) {

		$plead = "UNKNOWN PLEA";

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
		}
		return '<b>(( <span style="color: #9944dd;">* '.$suspect.' pleads '.$plead.' *</span> ))</b>';
	}

}