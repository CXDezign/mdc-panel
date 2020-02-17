<?php

class EvidenceLog {

	public function itemCategoryChooser() {

		$items = file ('resources/itemCategoryList.txt');
		$itemCount = 1;

		foreach ($items as $item) {
				echo "<option value=".$itemCount.">".$item."</option>";
				$itemCount++;
		}
	}

	public function getItemCategory($input) {

		switch ($input) {
			case 1:
				return 'Melee';
				break;
			case 2:
				return 'Narcotics';
				break;
			case 3:
				return 'Weapons';
				break;
			case 4:
				return 'Other';
				break;
		}
	}

}

?>