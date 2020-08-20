<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-parking mr-2"></i>Parking Ticket</h1>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="ParkingTicket">
		<?php
			// Section - General
			$c->form('general', 'sections', array(
				'g' => $g,
				'c' => $c,
				'time' => true,
				'patrol' => false,
				'callsign' => false
			));
			// Section - Officers
			$c->form('officer', 'sections', array(
				'g' => $g,
				'pg' => $pg,
				'c' => $c,
				'badge' => true,
				'slots' => false
			));
			// Section - Vehicle
			$c->form('vehicle', 'sections', array(
				'g' => $g,
				'pg' => $pg,
				'c' => $c,
				'registered' => true,
				'registeredAttributes' => 'disabled',
				'insurance' => true,
				'tints' => false,
			));
			// Section - Location
			require_once 'sections/location.php';
		?>
		<hr>
		<h4><i class="fas fa-fw fa-fingerprint mr-2"></i>Evidence Section</h4>
		<div class="form-row groupEvidencePhotograph">
			<?php
				// Form - Textfield - Photograph
				$c->form('textfield', 'forms', array(
					'size' => '10',
					'type' => 'text',
					'label' => '<label>Photograph</label>',
					'icon' => 'camera',
					'class' => '',
					'id' => 'inputEvidenceImage',
					'name' => 'inputEvidenceImage[]',
					'value' => '',
					'placeholder' => 'https://i.imgur.com/example.png',
					'tooltip' => 'Enter the direct URL to the photograph.',
					'attributes' => '',
					'style' => ''
				));
				// Form - Options Add - Photograph
				$c->form('options', 'forms', array(
					'size' => '2',
					'label' => '<label>Options</label>',
					'action' => 'addEvidencePhotogrtaph',
					'colour' => 'success',
					'icon' => 'fa-plus-square',
					'text' => 'Photograph'
				));
			?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-receipt mr-2"></i>Charges</h4>
		<div class="form-row groupSlotCitation crimeSelectorGroup">
		<?php
			// Form - List - Citation
			$c->form('list', 'forms', array(
				'size' => '6',
				'label' => '<label>Charge</label>',
				'icon' => 'gavel',
				'class' => 'selectpicker inputCrimeSelector',
				'id' => 'inputCrime-1',
				'name' => 'inputCrime[]',
				'attributes' => 'required data-live-search="true"',
				'title' => 'Select Charge',
				'list' => $pg->chargeChooser('traffic'),
				'hint' => '',
				'hintClass' => ''
			));
			// Form - List - Citation Class
			$c->form('list', 'forms', array(
				'size' => '2',
				'label' => '<label>Class</label>',
				'icon' => 'ellipsis-v',
				'class' => 'selectpicker inputCrimeClassSelector',
				'id' => 'inputCrimeClass-1',
				'name' => 'inputCrimeClass[]',
				'attributes' => 'required',
				'title' => 'Select Class',
				'list' => '',
				'hint' => '',
				'hintClass' => ''
			));
			// Form - Textfield - Citation Fine
			$c->form('textfield', 'forms', array(
				'size' => '2',
				'type' => 'number',
				'label' => '<label>Fine</label>',
				'icon' => 'dollar-sign',
				'class' => '',
				'id' => 'inputCrimeFine',
				'name' => 'inputCrimeFine[]',
				'value' => '',
				'placeholder' => '####',
				'tooltip' => 'Leave empty if no fine.',
				'attributes' => '',
				'style' => 'text-transform: uppercase;'
			));
			// Form - Options Add - Citation
			$c->form('options', 'forms', array(
				'size' => '2',
				'label' => '<label>Options</label>',
				'action' => 'addCitation',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Citation'
			));
		?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-parking mr-2"></i>Parking Ticket Details</h4>
		<div class="form-row">
		<?php
			// Form - List - Citation Reason
			$c->form('list', 'forms', array(
				'size' => '12',
				'label' => '<label>Parking Ticket Reason(s)</label>',
				'icon' => 'gavel',
				'class' => 'selectpicker',
				'id' => 'inputReason',
				'name' => 'inputReason[]',
				'attributes' => 'required multiple data-live-search="true"',
				'title' => 'Select Parking Ticket Reason',
				'list' => $pt->illegalParkingChooser(),
				'hint' => '<small>Select multiple if applicable.</small>',
				'hintClass' => ''
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
<?php
	// COPY SLOT - VEHICLE REGISTERED DETAILS
	$c->form('vehicle-registered', 'copy-slots', array(
		'g' => $g,
		'c' => $c,
		'attributesRO' => 'required',
		'tooltipRO' => 'Registered Owner - Firstname Lastname',
	));
	// COPY SLOT - VEHICLE INSURANCE EXPIRED DATE
	require_once 'copy-slots/vehicle-insurance-date.php';
?>
<!-- COPY SLOT - PHOTOGRAPH -->
<div class="container copyGroupEvidencePhotograph" style="display: none;">
<?php
	// Form - Textfield - Photograph
	$c->form('textfield', 'forms', array(
		'size' => '10',
		'type' => 'text',
		'label' => '',
		'icon' => 'camera',
		'class' => '',
		'id' => 'inputEvidenceImage',
		'name' => 'inputEvidenceImage[]',
		'value' => '',
		'placeholder' => 'https://i.imgur.com/example.png',
		'tooltip' => 'Enter the direct URL to the photograph.',
		'attributes' => 'required',
		'style' => ''
	));
	// Form - Options Add - Image
	$c->form('options', 'forms', array(
		'size' => '2',
		'label' => '',
		'action' => 'removeEvidencePhotogrtaph',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Photograph'
	));
?>
</div>
<!-- COPY SLOT - CITATION -->
<div class="container copyGroupSlotCitation" style="display: none;">
<?php
	// Form - List - Citation
	$c->form('list', 'forms', array(
		'size' => '6',
		'label' => '',
		'icon' => 'gavel',
		'class' => 'select-picker-copy inputCrimeSelector',
		'id' => 'inputCrime-',
		'name' => 'inputCrime[]',
		'attributes' => 'required data-live-search="true"',
		'title' => 'Select Charge',
		'list' => $pg->chargeChooser('traffic'),
		'hint' => '',
		'hintClass' => ''
	));
	// Form - List - Citation Class
	$c->form('list', 'forms', array(
		'size' => '2',
		'label' => '',
		'icon' => 'ellipsis-v',
		'class' => 'select-picker-copy inputCrimeClassSelector',
		'id' => 'inputCrimeClass-',
		'name' => 'inputCrimeClass[]',
		'attributes' => 'required',
		'title' => 'Select Class',
		'list' => '',
		'hint' => '',
		'hintClass' => ''
	));
	// Form - Textfield - Citation Fine
	$c->form('textfield', 'forms', array(
		'size' => '2',
		'type' => 'number',
		'label' => '',
		'icon' => 'dollar-sign',
		'class' => '',
		'id' => 'inputCrimeFine',
		'name' => 'inputCrimeFine[]',
		'value' => '',
		'placeholder' => '####',
		'tooltip' => 'Leave empty if no fine.',
		'attributes' => '',
		'style' => 'text-transform: uppercase;'
	));
	// Form - Options Remove - Citation
	$c->form('options', 'forms', array(
		'size' => '2',
		'label' => '',
		'action' => 'removeCitation',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Citation'
	));
?>
</div>
<?php require_once 'form-footer.php'; ?>