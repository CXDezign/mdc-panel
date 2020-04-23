<?php

	// Session Controller
	session_start();

	// Required Models
	require 'models/general.php';
	require 'models/arrestReport.php';
	require 'models/trafficReport.php';
	require 'models/evidenceLog.php';
	require 'models/deathReport.php';
	$g = new General();
	$ar = new ArrestReport();
	$tr = new TrafficReport();
	$el = new EvidenceLog();
	$dr = new DeathReport();