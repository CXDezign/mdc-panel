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

	public function cookieToggleBreadcrumb() {

		if (isset($_COOKIE['toggleBreadcrumb'])) {
			return $_COOKIE['toggleBreadcrumb'];
		} else {
			return false;
		}

	}

	public function cookieToggleBackgroundLogo() {

		if (isset($_COOKIE['toggleBackgroundLogo'])) {
			return $_COOKIE['toggleBackgroundLogo'];
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

		foreach ($ranks as $rank) {

			if ($rankCount === 0) {
				echo "<option value=".$rankCount.">".$rank."</option>";
				if ($cookie === 1) {
					if (isset($_COOKIE['officerRank'])) {
						echo '<optgroup label="Saved Cookie">';
						echo "<option selected value=".$_COOKIE['officerRank'].">".$this->getRank($_COOKIE['officerRank'],0)."</option>";
						echo '</optgroup>';
					}
				}
				echo '<optgroup label="Los Santos Police Department">';
			}

			if ($rankCount === 19) {
				echo '</optgroup>';
				echo '<optgroup label="Los Santos Sheriff&#39s Department">';
			}

			if ($rankCount === 28) {
				echo '</optgroup>';
			}

			if ($rankCount > 0) {
				echo "<option value=".$rankCount.">".$rank."</option>";
			}
			$rankCount++;
		}
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

		$charges = json_decode(file_get_contents("resources/penalSearch.json"), true);
		$chargeCount = 0;

		foreach ($charges as $charge) {
			if ($chargeCount != 0) {
				echo '<option value="'.$charge['id'].'">'.$charge['id'].'. '.$charge['charge'].' ('.$charge['type'].')'.'</option>';
			}
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

}

?>