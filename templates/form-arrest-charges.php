<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-gavel mr-2"></i>Arrest Charges Calculator</h1>
	<hr>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="ArrestCharges">
		<div class="form-row chargeGroup">
		<?php
			// Form - Options Add - Charge
			$c->form('options', 'forms', array(
				'size' => '2 mx-auto',
				'label' => '',
				'action' => 'addCharge',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Charge'
			));
		?>
		</div>
		<div class="container mt-5 text-center">
			<a class="btn btn-info px-5" target="_blank" href="<?= $g->getSettings('url-penal-code'); ?>" role="button">
				<i class="fas fa-archive fa-fw mr-1"></i>Open Penal Code
			</a>
		</div>
		<div class="container my-5 text-center">
			<button id="submitCharges" type="submit" name="submit" class="btn btn-primary px-5">
				<i class="fas fa-fw fa-plus-square mr-1"></i>Calculate Arrest
			</button>
		</div>
	</form>
</div>

<!-- COPY SLOTS -->

<!-- CHARGE SLOT -->
<div class="container fieldChargeCopy" style="display: none;">
<?php
	// Form - List - Charge
	$c->form('list', 'forms', array(
		'size' => '5',
		'label' => '',
		'icon' => 'gavel',
		'class' => 'select-picker-copy inputCrimeSelector',
		'id' => 'inputCrime-',
		'name' => 'inputCrime[]',
		'attributes' => 'required data-live-search="true"',
		'title' => 'Select Charge',
		'list' => $pg->chargeChooser(),
		'hint' => '',
		'hintClass' => ''
	));
	// Form - List - Charge Class
	$c->form('list', 'forms', array(
		'size' => 'auto',
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
	// Form - List - Charge Offence
	$c->form('list', 'forms', array(
		'size' => 'auto',
		'label' => '',
		'icon' => 'ellipsis-v',
		'class' => 'select-picker-copy inputCrimeOffenceSelector',
		'id' => 'inputCrimeOffence-',
		'name' => 'inputCrimeOffence[]',
		'attributes' => 'required',
		'title' => 'Select Offence',
		'list' => '',
		'hint' => '',
		'hintClass' => ''
	));
	// Form - List - Charge Addition
	$c->form('list', 'forms', array(
		'size' => 'auto',
		'label' => '',
		'icon' => 'ellipsis-v',
		'class' => 'select-picker-copy',
		'id' => 'inputCrimeAddition-',
		'name' => 'inputCrimeAddition[]',
		'attributes' => 'required',
		'title' => 'Select Addition',
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
</div>
<?php require_once 'form-footer.php'; ?>