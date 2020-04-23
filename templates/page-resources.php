<div class="container mb-5 pb-5">
	<h1><i class="fas fa-fw fa-book mr-2"></i></i>Useful Resources</h1>
	<hr>
	<div class="row">
		<div class="col-xl-6">
			<div class="card bg-dark">
				<div class="card-body text-light">
					<h5 class="card-title">Miranda Rights</h5>
					<textarea
					class="form-control shadow mb-3"
					id="mirandaRights"
					name="mirandaRights"
					rows="4"
					readonly>You have the right to remain silent. Anything you say can and will be used against you in a court of law. You have the right to an attorney. If you cannot afford an attorney, one will be provided for you. Do you understand your rights?</textarea>
					<a class="btn btn-light text-dark" onclick="copy()" data-toggle="tooltip" title="Copied!">Copy Miranda Rights</a>
				</div>
			</div>
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