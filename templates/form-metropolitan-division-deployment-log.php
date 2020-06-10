<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><img class="mr-2 align-bottom" src="/images/divisions/metro.png" height="40px">Metro Deployment Log - Form</h1>
	<h6><a target="_blank" rel="noopener noreferrer" href="https://lspd.gta.world/viewforum.php?f=646">Metro Division: Deployment Records - Category<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i></a></h6>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="MetroDeploymentLog">
		<hr>
		<h4><i class="fas fa-fw fa-archive mr-2"></i>Section I - General Information</h4>
		<div class="form-row">
		<?php
			// Form - List - Partner's Rank
			$c->form('list', 'forms', array(
				'size' => '6',
				'label' => '<label>Involved Platoons</label>',
				'icon' => 'users',
				'class' => 'selectpicker',
				'id' => 'inputInvolvedPlatoons',
				'name' => 'inputInvolvedPlatoons[]',
				'attributes' => 'required multiple',
				'title' => 'Select Platoons',
				'list' => $pg->listChooser('metroPlatoonList'),
				'hint' => '',
				'hintClass' => ''
			));
		?>
		</div>
		<div class="form-row">
		<?php
			// Form - Textfield - Incident Commander's Name
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'text',
				'label' => '<label>Incident Commander</label>',
				'icon' => 'id-card',
				'class' => '',
				'id' => 'inputIncidentCommander',
				'name' => 'inputIncidentCommander',
				'value' => '',
				'placeholder' => 'Firstname Lastname',
				'tooltip' => 'Leave empty if not applicable.',
				'attributes' => '',
				'style' => ''
			));
			// Form - List - Incident Commander's Rank
			$c->form('list', 'forms', array(
				'size' => '3',
				'label' => '<label>Rank</label>',
				'icon' => 'user-shield',
				'class' => 'selectpicker',
				'id' => 'inputIncidentCommanderRank',
				'name' => 'inputIncidentCommanderRank',
				'attributes' => '',
				'title' => 'Select Rank',
				'list' => $pg->rankChooser(0),
				'hint' => '',
				'hintClass' => ''
			));
		?>
		</div>
		<div class="form-row">
		<?php
			// Form - Textfield - Crisis Negotiator's Name
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'text',
				'label' => '<label>Crisis Negotiator</label>',
				'icon' => 'id-card',
				'class' => '',
				'id' => 'inputCrisisNegotiator',
				'name' => 'inputCrisisNegotiator',
				'value' => '',
				'placeholder' => 'Firstname Lastname',
				'tooltip' => 'Leave empty if not applicable.',
				'attributes' => '',
				'style' => ''
			));
			// Form - List - Crisis Negotiator's Rank
			$c->form('list', 'forms', array(
				'size' => '3',
				'label' => '<label>Rank</label>',
				'icon' => 'user-shield',
				'class' => 'selectpicker',
				'id' => 'inputCrisisNegotiatorRank',
				'name' => 'inputCrisisNegotiatorRank',
				'attributes' => '',
				'title' => 'Select Rank',
				'list' => $pg->rankChooser(0),
				'hint' => '',
				'hintClass' => ''
			));
		?>
		</div>
		<div class="form-row teamLeaderGroup">
		<?php
			// Form - Textfield - Platoon Team Leader's Name
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'text',
				'label' => '<label>Platoon Team Leader(s)</label>',
				'icon' => 'id-card',
				'class' => '',
				'id' => 'inputPlatoonTeamLeaderName',
				'name' => 'inputPlatoonTeamLeaderName[]',
				'value' => '',
				'placeholder' => 'Firstname Lastname',
				'tooltip' => 'Platoon Team Leader - Firstname Lastname',
				'attributes' => 'required',
				'style' => ''
			));
			// Form - List - Platoon Team Leader's Rank
			$c->form('list', 'forms', array(
				'size' => '4',
				'label' => '<label>Divisional Rank</label>',
				'icon' => 'user-shield',
				'class' => 'selectpicker',
				'id' => 'inputPlatoonTeamLeaderRank',
				'name' => 'inputPlatoonTeamLeaderRank[]',
				'attributes' => 'required',
				'title' => 'Select Divisional Rank',
				'list' => $pg->divisionalRankChooser(),
				'hint' => '',
				'hintClass' => ''
			));
			// Form - Options Add - Platoon Team Leader
			$c->form('options', 'forms', array(
				'size' => '3',
				'label' => '<label>Options</label>',
				'action' => 'addPlatoonTeamLeader',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Platoon Team Leader'
			));
		?>
		</div>
		<div class="form-row">
		<?php
			// Form - List - First Responding Officer's Rank
			$c->form('list', 'forms', array(
				'size' => '6',
				'label' => '<label>Deployment Type</label>',
				'icon' => 'clipboard-list',
				'class' => 'selectpicker',
				'id' => 'inputDeploymentType',
				'name' => 'inputDeploymentType',
				'attributes' => 'required',
				'title' => 'Select Deployment Type',
				'list' => $pg->listChooser('metroDeploymentTypes'),
				'hint' => '',
				'hintClass' => ''
			));
		?>
		</div>
	<hr>
	<h4><i class="fas fa-fw fa-hourglass mr-2"></i>Section II - Deployment Timeline</h4>
	<div class="form-row">
	<?php
		// Form - Textfield - Deployment Date
		$c->form('textfield', 'forms', array(
			'size' => '2',
			'type' => 'text',
			'label' => '<label>Date</label>',
			'icon' => 'calendar',
			'class' => '',
			'id' => 'inputDate',
			'name' => 'inputDate',
			'value' => $g->getUNIX('date'),
			'placeholder' => 'DD/MMM/YYYY',
			'tooltip' => 'DD/MMM/YYYY Format',
			'attributes' => 'required',
			'style' => 'text-transform: uppercase;'
		));
		// Form - Textfield - Deployment Start Time
		$c->form('textfield', 'forms', array(
			'size' => '2',
			'type' => 'text',
			'label' => '<label>Deployment Start Time</label>',
			'icon' => 'clock',
			'class' => '',
			'id' => 'inputDeploymentTimeStart',
			'name' => 'inputDeploymentTimeStart',
			'value' => $g->getUNIX('time'),
			'placeholder' => '00:00',
			'tooltip' => '00:00 Format',
			'attributes' => 'required',
			'style' => 'text-transform: uppercase;'
		));
		// Form - Textfield - Deployment End Time
		$c->form('textfield', 'forms', array(
			'size' => '2',
			'type' => 'text',
			'label' => '<label>Deployment End Time</label>',
			'icon' => 'clock',
			'class' => '',
			'id' => 'inputDeploymentTimeEnd',
			'name' => 'inputDeploymentTimeEnd',
			'value' => '',
			'placeholder' => '24:00',
			'tooltip' => '00:00 Format',
			'attributes' => 'required',
			'style' => 'text-transform: uppercase;'
		));
	?>
	</div>
	<div class="form-row">
	<?php
		// Form - Textfield - Deployment Start Time
		$c->form('textfield', 'forms', array(
			'size' => '4',
			'type' => 'text',
			'label' => '<label>Location / Trace Number</label>',
			'icon' => 'map-marker-alt',
			'class' => '',
			'id' => 'inputLocation',
			'name' => 'inputLocation',
			'value' => '',
			'placeholder' => '#, Street Name, District / ###-###',
			'tooltip' => 'Enter location or trace number of deployment.',
			'attributes' => 'required',
			'style' => ''
		));
	?>
	</div>
	<hr>
	<div class="form-row groupMDDeploymentEvent">
	<?php
		// Form - Options Add - Deployment Events
		$c->form('options', 'forms', array(
			'size' => '3',
			'label' => '<label>Deployment Events</label>',
			'action' => 'addMDDeploymentEvent',
			'colour' => 'success',
			'icon' => 'fa-plus-square',
			'text' => 'Deployment Event'
		));
	?>
	</div>
	<hr>
	<h4><i class="fas fa-fw fa-user-injured mr-2"></i>Section III - Casualty & Injury Information</h4>
	<div class="form-row groupInjuredTeamMember">
	<?php
		// Form - Options Add - Deployment Events
		$c->form('options', 'forms', array(
			'size' => '3',
			'label' => '<label>Injured Team Personnels</label>',
			'action' => 'addInjuredTeamMember',
			'colour' => 'success',
			'icon' => 'fa-plus-square',
			'text' => 'Injured Team Personnel'
		));
	?>
	</div>
	<hr>
	<div class="form-row">
	<?php
		// Form - Textfield - Suspect Casualties
		$c->form('textfield', 'forms', array(
			'size' => '3',
			'type' => 'number',
			'label' => '<label>Suspect Casualties</label>',
			'icon' => 'user-tag',
			'class' => '',
			'id' => 'inputCasualtiesSuspect',
			'name' => 'inputCasualtiesSuspect',
			'value' => '',
			'placeholder' => '#',
			'tooltip' => 'Suspect Casualties Count',
			'attributes' => '',
			'style' => ''
		));
		// Form - Textfield - Civilian Casualties
		$c->form('textfield', 'forms', array(
			'size' => '3',
			'type' => 'number',
			'label' => '<label>Civilian Casualties</label>',
			'icon' => 'user-tag',
			'class' => '',
			'id' => 'inputCasualtiesCivilian',
			'name' => 'inputCasualtiesCivilian',
			'value' => '',
			'placeholder' => '#',
			'tooltip' => 'Civilian Casualties Count',
			'attributes' => '',
			'style' => ''
		));
	?>
	</div>
	<hr>
	<h4><i class="fas fa-fw fa-clipboard mr-2"></i>Other Details</h4>
	<div class="form-row">
	<?php
		// Form - Textfield - Suspect Casualties
		$c->form('textfield', 'forms', array(
			'size' => '6',
			'type' => 'text',
			'label' => '<label>Signature</label>',
			'icon' => 'signature',
			'class' => '',
			'id' => 'inputSignature',
			'name' => 'inputSignature',
			'value' => '',
			'placeholder' => 'F. Lastname or https://i.imgur.com/abc123.png',
			'tooltip' => 'Forum Signature',
			'attributes' => '',
			'style' => ''
		));
	?>
	</div>
