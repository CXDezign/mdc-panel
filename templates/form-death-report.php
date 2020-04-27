<div class="container mb-5 pb-5" data-aos="fade-in" data-aos-duration="1000">
	<h1><i class="fas fa-fw fa-skull mr-2"></i>Death Report - Form</h1>
	<h6><a target="_blank" href="https://lspd.gta.world/viewtopic.php?f=1356&t=25509">Death Reports - Thread<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i></a></h6>
	<hr>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="DeathReport">

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
					placeholder="00:00"
					value="<?php echo $g->getTime(); ?>"
					required
					data-placement="bottom" title="24-Hour Format - 00:00">
				</div>
			</div>
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
					required>
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
					required>
					<datalist id="street_list">
					<?php
						$pg->streetChooser();
					?>
					</datalist>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-fw fa-skull mr-2"></i>Deceased Information</h4>
		<div class="form-row">
			<div class="form-group col-xl-4">
				<label>Full Name</label>
				<input
				class="form-control"
				type="text"
				id="inputDeathName"
				name="inputDeathName"
				placeholder="Firstname Lastname"
				data-placement="bottom" title="Leave empty if unknown.">
			</div>
			<div class="form-group col-xl-8">
				<label>Death Determination</label>
				<textarea
				class="form-control"
				id="inputDeathReason"
				name="inputDeathReason"
				rows="1"
				placeholder="Apparent Cause of Death"></textarea>
			</div>
		</div>


		<h4><i class="fas fa-eye fa-fw mr-2"></i>Witnesses Information</h4>
		<div class="form-row groupWitness">
			<div class="form-group col-xl-4">
				<label>Full Name</label>
				<input
				class="form-control"
				type="text"
				id="inputWitnessName"
				name="inputWitnessName[]"
				placeholder="Firstname Lastname"
				data-placement="bottom" title="Leave empty if none.">
			</div>
			<div class="form-group col-xl-2">
				<label>Options</label>
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addWitness">
						<i class="fas fa-fw fa-plus-square mr-1"></i>Witness
					</a>
				</div>
			</div>
		</div>


		<h4><i class="fas fa-fw fa-clipboard mr-2"></i>Administrative Information</h4>
		<div class="form-row">
			<div class="form-group col-xl-4">
				<label>First Responding Officer</label>
				<input
				class="form-control"
				type="text"
				id="inputRespondingName"
				name="inputRespondingName"
				placeholder="Firstname Lastname"
				required
				data-placement="bottom" title="First Responding Officer - Full Name">
			</div>
			<div class="form-group col-xl-md-3">
				<label>Rank</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
					</div>
					<select
					class="form-control"
					id="inputRespondingRank"
					name="inputRespondingRank"
					required>
					<?php
						$pg->rankChooser(0);
					?>
					</select>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-xl-4">
				<label>Handling Detective / Foresnsic Analyst</label>
				<input
				class="form-control"
				type="text"
				id="inputHandlingName"
				name="inputHandlingName"
				placeholder="Firstname Lastname"
				data-placement="bottom" title="Leave empty if none.">
			</div>
			<div class="form-group col-xl-md-3">
				<label>Rank</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
					</div>
					<select
					class="form-control"
					id="inputHandlingRank"
					name="inputHandlingRank"
					required>
					<?php
						$pg->rankChooser(0);
					?>
					</select>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-xl-4">
				<label>Handling Coroner</label>
				<input
				class="form-control"
				type="text"
				id="inputCoronerName"
				name="inputCoronerName"
				placeholder="Firstname Lastname"
				data-placement="bottom" title="Leave empty if none.">
			</div>
			<div class="form-group col-xl-2">
				<label>Coroner Case Number</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-hashtag"></i></span>
					</div>
					<input
					class="form-control" 
					type="text"
					id="inputCaseNumber"
					name="inputCaseNumber"
					placeholder="####"
					data-placement="bottom" title="Leave empty if unknown.">
				</div>
			</div>
			<div class="form-group col-xl-6">
				<label>Relevant MDC record</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-link"></i></span>
					</div>
					<input
					class="form-control"
					type="text"
					id="inputRecord"
					name="inputRecord"
					placeholder="https://mdc.gta.world"
					data-placement="bottom" title="Leave empty if none.">
				</div>
			</div>
		</div>

		<h4><i class="fas fa-fw fa-camera mr-2"></i>Evidence</h4>
		<div class="form-row groupEvidence">
			<div class="form-group col-xl-2">
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addEvidenceImage">
						<i class="fas fa-fw fa-plus-square mr-1"></i>Photograph
					</a>
				</div>
			</div>
			<div class="form-group col-xl-2">
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addEvidenceBox">
						<i class="fas fa-fw fa-plus-square mr-1"></i>Description
					</a>
				</div>
			</div>
		</div>

		<div class="container my-5 text-center">
			<button id="submit" type="submit" name="submit" class="btn btn-primary px-5">
				<i class="fas fa-fw fa-plus-square mr-1"></i>Submit
			</button>
		</div>
	</form>


	<!-- COPY SLOTS -->


	<div class="container groupCopyWitness" style="display: none;">
		<div class="form-group col-xl-4">
			<input
			class="form-control"
			type="text"
			id="inputWitnessName"
			name="inputWitnessName[]"
			placeholder="Firstname Lastname">
		</div>
		<div class="form-group col-xl-2">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeWitness" type="button" id="button-addon2">
					<i class="fas fa-fw fa-minus-square mr-1"></i>Witness
				</button>
			</div>
		</div>
	</div>

	<div class="container groupCopyImage" style="display: none;">
		<div class="form-group col-xl-10">
			<input
			class="form-control"
			type="text"
			id="inputEvidenceImage"
			name="inputEvidenceImage[]"
			placeholder="https://imgur.com">
		</div>
		<div class="form-group col-xl-2">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeImage" type="button" id="button-addon2">
					<i class="fas fa-fw fa-minus-square mr-1"></i>Photograph
				</button>
			</div>
		</div>
	</div>

	<div class="container groupCopyBox" style="display: none;">
		<div class="form-group col-xl-10">
			<textarea
			class="form-control"
			id="inputEvidenceBox"
			name="inputEvidenceBox[]"
			rows="1"
			placeholder="Brief Description"></textarea>
		</div>
		<div class="form-group col-xl-2">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeBox" type="button" id="button-addon2">
					<i class="fas fa-fw fa-minus-square mr-1"></i>Description
				</button>
			</div>
		</div>
	</div>


</div>

<?php
	require "form-footer.php";
?>