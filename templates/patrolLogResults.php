<div class="container mb-5">
	<h1 class="my-3">Patrol Log - Format</h1>
	<h4><i class="fas fa-eye fa-fw mr-2"></i>Preview</h4>
	<textarea
		class="form-control shadow mb-5"
		id="resultPatrolLog"
		name="resultPatrolLog"
		rows="14"
		readonly><?php echo $g->cookiePatrolLogReport(); ?></textarea>
	<div class="container mt-5 text-center">
		<a tabindex="0" class="btn btn-primary px-5" onclick="copy()" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw mr-2"></i>Copy Patrol Log</a>
	</div>
	<div class="container mt-2 text-center">
		<a class="btn btn-info px-5" target="_blank" href="https://lspd.gta.world/viewforum.php?f=829" role="button"><i class="fas fa-archive fa-fw mr-2"></i>Create Patrol Log</a>
	</div>
	<div class="container mt-5 text-center">	
		<a class="btn btn-secondary px-5" href="index.php?page=patrolLog" role="button"><i class="fas fa-arrow-alt-circle-left fa-fw mr-2"></i>Return</a>
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
		range.selectNode(document.getElementById("resultPatrolLog"));
		window.getSelection().removeAllRanges();
		window.getSelection().addRange(range);
		document.execCommand("copy");
		window.getSelection().removeAllRanges();
	}
</script>