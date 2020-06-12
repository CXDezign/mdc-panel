<?php

	require_once 'includes/initialise.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/svg" href="<?= $g->getSettings('site-favicon') ?>">
	<title><?= $g->getSettings('site-name') ?></title>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta property="og:title" content="<?= $g->getSettings('site-name') ?>">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?= $g->getSettings('site-url') ?>">
	<meta property="og:image" content="<?= $g->getSettings('site-image') ?>">
	<meta property="og:description" content="<?= $g->getSettings('site-description') ?>">

	<!-- jQuery 3.5.1 -->
	<script src="/js/jquery-3.5.1.min.js"></script>

	<!-- Bootstrap 4.5.0 -->
	<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
	<link href="/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">

	<!-- Custom Styles -->
	<link href="/css/custom.php?v=<?= $g->getSettings('site-version') ?>" rel="stylesheet" type="text/css">

	<!-- FontAwesome 5.13.0  -->
	<link href="/css/fontawesome.min.css" rel="stylesheet">
	<link href="/css/brands.min.css" rel="stylesheet">
	<link href="/css/solid.min.css" rel="stylesheet">

	<!-- Animate on Scroll 2.3.4 -->
	<link href="/css/aos.css" rel="stylesheet">

	<!-- Bootstrap Select Picker 1.13.14 -->
	<link href="/css/bootstrap-select.min.css" rel="stylesheet">

	<!-- Bootstrap Switch Button 3.6.1 -->
	<link href="/css/bootstrap4-toggle.min.css" rel="stylesheet">

	<!-- Colcade 0.2.0 -->
	<script src="/js/colcade.js"></script>

	<!-- Map Styles -->
	<link href="/map/style.css?v=<?= $g->getSettings('site-version') ?>" rel="stylesheet">

	<!-- Leaflet 1.6.0 -->
	<link href="/css/leaflet.css?v=<?= $g->getSettings('site-version') ?>" rel="stylesheet">
	<script src="/js/leaflet.js"></script>

	<!-- Leaflet Search -->
	<script src="/map/src/leaflet-search.js"></script>

	<!-- Leaflet Font Awesome Icons -->
	<link href="/map/src/leaflet.awesome-markers.css?v=<?= $g->getSettings('site-version') ?>" rel="stylesheet" type="text/css">
	<script src="/map/src/leaflet.awesome-markers.js"></script>
</head>
<body id="top">
	<div id="wrapper">
	<?php
		require_once 'templates/content-sidebar.php';
	?>
		<div id="container">
			<?php
				require_once 'templates/notification.php';
				require_once 'templates/content-breadcrumbs.php';
			?>
			<div class="container-page">
				<?php require_once 'routes.php'; ?>
			</div>
			<?php require_once 'templates/content-footer.php'; ?>
		</div>
	</div>
<script src="/js/aos.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/bootstrap-select.min.js"></script>
<script src="/js/bootstrap4-toggle.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		AOS.init();
		// Select Picker Initialisation
		$('.selectpicker').selectpicker();
	});
</script>
</body>
</html>