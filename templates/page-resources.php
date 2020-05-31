<div class="container mb-5 pb-5" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-book mr-2"></i>Useful Resources</h1>
	<hr>
	<div class="bricklayer bricklayer-resources">
		<div class="card card-resource bg-dark text-white">
			<div class="card-body">
				<h5 class="card-title">Miranda Rights</h5>
				<textarea
				class="form-control shadow mb-3"
				id="mirandaRights"
				name="mirandaRights"
				rows="4"
				readonly>You have the right to remain silent. Anything you say can and will be used against you in a court of law. You have the right to an attorney. If you cannot afford an attorney, one will be provided for you. Do you understand your rights?</textarea>
				<a class="btn btn-primary text-white" onclick="copy()" data-toggle="tooltip" title="Copied!">Copy Miranda Rights</a>
			</div>
		</div>
		<a target="_blank" rel="noopener noreferrer" href="<?= $g->getSettings('url-penal-code'); ?>">
			<div class="card card-resource bg-dark text-white" id="card-main-penal">
				<div class="card-body shadow">
					<p class="card-text card-icon"><i class="fas fa-fw fa-3x fa-balance-scale text-muted"></i></p>
					<h5 class="card-title">Penal Code<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i></h5>
					<p class="card-text card-description">Access the San Andreas Penal Code.</p>
				</div>
			</div>
		</a>
		<a target="_blank" rel="noopener noreferrer" href="<?= $g->getSettings('url-court-laws'); ?>">
			<div class="card card-resource bg-dark text-white" id="card-main-penal">
				<div class="card-body shadow">
					<p class="card-text card-icon"><i class="fas fa-fw fa-3x fa-university text-muted"></i></p>
					<h5 class="card-title">Court Laws<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i></h5>
					<p class="card-text card-description">U.S. Supreme court laws.</p>
				</div>
			</div>
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
	function copy() {
		document.getElementById("mirandaRights").select();
		document.execCommand("copy");
	}
</script>