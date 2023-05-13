<div style="background-color:#ffffff;color:#555555;font-size:13px;padding:15px;border-radius:5px;font-family:Arial, Helvetica, sans-serif;">
    <?php

    require_once(dirname(__FILE__) . '/header.php') ?>
    <hr style="">

    <p style="font-size:13px;text-align:center;">
        <span style="font-size:16px;"><span style="color:#000000;"><strong>II. EVIDENCE</strong></span></span>
    </p>
    <p style="font-size:13px;text-align:center;">
        &nbsp;
    </p>
    <p>
        <span style="font-size:14px;"><span style="color:#000000;">In support of the provided narrative, the following evidence shall be submitted into the court record:</span></span>
    </p>
    <p>
        &nbsp;
    </p>

    <?php for ($i = 01; $i <= $exhibits; $i++) { ?>
        <p>
            <strong>PEOPLE'S EXHIBIT <?= $i ?></strong>
        </p>
        <p>
            (insert spoiler)
        </p>
    <?php } ?>

    <hr>
    <p style="font-size:13px;text-align:center;">
        <span style="font-size:16px;"><span style="color:#000000;"><strong>III. SENTENCING RECOMMENDATION</strong></span></span>
    </p>
    <p style="font-size:13px;text-align:center;">
        &nbsp;
    </p>
    <p style="font-size:13px;text-align:justify;">
        <span style="font-size:14px;"><span style="color:#000000;">The Los Santos County District Attorney's Office also files in support of this arraignment to the Superior Court, the professional opinion of the office and shall be recommending the granting of the following sentences:</span></span>
    </p>
    <p>
        &nbsp;
    </p>
    <ul>
        <li>
            <span style="font-size:14px;"><span style="color:#000000;">X Day(s),&nbsp;X Hours(s) imprisonment.</span></span>
        </li>
        <li>
            <span style="font-size:14px;"><span style="color:#000000;">$X fine, restitution, reparation.&nbsp;</span></span>
        </li>
    </ul>
    <hr>
    <p style="font-size:13px;text-align:center;">
        <span style="font-size:16px;"><span style="color:#000000;"><strong>IV. BAIL APPLICATION</strong></span></span>
    </p>
    <p style="font-size:13px;text-align:center;">
        &nbsp;
    </p>
    <p style="font-size:14px;text-align:justify;">
        <span style="background-color:#ffffff;">
            <font color="#000000">This matter coming before this court for setting of bail with the defendant present and being advised of their rights herein, the People of the State of San Andreas move this Honourable&nbsp;Court to to enter an order to&nbsp;</font><strong style="color:#000000;font-size:14px;"><?= $bailSummary ?></strong>
            <font color="#000000">&nbsp;and in support thereof state as follows:</font>
        </span>
    </p>
    <p>
        &nbsp;
    </p>
    <p style="font-size:14px;">
        <span style="font-size:14px;"><span style="color:#000000;"><?= $bailLong ?></span></span>
    </p>
    <p style="font-size:14px;">
        &nbsp;
    </p>

    <ol>
        <?= $bailReasons ?>
    </ol>
    <p>
        &nbsp;
    </p>
    <hr>
    <p style="font-size:13px;text-align:center;">
        <span style="font-size:14px;"><span style="color:#000000;"><u>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Declaration&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span></span>
    </p>
    <p style="font-size:14px;text-align:justify;">
        <font color="#000000">In conclusion of this complaint, I&nbsp;<strong><?= $filler ?></strong>, affirm that the above-stated facts are true and accurate to the best of my knowledge and belief. This shall be the official arraignment for the Superior Court to commence proceedings.</font>
    </p>
    <p>
        &nbsp;
    </p>
    <p>
        <span style="font-size:14px;"><span style="color:#000000;">on&nbsp;<strong><?= strtoupper(date("F d, y")) ?></strong></span></span>
    </p>

</div>

<p>@mention</p>