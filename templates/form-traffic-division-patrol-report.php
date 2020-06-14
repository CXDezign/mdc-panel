<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-car-crash mr-2"></i>Traffic Division: Patrol Report - Form</h1>
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
		<div class="form-row">
		<?php
			// Form - Toggle - Traffic Patrol Vehicle
			$c->form('toggle', 'forms', array(
				'size' => '4',
				'label' => 'Toggle Patrol Vehicle',
				'id' => 'inputPatrolVehicle',
				'name' => 'inputPatrolVehicle',
				'dataOff' => 'Marked',
				'dataOn' => 'Unmarked',
				'dataOffStyle' => 'light',
				'dataOnStyle' => 'dark',
				'dataWidth' => '120',
				'dataHeight' => '20',
			));
		?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-car mr-2"></i>Traffic Stops</h4>
		<div class="form-row groupSlotTS">
		<?php
			// Form - Options Add - Traffic Stop Slot
			$c->form('options', 'forms', array(
				'size' => '2',
				'label' => '',
				'action' => 'addSlotTS',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Traffic Stop Slot'
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
<div class="container groupCopySlotTS" style="display: none;">
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
		'text' => 'Traffic Stop Slot'
	));
?>
</div>

<?php require_once 'form-footer.php'; ?>