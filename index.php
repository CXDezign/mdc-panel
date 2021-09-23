<?php

	// Variables
	$root = $_SERVER['DOCUMENT_ROOT'];
	$server = $_SERVER['SERVER_NAME'];
	require_once 'includes/initialise.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="title" content="<?= $g->getSettings('site-name') ?>">
	<meta name="description" content="<?= $g->getSettings('site-description') ?>">
	<meta name="author" content="<?= $g->getSettings('site-name') ?>">
	<meta name="keywords" content="MDC, MDC Panel, Mobile, Data, Computer, Panel, GTA5, GTAV, GTAO, GTA RP, Roleplay, RP, LSPD, LSSD, LSFD, Government, Penal Code, Los Santos Police Department, Los Santos Fires Department, Los Santos Sheriff's Department, Los Santos, Department, Agencies, Agency, Factions">
	<meta name="robots" content="index">
	<meta name="googlebot" content="all">
	<meta name="googlebot-news" content="all">

	<meta property="og:type" content="website">
	<meta property="og:url" content="https://<?= $g->getSettings('site-url') ?>">
	<meta property="og:title" content="<?= $g->getSettings('site-name') ?>">
	<meta property="og:description" content="<?= $g->getSettings('site-description') ?>">
	<meta property="og:image" content="http://<?= $server.$g->getSettings('site-image') ?>">
	<meta property="og:image:secure_url" content="https://<?= $server.$g->getSettings('site-image') ?>">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="630">
	<meta property="og:image:alt" content="MDC Panel">
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="https://<?= $g->getSettings('site-url') ?>">
	<meta property="twitter:title" content="<?= $g->getSettings('site-name') ?>">
	<meta property="twitter:image" content="<?= $server.$g->getSettings('site-image') ?>">
	<meta property="twitter:description" content="<?= $g->getSettings('site-description') ?>">

	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="192x192" href="/images/favicon/android-chrome-192x192.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
	<link rel="manifest" href="/images/favicon/site.webmanifest">
	<link rel="mask-icon" href="/images/favicon/safari-pinned-tab.svg" color="#e2b055">
	<link rel="shortcut icon" href="/images/favicon/favicon.ico">
	<meta name="msapplication-TileColor" content="#131313">
	<meta name="msapplication-TileImage" content="/images/favicon/mstile-144x144.png">
	<meta name="msapplication-config" content="/images/favicon/browserconfig.xml">
	<meta name="theme-color" content="#131313">

	<!-- Title -->
	<title><?= $g->getSettings('site-name') ?></title>

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
<script src="/js/clipboard.js"></script>
<script>
	var clipboard = new ClipboardJS('a');
	var clipboard2 = new ClipboardJS('.chargeCopy');

	clipboard2.on('success', function(e) {
		console.log(e);
	});

	clipboard2.on('error', function(e) {
		console.log(e);
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		// Animate on Scroll Initialisation
		AOS.init();
		// Select Picker Initialisation
		$('.selectpicker').selectpicker();
		// Tooltip Initialisation
		$('input').tooltip();
	});
</script>
<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip({
			delay: { "show": 100, "hide": 100 },
			animated: 'fade',
			placement: 'top',
			trigger: 'click'
		});
	});
	$(function () {
		$(document).on('shown.bs.tooltip', function (e) {
			setTimeout(function () {
				$(e.target).tooltip('hide');
			}, 500);
		});
	});
</script>
</body>
</html>