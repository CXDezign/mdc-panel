<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-truck-pickup mr-2"></i>Impound Report - Form</h1>
	<hr>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="ImpoundReport">

		<h4><i class="fas fa-fw fa-archive mr-2"></i>Impound Information</h4>
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
					value="<?= $g->getUNIX('time') ?>"
					required
					data-placement="bottom" title="24-Hour Format">
				</div>
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
				name="inputName"
				placeholder="Firstname Lastname"
				value="<?= $g->findCookie('officerName') ?>"
				data-placement="bottom" title="Officer - Full Name"
				required>
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
					name="inputRank"
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
					name="inputBadge"
					placeholder="####"
					value="<?= $g->findCookie('officerBadge') ?>"
					data-placement="bottom" title="Officer - Badge"
					required>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-fw fa-car mr-2"></i>Vehicle Details</h4>
		<div class="form-row">
			<div class="form-group col-xl-5">
				<label>Registered Owner</label>
				<input
				type="text"
				class="form-control"
				id="inputVehRO"
				name="inputVehRO"
				placeholder="Firstname Lastname"
				required>
			</div>
			<div class="form-group col-xl-4">
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
					data-placement="bottom" title="Example: Benefactor Schwartzer"
					required>
					<datalist id="vehicle_list">
					<?= $pg->listChooser('vehiclesList') ?>
					</datalist>
				</div>
			</div>
			<div class="form-group col-xl-3">
				<label>Identification Plate</label>
				<input
				type="text"
				class="form-control"
				id="inputVehPlate"
				name="inputVehPlate"
				placeholder="Identification Plate"
				data-placement="bottom" title="If unregistered, no paperwork must be filled out."
				required>
			</div>
		</div>

		<h4><i class="fas fa-fw fa-map-marked-alt mr-2"></i>Location Details</h4>
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
					<?= $pg->listChooser('districtsList') ?>
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
					data-placement="bottom" title="Location - Street Name"
					required>
					<datalist id="street_list">
					<?= $pg->listChooser('streetsList') ?>
					</datalist>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-fw fa-receipt mr-2"></i>Impound Details</h4>

		<div class="form-row">
			<div class="form-group col-xl-2">
				<label>Duration of Impound</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-clock"></i></span>
					</div>
					<input
					class="form-control"
					type="number"
					id="inputDuration"
					name="inputDuration"
					placeholder="#"
					data-placement="bottom" title="Duration of the impound in days."
					required>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-xl-6">
				<label>Impound Reason</label>
				<textarea
				class="form-control"
				id="inputReason"
				name="inputReason"
				rows="4"
				placeholder="Vehicle was used in the comission of a crime, see arrest report #.&#10Vehicle was obstructing the flow of traffic, see parking ticket #."
				required></textarea>
				<small class="form-text text-muted">Enter a brief and concise reason for the impounding of the above vehicle.</small>
			</div>
		</div>
		<div class="container my-5 text-center">
			<button id="submit" type="submit" name="submit" class="btn btn-primary px-5">
				<i class="fas fa-fw fa-plus-square mr-1"></i>Submit
			</button>
		</div>
	</form>
</div>

<?php
	require_once("form-footer.php");
?>
