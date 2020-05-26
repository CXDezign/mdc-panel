<?php
	
	require("includes/session-variables.php");

?>
<div class="container mb-5" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1 class="my-3">Generated <?= $type ?></h1>
	<?php
		if ($showChargeTable) {
			require 'form-arrest-charge-table.php';
		}
	?>
	<h4><i class="fas fa-eye fa-fw mr-2"></i>Preview</h4>
	<div class="container p-0">
		<div id="generatedReport">
			<?= $report ?>
		</div>
	</div>
	<div class="container mt-5 text-center">
		<a tabindex="0" class="btn btn-primary px-5" onclick="copy()" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw mr-2"></i>Copy <?= $type ?></a>
	</div>
	<div class="container mt-2 mb-5 text-center">
		<a class="btn btn-info px-5" target="_blank" href="https://mdc.gta.world/record/<?= $g->findCookie('defNameURL') ?>" role="button"><i class="fas fa-archive fa-fw mr-2"></i>Create Record: <?= $g->findCookie('defName') ?></a>
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