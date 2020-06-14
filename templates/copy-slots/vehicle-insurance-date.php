<div class="container copyGroupSlotInsurance" style="display: none;">
<?php
	// Form - Textfield - Insurance Expired Date
	$c->form('textfield', 'forms', array(
		'size' => '3 slotInsuranceDate',
		'type' => 'text',
		'label' => '<label>Insurance Expired Date</label>',
		'icon' => 'calendar',
		'class' => '',
		'id' => 'inputVehInsuranceDate',
		'name' => 'inputVehInsuranceDate',
		'value' => '',
		'placeholder' => 'DD/MMM/YYYY',
		'tooltip' => 'DD/MMM/YYYY Format',
		'attributes' => 'required',
		'style' => 'text-transform: uppercase;'
	));
	// Form - Textfield - Insurance Expired Time
	$c->form('textfield', 'forms', array(
		'size' => '2 slotInsuranceTime',
		'type' => 'text',
		'label' => '<label>Insurance Expired Time</label>',
		'icon' => 'clock',
		'class' => '',
		'id' => 'inputVehInsuranceTime',
		'name' => 'inputVehInsuranceTime',
		'value' => '',
		'placeholder' => '00:00',
		'tooltip' => '00:00 Format',
		'attributes' => 'required',
		'style' => 'text-transform: uppercase;'
	));
?>
</div>