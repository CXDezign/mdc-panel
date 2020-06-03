<?php

	// Session Controller
	session_start();

	// Required Models
	require_once $_SERVER['DOCUMENT_ROOT'] . '/models/general.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/models/paperwork-generators.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/session-variables.php';
	$g = new General();
	$pg = new PaperworkGenerators();
	$ar = new ArrestReportGenerator();
	$er = new EvidenceRegistrationLogGenerator();
	$pt = new ParkingTicketGenerator();