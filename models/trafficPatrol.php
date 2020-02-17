<?php

class TrafficPatrol {

	public function dateResolver($date1, $date2) {

		if (!$date2) {
			return $date1;
		} elseif ($date1 == $date2) {
			return $date1;
		} else {
			return $date1 . ' - ' . $date2;
		}

	}

	public function noteResolver($input) {
		if (!$input) {
			return "N/A";
		} else {
			return $input;
		}
	}

}

?>