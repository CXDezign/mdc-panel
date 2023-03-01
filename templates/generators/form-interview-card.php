<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-car mr-2"></i>FIELD INTERVIEW CARD</h1>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="InterviewCard">
		<hr>
		<h4 class="mb-2"><i class="fas fa-fw fa-clipboard mr-2"></i>FRONT</h4>
		<div class="form-row">
			<?php
				// Form - Textfield - Name
				$c->form('textfield', 'forms', array(
					'size' => '4',
					'type' => 'text',
					'label' => '<label>Name</label>',
					'icon' => 'id-card',
					'class' => '',
					'id' => 'inputInName',
					'name' => 'inputInName',
					'value' => '',
					'placeholder' => 'FIRST, MIDDLE, LAST',
					'tooltip' => 'Full Name',
					'attributes' => 'required',
					'style' => ''
				));
				// Form - Textfield - Phone Number
				$c->form('textfield', 'forms', array(
					'size' => '4',
					'type' => 'text',
					'label' => '<label>Phone Number</label>',
					'icon' => 'phone',
					'class' => '',
					'id' => 'inputInPhone',
					'name' => 'inputInPhone',
					'value' => '',
					'placeholder' => '###-###-###',
					'tooltip' => 'Phone Number',
					'attributes' => 'required',
					'style' => ''
				));
                // Form - Textfield - Gender
                $c->form('textfield', 'forms', array(
					'size' => '4',
					'type' => 'text',
					'label' => '<label>Gender</label>',
					'icon' => 'id-card',
					'class' => '',
					'id' => 'inputInGender',
					'name' => 'inputInGender',
					'value' => '',
					'placeholder' => 'MALE/FEMALE/OTHER',
					'tooltip' => 'Gender',
					'attributes' => 'required',
					'style' => ''
				));
			?>
		</div>
		<div class="form-row">
			<?php
				// Form - Textfield - Hair
				$c->form('textfield', 'forms', array(
					'size' => '4',
					'type' => 'text',
					'label' => '<label>Hair</label>',
					'icon' => 'id-card',
					'class' => '',
					'id' => 'inputInHair',
					'name' => 'inputInHair',
					'value' => '',
					'placeholder' => 'Hair',
					'tooltip' => 'Hair Colour',
					'attributes' => 'required',
					'style' => ''
                ));
                // Form - Textfield - Eyes
                $c->form('textfield', 'forms', array(
					'size' => '4',
					'type' => 'text',
					'label' => '<label>Eyes</label>',
					'icon' => 'id-card',
					'class' => '',
					'id' => 'inputInEyes',
					'name' => 'inputInEyes',
					'value' => '',
					'placeholder' => 'Eye Colour',
					'tooltip' => 'Eye Colour',
					'attributes' => 'required',
					'style' => ''
                ));
                // Form - Textfield - Height
                $c->form('textfield', 'forms', array(
					'size' => '4',
					'type' => 'text',
					'label' => '<label>Height</label>',
					'icon' => 'id-card',
					'class' => '',
					'id' => 'inputInHeight',
					'name' => 'inputInHeight',
					'value' => '',
					'placeholder' => 'Height',
					'tooltip' => 'Input Height',
					'attributes' => 'required',
					'style' => ''
                ));

				$c->form('textbox', 'forms', array(
					'size' => '6',
					'label' => '<label>Dashboard Camera</label>',
					'icon' => 'video',
					'id' => 'inputDashcam',
					'name' => 'inputDashcam',
					'rows' => '4',
					'placeholder' => 'The dashboard camera captures audio and video footage showcasing...',
					'attributes' => '',
					'hint' => '<small>Roleplay what the dashboard camera captures OR provide Streamable/YouTube links.<br>(( <strong style="color: darkred;">Lying in this section will lead to OOC punishments</strong> ))</small>'
				));
			?>
		</div>
		<?php
			// Section - Vehicle
			$c->form('vehicle', 'sections', array(
				'g' => $g,
				'pg' => $pg,
				'c' => $c,
				'registered' => true,
				'registeredAttributes' => '',
				'insurance' => true,
				'tints' => true
			));
			// Section - Location
			require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/sections/location.php';
		?>
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
		<?php
			// Form - Submit
			$c->form('submit', 'forms', array());
		?>
	</form>
</div>
<!-- COPY SLOTS -->
<?php
	// COPY SLOT - OFFICER
	require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/copy-slots/officer.php';
	// COPY SLOT - VEHICLE REGISTERED DETAILS
	$c->form('vehicle-registered', 'copy-slots', array(
		'g' => $g,
		'c' => $c,
		'attributesRO' => '',
		'tooltipRO' => 'Leave empty if the same as Defendant.',
	));
	// COPY SLOT - VEHICLE INSURANCE EXPIRED DATE
	require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/copy-slots/vehicle-insurance-date.php';
?>
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

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/form-footer.php'; ?>