<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-truck-pickup mr-2"></i>Impound Report</h1>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="ImpoundReport">
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
				'insurance' => false,
				'tints' => false,
			));
			// Section - Location
			require_once 'sections/location.php';
		?>
		<hr>
		<h4><i class="fas fa-fw fa-receipt mr-2"></i>Impound Details</h4>
		<div class="form-row">
		<?php
			// Form - Textfield - Duration of Impound
			$c->form('textfield', 'forms', array(
				'size' => '2',
				'type' => 'number',
				'label' => '<label>Duration of Impound</label>',
				'icon' => 'hourglass',
				'class' => '',
				'id' => 'inputDuration',
				'name' => 'inputDuration',
				'value' => '',
				'placeholder' => '#',
				'tooltip' => 'Duration of the impound in days.',
				'attributes' => 'required',
				'style' => 'text-transform: uppercase;'
			));
			// Form - Textbox - Narrative & Notes
			$c->form('textbox', 'forms', array(
				'size' => '6',
				'label' => '<label>Impound Reason</label>',
				'icon' => 'clipboard',
				'id' => 'inputReason',
				'name' => 'inputReason',
				'rows' => '4',
				'placeholder' => 'Vehicle was used in the comission of a crime, see arrest report #.&#10Vehicle was obstructing the flow of traffic, see parking ticket #.',
				'attributes' => 'required',
				'hint' => '<strong>Enter a brief explanation for impounding the listed vehicle.</strong>'
			));
		?>
		</div>
		<?php
			// Form - Submit
			$c->form('submit', 'forms', array());
		?>
	</form>
</div>
<?php
// COPY SLOTS

// COPY SLOT - VEHICLE REGISTERED DETAILS
require_once 'copy-slots/vehicle-registered.php';
require_once 'form-footer.php';
?>