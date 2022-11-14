<?php

	require_once('includes/initialise.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/svg" href="<?= $g->getSettings('site-favicon') ?>">
	<title><?= $g->getSettings('site-name') ?> - MAINTENANCE</title>
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
</head>
<body>
	<div class="wrapper">
		<div class="container mt-5 p-5">
			<div class="text-center">
				<h1><i class="fas fa-fw fa-5x fa-code-branch"></i></h1>
				<h3>WEBSITE TEMPORARILY UNAVAILABLE - MAINTENANCE</h3>
				<div class="container my-5">
					The MDC Panel is currently under maintenance and will be unavailable until further notice.
					<hr>
					Questions? Message <strong><?= $g->getSettings('site-discord-contact') ?></strong> on Discord.
				</div>
			</div>
		</div>
	</div>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>