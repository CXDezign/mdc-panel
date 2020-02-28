<?php
    class PatrolLog {
    	
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
		
    }
?>