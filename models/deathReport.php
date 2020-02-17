<?php

class DeathReport extends General {

	public function getDeceasedName($input) {

		switch($input) {
			case '':
				return 'JOHN/JANE DOE';
				break;
			default:
				return $input;
				break;
		}
	}

	public function getWitnessesName($input) {

		switch($input) {
			case '':
				return 'N/A';
				break;
			default:
				return $input;
				break;
		}
	}

	public function getHandlingName($input) {

		switch($input) {
			case '':
				return 'N/A';
				break;
			default:
				return $input;
				break;
		}
	}

	public function getHandlingCoroner($input) {

		switch($input) {
			case '':
				return 'N/A';
				break;
			default:
				return $input;
				break;
		}
	}

	public function getCoronerCaseNumber($input) {

		switch($input) {
			case '':
				return 'N/A';
				break;
			default:
				return $input;
				break;
		}
	}

	public function getMDCRecord($input) {

		switch($input) {
			case '':
				return '#';
				break;
			default:
				return $input;
				break;
		}
	}

}

?>