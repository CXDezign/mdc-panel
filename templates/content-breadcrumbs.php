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
			<?= $pg->getRank($g->findCookie('officerRank')).' '.$g->findCookie('officerName') ?> (<?= $g->findCookie('officerBadge') ?>)
		</div>
	</div>
</nav>