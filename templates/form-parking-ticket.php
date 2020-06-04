<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-parking mr-2"></i>Parking Ticket - Form</h1>
	<hr>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="ParkingTicket">


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
					required
					data-placement="bottom" title="Officer - Badge">
				</div>
			</div>
		</div>


		<h4><i class="fas fa-fw fa-camera mr-2"></i>Evidence</h4>
		<div class="form-row groupEvidence">
			<div class="form-group col-xl-10">
				<input
				class="form-control"
				type="text"
				id="inputEvidenceImage"
				name="inputEvidenceImage[]"
				placeholder="https://imgur.com"
				required>
				<small class="form-text text-muted text-center">
					Only provide direct URLs to images.
				</small>
			</div>
			<div class="form-group col-xl-2">
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addImage">
						<i class="fas fa-fw fa-plus-square mr-1"></i>Photograph
					</a>
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
					required
					data-placement="bottom" title="Example: Benefactor Schwartzer">
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
					required
					data-placement="bottom" title="Location - Street Name">
					<datalist id="street_list">
					<?= $pg->listChooser('streetsList') ?>
					</datalist>
				</div>
			</div>
		</div>


		<h4><i class="fas fa-fw fa-receipt mr-2"></i>Citation Details</h4>
		<div class="form-row citationGroup">
			<div class="form-group col-xl-10">
				<label>Reason</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-gavel"></i></span>
					</div>
					<select
					class="form-control selectpicker"
					data-live-search="true"
					id="inputReason"
					name="inputReason"
					required>
					<?php
						$pt->illegalParkingChooser();
					?>
					</select>
				</div>
			</div>
			<div class="form-group col-xl-2">
				<label>Fine</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-dollar-sign"></i></span>
					</div>
					<input
					type="number"
					class="form-control"
					id="inputFine"
					name="inputFine"
					placeholder="####"
					data-placement="bottom" title="$2,500 limit."
					required>
				</div>
			</div>
		</div>
		<div class="container my-5 text-center">
			<button id="submit" type="submit" name="submit" class="btn btn-primary px-5">
				<i class="fas fa-fw fa-plus-square mr-1"></i>Submit
			</button>
		</div>
	</form>

	<div class="container groupCopyImage" style="display: none;">
		<div class="form-group col-xl-10">
			<input
			class="form-control"
			type="text"
			id="inputEvidenceImage"
			name="inputEvidenceImage[]"
			placeholder="https://imgur.com"
			required>
		</div>
		<div class="form-group col-xl-2">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeImage" type="button" id="button-addon2">
					<i class="fas fa-fw fa-minus-square mr-1"></i>Photograph
				</button>
			</div>
		</div>
	</div>

</div>

<?php
	require_once("form-footer.php");
?>
