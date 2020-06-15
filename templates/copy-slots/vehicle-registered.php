<div class="container copyGroupSlotRegistered" style="display: none;">
<?php
	// Form - Textfield - Vehicle's Registered Owner
	$c->form('textfield', 'forms', array(
		'size' => '4 slotVehRO',
		'type' => 'text',
		'label' => '<label>Registered Owner</label>',
		'icon' => 'ticket-alt',
		'class' => '',
		'id' => 'inputVehRO',
		'name' => 'inputVehRO',
		'value' => '',
		'placeholder' => 'Firstname Lastname',
		'tooltip' => $tooltipRO,
		'attributes' => $attributesRO,
		'style' => ''
	));
	// Form - Textfield - Vehicle's Identification Plate
	$c->form('textfield', 'forms', array(
		'size' => '3 slotVehPlate',
		'type' => 'text',
		'label' => '<label>Identification Plate</label>',
		'icon' => 'ticket-alt',
		'class' => '',
		'id' => 'inputVehPlate',
		'name' => 'inputVehPlate',
		'value' => '',
		'placeholder' => '###XXX',
		'tooltip' => 'E.g: 987XYZ',
		'attributes' => 'required',
		'style' => 'text-transform: uppercase;'
	));
?>
</div>