</div>

<!-- COPY SLOTS -->

<!-- TEAM LEADER COPY SLOT -->
<div class="form-row teamLeaderGroupCopy" style="display: none;">
<?php
	// Form - Textfield - Platoon Team Leader's Name
	$c->form('textfield', 'forms', array(
		'size' => '4',
		'type' => 'text',
		'label' => '',
		'icon' => 'id-card',
		'class' => '',
		'id' => 'inputPlatoonTeamLeaderName',
		'name' => 'inputPlatoonTeamLeaderName[]',
		'value' => '',
		'placeholder' => 'Firstname Lastname',
		'tooltip' => 'Platoon Team Leader - Firstname Lastname',
		'attributes' => 'required',
		'style' => ''
	));
	// Form - List - Platoon Team Leader's Rank
	$c->form('list', 'forms', array(
		'size' => '4',
		'label' => '',
		'icon' => 'user-shield',
		'class' => 'select-picker-copy',
		'id' => 'inputPlatoonTeamLeaderRank',
		'name' => 'inputPlatoonTeamLeaderRank[]',
		'attributes' => 'required',
		'title' => 'Select Divisional Rank',
		'list' => $pg->divisionalRankChooser(),
		'hint' => '',
		'hintClass' => ''
	));
	// Form - Options Remove - Platoon Team Leader
	$c->form('options', 'forms', array(
		'size' => '3',
		'label' => '',
		'action' => 'removePlatoonTeamLeader',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Platoon Team Leader'
	));
