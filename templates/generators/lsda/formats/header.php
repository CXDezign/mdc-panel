<table align="center" border="0" cellpadding="3" cellspacing="2" style="background-color:#ffffff;border-collapse:collapse;border-spacing:0px;color:#353c41;font-size:14px;">
    <tbody>
        <tr>
            <td>
                <table align="center" border="0" cellpadding="3" cellspacing="2" style="border-collapse:collapse;border-spacing:0px;color:#353c41;font-size:14px;">
                    <tbody>
                        <tr>
                            <td style="text-align:right;">
                                <table align="center" border="0" cellpadding="3" cellspacing="2" style="border-collapse:collapse;border-spacing:0px;color:#353c41;font-size:14px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p style="text-align:center;">
                                                    <span style="color:#000000;"><strong><span style="font-size:28px;">SUPERIOR COURT OF THE STATE OF SAN ANDREAS</span></strong></span>
                                                </p>
                                                <p style="text-align:center;">
                                                    <span style="color:#000000;"><strong><span style="font-size:28px;">COUNTY OF LOS SANTOS</span></strong></span>
                                                </p>
                                                <p style="text-align:center;">
                                                    <span style="color:#000000;"><span style="font-size:28px;">CRIMINAL DIVISION</span></span>
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <span style="color:#000000;"><span style="text-align:left;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;</span></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <a href="https://i.ibb.co/zQMVtSr/150x150court.png" rel="external nofollow noopener" style="background-color:transparent;" title="Enlarge image" target="_blank"><img alt="150x150court.png" data-ratio="100.00" style="border-style:none;vertical-align:middle;" width="150" src="https://i.ibb.co/zQMVtSr/150x150court.png" class="ipsImage_thumbnailed"></a>
            </td>
        </tr>
    </tbody>
</table>
<hr style="">
<table align="center" border="0" cellpadding="3" cellspacing="2" style="background-color:#ffffff;border-collapse:collapse;border-spacing:0px;color:#353c41;font-size:14px;">
    <tbody>
        <tr>
            <td>
                <div style="border:1px solid #000000;padding:15px;">
                    <p>
                        <span style="color:#000000;"><span style="text-align:left;">THE PEOPLE OF</span></span><br>
                        <span style="color:#000000;"><span style="text-align:left;">THE STATE OF SAN ANDREAS</span></span><br>
                        <span style="color:#000000;"><strong><span style="text-align:left;">(Plaintiff)</span></strong></span><br>
                        &nbsp;
                    </p>
                    <p>
                        <span style="color:#000000;"><span style="text-align:left;">- against -&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><br>
                            <span style="text-align:left;"><?= $defendant ?></span></span><br>
                        <span style="color:#000000;"><strong><span style="text-align:left;">(Defendant)</span></strong></span>
                    </p>
                </div>
            </td>
            <td>
                <span style="color:#000000;"><span style="text-align:left;">)<br>)
                        <br>)
                        <br>)
                        <br>)
                        <br>)
                        <br>)
                        <br>)
                        <br>)
                    </span></span>
            </td>
            <td>
                <p style="text-align:center;">
                    <span style="color:#000000;">Court File: <?= date("y") ?>GJCR<?= str_pad($_POST["petitionNumber"], 5, "0", STR_PAD_LEFT); ?></span>
                </p>
                <p style="text-align:center;">
                    &nbsp;
                </p>
                <div style="background-color:#ffffff;border:1px solid #000000;padding:15px;">
                    <p style="text-align:center;">
                        <span style="color:#000000;"><?= $motion_name ?></span>
                    </p>
                </div>
                <p style="text-align:center;">
                    &nbsp;
                </p>
                <p style="text-align:center;">
                    <span style="color:#000000;"><em>Action Filed: <?= date("F d, y") ?></em></span>
                </p>
                <p style="text-align:center;">
                    &nbsp;
                </p>
            </td>
        </tr>
    </tbody>
</table>
<hr>
<p style="text-align:center;">
    <span style="color:#000000;"><span style="font-size:16px;"><strong>I. CHARGES</strong></span></span>
</p>
<p style="text-align:center;">
    &nbsp;
</p>
<table align="center" border="0" cellpadding="3" cellspacing="2" style="background-color:#ffffff;border-collapse:collapse;border-spacing:0px;color:#353c41;font-size:14px;">
    <tbody>
        <tr>
            <td>
                <table align="center" border="0" cellpadding="3" cellspacing="2" style="border-collapse:collapse;border-spacing:0px;color:#353c41;font-size:14px;">
                    <tbody>
                        <tr>
                            <td>
                                <p style="text-align:center;">
                                    <span style="font-size:14px;"><span style="color:#000000;"><strong>COUNT</strong></span></span>
                                </p>
                                <p style="text-align:center;">
                                    &nbsp;
                                </p>

                                <?php
                                for ($i = 1; $i <= count($charges); $i++) { ?>
                                    <p style="text-align:center;">
                                        <span style="font-size:14px;"><span style="color:#000000;"><?= $i ?></span></span>
                                    </p>
                                    <p style="text-align:center;">
                                        &nbsp;
                                    </p>
                                <?php } ?>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td>
                &nbsp;
            </td>
            <td>
                <p style="text-align:center;">
                    <span style="font-size:14px;"><span style="color:#000000;"><strong>OFFENSE</strong></span></span>
                </p>
                <p style="text-align:center;">
                    &nbsp;
                </p>
                <?php foreach ($charges as $charge) { ?>
                    <p style="text-align:center;">
                        <span style="font-size:14px;"><span style="color:#000000;"><?= $charge["fullName"] ?></span></span>
                    </p>
                    <p style="text-align:center;">
                        &nbsp;
                    </p>
                <?php } ?>
            </td>
            <td>
                <p>
                    &nbsp;
                </p>
            </td>
            <td>
                <table align="center" border="0" cellpadding="3" cellspacing="2" style="border-collapse:collapse;border-spacing:0px;color:#353c41;font-size:14px;">
                    <tbody>
                        <tr>
                            <td>
                                <p style="text-align:center;">
                                    <span style="font-size:14px;"><span style="color:#000000;"><strong>MAXIMUM PENALTY DESCRIPTION</strong></span></span>
                                </p>
                                <p style="text-align:center;">
                                    &nbsp;
                                </p>
                                <?php foreach ($charges as $charge) { ?>
                                    <p style="text-align:center;">
                                        <span style="font-size:14px;"><span style="color:#000000;"><?= $charge["penal_charge"]["time"]["days"] ?> Days, <?= $charge["penal_charge"]["time"]["hours"] ?> Hours Imprisonment, <?= empty($charge["fine"]) ? "no" : "$" . $charge["fine"] ?> fine.</span></span>
                                    </p>
                                    <p style="text-align:center;">
                                        &nbsp;
                                    </p>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>