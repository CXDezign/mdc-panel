<div class="container mb-5 pb-5" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-car mr-2"></i>Impound Report - Form</h1>
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
					value="<?= $g->getDate() ?>"
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
					value="<?= $g->getTime() ?>"
					required
					data-placement="bottom" title="24-Hour Format">
				</div>
			</div>
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
						placeholder="X Days"
						required
						data-placement="bottom" title="How many days Impound">
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
					<?php
						$pg->vehicleChooser();
					?>
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
				data-placement="bottom" title="Leave empty if unregistered.">
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
					<?php
						$pg->districtChooser();
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
						$pg->streetChooser();
					?>
					</datalist>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-fw fa-receipt mr-2"></i>Charges</h4>
		<div class="form-row citationGroup">
			<div class="form-group col-xl-6">
				<label>Crime ID, Title, & Classification</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-gavel"></i></span>
					</div>
					<select
					class="form-control selectpicker"
					data-live-search="true"
					id="inputCrime"
					name="inputCrime[]"
					required>
					<?php
						$pg->chargeChooser();
					?>
					</select>
				</div>
			</div>
			<div class="form-group col-xl-2">
				<label>Crime Type</label>
				<select
				class="form-control selectpicker"
				id="inputCrimeType"
				name="inputCrimeType[]"
				required>
				<?php
					$pg->crimeTypeChooser();
				?>
				</select>
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
					id="inputCrimeFine"
					name="inputCrimeFine[]"
					placeholder="####"
					data-placement="bottom" title="Leave empty if none.">
				</div>
			</div>
			<div class="form-group col-xl-2">
				<label>Options</label>
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addCitation">
						<i class="fas fa-fw fa-plus-square mr-1"></i>Citation</a>
				</div>
			</div>
		</div>
		<div class="container my-5 text-center">
		<button id="submit" type="submit" name="submit" class="btn btn-primary px-5">
			<i class="fas fa-fw fa-plus-square mr-1"></i>Submit</button>
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
					<i class="fas fa-fw fa-minus-square mr-1"></i>Slot</button>
			</div>
		</div>
	</div>

	<div class="container fieldCitationCopy" style="display: none;">
		<div class="form-group col-xl-6">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-fw fa-gavel"></i></span>
				</div>
				<select
				class="form-control select-picker-copy"
				data-live-search="true"
				id="inputCrime"
				name="inputCrime[]"
				required>
				<?php
					$pg->chargeChooser();
				?>
				</select>
			</div>
		</div>
		<div class="form-group col-xl-2">
			<select
			class="form-control select-picker-copy"
			id="inputCrimeType"
			name="inputCrimeType[]"
			required>
			<?php
				$pg->crimeTypeChooser();
			?>
			</select>
		</div>
		<div class="form-group col-xl-2">
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
		<div class="form-group col-xl-2">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeCitation" type="button" id="button-addon2">
					<i class="fas fa-fw fa-minus-square mr-1"></i>Citation</button>
			</div>
		</div>
	</div>
</div>

<?php
	require "form-footer.php";
?>
