<?php

class General {

	public function getVersion() {

		return 'v1.9.0';
	}

	public function getDate() {

		$unix = time();
		$date = date("d/M/Y", $unix);
		return $date;
	}

	public function getTime() {

		$unix = time();
		$time = date("H:i", $unix);
		return $time;
	}

	public function sessionGeneratedReportType() {

		if (isset($_SESSION['generatedReportType'])) {
			return $_SESSION['generatedReportType'];
		} else {
			return "";
		}
	}

	public function sessionGeneratedReport() {

		if (isset($_SESSION['generatedReport'])) {
			return $_SESSION['generatedReport'];
		} else {
			return "";
		}
	}

	public function sessionGeneratedThreadTitle() {

		if (isset($_SESSION['generatedThreadTitle'])) {
			return $_SESSION['generatedThreadTitle'];
		} else {
			return "";
		}
	}

	public function sessionGeneratedThreadURL() {

		if (isset($_SESSION['generatedThreadURL'])) {
			return $_SESSION['generatedThreadURL'];
		} else {
			return "";
		}
	}

	public function cookieToggleMode() {

		if (isset($_COOKIE['toggleMode'])) {
			return $_COOKIE['toggleMode'];
		} else {
			return false;
		}

	}

	public function cookieToggleClock() {

		if (isset($_COOKIE['toggleClock'])) {
			return $_COOKIE['toggleClock'];
		} else {
			return false;
		}

	}

	public function cookieName() {

		if (isset($_COOKIE['officerName'])) {
			return $_COOKIE['officerName'];
		} else {
			return "";
		}		

	}

	public function cookieRank() {

		if (isset($_COOKIE['officerRank'])) {
			return $_COOKIE['officerRank'];
		} else {
			return "";
		}
	}

	public function cookieBadge() {

		if (isset($_COOKIE['officerBadge'])) {
			return $_COOKIE['officerBadge'];
		} else {
			return "";
		}		
	}

	public function cookieCallSign() {

		if (isset($_COOKIE['callSign'])) {
			return $_COOKIE['callSign'];
		} else {
			return "";
		}

	}

	public function cookieDefName() {

		if (isset($_COOKIE['defName'])) {
			return $_COOKIE['defName'];
		} else {
			return "";
		}		

	}

	public function cookieDefNameURL() {

		if (isset($_COOKIE['defName'])) {
			$nameURL = $_COOKIE['defName'];
			$nameURL = str_replace(" ", "_", $nameURL);
			return $nameURL;
		} else {
			return "";
		}		
	}

	public function cookieTrafficPatrolURL() {

		if (isset($_COOKIE['inputTDPatrolReportURL'])) {
			return $_COOKIE['inputTDPatrolReportURL'];
		} else {
			return "";
		}
	}

	public function rankChooser() {

		$ranks = file ('resources/ranksList.txt');
		$rankCount = 0;

		if (isset($_COOKIE['officerRank'])) {
			$cookieOfficerRank = $_COOKIE['officerRank'];
		} else {
			$cookieOfficerRank = "";
		}

		foreach ($ranks as $rank) {
			echo "<option value=".$rankCount.">".$rank."</option>";
			$rankCount++;
		}
	}

	public function getRank($input) {

		switch ($input) {
			case 0:
				return 'Unknown Rank';
				break;
			case 1:
				return 'Police Officer I';
				break;
			case 2:
				return 'Police Officer II';
				break;
			case 3:
				return 'Police Officer III';
				break;
			case 4:
				return 'Police Officer III+1';
				break;
			case 5:
				return 'Detective I';
				break;
			case 6:
				return 'Detective II';
				break;
			case 7:
				return 'Detective III';
				break;
			case 8:
				return 'Sergeant I';
				break;
			case 9:
				return 'Sergeant II';
				break;
			case 10:
				return 'Lieutenant I';
				break;
			case 11:
				return 'Lieutenant II';
				break;
			case 12:
				return 'Captain';
				break;
			case 13:
				return 'Commander';
				break;
			case 14:
				return 'Deputy Chief of Police';
				break;
			case 15:
				return 'Assistant Chief of Police';
				break;
			case 16:
				return 'Chief of Police';
				break;
			case 17:
				return 'Forensic Analyst';
				break;
			case 18:
				return 'Crime Scene Investigator';
				break;
			case 19:
				return 'Deputy Sheriff';
				break;
			case 20:
				return 'Sergeant';
				break;
			case 21:
				return 'Lieutenant';
				break;
			case 22:
				return 'Captain';
				break;
			case 23:
				return 'Area Commander';
				break;
			case 24:
				return 'Division Chief';
				break;
			case 25:
				return 'Assistant Sheriff';
				break;
			case 26:
				return 'Undersheriff';
				break;
			case 27:
				return 'Sheriff';
				break;
			default:
				return 'Unknown Rank';
				break;
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

	public function vehicleChooser() {

		$vehicles = file ('resources/vehiclesList.txt');
		$vehicleCount = 1;

		foreach ($vehicles as $vehicle) {
			echo "<option>".$vehicle."</option>";
			$vehicleCount++;
		}
	}

	public function chargeChooser() {

		$charges = json_decode(file_get_contents("resources/penalSearch.json"), true);

		foreach ($charges as $charge) {
			echo '<option value="'.$charge['id'].'">'.$charge['id'].'. '.$charge['charge'].' ('.$charge['type'].')'.'</option>';
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

	public function getCrimeType($input) {

		switch ($input) {
			case 1:
				return 'C';
				break;
			case 2:
				return 'B';
				break;
			case 3:
				return 'A';
				break;
			default:
				return '?';
				break;
		}
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

}

?>