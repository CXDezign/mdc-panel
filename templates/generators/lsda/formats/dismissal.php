<div style="background-color:#fafafa;color:#555555;padding:5px; border-radius:3px;">
    <p style="color:#555555;font-size:14px;text-align:center;">
        <u><strong><span style="font-size:24px;">Superior Court of San Andreas</span></strong></u>
    </p>
    <p style="font-size:14px;text-align:center;">
        <a href="https://i.imgur.com/tNqYJgz.png" title="Enlarge image" data-wrappedlink="" data-ipslightbox="" data-ipslightbox-group="undefined"><img alt="tNqYJgz.png" class="ipsImage ipsImage_thumbnailed" data-ratio="100.00" height="260" width="260" src="https://i.imgur.com/tNqYJgz.png"></a>
    </p>
    <p style="font-size:14px;text-align:center;">
        <u><strong><span style="font-size:18px;">Criminal Division</span></strong></u>
    </p>
    <hr style="font-size:14px;">
    <p style="font-size:14px;text-align:center;">
        <span style="font-size:20px;"><strong>Petition for Dismissal</strong></span>
    </p>
    <p style="font-size:14px;">
        By decree of the State of San Andreas Penal Code and enforcement&nbsp;authority of the San Andreas State Constitution, Defendant&nbsp;<strong><?= $defendant ?></strong><span>&nbsp;</span>was&nbsp;arrested by a law enforcement entity of the state, and&nbsp;the following charges were requested to be pursued against the Defendant;
    </p>
    <hr style="font-size:14px;">
    <ul style="font-size:14px;">
        <?= $chargesGroup ?>
    </ul>
    <hr style="font-size:14px;">
    <p style="font-size:14px;">
        In response to these charges&nbsp;the District Attorney's Office has found insufficient justification&nbsp;to proceed with an arraignment for the charges listed. The District Attorney's Office wishes to drop and/or dismiss all criminal charges levied against the Defendant in relation to this specific instance.
    </p>
    <hr style="font-size:14px;">
    <p style="font-size:14px;">
        <span style="font-size:14px;">The District Attorney's Office affirms that all information submitted is accurate, and truthful given all the information and evidence available, and has been affirmed by <?= $pg->getRank($_POST["inputRank"]) ?><span>&nbsp;</span></span><strong style="font-size:14px;"><?= $_POST["employeeName"] ?></strong><span style="font-size:14px;"><span>&nbsp;</span>that this shall be an official petition for dismissal&nbsp;submitted for the approval of the&nbsp;Superior Court.&nbsp;</span>
    </p>
</div>

<p>@mention</p>