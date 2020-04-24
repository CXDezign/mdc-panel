<?php

	// Session Controller
	session_start();

	// Required Models
	require 'models/general.php';
	require 'models/arrestReport.php';
	require 'models/trafficReport.php';
	$g = new General();
	$ar = new ArrestReport();
	$tr = new TrafficReport();