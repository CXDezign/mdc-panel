<div class="container mb-5 pb-5">
	<h1 class="my-3">Patrol Log - Form</h1>
	<form action="/controllers/formProcessor.inc.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="PatrolLog">

		<h4><i class="fas fa-archive fa-fw mr-2"></i>General Details</h4>
		<div class="form-row">
			<div class="form-group col-xl-2">
				<label>Date</label>
				<div class="input-group">
					<input
					class="form-control"
					type="text"
					id="inputDate"
					name="inputDate"
					placeholder="DD/MMM/YYYY"
					style="text-transform: uppercase;"
					value="<?php echo $g->getDate()?>"
					required
					data-placement="bottom" title="DD/MMM/YYYY Format">
				</div>
			</div>
			<div class="form-group col-xl-2">
				<label>Patrol Start Time</label>
				<div class="input-group">
					<input
					class="form-control"
					type="text"
					id="inputTime"
					name="inputTime"
					placeholder="00:00"
					value="<?php echo $g->getTime()?>"
					required
					data-placement="bottom" title="24-Hour Format">
				</div>	
			</div>
			<div class="form-group col-xl-2">
				<label>Patrol End Time</label>
				<div class="input-group">
					<input
					class="form-control"
					type="text"
					id="inputTimeEnd"
					name="inputTimeEnd"
					placeholder="24:00"
					value=""
					required
					data-placement="bottom" title="24-Hour Format">
				</div>	
			</div>
			<div class="form-group col-xl-3">
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
		<div class="form-row">
			<div class="form-group col-xl-3">
				<label>Partner</label>
				<input
				class="form-control"
				type="text"
				id="inputPartner"
				name="inputPartner"
				placeholder="Firstname Lastname"
				data-placement="bottom" title="Leave empty if on solo patrol.">
			</div>
			<div class="form-group col-xl-3">
				<label>Partner Rank</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
					</div>
					<select
					class="form-control"
					id="inputRank"
					name="inputRank"
					>
					<?php
						$g->rankChooser();
					?>
					</select>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-car fa-fw mr-2"></i>Add Events</h4>
		<div class="form-row groupSlotEvent">
			<div class="form-group col-xl-12">
				<label>Event Options</label>
				<div class="form-row">
					<div class="col-xl-3">
						<a href="javascript:void(0)" class="btn btn-success w-100 addSlotInfo">
							<i class="fas fa-plus-square fa-fw mr-2"></i>Add Generic Event
						</a>
					</div>
					<div class="col-xl-2">
						<a href="javascript:void(0)" class="btn btn-success w-100 addSlotEventTS">
							<i class="fas fa-plus-square fa-fw mr-2"></i>Add Traffic Stop
						</a>
					</div>
					<div class="col-xl-2">
						<a href="javascript:void(0)" class="btn btn-success w-100 addSlotArrest">
							<i class="fas fa-plus-square fa-fw mr-2"></i>Add Arrest
						</a>
					</div>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-clipboard fa-fw mr-2"></i>Notes & Other Details</h4>
		<div class="form-row">
			<div class="form-group col-xl-12">
				<textarea
				class="form-control"
				id="inputNotes"
				name="inputNotes"
				rows="2"
				placeholder="Any optional and extra notes regarding the patrol."></textarea>
			</div>
		</div>
		<div class="container my-5 text-center">
			<button id="submit" type="submit" name="submit" class="btn btn-primary px-5">
				<i class="fas fa-plus-square fa-fw mr-2"></i>End Patrol
			</button>
		</div>
	</form>

	<!-- COPY SLOTS -->

	<div class="container bg-dark groupCopySlotInfo" style="display: none;">
		<div class="col-xl-12">
			<label class="font-weight-bold">Generic Event</label>
		</div>
		<input
		style="display: none;"
		type="text"
		id="type"
		name="type[]"
		value="1">
		<div class="form-group col-xl-1">
			<input
			class="form-control timeSlot"
			type="text"
			id="inputTimeEvent"
			name="inputTimeEvent[]"
			placeholder="00:00"
			required>
		</div>
		<div class="form-group col-xl-9">
			<input
			class="form-control"
			type="text"
			id="inputReasonInfo"
			name="inputReasonInfo[]"
			placeholder="Examples: Code 6 at X location, Handled emergency call ID ####, Provided perimeter on X scene."
			required>
		</div>
		<div class="form-group col-xl-2">
			<button class="btn btn-danger w-100 removeSlotInfo" type="button" id="button-addon2">
				<i class="fas fa-minus-square mr-2"></i>Event
			</button>
		</div>
		<div class="col-xl-12">
			<hr/>
		</div>
	</div>
	
	<div class="container groupCopySlotTraffic" style="display: none;">
		<div class="col-xl-12">
			<label class="font-weight-bold">Traffic Stop</label>
		</div>
		<input
		style="display: none;"
		type="text"
		id="type[]"
		name="type[]"
		value="2">
		<div class="form-group col-xl-1">
			<input
			class="form-control timeSlot"
			type="text"
			id="inputTimeEvent"
			name="inputTimeEvent[]"
			placeholder="00:00"
			required>
		</div>
		<div class="form-group col-xl-9">
			<input
			class="form-control"
			type="text"
			id="inputReasonTS"
			name="inputReasonTS[]"
			placeholder="Traffic Stop Reasoning"
			required>
		</div>
		<div class="form-group col-xl-2">
			<div class="input-group-addon">
				<button class="btn btn-danger w-100 removeSlotTS" type="button" id="button-addon2"><i class="fas fa-minus-square"></i> Event</button>
			</div>
		</div>
		<div class="form-row col-xl-12">
			<div class="form-group col-xl-4">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-car"></i></span>
					</div>
					<input
					class="form-control"
					type="text"
					id="inputVeh"
					name="inputVeh[]"
					placeholder="Make & Model"
					list="vehicle_list"
					required
					data-placement="bottom" title="Example: Benefactor Schwartzer">
					<datalist id="vehicle_list">
					<?php
						$pl->vehicleChooser();
					?>
					</datalist>
				</div>
			</div>
			<div class="form-group col-xl-4">
				<input
				type="text"
				class="form-control"
				id="inputVehPlate"
				name="inputVehPlate[]"
				placeholder="Identification Plate"
				data-placement="bottom" title="Leave empty if unregistered.">
			</div>
		</div>
		<div class="form-row col-xl-12">
			<div class="form-group col-xl-4">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-map-marked-alt"></i></span>
					</div>
					<input
					class="form-control"
					type="text"
					id="inputDistrict"
					name="inputDistrict[]"
					placeholder="District"
					list="district_list"
					required
					data-placement="bottom" title="Location - District">
					<datalist id="district_list">
					<?php
						$pl->districtChooser();
					?>
					</datalist>
				</div>
			</div>
			<div class="form-group col-xl-4">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-road"></i></span>
					</div>
					<input
					class="form-control"
					type="text"
					id="inputStreet"
					name="inputStreet[]"
					placeholder="Street Name"
					list="street_list"
					required
					data-placement="bottom" title="Location - Street Name">
					<datalist id="street_list">
					<?php
						$pl->streetChooser();
					?>
					</datalist>
				</div>
			</div>
		</div>
		<div class="col-xl-12">
			<hr/>
		</div>
	</div>
	
	<div class="container groupCopySlotArrest" style="display: none;">
		<div class="col-xl-12">
			<label class="font-weight-bold">Arrest</label>
		</div>
		<input
		style="display: none;"
		type="text"
		id="type[]"
		name="type[]"
		value="3">
		<div class="form-group col-xl-1">
			<input
			class="form-control timeSlot"
			type="text"
			id="inputTimeEvent"
			name="inputTimeEvent[]"
			placeholder="00:00"
			required>
		</div>
		<div class="form-group col-xl-4">
			<input
			class="form-control"
			type="text"
			id="inputArrestee"
			name="inputArrestee[]"
			placeholder="Firstname Lastname"
			required>
		</div>
		<div class="form-group col-xl-4">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-fw fa-hashtag"></i></span>
				</div>
				<input
				class="form-control"
				type="number"
				id="inputArrestID"
				name="inputArrestID[]"
				placeholder="Arrest Report ID"
				required>
			</div>
		</div>
		<div class="form-group col-xl-2">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeSlotArrest" type="button" id="button-addon2">
					<i class="fas fa-minus-square mr-2"></i>Event
				</button>
			</div>
		</div>
		<div class="col-xl-12">
			<hr/>
		</div>
	</div>
</div>

<?php
	require "form-footer.php";
?>
