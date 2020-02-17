<?php
	
	session_start();
	require '../models/general.php';
	require '../models/evidenceLog.php';
	$g = new General();
	$el = new EvidenceLog();

	function errorPage() {
		header('Location: ../index.php?page=deathReport&message=missing');
		exit();
	}

	if (isset($_POST['submit'])) {

		if (isset($_POST['inputDate'])) {
			$inputDate = $_POST['inputDate'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputTime'])) {
			$inputTime = $_POST['inputTime'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputName'])) {
			$inputName = $_POST['inputName'];
			setcookie("officerName",$inputName,2147483647, "/MDC");
		} else {
			errorPage();
		}

		if (isset($_POST['inputRank'])) {
			$inputRank = $_POST['inputRank'];
			setcookie("officerRank",$inputRank,2147483647, "/MDC");
		} else {
			errorPage();
		}

		if (isset($_POST['inputSuspectName'])) {
			$inputSuspectName = $_POST['inputSuspectName'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputItemCategory'])) {
			$inputItemCategory = $_POST['inputItemCategory'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputItemRegistry'])) {
			$inputItemRegistry = $_POST['inputItemRegistry'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputItemAmount'])) {
			$inputItemAmount = $_POST['inputItemAmount'];
		} else {
			errorPage();
		}

		if (isset($_POST['inputEvidenceImage'])) {
			$inputEvidenceImage = $_POST['inputEvidenceImage'];
			$inputEvidenceImage = array_filter($inputEvidenceImage);
		}

		if (empty($inputEvidenceImage) == false) {
			$i = 1;
			foreach ($inputEvidenceImage as $evidenceImage) {
				$evidence[] = "[altspoiler=EXHIBIT #0".$i."][img]".$evidenceImage."[/img][/altspoiler]";
				$i++;
			}
			$evidence = implode("", $evidence);
		} else {
			$evidence = "";
		}

		for ($i=0;$i<count($inputItemRegistry);$i++) {
			$items[$i] = "[*] x".$inputItemAmount[$i]." - ".$inputItemRegistry[$i];
		}

		$items = implode("", $items);

		$evidenceLogTitle = "[".$el->getItemCategory($inputItemCategory)."] ".$inputSuspectName." [".strtoupper($inputDate)."]";

		$evidenceLog = "[divbox2=#fff]
[center][lspdlogo=150][/lspdlogo]

[size=120][b]Los Santos Police Department
Mission Row Station[/b][/size]
[i]Evidence Registration Log[/i][/center]
[color=white]...[/color]
[hr][/hr]
[color=white]...[/color]
[b]Name:[/b] ".$inputName."
[b]Rank:[/b] ".$g->getRank($inputRank)."
[b]Date & Time:[/b] ".strtoupper($inputDate)." -  ".$inputTime."

[b]Suspect Name:[/b] ".$inputSuspectName."
[b]Items name & amount:[/b]

[list]".$items."[/list]

[b]Screenshot:[/b]
".$evidence."
[/divbox2]";

		/*$evidenceLog = "[divbox2=#FFF]
[center][lspdlogo=150][/lspdlogo]

[size=120][b]Los Santos Police Department
Mission Row Station[/b][/size]
[i]Evidence Registration Log[/i][/center]
[hr][/hr]
[b]1. GENERAL INFORMATION[/b]
[hr][/hr]
[list=none][b]DATE & TIME:[/b] ".strtoupper($inputDate)." -  ".$inputTime."
[b]EVIDENCE BOOKING OFFICER:[/b] ".$g->getRank($inputRank)." ".$inputName."
[b]SUSPECT:[/B] ".$inputSuspectName."
[/list]
[hr][/hr]
[b]2. ITEM REGISTRY[/b]
[hr][/hr]
[list=none][b]ITEM CATEGORY:[/b] ".$el->getItemCategory($inputItemCategory)."
[b]ITEM NAME AND AMOUNT:[/b] [list]
".$items."
[/list][/list]
[hr][/hr]
[b]3. EVIDENCE[/b]
[hr][/hr]
".$evidence."
[/divbox2]";*/

		$_SESSION['evidenceLog'] = $evidenceLog;
		$_SESSION['evidenceLogTitle'] = strtoupper($evidenceLogTitle);

		header('Location: ../index.php?page=evidenceLogResults');
		exit();

	} else {

		$evidenceLog = "Error! Contact xanx#0001 on Discord";
		$_SESSION['evidenceLog'] = $evidenceLog;
		$_SESSION['evidenceLogTitle'] = $evidenceLog;
		header('Location: ../index.php?page=evidenceLogResults');
		exit();

	}
?>