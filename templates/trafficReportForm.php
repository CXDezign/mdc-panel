<div class="container mb-5 pb-5">
	<h1 class="my-3">Traffic Report - Form</h1>
	<form action="controllers/trafficReportFormProcessor.inc.php" method="POST">

		<h4><i class="fas fa-archive fa-fw"></i> General Details</h4>
		<div class="form-row">
			<div class="form-group col-2">
				<label>Date</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-calendar"></i></span>
					</div>
					<input
					class="form-control"
					type="text"
					id="inputDate"
					name="inputDate"
					placeholder="DD/MMM/YYYY"
					value="<?php echo $g->getDate(); ?>"
					style="text-transform: uppercase;"
					required
					data-placement="bottom" title="DD/MMM/YYYY Format">
				</div>
			</div>
			<div class="form-group col-2">
				<label>Time</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-clock"></i></span>
					</div>
					<input
					class="form-control"
					type="text"
					id="inputTime"
					name="inputTime"
					placeholder="00:00 - 24:00"
					value="<?php echo $g->getTime(); ?>"
					required
					data-placement="bottom" title="24-Hour Format - 00:00">
				</div>
			</div>
			<div class="form-group col-2">
				<label>Call Sign</label>
				<input
				class="form-control"
				type="text"
				id="inputCallsign"
				name="inputCallsign"
				placeholder="Call Sign"
				value="<?php echo $g->cookieCallSign(); ?>"
				required
				data-placement="bottom" title="Example: 2-ADAM-1, 2A1">
			</div>
		</div>

		<h4><i class="fas fa-user-shield fa-fw"></i> Officer Details</h4>
		<div class="form-row officerGroup">
			<div class="form-group col-4">
				<label>Full Name</label>
				<input
				class="form-control"
				type="text"
				id="inputName"
				name="inputName[]"
				placeholder="Firstname Lastname"
				value="<?php echo $g->cookieName(); ?>"
				required
				data-placement="bottom" title="Officer - Full Name">
			</div>
			<div class="form-group col-3">
				<label>Rank</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
					</div>
					<select
					class="form-control"
					id="inputRank"
					name="inputRank[]"
					required>
					<option value="<?php echo $g->cookieRank(); ?>"><?php echo $g->getRank($g->cookieRank());?></option>
					<?php
						$g->rankChooser();
					?>
					</select>
				</div>
			</div>
			<div class="form-group col-2">
				<label>Badge</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-hashtag"></i></span>
					</div>
					<input
					class="form-control" 
					type="number"
					id="inputBadge"
					name="inputBadge[]"
					placeholder="####"
					value="<?php echo $g->cookieBadge(); ?>"
					required
					data-placement="bottom" title="Officer - Badge">
				</div>
			</div>
			<div class="form-group col-1">
				<label>Options</label>
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addOfficer"><i class="fas fa-plus-square"></i> Slot</a>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-clipboard fa-fw"></i> Defendant & Narrative</h4>
		<div class="form-row">
			<div class="form-group col-4">
				<label>Full Name</label>
				<input
				type="text"
				class="form-control"
				id="inputDefName"
				name="inputDefName"
				placeholder="Firstname Lastname"
				required
				data-placement="bottom" title="Defendant - Full Name">
			</div>
			<div class="form-group col-2">
				<label>Drivers License</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-id-card"></i></span>
					</div>
					<select
					class="form-control"
					id="inputDefLicense"
					name="inputDefLicense"
					required>
					<?php
						$tr->licenseChooser();
					?>
					</select>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-6">
				<label>Narrative & Notes</label>
				<textarea
				class="form-control"
				id="inputNarrative"
				name="inputNarrative"
				rows="4"
				placeholder="Witnessed the defendant to be X on the X street.
