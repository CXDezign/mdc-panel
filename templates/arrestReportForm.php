<div class="container mb-5 pb-5">
	<?php include 'templates/arrestChargeTable.php'; ?>
	<h1 class="my-3">Arrest Report - Form</h1>
	<form action="controllers/arrestReportFormProcessor.inc.php" method="POST">

		<h4><i class="fas fa-archive fa-fw"></i> General Details</h4>
		<div class="form-row">
			<div class="form-group col-xl-2">
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
			<div class="form-group col-xl-2">
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
			<div class="form-group col-xl-2">
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
			<div class="form-group col-xl-4">
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
			<div class="form-group col-xl-3">
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
			<div class="form-group col-xl-2">
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
			<div class="form-group col-xl-1">
				<label>Options</label>
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addOfficer"><i class="fas fa-plus-square"></i> Slot</a>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-map-marked-alt fa-fw"></i> Arrest Details</h4>

		<div class="form-row">
			<div class="form-group col-xl-4">
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
						$ar->districtChooser();
					?>
					</datalist>
				</div>
			</div>
			<div class="form-group col-xl-4">
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
						$ar->streetChooser();
					?>
					</datalist>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-clipboard fa-fw"></i> Suspect & Narrative</h4>
		<div class="form-row">
			<div class="form-group col-xl-4">
				<label>Full Name</label>
				<input
				type="text"
				class="form-control"
				id="inputDefName"
				name="inputDefName"
				placeholder="Firstname Lastname"
				required
				data-placement="bottom" title="Suspect - Full Name">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-xl-12">
				<label>Narrative & Notes</label>
				<textarea
				class="form-control"
				id="inputNarrative"
				name="inputNarrative"
				rows="4"
				placeholder="Witnessed the suspect to be X on the X street.
The suspect was found to be X."
				required></textarea>
				<small id="helpDashcam" class="form-text text-muted">Enter as much detail as possible in regards to the arrest, chronologically describing the events leading up to the arrest and explaining the reasoning for charging the suspect with particular charges.</small>
			</div>
		</div>
		
		<h4><i class="fas fa-fingerprint fa-fw"></i> Evidence</h4>
		<div class="form-row">
			<div class="form-group col-xl-6">
				<label>Evidence</label>
				<textarea
				class="form-control"
				id="inputEvidence"
				name="inputEvidence"
				rows="4"
				placeholder="Videos, Photographs, Links, Audio Recordings / Transcripts, Witness Statements"
				></textarea>
				<small class="form-text text-muted">
					<strong>Required if suspect pleads No Contest or Not Guilty</strong>.
					<hr>
					Enter any evidence supporting the arrest.
				</small>
			</div>
			<div class="form-group col-xl-6">
				<label>Dashboard Camera</label>
				<textarea
				class="form-control"
				id="inputDashcam"
				name="inputDashcam"
				rows="4"
				placeholder="The dashboard camera captures audio and footage displaying..."></textarea>
				<small class="form-text text-muted">
					<strong>Required if suspect pleads No Contest or Not Guilty and if dashboard camera recording is not available in the evidence section</strong>.
					<hr>
					(( Dashboard camera roleplay. - Do not include "/do" or " * ". - <b style="color: darkred;">Lying in this section will lead to punishments</b>. Enter as much detail as possible in regards to what the dashboard camera would capture on video and audio. ))
				</small>
			</div>
		</div>
		
		<h4><i class="fas fa-landmark fa-fw"></i> Processing Details</h4>
		<div class="form-row">
			
			<div class="form-group col-xl-4">
				<label>Wristband</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-tag"></i></span>
					</div>
					<select
					class="form-control"
					id="inputWristband"
					name="inputWristband"
					required>
					<option value="0" selected>N/A</option>
					<?php
						$ar->wristbandChooser();
					?>
					</select>
				</div>
				<small class="form-text text-muted">
					<strong>N/A</strong>: Only when arresting at Level I Lockups.<br>
					<hr>
					<strong><span style="color: rgba(200,0,0,255)">Red Wristband</span></strong>: Any and all violent charges.<br>
					<strong><span style="color: rgba(0,0,200,255)">Blue Wristband</span></strong>: Any and all non-violent charges.<br>
					<strong><span style="color: #FFBF40;">Yellow Wristband</span></strong>: Any and all medical related concerns. (Terminally Ill, Contageous Disease, etc).
				</small>
			</div>
			<div class="form-group col-xl-4">
				<label>Bracelet</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-tag"></i></span>
					</div>
					<select
					class="form-control"
					id="inputBracelet"
					name="inputBracelet"
					required>
					<option value="0" selected>N/A</option>
					<?php
						$ar->braceletChooser();
					?>
					</select>
				</div>
				<small class="form-text text-muted">
					<strong>N/A</strong>: Only when arresting at Level I Lockups.<br>
					<hr>
					<strong><span style="color: #808080;">White Bracelet:</span></strong> General inmate population.<br>
					<strong><span style="color: #FF8000;">Orange Bracelet:</span></strong> Juveniles (Male and Female)<br>
				</small>
			</div>
			<div class="form-group col-xl-4">
				<label>Plea</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-gavel"></i></span>
					</div>
					<select
					class="form-control"
					id="inputPlea"
					name="inputPlea"
					required>
					<?php
						$ar->pleaChooser();
					?>
					</select>
				</div>
				<small class="form-text text-muted">
					Please remember to ask for GTA:W forum name if pleading <b>Not Guilty</b> or <b>No Contest</b>.
				</small>
			</div>
		</div>
		
		<div class="container my-5 text-center">
		<button id="submit" type="submit" name="submit" class="btn btn-primary px-5"><i class="fas fa-plus-square fa-fw"></i>Submit</button>
	</div>
	</form>

	<div class="container fieldGroupCopy" style="display: none;">
		<div class="form-group col-xl-4">
			<input
			class="form-control"
			type="text"
			id="inputName"
			name="inputName[]"
			placeholder="Firstname Lastname"
			required>
		</div>
		<div class="form-group col-xl-3">
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
		<div class="form-group col-xl-2">
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
		<div class="form-group col-xl-1">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeOfficer" type="button" id="button-addon2"><i class="fas fa-minus-square"></i> Slot</button>
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

<script>
	$(document).ready(function(){
		$('input').tooltip();
	});
</script>