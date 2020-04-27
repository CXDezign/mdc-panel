<?php

	// Session Controller
	session_start();

	// Required Models
	require 'models/general.php';
	require 'models/paperwork-generators.php';
	$g = new General();
	$pg = new PaperworkGenerators();