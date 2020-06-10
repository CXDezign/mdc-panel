<hr>
<h4><i class="fas fa-fw fa-car mr-2"></i>Vehicle Details</h4>
<div class="form-row">
	<?php
		// Form - Textfield - Vehicle's Registered Owner
		$c->form('textfield', 'forms', array(
			'size' => '4',
			'type' => 'text',
			'label' => '<label>Registered Owner</label>',
			'icon' => 'ticket-alt',
			'class' => '',
			'id' => 'inputVehRO',
			'name' => 'inputVehRO',
			'value' => '',
			'placeholder' => 'Firstname Lastname',
			'tooltip' => $vehROTooltip,
			'attributes' => $vehROAttributes,
			'style' => ''
		));
		// Form - Datalist - Vehicle's Make & Model
		$c->form('datalist', 'forms', array(
			'size' => '3',
			'label' => '<label>Make & Model</label>',
			'icon' => 'car',
			'id' => 'inputVeh',
			'name' => 'inputVeh',
			'placeholder' => 'Make & Model',
			'tooltip' => '(E.g: Benefactor Dubsta)',
			'attributes' => 'required',
			'list' => 'vehicle_list',
			'listChooser' => $pg->listChooser('vehiclesList')
		));
		// Form - Textfield - Vehicle's Identification Plate
		$c->form('textfield', 'forms', array(
			'size' => '3',
			'type' => 'text',
			'label' => '<label>Identification Plate</label>',
			'icon' => 'ticket-alt',
			'class' => '',
			'id' => 'inputVehPlate',
			'name' => 'inputVehPlate',
			'value' => '',
			'placeholder' => '###XXX',
			'tooltip' => '(E.g: 987XYZ or Empty if unregistered)',
			'attributes' => '',
			'style' => 'text-transform: uppercase;'
		));
		if ($tints) {
			// Form - List - Vehicle's Tint Level
			$c->form('list', 'forms', array(
				'size' => '2',
				'label' => '<label>Tint Level</label>',
				'icon' => 'adjust',
				'class' => 'selectpicker',
				'id' => 'inputVehTint',
				'name' => 'inputVehTint',
				'attributes' => 'required',
				'title' => 'Select Tint',
				'list' => $pg->tintChooser(),
				'hint' => '',
				'hintClass' => ''
			));
		}
	?>
</div>