<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1 class="my-3"><i class="fas fa-fw fa-bug mr-2"></i>Fatal Error!</h1>
	<div class="container p-0">
		<h4>Whoops! Looks like you encountered a fatal error.</h4>
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
</script>