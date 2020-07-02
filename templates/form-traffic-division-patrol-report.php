<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><img class="mr-2 align-bottom" src="/images/divisions/traffic.png" height="40px">Traffic Division: Patrol Report</h1>
	<h6><a target="_blank" rel="noopener noreferrer" href="https://lspd.gta.world/viewforum.php?f=101">Traffic Division: Patrol Reports - Category<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i></a></h6>
	<hr>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="TrafficDivisionPatrolReport">

		<h4><i class="fas fa-fw fa-archive mr-2"></i>General Details</h4>
		<div class="form-row">
		<?php
			// Form - Textfield - Date Time From To
			$c->form('datetimefromto', 'forms', array(
				'dateSize' => '4',
				'timeSize' => '4',
				'dateValue' => $g->getUNIX('date'),
				'timeValue' => $g->getUNIX('time'),
				'style' => 'text-transform: uppercase;'
			));
		?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-car mr-2"></i>Patrol Details</h4>
		<div class="form-row groupSlotTDPatrolDetails">
		<?php
			// Form - Toggle - Traffic Patrol Vehicle
			$c->form('toggle', 'forms', array(
				'size' => '2',
				'label' => 'Toggle Patrol Vehicle',
				'class' => '',
				'attributes' => '',
				'id' => 'inputPatrolVehicle',
				'name' => 'inputPatrolVehicle',
				'dataOff' => "<i class='mr-1 fas fa-fw fa-adjust'></i>Marked",
				'dataOn' => "<i class='mr-1 fas fa-fw fa-adjust'></i>Unmarked",
				'dataOffStyle' => 'light',
				'dataOnStyle' => 'dark',
				'dataWidth' => '160',
				'dataHeight' => '38',
			));
		?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-car mr-2"></i>Traffic Stops</h4>
		<div class="form-row groupSlotTDTrafficStop">
		<?php
			// Form - Options Add - Traffic Stop Slot
			$c->form('options', 'forms', array(
				'size' => '2',
				'label' => '',
				'action' => 'addSlotTS',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Traffic Stop'
			));
		?>
		</div>
		<hr>
		<div class="form-row">
		<?php
			// Form - Textfield - Vehicle Impounds
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'number',
				'label' => '<label>Vehicle Impounds</label>',
				'icon' => 'truck-pickup',
				'class' => '',
				'id' => 'inputVehicleImpounds',
				'name' => 'inputVehicleImpounds',
				'value' => '',
				'placeholder' => '#',
				'tooltip' => 'Vehicle Impounds Count',
				'attributes' => '',
				'style' => ''
			));
			// Form - Textfield - Traffic Assists
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'number',
				'label' => '<label>Traffic Assists</label>',
				'icon' => 'hands-helping',
				'class' => '',
				'id' => 'inputTrafficAssists',
				'name' => 'inputTrafficAssists',
				'value' => '',
				'placeholder' => '#',
				'tooltip' => 'Traffic Assists Count',
				'attributes' => '',
				'style' => ''
			));
			// Form - Textfield - Traffic Investigations
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'number',
				'label' => '<label>Traffic Investigations</label>',
				'icon' => 'car-crash',
				'class' => '',
				'id' => 'inputTrafficInvestigations',
				'name' => 'inputTrafficInvestigations',
				'value' => '',
				'placeholder' => '#',
				'tooltip' => 'Traffic Investigations Count',
				'attributes' => '',
				'style' => ''
			));
		?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-clipboard mr-2"></i>Targeted Enforcement</h4>
		<div class="form-row groupSlotTDEnforcementSpeed">
		<?php
			// Form - Datalist - Speed Enforcement
			$c->form('datalist', 'forms', array(
				'size' => '4',
				'label' => '<label>Speed Enforcement</label>',
				'icon' => 'tachometer-alt',
				'id' => 'inputEnforcementSpeed',
				'name' => 'inputEnforcementSpeed[]',
				'placeholder' => 'Street, Cross-Street',
				'tooltip' => 'E.g. Popular Street',
				'attributes' => '',
				'list' => 'street_list',
				'listChooser' => $pg->listChooser('streetsList')
			));
			// Form - Options Add - Speed Enforcement Slot
			$c->form('options', 'forms', array(
				'size' => '3',
				'label' => '<label>Options</label>',
				'action' => 'addEnforcementSpeed',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Speed Enforcement'
			));
		?>
		</div>
		<div class="form-row groupSlotTDEnforcementParking">
		<?php
			// Form - Datalist - Parking Enforcement
			$c->form('datalist', 'forms', array(
				'size' => '4',
				'label' => '<label>Parking Enforcement</label>',
				'icon' => 'parking',
				'id' => 'inputEnforcementParking',
				'name' => 'inputEnforcementParking[]',
				'placeholder' => 'Street, Cross-Street',
				'tooltip' => 'E.g. Popular Street',
				'attributes' => '',
				'list' => 'street_list',
				'listChooser' => $pg->listChooser('streetsList')
			));
			// Form - Options Add - Parking Enforcement Slot
			$c->form('options', 'forms', array(
				'size' => '3',
				'label' => '<label>Options</label>',
				'action' => 'addEnforcementParking',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Parking Enforcement'
			));
		?>
		</div>
		<div class="form-row groupSlotTDEnforcementYielding">
		<?php
			// Form - Datalist - Yielding Enforcement
			$c->form('datalist', 'forms', array(
				'size' => '4',
				'label' => '<label>Yielding Enforcement</label>',
				'icon' => 'traffic-light',
				'id' => 'inputEnforcementYielding',
				'name' => 'inputEnforcementYielding[]',
				'placeholder' => 'Street, Cross-Street',
				'tooltip' => 'E.g. Popular Street',
				'attributes' => '',
				'list' => 'street_list',
				'listChooser' => $pg->listChooser('streetsList')
			));
			// Form - Options Add - Yielding Enforcement Slot
			$c->form('options', 'forms', array(
				'size' => '3',
				'label' => '<label>Options</label>',
				'action' => 'addEnforcementYield',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Yielding Enforcement'
			));
		?>
		</div>
		<div class="form-row">
		<?php
			// Form - Textfield - Group Operation
			$c->form('textfield', 'forms', array(
				'size' => '12',
				'type' => 'text',
				'label' => '<label>Group Operation URL</label>',
				'icon' => 'users',
				'class' => '',
				'id' => 'inputGroupOperationURL',
				'name' => 'inputGroupOperationURL',
				'value' => '',
				'placeholder' => 'Direct URL to the group operation thread.',
				'tooltip' => 'URL',
				'attributes' => '',
				'style' => ''
			));
		?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-clipboard mr-2"></i>Notes & Other Details</h4>
		<div class="form-row">
		<?php
			// Form - Textbox - Notes
			$c->form('textbox', 'forms', array(
				'size' => '12',
				'label' => '<label>Notes</label>',
				'icon' => 'clipboard',
				'id' => 'inputNotes',
				'name' => 'inputNotes',
				'rows' => '2',
				'placeholder' => 'Any optional and extra notes regarding the patrol.',
				'attributes' => '',
				'hint' => ''
			));
			// Form - Textfield - Traffic Division Patrol Report URL
			$c->form('textfield', 'forms', array(
				'size' => '12',
				'type' => 'text',
				'label' => '<label>Traffic Division: Patrol Report URL</label>',
				'icon' => 'car-crash',
				'class' => '',
				'id' => 'inputTDPatrolReportURL',
				'name' => 'inputTDPatrolReportURL',
				'value' => '',
				'placeholder' => 'Direct URL to your personal Patrol Report thread.',
				'tooltip' => 'URL',
				'attributes' => '',
				'style' => ''
			));
		?>
		</div>
		<?php
			// Form - Submit
			$c->form('submit', 'forms', array());
		?>
	</form>
