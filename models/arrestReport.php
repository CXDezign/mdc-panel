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
	
	public function wristbandChooser() {

		$wristbands = file ('resources/wristbandList.txt');
		$wristbandCount = 1;

		foreach ($wristbands as $wristband) {
			echo "<option>".$wristband."</option>";
			$wristbandCount++;
		}
	}
	
	public function braceletChooser() {

		$bracelets = file ('resources/braceletList.txt');
		$braceletCount = 1;

		foreach ($bracelets as $bracelet) {
			echo "<option>".$bracelet."</option>";
			$braceletCount++;
		}
	}
	
	public function pleaChooser() {

		$pleas = file ('resources/pleaList.txt');
		$pleaCount = 1;

		foreach ($pleas as $plea) {
			echo "<option>".$plea."</option>";
			$pleaCount++;
		}
	}

	public function getPlea($input) {
		switch ($input) {
			case 'Guilty':
				return 'PLEADS <b>GUILTY</b>';
				break;
			case 'Not Guilty':
				return 'PLEADS <b>NOT GUILTY</b>';
				break;
			case 'No Contest':
				return 'PLEADS <b>NO CONTEST</b>';
				break;
			}
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