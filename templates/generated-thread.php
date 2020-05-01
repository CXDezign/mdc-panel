<?php
	
	require("includes/session-variables.php");

?>
<div class="container mb-5" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1 class="my-3">Generated <?= $type ?></h1>
	<h4><i class="fas fa-code fa-fw mr-2"></i>BBCode</h4>
		<?php if ($showTitle == true) { ?>
			<textarea
				class="form-control shadow mb-3"
				id="generatedThreadTitle"
				name="generatedThreadTitle"
				rows="1"
				readonly><?= $title ?></textarea>
		<?php } ?>
		<textarea
			class="form-control shadow mb-5"
			id="generatedThread"
			name="generatedThread"
			rows="15"
			readonly><?= $report ?></textarea>
		<hr class="my-5">
		<?php if ($showTitle == true) { ?>
		<div class="container mt-2 text-center">
			<a tabindex="0" class="btn btn-primary px-5" onclick="copyThreadTitle()" data-toggle="tooltip" title="Copied!">
				<i class="fas fa-copy fa-fw mr-2"></i>Copy <?= $type ?> Title
			</a>
		</div>
		<?php } ?>
		<div class="container mt-2 text-center">
			<a tabindex="0" class="btn btn-primary px-5" onclick="copyThread()" data-toggle="tooltip" title="Copied!">
				<i class="fas fa-copy fa-fw mr-2"></i>Copy <?= $type ?>
			</a>
		</div>
		<div class="container mt-2 text-center">
			<a class="btn btn-info px-5" target="_blank" href="<?= $threadURL ?>" role="button">
				<i class="fas fa-archive fa-fw mr-2"></i>
				<?php
					if ($showTitle == 1) {
						echo 'Create '.$type.' Thread';
					} else {
					 	echo 'Post '.$type;
					}
				?>
			</a>
		</div>
</div>

<script>
	$(document).ready(function(){
		$('a[data-toggle="tooltip"]').tooltip({
			delay: { "show": 100, "hide": 100 },
			animated: 'fade',
			placement: 'top',
			trigger: 'click'
		});
	});
	$(function () {
		$(document).on('shown.bs.tooltip', function (e) {
			setTimeout(function () {
				$(e.target).tooltip('hide');
			}, 500);
		});
	});
	function copyThreadTitle() {
		document.getElementById("generatedThreadTitle").select();
		document.execCommand("copy");
	}
	function copyThread() {
		document.getElementById("generatedThread").select();
		document.execCommand("copy");
	}
</script>