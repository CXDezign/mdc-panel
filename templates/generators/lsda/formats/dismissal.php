<div style="background-color:#ffffff;color:#555555;font-size:13px;padding:15px;border-radius:5px;font-family:Arial, Helvetica, sans-serif;">
    <?php

    require_once(dirname(__FILE__) . '/header.php') ?>
    <hr style="">

    <p style="text-align:center;">
        <span style="color:#000000;"><span style="font-size:16px;"><strong>II. MOTION</strong></span></span>
    </p>
    <p style="text-align:center;">
        &nbsp;
    </p>
    <p style="background-color:#ffffff;color:#555555;font-size:14px;">
        <span style="color:#000000;"><span style="font-size:14px;">I, the Plaintiff/Defendant named above, hereby move the Court to dismiss the Petitioner’s complaint on the following grounds:</span></span>
    </p>
    <p style="background-color:#ffffff;color:#555555;font-size:14px;">
        <?= $_POST["inputReason"] ?>
    </p>
    <hr style="">
    <p style="text-align:justify;">
        <span style="font-size:14px;"><span style="color:#000000;">I&nbsp;<strong><?=$filler?></strong>, affirm that the above stated facts are true and accurate to the best of my knowledge and belief. This shall be the official statement for the dismissal of the designated offenses submitted for the Superior Court to dismiss or reduce the accusatory instrument.</span></span>
    </p>
    <p style="">
        &nbsp;
    </p>
    <p style="">
        <span style="font-size:14px;"><span style="color:#000000;">on&nbsp;<strong><?= strtoupper(date("F d, y")) ?></strong></span></span>
    </p>
</div>

<p>@mention</p>