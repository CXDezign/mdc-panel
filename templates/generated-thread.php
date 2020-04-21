<div class="container mb-5">
	<h1 class="my-3">Generated <?php echo $g->sessionGeneratedReportType();?></h1>
	<h4><i class="fas fa-code fa-fw mr-2"></i>BBCode</h4>
		<textarea
		class="form-control shadow mb-3"
		id="generatedThreadTitle"
		name="generatedThreadTitle"
		rows="1"
		readonly><?php echo $g->sessionGeneratedThreadTitle(); ?></textarea>
		<textarea
		class="form-control shadow mb-5"
		id="generatedThread"
		name="generatedThread"
		rows="14"
		readonly><?php echo $g->sessionGeneratedReport(); ?></textarea>
	<div class="container mt-5 text-center">
		<a tabindex="0" class="btn btn-primary px-5" onclick="copyThreadTitle()" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw mr-2"></i>Copy <?php echo $g->sessionGeneratedReportType();?> Title</a>
	</div>
	<div class="container mt-2 text-center">
		<a tabindex="0" class="btn btn-primary px-5" onclick="copyThread()" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw mr-2"></i>Copy <?php echo $g->sessionGeneratedReportType();?></a>
	</div>
	<div class="container mt-2 text-center">
		<a class="btn btn-info px-5" target="_blank" href="<?php echo $g->sessionGeneratedThreadURL();?>" role="button"><i class="fas fa-archive fa-fw mr-2"></i>Create Thread</a>
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