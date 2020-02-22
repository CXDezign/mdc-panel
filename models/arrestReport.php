<?php

class ArrestReport {

	public function chargeChooser() {
		$charges = file ('resources/fullChargesList.txt');
		$chargeCount = 1;
		
		foreach ($charges as $charge) {
			echo "<option value=".$chargeCount.">".$charge."</option>";
			$chargeCount++;
		}
	}
	
	public function crimeTypeChooser() {

		$crimeTypes = file ('resources/crimeTypeList.txt');
		$crimeTypeCount = 1;

		foreach ($crimeTypes as $crimeType) {
			echo "<option value=".$crimeTypeCount.">".$crimeType."</option>";
			$crimeTypeCount++;
		}
	}
	
	public function offenceChooser() {

		$crimeOffence = file ('resources/offenceList.txt');
		$crimeOffenceCount = 1;

		foreach ($crimeOffence as $offence) {
			echo "<option value=".$crimeOffenceCount.">".$offence."</option>";
			$crimeOffenceCount++;
		}
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

		$bracelet = '';
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
			default:
				$bracelet = 'Unknown Bracelet';
				$color = 'inherit';
				break;
		}
		return '<span style="color: '.$color.';">'.$bracelet.'</span>';
	}

	public function getWristband($input) {

		$wristband = '';
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
			default:
				$wristband = 'Unknown Wristband';
				$color = 'inherit';
				break;
		}
		return '<span style="color: '.$color.';">'.$wristband.'</span>';
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
			default:
				$plead = 'Unknown';
				break;
		}
		return '<b>(( <span style="color: #9944dd;">* '.$suspect.' pleads '.$plead.' *</span> ))</b>';
	}
	
	public function getDashboardCamera($input,$callsign) {

		switch ($input) {
			case '':
				return '<b style="color: #9944dd;">* The dashboard camera footage of '.$callsign.' supports the above narrative. *</b>';
				break;
			default:
				return '<b style="color: #9944dd;">* '.$input.' *</b>';
				break;
		}
	}

}

?>