</div>
<!-- COPY SLOTS -->
<div class="form-row copyGroupSlotModel" style="display: none;">
<?php
	// Form - Datalist - Vehicle Model
	$c->form('datalist', 'forms', array(
		'size' => '3 slotTDPatrolVehicle',
		'label' => '<label>Vehicle Make & Model</label>',
		'icon' => 'car',
		'id' => 'inputVehicleModel',
		'name' => 'inputVehicleModel',
		'placeholder' => 'Make & Model',
		'tooltip' => 'E.g: Unmarked Vapid Torrence',
		'attributes' => 'required',
		'list' => 'vehicle_list',
		'listChooser' => $pg->listChooser('vehiclesList')
	));
?>
</div>
<!-- COPY SLOT - TRAFFIC STOP -->
<div class="container copyGroupSlotTDTrafficStop" style="display: none;">
<?php
	// Form - Textfield - Defendant's Name
	$c->form('textfield', 'forms', array(
		'size' => '3',
		'type' => 'text',
		'label' => '',
		'icon' => 'id-card',
		'class' => '',
		'id' => 'inputNameTS',
		'name' => 'inputNameTS[]',
		'value' => '',
		'placeholder' => 'Firstname Lastname',
		'tooltip' => 'Defendant - Firstname Lastname',
		'attributes' => 'required',
		'style' => ''
	));
	// Form - Textfield - Citations
	$c->form('textfield', 'forms', array(
		'size' => '2',
		'type' => 'number',
		'label' => '',
		'icon' => 'receipt',
		'class' => '',
		'id' => 'inputCitationsTS',
		'name' => 'inputCitationsTS[]',
		'value' => '',
		'placeholder' => '#',
		'tooltip' => 'Citation Count',
		'attributes' => '',
		'style' => ''
	));
	// Form - Options Remove - Traffic Stop Slot
	$c->form('options', 'forms', array(
		'size' => '2',
		'label' => '',
		'action' => 'removeSlotTS',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Traffic Stop'
	));
