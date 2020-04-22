<div class="container text-white text-center">
	<div id="timestamp"></div>
</div>
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