?>
</div>

<!-- DEPLOYMENT EVENT COPY SLOT -->
<div class="form-row groupCopyMDDeploymentEvent" style="display: none;">
<?php
	// Form - Textfield - Deployment Event
	$c->form('textfield', 'forms', array(
		'size' => '9',
		'type' => 'text',
		'label' => '',
		'icon' => 'calendar-day',
		'class' => '',
		'id' => 'inputDeploymentEvent',
		'name' => 'inputDeploymentEvent[]',
		'value' => '',
		'placeholder' => 'Deployment Event Detail',
		'tooltip' => 'Deployment Event Detail',
		'attributes' => 'required',
		'style' => ''
	));
	// Form - Options Remove - Deployment Events
	$c->form('options', 'forms', array(
		'size' => '3',
		'label' => '',
		'action' => 'removeMDDeploymentEvent',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Deployment Event'
	));
?>
</div>

<!-- Injured Team Personnel Slot -->
<div class="form-row copyGroupInjuredTeamMember" style="display: none;">
<?php
	// Form - Textfield - Platoon Team Leader's Name
	$c->form('textfield', 'forms', array(
		'size' => '4',
		'type' => 'text',
		'label' => '',
		'icon' => 'id-card',
		'class' => '',
		'id' => 'inputInjuredTeamName',
		'name' => 'inputInjuredTeamName[]',
		'value' => '',
		'placeholder' => 'Firstname Lastname',
		'tooltip' => 'Injured Team Personnel - Firstname Lastname',
		'attributes' => 'required',
		'style' => ''
	));
	// Form - List - Platoon Team Leader's Rank
	$c->form('list', 'forms', array(
		'size' => '4',
		'label' => '',
		'icon' => 'user-shield',
		'class' => 'select-picker-copy',
		'id' => 'inputInjuredTeamRank',
		'name' => 'inputInjuredTeamRank[]',
		'attributes' => 'required',
		'title' => 'Select Divisional Rank',
		'list' => $pg->divisionalRankChooser(),
		'hint' => '',
		'hintClass' => ''
	));
	// Form - Options Remove - Injured Team Personnel
	$c->form('options', 'forms', array(
		'size' => '3',
		'label' => '',
		'action' => 'removeInjuredTeamMember',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Injured Team Personnel'
	));
?>
</div>

<?php require_once 'form-footer.php'; ?>