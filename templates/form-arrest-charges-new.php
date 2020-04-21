<div class="container mb-5 pb-5">
	<h1 class="my-3">Arrest Report - Charges</h1>
	<form action="index.php?page=arrestReport" method="POST">
		<p id="json"></p>
		<h4><i class="fas fa-fw fa-receipt mr-2"></i>Charges</h4>
		<div class="form-row chargeGroup">
			<div class="form-group col-xl-6">
				<label>Crime ID, Title, & Classification</label>
				<span id="span"></span>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-gavel"></i></span>
					</div>
					<select
					class="form-control"
					id="inputCrime"
					name="inputCrime[]"
					required>
					<?php
						$ar->chargeChooser();
					?>
					</select>
				</div>
			</div>
			<div class="form-group col-xl-2">
				<label>Crime Type</label>
				<select
				id="inputCrimeType"
				name="inputCrimeType[]"
				class="form-control"
				required>
				<?php
					$ar->crimeTypeChooser();
				?>
				</select>
			</div>
			<div class="form-group col-xl-2">
				<label>Crime Offence</label>
				<select
				id="inputCrimeOffence"
				name="inputCrimeOffence[]"
				class="form-control"
				required>
				<?php
					$ar->offenceChooser();
				?>
				</select>
			</div>
			<div class="form-group col-xl-2">
				<label>Options</label>
				<div class="input-group-addon">
					<a href="javascript:void(0)" class="btn btn-success w-100 addCharge">
						<i class="fas fa-fw fa-plus-square mr-1"></i>Add Charge
					</a>
				</div>
			</div>
		</div>
		
		<div class="container mt-2 text-center">
			<a class="btn btn-info px-5" target="_blank" href="https://forum.gta.world/en/index.php?/topic/20053-san-andreas-penal-code/" role="button"><i class="fas fa-archive fa-fw mr-1"></i>Open Penal Code</a>
		</div>
		
		<div class="container my-5 text-center">
		<button id="submit" type="submit" name="submit" class="btn btn-primary px-5">
			<i class="fas fa-fw fa-plus-square mr-1"></i>Calculate Arrest
		</button>
	</div>
	</form>

	<div class="container fieldChargeCopy" style="display: none;">
		<div class="form-group col-xl-6">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-fw fa-gavel"></i></span>
				</div>
				<select
				class="form-control"
				id="inputCrime"
				name="inputCrime[]"
				required>
				<?php
					$ar->chargeChooser();
				?>
				</select>
			</div>
		</div>
		<div class="form-group col-xl-2">
			<select
			id="inputCrimeType"
			name="inputCrimeType[]"
			class="form-control"
			required>
			<?php
				$tr->crimeTypeChooser();
			?>
			</select>
		</div>
		<div class="form-group col-xl-2">
			<select
			id="inputCrimeOffence"
			name="inputCrimeOffence[]"
			class="form-control"
			required>
			<?php
				$ar->offenceChooser();
			?>
			</select>
		</div>
		<div class="form-group col-xl-2">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeCharge" type="button" id="button-addon2"><i class="fas fa-fw fa-minus-square mr-1"></i>Remove Charge</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){

		var maxCharges = 20;

		$(".addCharge").click(function(){
			if($('body').find('.chargeGroup').length < maxCharges){
				var fieldHTML = '<div class="form-row chargeGroup">'+$(".fieldChargeCopy").html()+'</div>';
				$('body').find('.chargeGroup:last').after(fieldHTML);
			} else {
				alert('Maximum '+maxCharges+' charges are allowed.');
			}
		});

		$("body").on("click",".removeCharge",function(){ 
			$(this).parents(".chargeGroup").remove();
		});

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