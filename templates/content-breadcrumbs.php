<nav class="breadcrumb" id="breadcrumb">
	<div class="row w-100">
		<div class="col-sm-8">
		<ol class="p-0 m-0" data-aos="flip-up" data-aos-duration="25" data-aos-delay="100">
			<li class="breadcrumb-item d-inline-block">
				<a href="/">
					<i class="fa fa-fw fa-th-large mr-1"></i>Dashboard
				</a>
			</li>
			<?= $c->breadcrumbs() ?>
		</ol>
		</div>
		<div class="col-sm-4 text-right user">
			<?php
				if ($g->findCookie('officerRank')) {
					echo $pg->getRank($g->findCookie('officerRank'));
				}
				echo ' ';
				if ($g->findCookie('officerName')) {
					echo $g->findCookie('officerName');
				}
				echo ' ';
				if ($g->findCookie('officerBadge')) {
					echo '(#'.$g->findCookie('officerBadge').')';
				}
			?>
		</div>
	</div>
</nav>