<div class="container mb-5">
	<h1 class="my-3">Evidence Registration Log - Results</h1>
	<h4><i class="fas fa-code fa-fw"></i> BBCode</h4>
		<textarea
		class="form-control shadow mb-3"
		id="resultEvidenceLogTitle"
		name="resultEvidenceLogTitle"
		rows="1"
		readonly><?php echo $g->cookieEvidenceLogTitle(); ?></textarea>
		<textarea
		class="form-control shadow mb-5"
		id="resultEvidenceLog"
		name="resultEvidenceLog"
		rows="14"
		readonly><?php echo $g->cookieEvidenceLog(); ?></textarea>

	<div class="container mt-5 text-center">
		<a tabindex="0" class="btn btn-primary px-5" onclick="copyTitle()" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw"></i> Copy Evidence Registration Log Title</a>
	</div>
	<div class="container mt-2 text-center">
		<a tabindex="0" class="btn btn-primary px-5" onclick="copy()" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw"></i> Copy Evidence Registration Log</a>
	</div>
	<div class="container mt-2 text-center">
		<a class="btn btn-info px-5" target="_blank" href="https://lspd.gta.world/posting.php?mode=post&f=388" role="button"><i class="fas fa-archive fa-fw"></i> Create Thread</a>
	</div>
	<div class="container mt-5 text-center">	
		<a class="btn btn-secondary px-5" href="index.php?page=evidenceLog" role="button"><i class="fas fa-arrow-alt-circle-left fa-fw"></i> Return</a>
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
		document.getElementById("resultEvidenceLog").select();
		document.execCommand("copy");
	}
	function copyTitle() {
		document.getElementById("resultEvidenceLogTitle").select();
		document.execCommand("copy");
	}
</script>