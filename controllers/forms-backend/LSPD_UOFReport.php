<?php

    // Variables
    $inputSuspectName = $_POST['inputSuspectName'] ?: array();
    $inputSuspectName = array_values(array_filter($inputSuspectName));
    $inputSuspectStatus = $_POST['inputSuspectStatus'] ?: array();
    $inputSuspectStatus = array_values(array_filter($inputSuspectStatus));
    $inputSuspectStatusArray = arrayMap($_POST['inputSuspectStatus'], 0);
    $inputEvidenceBox = $_POST['inputEvidenceBox'] ?? array();
    $inputEvidenceBox = array_values(array_filter($inputEvidenceBox));
    $inputNarrative = $_POST['inputNarrative'] ?: '';

    // Set Cookies
    setCookiePost('callSign', $postInputCallsign);
    setCookiePost('officerNameArray', $postInputNameArray[0]);
    setCookiePost('officerRankArray', $postInputRankArray[0]);
    setCookiePost('officerBadgeArray', $postInputBadgeArray[0]);
    setCookiePost('defName', $postInputDefName);
    setCookiePost('defNameURL', $postInputDefName);

    // Officer Resolver
    $officers = '';
    foreach ($postInputNameArray as $iOfficer => $officer) {
        $officers .= resolverOfficerBB($officer, $postInputRankArray[$iOfficer], $postInputBadgeArray[$iOfficer]);
    }

    // Person Resolver
    $suspects = '';
    if (!empty($inputSuspectName)) {

        foreach ($inputSuspectName as $indSuspect => $suspect) {
            $suspects .= '
[b]SUBJECT NAME:[/b] '.$inputSuspectName[$indSuspect].'
[b]MDC RECORD:[/b] [url=https://mdc.gta.world/record/'.str_replace(" ", "_", $inputSuspectName[$indSuspect]).']ACCESS[/url]
[b]STATUS:[/b] ' . $inputSuspectStatusArray[$indSuspect]==1?"DECEASED":"ALIVE" . '
[b]NOTES:[/b]
[hr][/hr]
';
            $index++;
        }
    }

    // Evidence Resolver
    $evidenceImage = '';
    if (!empty($postInputEvidenceImageArray)) {

        $evidenceImage = '';
        foreach ($postInputEvidenceImageArray as $eImgID => $image) {
            $evidenceImageCount = $eImgID + 1;
            $evidenceImage .= '[altspoiler="EXHIBIT - Photograph #' . $evidenceImageCount . '"][img]' . $image . '[/img][/altspoiler]';
        }
    }

    $evidenceBox = '';
    if (!empty($inputEvidenceBox)) {

        $evidenceBox = '';
        foreach ($inputEvidenceBox as $eBoxID => $box) {
            $evidenceBoxCount = $eBoxID + 1;
            $evidenceBox .= '[altspoiler="EXHIBIT - Description #' . $evidenceBoxCount . '"]' . $box . '[/altspoiler]';
        }
    }

    if ($evidenceImage == '' && $evidenceBox == '') {
        $evidenceImage = 'No Evidence Submitted.';
    }

    // Report Builder
    $redirectPath = redirectPath(2);
    $generatedReportType = 'Use of Force Report';
    $generatedThreadURL = 'https://lspd.gta.world/viewforum.php?f=1830';

    preg_match_all('/\b\w/', $postInputNameArray[0], $matches);
    $initials = implode('', $matches[0]);


    //$generatedThreadTitle = 'UOF - ' . $postInputStreet . ', ' . $postInputDistrict . ' - ' . strtoupper($postInputDate);
    $generatedThreadTitle = 'CUOF - '.$initials.' - '.strtoupper($postInputDate);

    echo $_POST["generatorSubType"];
    if ($_POST["generatorSubType"] == 0)
        $generatedReport = '
[divbox2=white][center][img]https://i.ibb.co/60wDx20/UOF.png[/img][/center][hr][/hr]
[divbox=#083a6b][b][color=#FFFFFF]1. REPORT INFORMATION[/color][/b][/divbox]
[divbox=white]
[b]REPORTING EMPLOYEE:[/b] '. $pg->getRank($postInputRankArray[0]) . ' ' . $postInputNameArray[0] .'
[b]DATE AND TIME OF INCIDENT:[/b] '. strtoupper($postInputDate). ', '. $postInputTime   . '
[b]LOCATION OF INCIDENT:[/b] ' . $postInputStreet . ', ' . $postInputDistrict . '
[b]TYPE OF UOF:[/b] Officer Involved Shooting / In-Custody Death / Other
[/divbox][hr][/hr]
[divbox=white][b]NARRATIVE:[/b]
[LIST]
[*]'. $inputNarrative
.'
[/LIST][/divbox]
[hr][/hr]
[divbox=#083a6b][b][color=#FFFFFF]2. INVOLVED SUBJECTS[/color][/b][/divbox]
[divbox=white]
'.$suspects.'
[b]Involved Employee(s):[/b]
[LIST]
'.$officers.'
[/LIST]
[b]Supervisor:[/b]
[LIST]Rank First Last
[/LIST][/divbox]
[hr][/hr]
[divbox=#083a6b][b][color=#FFFFFF]3. EVIDENCE (if applicable)[/color][/b][/divbox]
' . $evidenceBox . '
' . $evidenceImage.'
[/divbox2]';
 else 
    $generatedReport = '
[divbox2=white][center][img]https://i.ibb.co/60wDx20/UOF.png[/img][/center][hr][/hr]
[divbox=#083a6b][b][color=#FFFFFF]1. SUPPLEMENTARY REPORT INFORMATION[/color][/b][/divbox]
[divbox=white]
[b]REPORTING EMPLOYEE:[/b] ' . $pg->getRank($postInputRankArray[0]) . ' ' . $postInputNameArray[0] . '
[b]DATE AND TIME OF INCIDENT:[/b] '. strtoupper($postInputDate) . '-' .$postInputTime .'
[/divbox][hr][/hr]
[divbox=white][b]NARRATIVE:[/b]
[LIST]
[*]'.$inputNarrative.'
[/LIST][/divbox]
[hr][/hr]
[divbox=#083a6b][b][color=#FFFFFF]2. EVIDENCE (if applicable)[/color][/b][/divbox]
[spoiler]' . $evidenceBox . '
' . $evidenceImage.'
[/spoiler]
[/divbox2]
    
';

$generatedReport = str_replace('				', '', $generatedReport);
