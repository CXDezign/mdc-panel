<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1 class="my-3">Generated <?= $type ?></h1>
	<?php

		if ($showChargeTable) {
			require_once('form-arrest-charge-table.php');
		}

		if ($title) {
			echo '<input
				class="form-control shadow mb-3"
				id="generatedThreadTitle"
				name="generatedThreadTitle"
				value="'.$title.'"
				readonly>';
		}

		if ($report) {
			echo '<div class="container p-0 bg-transparent" contenteditable="true" id="generatedReport">'.$report.'</div>';
		}
		
	?>
	<div class="container mt-5 text-center">
		<a class="btn btn-primary px-5" data-clipboard-target="#generatedReport" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw mr-2"></i>Copy <?= $type ?></a>
	</div>
	<div class="container mt-2 mb-5 text-center">
		<a class="btn btn-info px-5" target="_blank" href="https://mdc.gta.world/record/<?= $g->findCookie('defNameURL') ?>" role="button"><i class="fas fa-archive fa-fw mr-2"></i>Create Record: <?= $g->findCookie('defName') ?></a>
	</div>
</div>