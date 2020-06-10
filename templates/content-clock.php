<div class="container text-white text-center my-3 px-5 container-time" data-aos="flip-up" data-aos-duration="25" data-aos-delay="100">
	<div id="timestamp">|</div>
</div>
<script>
	$(document).ready(function() {
		var timestamp = document.getElementById('timestamp');

		function time() {
			var d = new Date();
			var s = d.getSeconds();
			var m = d.getMinutes();
			var h = d.getHours();

			if (h < 10) {
				var h = '0'+h;
			}

			if (m < 10) {
				var m = '0'+m;
			}

			if (s < 10) {
				var s = '0'+s;
			}

			timestamp.textContent = h + ":" + m + ":" + s;
		}

		time();
		setInterval(time, 1000);
	});
</script>