The defendant was found to be X."
				required></textarea>
				<small id="helpDashcam" class="form-text text-muted">Enter as much detail as possible in regards to the traffic stop, what was witnessed by the officer, whether the defendant complied and was respectful, items of interest in the vehicle's cabin, occupancy.</small>
			</div>
			<div class="form-group col-6">
				<label>Dashboard Camera</label>
				<textarea
				class="form-control"
				id="inputDashcam"
				name="inputDashcam"
				rows="4"
				placeholder="The dashboard camera would pick up on the defendant to be X on the X street."></textarea>
				<small id="helpDashcam" class="form-text text-muted">(( Dashboard camera roleplay. - Do not include "/do" or " * ". - <b style="color: darkred;">Lying in this section will lead to punishments</b>. Enter as much detail as possible in regards to what the dashboard camera would capture on video and audio. ))</small>
			</div>
		</div>

		<h4><i class="fas fa-car fa-fw"></i> Vehicle Details</h4>
		<div class="form-row">
			<div class="form-group col-4">
				<label>Make & Model</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-car"></i></span>
					</div>
					<input
					class="form-control"
					type="text"
					id="inputVeh"
					name="inputVeh"
					placeholder="Make & Model"
					list="vehicle_list"
					required
					data-placement="bottom" title="Example: Benefactor Schwartzer">
					<datalist id="vehicle_list">
					<?php
						$tr->vehicleChooser();
					?>
					</datalist>
				</div>
			</div>
			<div class="form-group col-2">
				<label>Paint</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-spray-can"></i></span>
					</div>
					<input
					type="text"
					class="form-control"
					id="inputVehPaint"
					name="inputVehPaint"
					placeholder="Paint"
					required
					data-placement="bottom" title="Example: Silver, Red, Black">
				</div>
			</div>
			<div class="form-group col-3">
				<label>Identification Plate</label>
				<input
				type="text"
				class="form-control"
				id="inputVehPlate"
				name="inputVehPlate"
				placeholder="Identification Plate"
				data-placement="bottom" title="Leave empty if unregistered.">
			</div>
			<div class="form-group col-2">
				<label>Tint Level</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-adjust"></i></span>
					</div>
					<select
					class="form-control"
					id="inputVehTint"
					name="inputVehTint"
					required>
					<?php
						$tr->tintChooser();
					?>
					</select>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-map-marked-alt fa-fw"></i> Location Details</h4>
		<div class="form-row">
			<div class="form-group col-4">
				<label>District</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-map-marked-alt"></i></span>
					</div>
					<input
					class="form-control"
					type="text"
					id="inputDistrict"
					name="inputDistrict"
					placeholder="District"
					list="district_list"
					required
					data-placement="bottom" title="Location - District">
					<datalist id="district_list">
					<?php
						$tr->districtChooser();
					?>
					</datalist>
				</div>
			</div>
			<div class="form-group col-4">
				<label>Street Name</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-road"></i></span>
					</div>
					<input
					class="form-control"
					type="text"
					id="inputStreet"
					name="inputStreet"
					placeholder="Street Name"
					list="street_list"
					required
					data-placement="bottom" title="Location - Street Name">
					<datalist id="street_list">
					<?php
						$tr->streetChooser();
					?>
					</datalist>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-receipt fa-fw"></i> Charges</h4>
		<div class="form-row citationGroup">
			<div class="form-group col-6">
				<label>Crime ID, Title, & Classification</label>
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
						$tr->chargeChooser();
					?>
					</select>
				</div>
			</div>
			<div class="form-group col-2">
				<label>Crime Type</label>
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
			<div class="form-group col-2">
				<label>Fine</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-dollar-sign"></i></span>
					</div>
					<input
					type="number"
					class="form-control"
					id="inputCrimeFine"
					name="inputCrimeFine[]"
					placeholder="####"
					data-placement="bottom" title="Leave empty if none.">
				</div>
			</div>
			<div class="form-group col-2">
				<label>Options</label>
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addCitation"><i class="fas fa-plus-square fa-fw"></i> Citation</a>
				</div>
			</div>
		</div>
		<div class="container my-5 text-center">
		<button id="submit" type="submit" name="submit" class="btn btn-primary px-5"><i class="fas fa-plus-square fa-fw"></i>Submit</button>
	</div>
	</form>

	<div class="container fieldGroupCopy" style="display: none;">
		<div class="form-group col-4">
			<input
			class="form-control"
			type="text"
			id="inputName"
			name="inputName[]"
			placeholder="Firstname Lastname"
			required>
		</div>
		<div class="form-group col-3">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
				</div>
				<select
				class="form-control"
				id="inputRank"
				name="inputRank[]"
				required>
				<?php
					$g->rankChooser();
				?>
				</select>
			</div>
		</div>
		<div class="form-group col-2">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-fw fa-hashtag"></i></span>
				</div>
				<input
				class="form-control" 
				type="number"
				id="inputBadge"
				name="inputBadge[]"
				placeholder="####"
				required>
			</div>
		</div>
		<div class="form-group col-1">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeOfficer" type="button" id="button-addon2"><i class="fas fa-minus-square"></i> Slot</button>
			</div>
		</div>
	</div>

	<div class="container fieldCitationCopy" style="display: none;">
		<div class="form-group col-6">
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
					$tr->chargeChooser();
				?>
				</select>
			</div>
		</div>
		<div class="form-group col-2">
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
		<div class="form-group col-2">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-fw fa-dollar-sign"></i></span>
				</div>
				<input
				type="number"
				class="form-control"
				id="inputCrimeFine"
				name="inputCrimeFine[]"
				placeholder="####">
			</div>
		</div>
		<div class="form-group col-2">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeCitation" type="button" id="button-addon2"><i class="fas fa-minus-square"></i> Citation</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var maxSlots = 4;
		$(".addOfficer").click(function(){
			if($('body').find('.officerGroup').length < maxSlots){
				var fieldHTML = '<div class="form-row officerGroup">'+$(".fieldGroupCopy").html()+'</div>';
				$('body').find('.officerGroup:last').after(fieldHTML);
			}else{
				alert('Maximum '+maxSlots+' officer slots are allowed.');
			}
		});

		$("body").on("click",".removeOfficer",function(){ 
			$(this).parents(".officerGroup").remove();
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		var maxCitations = 10;
		$(".addCitation").click(function(){
			if($('body').find('.citationGroup').length < maxCitations){
				var fieldHTML = '<div class="form-row citationGroup">'+$(".fieldCitationCopy").html()+'</div>';
				$('body').find('.citationGroup:last').after(fieldHTML);
			}else{
				alert('Maximum '+maxCitations+' citation slots are allowed.');
			}
		});

		$("body").on("click",".removeCitation",function(){ 
			$(this).parents(".citationGroup").remove();
		});
	});
</script>

<script>
	$(document).ready(function(){
		$('input').tooltip();
	});
</script>