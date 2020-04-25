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

}

?>