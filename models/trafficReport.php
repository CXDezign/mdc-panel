<?php

class TrafficReport {

	public function licenseChooser() {

		$licenses = file ('resources/licensesList.txt');
		$licenseCount = 1;

		foreach ($licenses as $license) {
			echo "<option value=".$licenseCount.">".$license."</option>";
			$licenseCount++;
		}
	}

	public function paintChooser() {

		$paints = file ('resources/paintsList.txt');
		$paintCount = 1;

		foreach ($paints as $paint) {
			echo "<option value=".$paintCount.">".$paint."</option>";
			$paintCount++;
		}
	}

	public function tintChooser() {

		$tints = file ('resources/tintsList.txt');
		$tintCount = 0;

		foreach ($tints as $tint) {
			echo "<option value=".$tintCount.">".$tint."</option>";
			$tintCount++;
		}
	}

	public function getDefLicense($input) {

		switch ($input) {
			case 1:
				return 'a <b>valid drivers license</b>.';
				break;
			case 2:
				return '<b>no drivers license</b>.';
				break;
			case 3:
				return 'an <b>expired drivers license</b>.';
				break;
			case 4:
				return 'a <b>suspended drivers license</b>.';
				break;
			case 5:
				return 'a <b>revoked drivers license</b>.';
				break;
			default:
				return 'a <b>valid drivers license</b>.';
				break;
		}
	}

	public function getDashboardCamera($input) {

		$dashboardCamera = "";

		switch ($input) {
			case '':
				$dashboardCamera = 'The dashboard camera footage supports the above narrative.';
				break;
			default:
				$dashboardCamera = $input;
				break;
		}
		return '<b style="color: #9944dd;">* '.$dashboardCamera.' *</b>';
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

	public function getVehiclePlates($input) {

		switch ($input) {
			case '':
				return '<b>unregistered</b>';
				break;
			default:
				return 'identification plate reading <b>'.$input.'</b>';
				break;
		}
	}

	public function getCrimeFine($input) {

		switch ($input) {
			case '':
				return 0;
				break;
			default:
				return $input;
				break;
		}
	}

}

?>