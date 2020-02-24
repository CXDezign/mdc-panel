<div class="container mb-5 pb-5">
	<h1 class="my-3">Patrol Log - Form</h1>
	<form action="controllers/TDPatrolReportProcessor.inc.php" method="POST">

		<h4><i class="fas fa-archive fa-fw"></i> General Details</h4>
		<div class="form-row">
			<div class="form-group col-2">
				<label>Date</label>
				<div class="input-group">
					<input
					class="form-control"
					type="text"
					id="inputDateFrom"
					name="inputDateFrom"
					placeholder="DD/MMM/YYYY"
					style="text-transform: uppercase;"
					value="<?php echo $g->getDate()?>"
					required>
				</div>
				<center><small id="helpDate" class="form-text text-muted">DD/MMM/YYYY Format</small></center>
			</div>
			<div class="form-group col-2">
				<label>Start of Patrol Time</label>
				<div class="input-group">
					<input
					class="form-control"
					type="text"
					id="inputTimeFrom"
					name="inputTimeFrom"
					placeholder="00:00"
					value="<?php echo $g->getTime()?>"
					required>
				</div>
				<center><small id="helpTime" class="form-text text-muted">24-Hour Format</small></center>	
			</div>
			<div class="form-group col-3">
				<label>Call Sign</label>
				<input
				class="form-control"
				type="text"
				id="inputCallsign"
				name="inputCallsign"
				placeholder="Call Sign"
				value="<?php echo $g->cookieCallSign(); ?>"
				required>
				<small id="helpCallSign" class="form-text text-muted">Example: 2-ADAM-1, 2A1</small>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-3">
				<label>Partner</label>
				<input
				class="form-control"
				type="text"
				id="inputPartner"
				name="inputPartner"
				placeholder="Firstname Lastname"
				required>
				<small id="helpCallSign" class="form-text text-muted">Leave blank if solo patrol</small>
			</div>
		</div>

		<h4><i class="fas fa-car fa-fw"></i> Add Events</h4>
		<div class="form-row groupSlotEvent">
			<div class="form-group col-12">
				<label>Event Options</label>
				<div class="col-12"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addSlotInfo col-2"><i class="fas fa-plus-square fa-fw"></i> Add Information</a>
					<a href="javascript:void(0)" class="btn btn-success w-100 addSlotTS col-2"><i class="fas fa-plus-square fa-fw"></i> Add Traffic Stop</a>
					<a href="javascript:void(0)" class="btn btn-success w-100 addSlotArrest col-2"><i class="fas fa-plus-square fa-fw"></i> Add Arrest</a>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-clipboard fa-fw"></i> Notes & Other Details</h4>
		<div class="form-row">
			<div class="form-group col-12">
				<textarea
				class="form-control"
				id="inputNotes"
				name="inputNotes"
				rows="2"
				placeholder="Any optional and extra notes regarding the patrol."></textarea>
			</div>
		</div>
		<div class="container my-5 text-center">
			<button id="submit" type="submit" name="submit" class="btn btn-primary px-5"><i class="fas fa-plus-square fa-fw"></i>End Patrol</button>
		</div>
	</form>

	<!-- COPY SLOTS -->

	<div class="container groupCopySlotInfo" style="display: none;">
		<h6>Information Event</h6>
		<div class="form-row col-12">
			<div class="form-group col-8">
				<input
				class="form-control"
				type="text"
				id="inputReasonInfo[]"
				name="inputReasonInfo[]"
				placeholder="EG: Code 7 MRS"
				required>
			</div>
			<div class="form-group col-2">
				<div class="input-group-addon"> 
					<button class="btn btn-danger w-100 removeSlotInfo" type="button" id="button-addon2"><i class="fas fa-minus-square"></i> Event</button>
				</div>
			</div>
		</div>
		<div class="form-row col-12">
			<hr />
		</div>
	</div>
	
	<div class="container groupCopySlotTraffic" style="display: none;">
		<h6>Traffic Stop Event</h6>
		<div class="form-row col-12">
			<div class="form-group col-4">
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
			<div class="form-group col-4">
					<input
					type="text"
					class="form-control"
					id="inputVehPlate"
					name="inputVehPlate"
					placeholder="Identification Plate"
					data-placement="bottom" title="Leave empty if unregistered.">
			</div>
		</div>
		<div class="form-row col-12">
			<div class="form-group col-4">
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
			<div class="form-group col-xl-4">
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
		<div class="form-row col-12">
			<div class="form-group col-8">
				<input
				class="form-control"
				type="text"
				id="inputReasonTS[]"
				name="inputReasonTS[]"
				placeholder="Brief explanation of Traffic Stop"
				required>
			</div>
			<div class="form-group col-2">
				<div class="input-group-addon"> 
					<button class="btn btn-danger w-100 removeSlotTS" type="button" id="button-addon2"><i class="fas fa-minus-square"></i> Event</button>
				</div>
			</div>
		</div>
		<div class="form-row col-12">
			<hr />
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var event = 1;
		// Maximum Slots
		var maxSlotInfo = 30;
		var maxSlotTraffic = 30;
		$(".addSlotInfo").click(function(){
			if($('body').find('.groupSlotEvent').length < maxSlotInfo){
				$('.groupCopySlotInfo h6').text('Information (Event #'+event+')');
				var fieldHTML = '<div class="form-row groupSlotEvent">'+$(".groupCopySlotInfo").html()+'</div>';
				$('body').find('.groupSlotEvent:last').after(fieldHTML);
				event++;
			}else{
				alert('Maximum '+maxSlotInfo+' Info slots are allowed.');
			}
		});
		
		$(".addSlotTS").click(function(){
			if($('body').find('.groupSlotEvent').length < maxSlotTraffic){
				$('.groupCopySlotTraffic h6').text('Traffic Stop (Event #'+event+')');
				var fieldHTML = '<div class="form-row groupSlotEvent">'+$(".groupCopySlotTraffic").html()+'</div>';
				$('body').find('.groupSlotEvent:last').after(fieldHTML);
				event++;
				
			}else{
				alert('Maximum '+maxSlotTraffic+' Traffic Stop slots are allowed.');
			}
		});

		$("body").on("click",".removeSlotInfo",function(){ 
			$(this).parents(".groupSlotEvent").remove();
		});
		$("body").on("click",".removeSlotTS",function(){ 
			$(this).parents(".groupSlotEvent").remove();
		});

		// Tooltips
		$('input').tooltip();

	});
</script>
