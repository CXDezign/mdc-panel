<div class="container text-white text-center my-3 px-5" data-aos="flip-up" data-aos-duration="25" data-aos-delay="100">
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