?>
</div>
<!-- COPY SLOT - ENFORCEMENT SPEED -->
<div class="container copyGroupSlotEnforcementSpeed" style="display: none;">
<?php
	// Form - Datalist - Speed Enforcement
	$c->form('datalist', 'forms', array(
		'size' => '4',
		'label' => '',
		'icon' => 'tachometer-alt',
		'id' => 'inputEnforcementSpeed',
		'name' => 'inputEnforcementSpeed[]',
		'placeholder' => 'Street, Cross-Street',
		'tooltip' => 'E.g. Popular Street',
		'attributes' => '',
		'list' => 'street_list',
		'listChooser' => $pg->listChooser('streetsList')
	));
	// Form - Options Remove - Speed Enforcement Slot
	$c->form('options', 'forms', array(
		'size' => '3',
		'label' => '',
		'action' => 'removeEnforcementSpeed',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Speed Enforcement'
	));
?>
</div>
<!-- COPY SLOT - ENFORCEMENT PARKING -->
<div class="container copyGroupSlotEnforcementParking" style="display: none;">
<?php
	// Form - Datalist - Parking Enforcement
	$c->form('datalist', 'forms', array(
		'size' => '4',
		'label' => '',
		'icon' => 'parking',
		'id' => 'inputEnforcementParking',
		'name' => 'inputEnforcementParking[]',
		'placeholder' => 'Street, Cross-Street',
		'tooltip' => 'E.g. Popular Street',
		'attributes' => '',
		'list' => 'street_list',
		'listChooser' => $pg->listChooser('streetsList')
	));
	// Form - Options Remove - Parking Enforcement Slot
	$c->form('options', 'forms', array(
		'size' => '3',
		'label' => '',
		'action' => 'removeEnforcementParking',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Parking Enforcement'
	));
?>
</div>
<!-- COPY SLOT - ENFORCEMENT YIELDING -->
<div class="container copyGroupSlotEnforcementYielding" style="display: none;">
<?php
	// Form - Datalist - Yielding Enforcement
	$c->form('datalist', 'forms', array(
		'size' => '4',
		'label' => '',
		'icon' => 'traffic-light',
		'id' => 'inputEnforcementYielding',
		'name' => 'inputEnforcementYielding[]',
		'placeholder' => 'Street, Cross-Street',
		'tooltip' => 'E.g. Popular Street',
		'attributes' => '',
		'list' => 'street_list',
		'listChooser' => $pg->listChooser('streetsList')
	));
	// Form - Options Remove - Yielding Enforcement Slot
	$c->form('options', 'forms', array(
		'size' => '3',
		'label' => '',
		'action' => 'removeEnforcementYield',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Yielding Enforcement'
	));
?>
</div>

<?php require_once 'form-footer.php'; ?>