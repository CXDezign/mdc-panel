<?php

	$json = json_decode(file_get_contents("db/changeLog.json"), true);

	$changelog = "";
	$changelogVersions = "";

	foreach ($json as $change) {

		$changeID = $change['id'];
		$changeDate = $change['date'];
		$changeList = $change['changes'];
		$changes = "";

		foreach ($changeList as $changeItem) {
			$changeItem = str_replace(" - ", "</span> - ", $changeItem);
			$changes .= '<li><span class="cl-general">'.$changeItem;
		}

		$changelog .= '
			<div class="changelog-spacing" id="'.$changeID.'"></div>
			<div class="card card-panel card-change mb-4">
				<div class="card-body shadow">
					<div class="card-title">
						<h4 class="row">
							<div class="col-xl-6 text-left">
								<span class="badge badge-dark">'.$changeID.'</span> - '.$changeDate.'</span>
							</div>
							<div class="col-xl-6 text-right">
								<a href="#top">
									<i class="fas fa-fw fa-angle-up"></i>
								</a>
							</div>
						</h4>
					</div>
					<ul class="card-text">'.$changes.'</ul>
				</div>
			</div>';

		$changelogVersions .= '<a class="d-inline-block" href="/changelogs#'.$changeID.'"><h4><span class="badge badge-dark">'.$changeID.'</span></h4></a> ';
	}

?>
<div class="container mb-5 pb-5" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-plug mr-2"></i></i>Changelogs</h1>
	<hr>
		Select a version to jump to:<br><br>
		<?= $changelogVersions ?>
	<hr>
	<?= $changelog ?>
</div>