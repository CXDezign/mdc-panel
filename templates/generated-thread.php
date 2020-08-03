<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1 class="my-3">Generated <?= $type ?></h1>
	<?php if ($title) { ?>
		<input
			class="form-control shadow mb-3"
			id="generatedThreadTitle"
			name="generatedThreadTitle"
			value="<?= $title ?>">
	<?php } ?>
	<textarea
		class="form-control shadow mb-5"
		id="generatedThread"
		name="generatedThread"
		rows="15"><?= $report ?></textarea>
	<hr class="my-5">
	<?php if ($title) { ?>
	<div class="container mt-2 text-center">
		<a class="btn btn-primary px-5" data-clipboard-target="#generatedThreadTitle" data-toggle="tooltip" title="Copied!">
			<i class="fas fa-copy fa-fw mr-2"></i>Copy <?= $type ?> Title
		</a>
	</div>
	<?php } ?>
	<div class="container mt-2 text-center">
		<a class="btn btn-primary px-5" data-clipboard-target="#generatedThread" data-toggle="tooltip" title="Copied!">
			<i class="fas fa-copy fa-fw mr-2"></i>Copy <?= $type ?>
		</a>
	</div>
	<div class="container mt-2 text-center">
		<a class="btn btn-info px-5" target="_blank" href="<?= $threadURL ?>" role="button">
			<i class="fas fa-archive fa-fw mr-2"></i>
			<?php
				if ($title == 1) {
					echo 'Create '.$type.' Thread';
				} else {
				 	echo 'Post '.$type;
				}
			?>
		</a>
	</div>
</div>
<script src="/js/clipboard.js"></script>
<script>
	var clipboard = new ClipboardJS('a');

	clipboard.on('success', function(e) {
	console.log(e);
	});

	clipboard.on('error', function(e) {
	console.log(e);
	});
</script>
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
</script>