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

	public function cookieTrafficReport() {

		if (isset($_SESSION['trafficReport'])) {
			return $_SESSION['trafficReport'];
		} else {
			return "";
		}
	}

	public function cookieTrafficPatrol() {

		if (isset($_SESSION['trafficPatrol'])) {
			return $_SESSION['trafficPatrol'];
		} else {
			return "";
		}

	}

	public function cookieDeathReport() {

		if (isset($_SESSION['deathReport'])) {
			return $_SESSION['deathReport'];
		} else {
			return "";
		}

	}

	public function cookieDeathReportTitle() {

		if (isset($_SESSION['deathReportTitle'])) {
			return $_SESSION['deathReportTitle'];
		} else {
			return "";
		}

	}

	public function cookieEvidenceLog() {

		if (isset($_SESSION['evidenceLog'])) {
			return $_SESSION['evidenceLog'];
		} else {
			return "";
		}

	}

	public function cookieEvidenceLogTitle() {

		if (isset($_SESSION['evidenceLogTitle'])) {
			return $_SESSION['evidenceLogTitle'];
		} else {
			return "";
		}

	}
	
	public function cookieArrestReport() {

		if (isset($_SESSION['arrestReport'])) {
			return $_SESSION['arrestReport'];
		} else {
			return "";
		}

	}
	
	public function cookiePatrolLogReport() {

		if (isset($_SESSION['patrolLog'])) {
			return $_SESSION['patrolLog'];
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

	public function cookieName() {

		if (isset($_COOKIE['officerName'])) {
			return $_COOKIE['officerName'];
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
}

?>