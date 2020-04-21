<div class="container mb-5">
	<h1 class="my-3">Generated <?php echo $g->sessionGeneratedReportType();?></h1>
	<h4><i class="fas fa-eye fa-fw mr-2"></i>Preview</h4>
	<div class="container p-0">
		<div id="generatedReport">
			<?php
				echo $g->sessionGeneratedReport();
			?>
		</div>
	</div>
	<div class="container mt-5 text-center">
		<a tabindex="0" class="btn btn-primary px-5" onclick="copy()" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw mr-2"></i>Copy <?php echo $g->sessionGeneratedReportType();?></a>
	</div>
	<div class="container mt-2 text-center">
		<a class="btn btn-info px-5" target="_blank" href="https://mdc.gta.world/record/<?php echo $g->cookieDefNameURL(); ?>" role="button"><i class="fas fa-archive fa-fw mr-2"></i>Create Record: <?php echo $g->cookieDefName(); ?></a>
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
	function copy() {
		var range = document.createRange();
		range.selectNode(document.getElementById("generatedReport"));
		window.getSelection().removeAllRanges();
		window.getSelection().addRange(range);
		document.execCommand("copy");
		window.getSelection().removeAllRanges();
	}
</script>