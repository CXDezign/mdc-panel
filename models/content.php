<?php

class Content {

	// FORMS

	function form($file, $directory, $variables = array(), $print = true) {

		$output = null;
		$root = $_SERVER['DOCUMENT_ROOT'];

		switch ($directory) {
			case 'forms':
				$directory = '/templates/forms/';
				break;
			case 'sections':
				$directory = '/templates/sections/';
				break;
			default:
				break;
		}

		if (file_exists($root.$directory.$file.'.php')) {
			// Extract the variables to a local namespace
			extract($variables);

			// Start output buffering
			ob_start();

			// Include the template file
			include $root.$directory.$file.'.php';

			// End buffering and return its contents
			$output = ob_get_clean();
		}
		if ($print) {
			print $output;
		}
		return $output;

	}

	// BREADCRUMBS

	public function breadcrumbs() {

		$breadcrumb = '';
		$root_domain = "/";
		$breadcrumbs = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

		foreach ($breadcrumbs as $crumb) {
			$link = ucwords(str_replace(array(".php","-","_"), array(""," "," "), $crumb));
			$root_domain .= $crumb.'/';
			$breadcrumb .= '<li class="breadcrumb-item d-inline-block">
				<a href="'. $root_domain .'">' . $link . '</a>
			</li>';
		}

		return $breadcrumb;

	}

	public function visitors() {

		$dbfile = "db/visitors.json";
		$expire = 3600;

		if (!file_exists($dbfile)) {
			throw new UnexpectedValueException("Error: Data file " . $dbfile . " NOT FOUND!");
		}

		if (!is_writable($dbfile)) {
			throw new UnexpectedValueException("Error: Data file " . $dbfile . " is NOT writable! Please CHMOD it to 666!");
		}

		function in_array_r($needle, $haystack, $strict = false) {
			foreach ($haystack as $item) {
				if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
					return true;
				}
			}
			return false;
		}

		function CountVisitors($dbfile, $expire) {

			$currentIP = getIP();
			$currentTime = time();

			$visitors = json_decode(file_get_contents($dbfile), true);

			if (!empty($visitors)) {

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
				return count($visitors);
			} else {
				$visistorsNew = array();
				$newVisitor = array($currentIP => $currentTime);
				array_push($visistorsNew, $newVisitor);
				file_put_contents($dbfile, json_encode($visistorsNew));
				return count($visistorsNew);
			}
		}

		function getIP() {

			$ip = $_SERVER['REMOTE_ADDR'];
			return ip2long($ip);

		}
	 
		return CountVisitors($dbfile, $expire);

	}

}