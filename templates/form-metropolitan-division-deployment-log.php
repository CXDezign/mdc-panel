<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><img class="mr-2 align-bottom" src="/images/divisions/metro.png" height="40px">Metro Deployment Log - Form</h1>
	<h6><a target="_blank" rel="noopener noreferrer" href="https://lspd.gta.world/viewforum.php?f=646">Metro Division: Deployment Records - Category<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i></a></h6>
	<hr>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="MetroDeploymentLog">

		<h4><i class="fas fa-fw fa-archive mr-2"></i>Section I - General Information</h4>
		<div class="form-row">
			<div class="form-group col-xl-6">
				<label>Involved Platoons</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-users"></i></span>
					</div>
					<select
					class="form-control selectpicker" multiple
					id="inputInvolvedPlatoons"
					name="inputInvolvedPlatoons[]"
					title="Select Platoons"
					required>
					<?= $pg->listChooser('metroPlatoonList') ?>
					</select>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-xl-4">
				<label>Incident Commander</label>
				<input
				class="form-control"
				type="text"
				id="inputIncidentCommander"
				name="inputIncidentCommander"
				placeholder="Firstname Lastname"
				data-placement="bottom" title="Leave empty if none.">
				<small class="form-text text-muted text-center">
					If Applicable.
				</small>
			</div>
			<div class="form-group col-xl-3">
				<label>Rank</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
					</div>
					<select
					class="form-control selectpicker"
					id="inputIncidentCommanderRank"
					name="inputIncidentCommanderRank"
					title="Select Rank">
					<?php
						$pg->rankChooser(0);
					?>
					</select>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-xl-4">
				<label>Crisis Negotiator</label>
				<input
				class="form-control"
				type="text"
				id="inputCrisisNegotiator"
				name="inputCrisisNegotiator"
				placeholder="Firstname Lastname"
				data-placement="bottom" title="Leave empty if none.">
				<small class="form-text text-muted text-center">
					If Applicable.
				</small>
			</div>
			<div class="form-group col-xl-3">
				<label>Rank</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
					</div>
					<select
					class="form-control selectpicker"
					id="inputCrisisNegotiatorRank"
					name="inputCrisisNegotiatorRank"
					title="Select Rank">
					<?php
						$pg->rankChooser(0);
					?>
					</select>
				</div>
			</div>
		</div>
		<div class="form-row teamLeaderGroup">
			<div class="form-group col-xl-4">
				<label>Platoon Team Leaders</label>
				<input
				class="form-control"
				type="text"
				id="inputPlatoonTeamLeaderName"
				name="inputPlatoonTeamLeaderName[]"
				placeholder="Firstname Lastname"
				data-placement="bottom" title="Leave empty if none."
				required>
			</div>
			<div class="form-group col-xl-4">
				<label>Divisional Rank</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
					</div>
					<select
					class="form-control selectpicker"
					id="inputPlatoonTeamLeaderRank"
					name="inputPlatoonTeamLeaderRank[]"
					title="Select Divisional Rank"
					required>
					<?=	$pg->divisionalRankChooser(); ?>
					</select>
				</div>
			</div>
			<div class="form-group col-xl-3">
				<label>Options</label>
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addPlatoonTeamLeader">
						<i class="fas fa-fw fa-plus-square mr-1"></i>Platoon Team Leader
					</a>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-xl-6">
				<label>Deployment Type</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-clipboard-list"></i></span>
					</div>
					<select
					class="form-control selectpicker"
					id="inputDeploymentType"
					name="inputDeploymentType"
					title="Select Deployment Type"
					required>
					<?= $pg->listChooser('metroDeploymentTypes') ?>
					</select>
				</div>
			</div>
		</div>

	<hr>
	<h4><i class="fas fa-fw fa-hourglass mr-2"></i>Section II - Deployment Timeline</h4>
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
				value="<?= $g->getUNIX('date') ?>"
				required
				data-placement="bottom" title="DD/MMM/YYYY Format">
			</div>
		</div>
		<div class="form-group col-xl-2">
			<label>Deployment Start Time</label>
			<div class="input-group">
				<input
				class="form-control"
				type="text"
				id="inputDeploymentTimeStart"
				name="inputDeploymentTimeStart"
				placeholder="00:00"
				value="<?= $g->getUNIX('time') ?>"
				required
				data-placement="bottom" title="24-Hour Format">
			</div>	
		</div>
		<div class="form-group col-xl-2">
			<label>Deployment End Time</label>
			<div class="input-group">
				<input
				class="form-control"
				type="text"
				id="inputDeploymentTimeEnd"
				name="inputDeploymentTimeEnd"
				placeholder="24:00"
				value=""
				required
				data-placement="bottom" title="24-Hour Format">
			</div>	
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-xl-4">
			<label>Location / Trace Number</label>
			<input
			class="form-control"
			type="text"
			id="inputLocation"
			name="inputLocation"
			placeholder="#, Street Name, District"
			list="street_list"
			required
			data-placement="bottom" title="Location - Street Name">
			<datalist id="street_list">
			<?= $pg->listChooser('streetsList') ?>
			</datalist>
		</div>
	</div>
	<hr>
	<div class="form-row groupMDDeploymentEvent">
		<div class="form-group col-xl-12">
			<label>Deployment Events</label>
			<div class="form-row">
				<div class="col-xl-3">
					<a href="javascript:void(0)" class="btn btn-success w-100 addMDDeploymentEvent">
						<i class="fas fa-fw fa-plus-square mr-1"></i>Add Deployment Event
					</a>
				</div>
			</div>
		</div>
	</div>

	<hr>
	<h4><i class="fas fa-fw fa-user-injured mr-2"></i>Section III - Casualty & Injury Information</h4>
	<div class="form-row groupInjuredTeamMember">
		<div class="form-group col-xl-3">
			<label>Injured Team Members</label>
			<div class="input-group-addon"> 
				<a href="javascript:void(0)" class="btn btn-success w-100 addInjuredTeamMember">
					<i class="fas fa-fw fa-plus-square mr-1"></i>Injured Team Member
				</a>
			</div>
		</div>
	</div>
	<hr>
	<div class="form-row">
		<div class="col-xl-3">
			<div class="form-group">
				<h5 class="text-center"><i class="fas fa-fw fa-user-tag mr-2"></i>Suspect Casualties</h5>
				<input
				class="form-control"
				type="number"
				id="inputCasualtiesSuspect"
				name="inputCasualtiesSuspect"
				placeholder="#">
			</div>
		</div>
		<div class="col-xl-3">
			<div class="form-group">
				<h5 class="text-center"><i class="fas fa-fw fa-user-tag mr-2"></i>Civilian Casualties</h5>
				<input
				class="form-control"
				type="number"
				id="inputCasualtiesCivilian"
				name="inputCasualtiesCivilian"
				placeholder="#">
			</div>
		</div>
	</div>

	<hr>
	<h4><i class="fas fa-fw fa-clipboard mr-2"></i>Other Details</h4>
	<div class="form-row">
		<div class="form-group col-xl-6">
			<label>Signature</label>
			<input
			class="form-control"
			type="text"
			id="inputSignature"
			name="inputSignature"
			value=""
			placeholder="F. Lastname or https://i.imgur.com/abc123.png">
		</div>
	</div>

	<!-- COPY SLOTS -->

	<!-- TEAM LEADER COPY SLOT -->
	<div class="form-row teamLeaderGroupCopy" style="display: none;">
		<div class="form-group col-xl-4">
			<input
			class="form-control"
			type="text"
			id="inputPlatoonTeamLeaderName"
			name="inputPlatoonTeamLeaderName"
			placeholder="Firstname Lastname"
			data-placement="bottom" title="Leave empty if none."
			required>
		</div>
		<div class="form-group col-xl-4">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
				</div>
				<select
				class="form-control select-picker-copy"
				id="inputPlatoonTeamLeaderRank"
				name="inputPlatoonTeamLeaderRank"
				title="Select Divisional Rank"
				required>
				<?= $pg->divisionalRankChooser(); ?>
				</select>
			</div>
		</div>
		<div class="form-group col-xl-3">
			<div class="input-group-addon"> 
				<a href="javascript:void(0)" class="btn btn-danger w-100 removePlatoonTeamLeader">
					<i class="fas fa-fw fa-minus-square mr-1"></i>Platoon Team Leader
				</a>
			</div>
		</div>
	</div>

	<!-- DEPLOYMENT EVENT COPY SLOT -->
	<div class="form-row groupCopyMDDeploymentEvent" style="display: none;">
		<div class="form-group col-xl-9">
			<input
			class="form-control"
			type="text"
			id="inputDeploymentEvent"
			name="inputDeploymentEvent[]"
			placeholder="Deployment Event Detail"
			required>
		</div>
		<div class="form-group col-xl-2">
			<button class="btn btn-danger w-100 removeMDDeploymentEvent" type="button">
				<i class="fas fa-fw fa-minus-square mr-1"></i>Event
			</button>
		</div>
	</div>

	<!-- INJURED TEAM MEMBER SLOT -->
	<div class="form-row copyGroupInjuredTeamMember" style="display: none;">
		<div class="form-group col-xl-4">
			<input
			class="form-control"
			type="text"
			id="inputInjuredTeamName"
			name="inputInjuredTeamName[]"
			placeholder="Firstname Lastname"
			data-placement="bottom" title="Leave empty if none."
			required>
		</div>
		<div class="form-group col-xl-4">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
				</div>
				<select
				class="form-control select-picker-copy"
				id="inputInjuredTeamRank"
				name="inputInjuredTeamRank[]"
				required
				title="Select Divisional Rank">
				<?= $pg->divisionalRankChooser(); ?>
				</select>
			</div>
		</div>
		<div class="form-group col-xl-3">
			<div class="input-group-addon">
				<a href="javascript:void(0)" class="btn btn-danger w-100 removeInjuredTeamMember">
					<i class="fas fa-fw fa-minus-square mr-1"></i>Injured Team Member
				</a>
			</div>
		</div>
	</div>







</div>

<?php
	require_once("form-footer.php");
?>