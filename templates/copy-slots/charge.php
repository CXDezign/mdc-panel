<?php 
//DEFAULT VALUES
if(!isset($prefix)) $prefix = "inputCrime"; 
if(!isset($groupClass)) $groupClass = "copyGroupSlotCharge"; 
if(!isset($charges_types)) $charges_types = "generic"; 

?>

<!-- CHARGE SLOT -->
<div class="container <?= $groupClass ?>" style="display: none;">
<?php
	// Form - List - Charge
	$c->form('list', 'forms', array(
		'size' => '5',
		'label' => '',
		'icon' => 'gavel',
		'class' => 'select-picker-copy inputCrimeSelector',
		'id' => $prefix.'-',
		'name' => $prefix.'[]',
		'attributes' => 'required data-live-search="true"',
		'title' => 'Charge',
		'list' => $pg->chargeChooser($charges_types),
		'hint' => '',
		'hintClass' => ''
	));
	// Form - List - Charge Class
	$c->form('list', 'forms', array(
		'size' => 'auto',
		'label' => '',
		'icon' => 'ellipsis-v',
		'class' => 'select-picker-copy inputCrimeClassSelector',
		'id' => $prefix.'Class-',
		'name' => $prefix.'Class[]',
		'attributes' => 'required',
		'title' => 'Class',
		'list' => '',
		'hint' => '',
		'hintClass' => ''
	));
	// Form - List - Charge Offence
	$c->form('list', 'forms', array(
		'size' => 'auto',
		'label' => '',
		'icon' => 'hashtag',
		'class' => 'select-picker-copy inputCrimeOffenceSelector',
		'id' => $prefix.'Offence-',
		'name' => $prefix.'Offence[]',
		'attributes' => 'required',
		'title' => 'Offence',
		'list' => '',
		'hint' => '',
		'hintClass' => ''
	));
	// Form - List - Charge Addition
	$c->form('list', 'forms', array(
		'size' => 'auto',
		'label' => '',
		'icon' => 'exclamation-triangle',
		'class' => 'select-picker-copy inputCrimeAdditionSelector',
		'id' => $prefix.'Addition-',
		'name' => $prefix.'Addition[]',
		'attributes' => 'required',
		'title' => 'Addition',
		'list' => $pg->listChooser('sentencingAdditionsList'),
		'hint' => '',
		'hintClass' => ''
	));
	// Form - Options Remove - Charge
	$c->form('options', 'forms', array(
		'size' => 'auto',
		'label' => '',
		'action' => 'removeCharge',
		'colour' => 'danger',
		'icon' => 'fa-minus-square m-0',
		'text' => ''
	));
?>
<input type="hidden" id="<?= $prefix ?>DrugSubstanceCategory-" name="<?= $prefix ?>SubstanceCategory[]" value="?">
</div>