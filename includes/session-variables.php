<?php

	// Session Variables
	$type = (empty($_SESSION['generatedReportType'])) ? "Report" : $_SESSION['generatedReportType'];
	$report = (empty($_SESSION['generatedReport'])) ? "" : $_SESSION['generatedReport'];
	$title = (empty($_SESSION['generatedThreadTitle'])) ? "" : $_SESSION['generatedThreadTitle'];
	$threadURL = (empty($_SESSION['generatedThreadURL'])) ? "" : $_SESSION['generatedThreadURL'];
	$showChargeTable = (empty($_SESSION['showGeneratedArrestChargeTables'])) ? false : $_SESSION['showGeneratedArrestChargeTables'];
	$chargeTable = (empty($_SESSION['generatedArrestChargeList'])) ? "" : $_SESSION['generatedArrestChargeList'];
	$chargeTableTotals = (empty($_SESSION['generatedArrestChargeTotals'])) ? "" : $_SESSION['generatedArrestChargeTotals'];