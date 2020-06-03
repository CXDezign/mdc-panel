<?php

	require_once('includes/initialise.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/png" href="<?= $g->getSettings('site-favicon') ?>">
	<title><?= $g->getSettings('site-name') ?> - MAINTENANCE</title>
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
	<script src="https://kit.fontawesome.com/129680e694.js" crossorigin="anonymous"></script>
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
</body>
</html>