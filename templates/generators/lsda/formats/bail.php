<p style="text-align:center;">
    <u><strong><span style="font-size:24px;">Superior Court of San Andreas</span></strong></u>
</p>
<p style="text-align:center;">
    <a href="https://i.imgur.com/tNqYJgz.png" title="Enlarge image" data-wrappedlink="" data-ipslightbox="" data-ipslightbox-group="undefined"><img alt="tNqYJgz.png" class="ipsImage ipsImage_thumbnailed" data-ratio="100.00" height="260" width="260" src="https://i.imgur.com/tNqYJgz.png"></a>
</p>
<p style="text-align:center;">
    <u><strong><span style="font-size:18px;">Criminal Division</span></strong></u>
</p>
<hr>
<p style="text-align:center;">
    <span style="font-size:20px;"><strong>Petition for Bail</strong></span>
</p>
<p style="background-color:#fafafa;color:#555555;font-size:14px;">
    By decree of the State of San Andreas Penal Code and enforcement&nbsp;authority of the San Andreas State Constitution, defendant&nbsp;<strong><?=$_POST["inputDefName"] ?></strong><span>&nbsp;</span>has been officially arrested by law enforcement entities of the state, and is expected to face the following charges;
</p>
<hr style="background-color:#fafafa;color:#555555;font-size:14px;">
<ul style="background-color:#fafafa;color:#555555;font-size:14px;">
    <?=$chargesGroup ?>
    <li style="background-color:#fafafa;color:#555555;font-size:14px;">
        <?=$total ?></strong>
    </li>
</ul>
<hr style="background-color:#fafafa;color:#555555;font-size:14px;">
<p style="background-color:#fafafa;color:#555555;font-size:14px;">
    In response to these charges&nbsp;the District Attorney's Office is requesting the court to grant bail for the defendant, as we enter our pre-trial stage and compile all necessary evidence and facts of the case to present an official arraignment. In the official opinion of the District Attorney\'s Office in relation to the charges, we are recommending that bail be <?=($action == 2 ? "<b>NOT</b> " : "") ?>given on the following conditions;
</p>
<hr style="background-color:#fafafa;color:#555555;font-size:14px;">
<ul style="background-color:#fafafa;color:#555555;font-size:14px;">
    <?=$conditionsGroup ?>
</ul>
<hr style="background-color:#fafafa;color:#555555;font-size:14px;">
<p style="background-color:#fafafa;color:#555555;font-size:14px;">
    <span style="background-color:#fafafa;color:#555555;font-size:14px;">The District Attorney's Office affirms that all information submitted is accurate, and truthful given all the information and evidence available, and has been affirmed by <?=$pg->getRank($_POST["inputRank"]) ?><span>&nbsp;</span></span><strong style="background-color:#fafafa;color:#555555;font-size:14px;"><?=$_POST["employeeName"] ?></strong><span style="background-color:#fafafa;color:#555555;font-size:14px;"><span>&nbsp;</span>that this shall be the official bail petition&nbsp;submitted for the approval of the&nbsp;Superior Court.&nbsp;</span>
</p>