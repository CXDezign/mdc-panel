<div class="container mb-5 pb-5">
	<h1 class="mt-3">Death Report - Form</h1>
	<h6 class="mb-4"><a target="_blank" href="https://lspd.gta.world/viewtopic.php?f=1356&t=25509">Death Reports - Thread</a></h6>
	<form action="controllers/deathReportFormProcessor.inc.php" method="POST">


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
						$tr->districtChooser();
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
						$tr->streetChooser();
					?>
					</datalist>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-skull fa-fw"></i> Deceased Information</h4>
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
				placeholder="Apparent Cause of Death"
				required></textarea>
			</div>
		</div>


		<h4><i class="fas fa-eye fa-fw"></i> Witnesses Information</h4>
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
					<a href="javascript:void(0)" class="btn btn-success w-100 addWitness"><i class="fas fa-plus-square fa-fw"></i> Witness</a>
				</div>
			</div>
		</div>


		<h4><i class="fas fa-clipboard fa-fw"></i> Administrative Information</h4>
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
						$g->rankChooser();
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
						$g->rankChooser();
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


		<h4><i class="fas fa-camera fa-fw"></i> Evidence</h4>
		<div class="form-row groupEvidence">
			<div class="form-group col-xl-2">
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addImage"><i class="fas fa-plus-square fa-fw"></i> Photograph</a>
				</div>
			</div>
			<div class="form-group col-xl-2">
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addBox"><i class="fas fa-plus-square fa-fw"></i> Description</a>
				</div>
			</div>
		</div>


		<div class="container my-5 text-center">
		<button id="submit" type="submit" name="submit" class="btn btn-primary px-5"><i class="fas fa-plus-square fa-fw"></i>Submit</button>
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
				<button class="btn btn-danger w-100 removeWitness" type="button" id="button-addon2"><i class="fas fa-minus-square"></i> Witness</button>
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
				<button class="btn btn-danger w-100 removeImage" type="button" id="button-addon2"><i class="fas fa-minus-square"></i> Photograph</button>
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
				<button class="btn btn-danger w-100 removeBox" type="button" id="button-addon2"><i class="fas fa-minus-square"></i> Description</button>
			</div>
		</div>
	</div>


</div>


<script type="text/javascript">
	$(document).ready(function(){
		var maxWitness = 5;
		$(".addWitness").click(function(){
			if($('body').find('.groupWitness').length < maxWitness){
				var fieldHTML = '<div class="form-row groupWitness">'+$(".groupCopyWitness").html()+'</div>';
				$('body').find('.groupWitness:last').after(fieldHTML);
			}else{
				alert('Maximum '+maxWitness+' witnesses are allowed.');
			}
		});

		$("body").on("click",".removeWitness",function(){ 
			$(this).parents(".groupWitness").remove();
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		var maxEvidence = 5;
		$(".addImage").click(function(){
			if($('body').find('.groupEvidence').length < maxEvidence){
				var fieldHTML = '<div class="form-row groupEvidence">'+$(".groupCopyImage").html()+'</div>';
				$('body').find('.groupEvidence:last').after(fieldHTML);
			}else{
				alert('Maximum 4 evidence slots are allowed.');
			}
		});

		$("body").on("click",".removeImage",function(){ 
			$(this).parents(".groupEvidence").remove();
		});

		$(".addBox").click(function(){
			if($('body').find('.groupEvidence').length < maxEvidence){
				var fieldHTML = '<div class="form-row groupEvidence">'+$(".groupCopyBox").html()+'</div>';
				$('body').find('.groupEvidence:last').after(fieldHTML);
			}else{
				alert('Maximum 4 evidence slots are allowed.');
			}
		});

		$("body").on("click",".removeBox",function(){ 
			$(this).parents(".groupEvidence").remove();
		});
	});
</script>
<script>
	$(document).ready(function(){
		$('input').tooltip();
	});
</script>