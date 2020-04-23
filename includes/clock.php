<hr class="mx-3 my-1">
<div class="container text-white text-center">
	<div id="timestamp"></div>
</div>
<hr class="mx-3 my-1">
<script>
	$(document).ready(function() {
		timestamp();
		setInterval(timestamp, 1000);
	});

	function timestamp() {
		$.ajax({
			url: '/controllers/timestamp.php',
			success: function(data) {
				$('#timestamp').html(data);
			},
		});
	}
</script>