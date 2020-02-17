<div class="container mb-5">
	<h1 class="my-3">Traffic Division: Patrol Report - Results</h1>
	<h4><i class="fas fa-code fa-fw"></i> BBCode</h4>
		<textarea
		class="form-control shadow mb-5"
		id="resultTDPatrolReport"
		name="resultTDPatrolReport"
		rows="14"
		readonly><?php echo $g->cookieTrafficPatrol(); ?></textarea>

	<div class="container mt-5 text-center">
		<a tabindex="0" class="btn btn-primary px-5" onclick="copyTDPatrolReport()" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw"></i> Copy Traffic Division: Patrol Report</a>
	</div>
	<div class="container mt-2 text-center">
		<a class="btn btn-info px-5" target="_blank" href="<?php echo $g->cookieTrafficPatrolURL(); ?>" role="button"><i class="fas fa-archive fa-fw"></i> Post Report</a>
	</div>
	<div class="container mt-5 text-center">
		<a class="btn btn-secondary px-5" href="index.php?page=tdPatrolReport" role="button"><i class="fas fa-arrow-alt-circle-left fa-fw"></i> Return</a>
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

		$(function () {
			$(document).on('shown.bs.tooltip', function (e) {
				setTimeout(function () {
					$(e.target).tooltip('hide');
				}, 500);
			});
		});
	});
	function copyTDPatrolReport() {
		document.getElementById("resultTDPatrolReport").select();
		document.execCommand("copy");
	}
</script>