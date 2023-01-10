<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-clipboard mr-2"></i>Trespass Notice</h1>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="TrespassNotice">
		<?php
			// Section - General
			$c->form('general', 'sections', array(
				'g' => $g,
				'c' => $c,
				'time' => true,
				'patrol' => false,
				'callsign' => true
			));
			// Section - Officers
			$c->form('officer', 'sections', array(
				'g' => $g,
				'pg' => $pg,
				'c' => $c,
				'badge' => true,
				'slots' => false
			));
			// Section - Location
			require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/sections/location.php';
		?>
		<hr>
		<h4 class="mb-2"><i class="fas fa-fw fa-clipboard mr-2"></i>Suspect Details</h4>
		<div class="form-row">
			<?php
				// Form - Textfield - Suspect's Name
				$c->form('textfield', 'forms', array(
					'size' => '4',
					'type' => 'text',
					'label' => '<label>Suspect&#39;s Full Name</label>',
					'icon' => 'id-card',
					'class' => '',
					'id' => 'inputDefName',
					'name' => 'inputDefName',
					'value' => '',
					'placeholder' => 'Firstname Lastname',
					'tooltip' => 'Suspect - Full Name',
					'attributes' => 'required',
					'style' => ''
				));
			?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-receipt mr-2"></i>Trespass Details</h4>
		<div class="form-row">
		<?php
			// Form - Textfield - Duration of Trespass
			$c->form('textfield', 'forms', array(
				'size' => '3',
				'type' => 'number',
				'label' => '<label>Duration of Trespass</label>',
				'icon' => 'hourglass',
				'class' => '',
				'id' => 'inputDuration',
				'name' => 'inputDuration',
				'value' => '',
				'placeholder' => '#',
				'tooltip' => 'Duration of the notice in days (leave blank if permanent).',
				'attributes' => '',
				'style' => 'text-transform: uppercase;'
			));
			// Form - Textfield - Property
			$c->form('textfield', 'forms', array(
				'size' => '6',
				'type' => 'text',
				'label' => '<label>Property</label>',
				'icon' => 'home',
				'class' => '',
				'id' => 'inputProperty',
				'name' => 'inputProperty',
				'value' => '',
				'placeholder' => '1003 Mission Row Property',
				'tooltip' => 'Where the person is trespassed from.',
				'attributes' => 'required',
				'style' => ''
			));
			// Form - Textfield - Manager's Name
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'text',
				'label' => '<label>Manager&#39;s Full Name</label>',
				'icon' => 'id-card',
				'class' => '',
				'id' => 'inputManagerName',
				'name' => 'inputManagerName',
				'value' => '',
				'placeholder' => 'Firstname Lastname',
				'tooltip' => 'Manager - Full Name',
				'attributes' => 'required',
				'style' => ''
			));
			// Form - Textfield - Manager's Phone Number
			$c->form('textfield', 'forms', array(
				'size' => '3',
				'type' => 'text',
				'label' => '<label>Manager&#39;s Phone Number</label>',
				'icon' => 'phone',
				'class' => '',
				'id' => 'inputPhone',
				'name' => 'inputPhone',
				'value' => '',
				'placeholder' => '###-###-###',
				'tooltip' => 'Enter the manager&#39;s phone number.',
				'attributes' => 'required',
				'style' => 'text-transform: uppercase;'
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

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/form-footer.php';
?>