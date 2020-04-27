<div class="container mb-5" data-aos="fade-in" data-aos-duration="1000">
	<h1 class="my-3"><i class="fas fa-fw fa-bug mr-2"></i>Fatal Error!</h1>
	<div class="container p-0">
		<div>
			<h4>
			Whoops! Looks like you encountered a fatal error.<br><br>
			Please contact <span class="text-golden" id="username">xanx#0001</span> on <span class="text-golden">Discord</span> and describe the events leading up prior to this message.
			</h4>
		</div>
	</div>
	<div class="container mt-5 text-center">
		<a tabindex="0" class="btn btn-primary px-5" onclick="copy()" data-toggle="tooltip" title="Copied!"><i class="fas fa-copy fa-fw mr-2"></i>Copy Discord Username</a>
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
		range.selectNode(document.getElementById("username"));
		window.getSelection().removeAllRanges();
		window.getSelection().addRange(range);
		document.execCommand("copy");
		window.getSelection().removeAllRanges();
	}
</script>