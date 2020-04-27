<script type="text/javascript">
	$(document).ready(function(){

		// Set initial value when page loads
		var chargeID = $("#span").text($("#inputCrime").val());
		// Set value when selection changes
		$("#inputCrime").change(function () {
			$("#inputCrime option:selected").each(function() {
				chargeID = $(this).val();
			});
			$("#span").text(chargeID);
		});

		// Get JSON
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var charges = JSON.parse(this.responseText);
				//var charges = JSON.stringify(JSON.parse(this.responseText));
				for (charge in charges) {
					var items = Object.keys(charges);
					var items2 = Object.entries(charges);
					var itemText = "";
					for (i = 0; i < items.length; i++) {
						itemText += "'" + items[i] + "' - " + items2[i] + "<br>";
					}
					var result = itemText;
					document.getElementById("json").innerHTML = result;
				}
			}
			//document.getElementById("json").innerHTML = charges;
		};
		xmlhttp.open("GET", "./resources/penalSearch.json", true);
		xmlhttp.send();
	});
</script>