<div class="container mb-5">
	<h1 class="my-3">Arrest Report - Results</h1>
	<h4><i class="fas fa-eye fa-fw"></i> Preview</h4>
	<div class="container p-0">
		<div id="resultArrestReport">
			<?php
				echo $g->cookieArrestReport();
			?>
		</div>
	</div>
	<div class="container mt-5 text-center">
		<a tabindex="0" class="btn btn-primary px-5" onclick="copy()" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw"></i> Copy Arrest Report</a>
	</div>
	<div class="container mt-2 text-center">
		<a class="btn btn-info px-5" target="_blank" href="https://mdc.gta.world/record/<?php echo $g->cookieDefNameURL(); ?>" role="button"><i class="fas fa-archive fa-fw"></i> Create Record: <?php echo $g->cookieDefName(); ?></a>
	</div>
	<div class="container mt-5 text-center">	
		<a class="btn btn-secondary px-5" href="index.php?page=arrestCharges" role="button"><i class="fas fa-arrow-alt-circle-left fa-fw"></i> Return</a>
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
		range.selectNode(document.getElementById("resultArrestReport"));
		window.getSelection().removeAllRanges();
		window.getSelection().addRange(range);
		document.execCommand("copy");
		window.getSelection().removeAllRanges();
	}
</script>