<div class="container" data-aos="fade-out" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-book mr-2"></i>Useful Resources</h1>
	<hr>
	<div class="grid" id="resources">
		<div class="grid-col grid-col--1"></div>
		<div class="grid-col grid-col--2"></div>
		<div class="grid-item">
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
		</div>
		<div class="grid-item">
			<a target="_blank" rel="noopener noreferrer" href="<?= $g->getSettings('url-penal-code'); ?>">
				<div class="card card-resource bg-dark text-white" id="card-main-penal">
					<div class="card-body shadow">
						<p class="card-text card-icon"><i class="fas fa-fw fa-3x fa-balance-scale text-muted"></i></p>
						<h5 class="card-title">Penal Code<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i></h5>
						<p class="card-text card-description">Access the San Andreas Penal Code.</p>
					</div>
				</div>
			</a>
		</div>
		<div class="grid-item">
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
</div>
<script>
	$(document).ready(function(){
		$('a[data-toggle="tooltip"]').tooltip({
			delay: { "show": 100, "hide": 100 },
			animated: 'fade',
			placement: 'top',
			trigger: 'click'
		});

		$('.grid').colcade({
			columns: '.grid-col',
			items: '.grid-item'
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