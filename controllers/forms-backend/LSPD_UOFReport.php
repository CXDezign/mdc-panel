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
    $suspects = 'Unknown';
    if (!empty($inputSuspectName)) {

        foreach ($inputSuspectName as $indSuspect => $suspect) {
            $suspects .= '[indent][u]Person #1 - ' . $inputSuspectName[$indSuspect] . '[/u]
[b]Status:[/b] ' . $pg->getStatus($inputSuspectStatusArray[$indSuspect]) . '[/indent]

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
    $generatedThreadTitle = 'UOF - ' . $postInputStreet . ', ' . $postInputDistrict . ' - ' . strtoupper($postInputDate);

    echo $_POST["generatorSubType"];
    if ($_POST["generatorSubType"] == 0)
        $generatedReport = '
[font=Arial][color=black]

[center][img]https://i.imgur.com/LEWTXbL.png[/img]

[size=125][b]SHERIFF\'S DEPARTMENT
COUNTY OF LOS SANTOS[/b]
[i]"A Tradition of Service Since 1850"[/i][/size]

[size=110][u]USE OF FORCE REPORT[/u][/size][/center][hr][/hr]

[font=arial][color=black][indent][size=105][b]Filing Information[/b][/size]

[indent]
[b]Time & Date:[/b] ' . $postInputTime . ', ' . strtoupper($postInputDate) . '
[b]Location:[/b] ' . $postInputStreet . ', ' . $postInputDistrict . '

[b]Filed By:[/b] ' . $pg->getRank($postInputRankArray[0]) . ' ' . $postInputNameArray[0] . '
[b]Unit Number:[/b] ' . $postInputCallsign . '
[/indent]

[size=105][b]Suspects[/b][/size]
' . $suspects . '[size=105][b]Employees Involved (Only include employees who used lethal force)[/b][/size]
[list]' . $officers . '[/list]

[size=105][b]Narrative[/b][/size]
[indent]' . $inputNarrative . '[/indent]

[size=105][b]Evidence[/b][/size]
' . $evidenceBox . '
' . $evidenceImage;
 else 
    $generatedReport = '
[divbox2=white][center][img]https://i.ibb.co/60wDx20/UOF.png[/img][/center][hr][/hr]
[divbox=#083a6b][b][color=#FFFFFF]1. SUPPLEMENTARY REPORT INFORMATION[/color][/b][/divbox]
[divbox=white]
[b]REPORTING EMPLOYEE:[/b]
[b]DATE AND TIME OF INCIDENT:[/b]
[/divbox][hr][/hr]
[divbox=white][b]NARRATIVE:[/b]
[LIST]Please provide a full narrative of events, following departmental report format.
[/LIST][/divbox]
[hr][/hr]
[divbox=#083a6b][b][color=#FFFFFF]2. EVIDENCE (if applicable)[/color][/b][/divbox]
[spoiler][/spoiler]
[/divbox2]
    
';

$generatedReport = str_replace('				', '', $generatedReport);
