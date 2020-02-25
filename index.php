<?php

	session_start();
	require 'models/general.php';
	require 'models/arrestReport.php';
	require 'models/trafficReport.php';
	require 'models/evidenceLog.php';
	require 'models/deathReport.php';
	require 'models/trafficPatrol.php';
	require 'models/patrolLog.php';
	$g = new General();
	$ar = new ArrestReport();
	$tr = new TrafficReport();
	$el = new EvidenceLog();
	$dr = new DeathReport();
	$tp = new TrafficPatrol();
	$pl = new PatrolLog();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta property="og:title" content="MDC Panel">
		<meta property="og:type" content="website">
		<meta property="og:url" content="http://xanx.co.uk/MDC">
		<meta property="og:image" content="http://xanx.co.uk/MDC/images/Logo-MDC.png">
		<meta property="og:description" content="MDC Panel - Created by xanx.">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/129680e694.js" crossorigin="anonymous"></script>
		<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<title>MDC Panel - <?php echo $g->getVersion(); ?></title>
		<link rel="stylesheet" href="styles/custom.css?v=<?php echo $g->getVersion(); ?>">

		<!-- Map -->
		<link rel="stylesheet" href="map/style.css">

		<!-- FontAwesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

		<!-- Leaflet -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.1.0/dist/leaflet.css">
		<script src="https://unpkg.com/leaflet@1.1.0/dist/leaflet.js"></script>

		<!-- Leaflet Search -->
		<link rel="stylesheet" href="map/src/leaflet-search.css">
		<script src="map/src/leaflet-search.js"></script>

		<!-- Leaflet Font Awesome Icons -->
		<link rel="stylesheet" href="map/src/leaflet.awesome-markers.css">
		<script src="map/src/leaflet.awesome-markers.js"></script>
	</head>
	<body>
		<div class="wrapper">
			<?php
				include("templates/sidebar.php");
			?>
			<div id="container">
				<?php
					include("includes/pageResolver.inc.php");
				?>
			</div>
		</div>
	</body>
</html>