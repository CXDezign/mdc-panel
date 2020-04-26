<div class="container text-white text-center my-3 px-5" data-aos="fade-in">
	<div id="timestamp">|</div>
</div>
<script>
	timestamp();
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