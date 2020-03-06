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

	public function vehicleChooser() {

		$vehicles = file ('resources/vehiclesList.txt');
		$vehicleCount = 1;

		foreach ($vehicles as $vehicle) {
			echo "<option>".$vehicle."</option>";
			$vehicleCount++;
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

	public function chargeChooser() {

		$charges = file ('resources/chargesList.txt');
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

		switch ($input) {
			case '':
				return '<b style="color: #9944dd;">* The dashboard camera footage supports the above narrative. *</b>';
				break;
			default:
				return '<b style="color: #9944dd;">* '.$input.' *</b>';
				break;
		}
	}

	public function getVehicleTint($input) {

		switch ($input) {
			case 0:
				return 'The vehicle had a legal tint level after visual inspection.';
				break;
			case 1:
			case 2:
				return 'The vehicle had an illegal tint level (<b>'.$input.'</b>) after inspection with the tint meter device.';
				break;
			case 3:
			case 4:
			case 5:
				return 'The vehicle had a legal tint level (<b>'.$input.'</b>) after inspection with the tint meter device.';
				break;
			default:
				return 'The vehicle had a legal tint level after a visual inspection.';
				break;
		}
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

	public function getCrimeClass($input) {

		switch ($input) {
			case 1:
				return 'M';
				break;
			case 2:
				return 'M';
				break;
			case 3:
				return 'M';
				break;
			case 4:
				return 'I';
				break;
			case 5:	
				return 'I';
				break;
			case 6:
				return 'I';
				break;
			case 7:
				return 'M';
				break;
			case 8:
				return 'I';
				break;
			case 9:
				return 'I';
				break;
			case 10:
				return 'I';
				break;
			case 11:
				return 'I';
				break;
			case 12:
				return 'M';
				break;
			case 13:
				return 'M';
				break;
			case 14:
				return 'F';
				break;
			case 15:
				return 'M';
				break;
			case 16:
				return 'I';
				break;
			case 17:
				return 'I';
				break;
			case 18:
				return 'I';
				break;
			case 19:
				return 'M';
				break;
			case 20:
				return 'I';
				break;
			case 21:
				return 'M';
				break;
			case 22:
				return 'F';
				break;
			case 23:
				return 'F';
				break;
			case 24:
				return 'F';
				break;
			case 25:
				return 'I';
				break;
			default:
				return '?';
				break;
		}
	}

	public function colourGreen() {
		return '<span style="color: #27ae60;">';
	}

	public function colourOrange() {
		return '<span style="color: #f39c12;">';
	}

	public function colourRed() {
		return '<span style="color: #e74c3c;">';
	}

	public function colourUnknown() {
		return '<span>';
	}

	public function getCrimeColour($input) {

		switch ($input) {
			case 1:
				return $this->colourOrange();
				break;
			case 2:
				return $this->colourOrange();
				break;
			case 3:
				return $this->colourOrange();
				break;
			case 4:
				return $this->colourGreen();
				break;
			case 5:	
				return $this->colourGreen();
				break;
			case 6:
				return $this->colourGreen();
				break;
			case 7:
				return $this->colourOrange();
				break;
			case 8:
				return $this->colourGreen();
				break;
			case 9:
				return $this->colourGreen();
				break;
			case 10:
				return $this->colourGreen();
				break;
			case 11:
				return $this->colourGreen();
				break;
			case 12:
				return $this->colourOrange();
				break;
			case 13:
				return $this->colourOrange();
				break;
			case 14:
				return $this->colourRed();
				break;
			case 15:
				return $this->colourOrange();
				break;
			case 16:
				return $this->colourGreen();
				break;
			case 17:
				return $this->colourGreen();
				break;
			case 18:
				return $this->colourGreen();
				break;
			case 19:
				return $this->colourOrange();
				break;
			case 20:
				return $this->colourGreen();
				break;
			case 21:
				return $this->colourOrange();
				break;
			case 22:
				return $this->colourRed();
				break;
			case 23:
				return $this->colourRed();
				break;
			case 24:
				return $this->colourRed();
				break;
			case 25:
				return $this->colourGreen();
				break;
			default:
				return $this->colourUnknown();
				break;
		}
	}

	public function getCrime($input) {

		switch ($input) {
			case 1:
				return '401. Driving On A Suspended License';
				break;
			case 2:
				return '402. Hit and Run';
				break;
			case 3:
				return '403. Reckless Operation Of an Off-Road or Naval Vehicle';
				break;
			case 4:
				return '404. Speeding';
				break;
			case 5:	
				return '405. Failure to Yield to a Traffic Control Device';
				break;
			case 6:
				return '406. Illegal Parking';
				break;
			case 7:
				return '407. Reckless Driving';
				break;
			case 8:
				return '408. Vehicular Noise Violation';
				break;
			case 9:
				return '409. Negligent Operation of a Vehicle';
				break;
			case 10:
				return '410. Illegal Usage of Hydraulics';
				break;
			case 11:
				return '411. Tinted Windows';
				break;
			case 12:
				return '412. Driving under the Influence of Alcohol or Narcotics [DUI]';
				break;
			case 13:
				return '413. Motor Vehicle Contest';
				break;
			case 14:
				return '414. Vehicular Endangerment';
				break;
			case 15:
				return '415. Driving Without a Valid License';
				break;
			case 16:
				return '416. Jaywalking';
				break;
			case 17:
				return '417. Possession of Open Container';
				break;
			case 18:
				return '418. Failure to Wear a Seatbelt/Safety Equipment';
				break;
			case 19:
				return '419. Operation of a Unsafe Motor Vehicle';
				break;
			case 20:
				return '420. Vehicle Registration Violation';
				break;
			case 21:
				return '421. Operating an Aircraft Without A License';
				break;
			case 22:
				return '422. Reckless Operation Of An Aircraft';
				break;
			case 23:
				return '423. Failure To Adhere To ATC';
				break;
			case 24:
				return '424. Aerial Evasion';
				break;
			case 25:
				return '425. Negligent Operation of Bicycle';
				break;
			default:
				return 'Unknown Charge';
				break;
		}
	}
}

?>