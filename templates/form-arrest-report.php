<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-landmark mr-2"></i>Sentencing Charges</h1>
	<?php
		require_once('form-arrest-charge-table.php');
	?>
	<h1><i class="fas fa-fw fa-landmark mr-2"></i>Arrest Report - Form</h1>
	<hr>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="ArrestReport">

		<h4><i class="fas fa-fw fa-archive mr-2"></i>General Details</h4>
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
					value="<?= $g->getUNIX('date') ?>"
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
					value="<?= $g->getUNIX('time'); ?>"
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
				value="<?= $g->findCookie('callSign') ?>"
				required
				data-placement="bottom" title="Example: 2-ADAM-1, 2A1">
			</div>
		</div>

		<h4><i class="fas fa-fw fa-user-shield mr-2"></i>Officer Details</h4>
		<div class="form-row officerGroup">
			<div class="form-group col-xl-4">
				<label>Full Name</label>
				<input
				class="form-control"
				type="text"
				id="inputName"
				name="inputName[]"
				placeholder="Firstname Lastname"
				value="<?= $g->findCookie('officerName') ?>"
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
					class="form-control selectpicker"
					id="inputRank"
					name="inputRank[]"
					required>
					<?php
						$pg->rankChooser(1);
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
					value="<?= $g->findCookie('officerBadge') ?>"
					required
					data-placement="bottom" title="Officer - Badge">
				</div>
			</div>
			<div class="form-group col-xl-1">
				<label>Options</label>
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addOfficer">
						<i class="fas fa-fw fa-plus-square mr-1"></i>Slot</a>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-fw fa-clipboard mr-2"></i>Arrest & Suspect Details</h4>

		<div class="form-row">
			<div class="form-group col-xl-4">
				<label>Suspect's Full Name</label>
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
					<?= $ar->listChooser('districtsList') ?>
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
					<?= $ar->listChooser('streetsList') ?>
					</datalist>
				</div>
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

		
		<h4><i class="fas fa-fw fa-fingerprint mr-2"></i>Evidence</h4>
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
		
		<h4><i class="fas fa-fw fa-landmark mr-2"></i>Processing Details</h4>
		<div class="form-row">
			<div class="form-group col-xl-4">
				<label>Wristband</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-tag"></i></span>
					</div>
					<select
					class="form-control selectpicker"
					id="inputWristband"
					name="inputWristband"
					required>
					<?=	$ar->listChooser('wristbandList'); ?>
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
					class="form-control selectpicker"
					id="inputBracelet"
					name="inputBracelet"
					required>
					<?=	$ar->listChooser('braceletList'); ?>
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
					class="form-control selectpicker"
					id="inputPlea"
					name="inputPlea"
					required>
					<?=	$ar->listChooser('pleaList'); ?>
					</select>
				</div>
				<small class="form-text text-muted">
					Please remember to ask for GTA:W forum name if pleading <strong>Not Guilty</strong> or <strong>No Contest</strong>.
				</small>
			</div>
		</div>
		
		<div class="container my-5 text-center">
			<button id="submit" type="submit" name="submit" class="btn btn-primary px-5">
				<i class="fas fa-fw fa-plus-square mr-1"></i>Submit
			</button>
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
				class="form-control select-picker-copy"
				id="inputRank"
				name="inputRank[]"
				required>
				<?php
					$pg->rankChooser(0);
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
				<button class="btn btn-danger w-100 removeOfficer" type="button" id="button-addon2">
					<i class="fas fa-fw fa-minus-square mr-1"></i>Slot
				</button>
			</div>
		</div>
	</div>
</div>

<?php

	require_once 'form-footer.php';

?>
