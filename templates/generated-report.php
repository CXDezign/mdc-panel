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
			echo '<h3 class="my-3"><i class="fas fa-fw fa-eye mr-2"></i>Preview</h3><div class="container" readonly>'.$report.'</div>';
			echo '<br><h3 class="my-3"><i class="fas fa-fw fa-code mr-2"></i>Code</h3><textarea class="form-control" id="generatedReport">'.$report.'</textarea>';
		}

		if ($arrestSubmissionTitle) {
			echo '<br><h3 class="my-3"><i class="fas fa-fw fa-gavel mr-2"></i>Post-Arrest Submission</h3>
			<input
				class="form-control shadow mb-3"
				id="arrestSubmissionTitle"
				name="arrestSubmissionTitle"
				value="'.$arrestSubmissionTitle.'"
				readonly>';
		}

		if ($arrestSubmission) {
			echo '<textarea class="form-control" id="arrestSubmission">'.$arrestSubmission.'</textarea>';
		}

		// Buttons
		if ($title) {
			echo '<div class="container mt-5 text-center">
				<a class="btn btn-primary px-5" data-clipboard-target="#generatedThreadTitle" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw mr-2"></i>Copy Title</a>
			</div>';
		}
	?>
	<div class="container mt-5 text-center">
		<a class="btn btn-primary px-5" data-clipboard-target="#generatedReport" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw mr-2"></i>Copy <?= $type ?></a>
	</div>
	<?php

		// Buttons
		if ($arrestSubmissionTitle) {
			echo '<div class="container mt-2 text-center">
				<a class="btn btn-primary px-5" data-clipboard-target="#arrestSubmissionTitle" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw mr-2"></i>Copy Post-Arrest Submission Title</a>
			</div>';
		}

		if ($arrestSubmission) {
			echo '<div class="container mt-2 text-center">
				<a class="btn btn-primary px-5" data-clipboard-target="#arrestSubmission" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw mr-2"></i>Copy Post-Arrest Submission</a>
			</div>';
		}

	?>
</div>