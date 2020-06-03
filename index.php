<?php

	require_once('includes/initialise.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/png" href="<?= $g->getSettings('site-favicon') ?>">
	<title><?= $g->getSettings('site-name') ?></title>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta property="og:title" content="<?= $g->getSettings('site-name') ?>">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?= $g->getSettings('site-url') ?>">
	<meta property="og:image" content="<?= $g->getSettings('site-image') ?>">
	<meta property="og:description" content="<?= $g->getSettings('site-description') ?>">

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="/styles/custom.php?v=<?= $g->getSettings('site-version') ?>">

	<!-- FontAwesome -->
	<link href="/styles/fontawesome.css" rel="stylesheet">
	<link href="/styles/brands.css" rel="stylesheet">
	<link href="/styles/solid.css" rel="stylesheet">

	<!-- Animate on Scroll -->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

	<!-- Bootstrap Select Picker -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

	<!-- Bootstrap Switch Button -->
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

	<!-- Colcade -->
	<script src="https://unpkg.com/colcade@0/colcade.js"></script>

	<!-- Map Style -->
	<link rel="stylesheet" type="text/css" href="/map/style.css">

	<!-- Leaflet -->
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.1.0/dist/leaflet.css">
	<script src="https://unpkg.com/leaflet@1.1.0/dist/leaflet.js"></script>

	<!-- Leaflet Search -->
	<script src="/map/src/leaflet-search.js"></script>

	<!-- Leaflet Font Awesome Icons -->
	<link rel="stylesheet" type="text/css" href="/map/src/leaflet.awesome-markers.css">
	<script src="/map/src/leaflet.awesome-markers.js"></script>
</head>
<body id="top">
	<div class="wrapper">
	<?php
		require_once("templates/sidebar.php");
		echo '<div id="container">';
			require_once("includes/breadcrumbs.php");
			echo '<div class="container-page d-flex align-items-center">';
				require_once("routes.php");
			require_once("templates/footer.php");
	?>
			</div>
		</div>
	</div>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
</body>
</html>