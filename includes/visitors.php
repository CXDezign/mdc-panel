<?php
	 
	$dbfile = "db/visitors.json";
	$expire = 300;

	if (!file_exists($dbfile)) {
		die("Error: Data file " . $dbfile . " NOT FOUND!");
	}

	if (!is_writable($dbfile)) {
		die("Error: Data file " . $dbfile . " is NOT writable! Please CHMOD it to 666!");
	}

	function in_array_r($needle, $haystack, $strict = false) {
		foreach ($haystack as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
				return true;
			}
		}
		return false;
	}

	function CountVisitors() {

		global $dbfile, $expire;

		$currentIP = getIP();
		$currentTime = time();

		$visitors = json_decode(file_get_contents($dbfile), true);

		if (empty($visitors) == false) {

			foreach ($visitors as $iVisitor => $visitor) {
				$sameVisitorKey[] = implode(array_keys($visitor));
				$sameVisitorVal[] = implode(array_values($visitor));
			}

			if (in_array_r($currentIP, $sameVisitorKey)) {
				foreach($sameVisitorKey as $iVisitor => $visitor) {

					if ($visitor == $currentIP) {
						// If Current IP matches IP in array and stored expire time is in future, refresh expire time to current time
						$visitors[$iVisitor][$visitor] = $currentTime;
					} elseif (($visitor != $currentIP) && ($sameVisitorVal[$iVisitor]+$expire < $currentTime)) {
						// If Current IP doesn't match IP in array and stored expire time is in the past, remove entry
						unset($visitors[$iVisitor]);
					}
				}
			} else {
				// If array is filled with only 1 visitor and doesn't match any IPs
				$newVisitor = array($currentIP => $currentTime);
				array_push($visitors, $newVisitor);
			}

			// Reindex array
			$visitors = array_values($visitors);
			// JSON encode and return output
			file_put_contents($dbfile, json_encode($visitors));
			$output = count($visitors);
			return $output;
		} else {
			$visistorsNew = array();
			$newVisitor = array($currentIP => $currentTime);
			array_push($visistorsNew, $newVisitor);
			file_put_contents($dbfile, json_encode($visistorsNew));
			$output = count($visistorsNew);
			return $output;
		}
	}

	function getIP() {

		$ip = $_SERVER['REMOTE_ADDR'];
		return ip2long($ip);

	}
 
	$visitors_online = CountVisitors();

?>

<div class="container text-center text-white mb-3" data-aos="flip-up" data-aos-duration="25" data-aos-delay="100">
	<i class="fas fa-fw fa-users mr-1"></i><span class="sidebar-visitor-text">Visitors Online:</span> <strong>
	<?= $visitors_online; ?>
	</strong>
</div>