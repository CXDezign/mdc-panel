<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-user-lock mr-2"></i>Petition for bail Generator</h1>
	<hr>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="BailPetition">
		<div class="form-row">
			<?php
			// Form - Textfield - Suspect's Name
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'text',
				'label' => '<label>Defendant&#39;s Full Name</label>',
				'icon' => 'id-card',
				'class' => '',
				'id' => 'inputDefName',
				'name' => 'inputDefName',
				'value' => '',
				'placeholder' => 'Firstname Lastname',
				'tooltip' => 'Defendant - Full Name',
				'attributes' => 'required',
				'style' => ''
			));
			$c->form('toggle', 'forms', array(
				'size' => '3',
				'label' => 'Recommend Bail',
				'class' => '',
				'attributes' => '',
				'id' => 'inputApproveBail',
				'name' => 'inputApproveBail',
				'dataOff' => "<i class='mr-1 fas fa-fw fa-check-circle'></i>Recommend bail",
				'dataOn' => "<i class='mr-1 fas fa-fw fa-times-circle'></i>Recommend NOT bail",
				'dataOffStyle' => 'success',
				'dataOnStyle' => 'danger',
				'dataWidth' => '100%',
				'dataHeight' => '38'
			));
			?>
		</div>
		<div class="form-row">

			<?php

			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'text',
				'label' => '<label>Employee&#39;s Full Name</label>',
				'icon' => 'id-card',
				'class' => '',
				'id' => 'employeeName',
				'name' => 'employeeName',
				'value' => '',
				'placeholder' => 'Firstname Lastname',
				'tooltip' => 'Employee - Full Name',
				'attributes' => 'required',
				'style' => ''
			));
			$c->form('list', 'forms', array(
				'size' => '3',
				'label' => '<label>Employee&#39;s Rank</label>',
				'icon' => 'user-shield',
				'class' => 'selectpicker',
				'id' => 'inputRank',
				'name' => 'inputRank',
				'attributes' => 'required',
				'title' => 'Select Rank',
				'list' => $pg->rankChooser(0),
				'hint' => '',
				'hintClass' => ''
			));

			?>

		</div>
		<div class="form-row">
			<?php
			// Form - Options Add - Charge
			$c->form('options', 'forms', array(
				'size' => '2 ml-auto',
				'label' => '',
				'action' => 'addCharge',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Charge'
			));
			// Form - Options Add - Drug Charge
			$c->form('options', 'forms', array(
				'size' => '2 mr-auto',
				'label' => '',
				'action' => 'addDrugCharge',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Drug Charge'
			));

			?>
		</div>
		<div class="form-row groupSlotCharge"></div>
		<div class="form-row groupSlotChargeDrug"></div>
		<div class="form-row">
			<?php
			// Form - List - Citation Reason
			$c->form('list', 'forms', array(
				'size' => '12',
				'label' => '<label>Bail Reasons(s)</label>',
				'icon' => 'gavel',
				'class' => 'selectpicker',
				'id' => 'inputReason',
				'name' => 'inputReason[]',
				'attributes' => 'required multiple data-live-search="true"',
				'title' => 'Select Bail Condition / Denial Reason',
				'list' => $da->bailReasonsChooser(),
				'hint' => '<small>Select multiple if applicable.</small>',
				'hintClass' => ''
			));
			?>
		</div>
		<div class="container mt-5 text-center">
			<a class="btn btn-info px-5" target="_blank" href="<?= $g->getSettings('url-penal-code'); ?>" role="button">
				<i class="fas fa-archive fa-fw mr-1"></i>Open Penal Code
			</a>
			<a class="btn btn-info px-5" target="_blank" href="<?= $g->getSettings('url-bail-schedule'); ?>" role="button">
				<i class="fas fa-archive fa-fw mr-1"></i>Open Bail Schedule
			</a>
		</div>
		<div class="container my-5 text-center">
			<div class="form-row row d-flex justify-content-center">

			</div>
			<button id="submitCharges" type="submit" name="submit" class="btn btn-primary px-5">
				<i class="fas fa-fw fa-plus-square mr-1"></i>Generate
			</button>
		</div>
	</form>
</div>

<!-- COPY SLOTS -->

<!-- CHARGE SLOT -->
<div class="container copyGroupSlotCharge" style="display: none;">
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
		'title' => 'Charge',
		'list' => $pg->chargeChooser('generic'),
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
		'id' => 'inputCrimeOffence-',
		'name' => 'inputCrimeOffence[]',
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
		'id' => 'inputCrimeAddition-',
		'name' => 'inputCrimeAddition[]',
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
	<input type="hidden" id="inputCrimeDrugSubstanceCategory-" name="inputCrimeSubstanceCategory[]" value="?">
</div>

<!-- DRUG CHARGE SLOT -->
<div class="container copyGroupSlotDrugCharge" style="display: none;">
	<?php
	// Form - List - Charge
	$c->form('list', 'forms', array(
		'size' => '5',
		'label' => '',
		'icon' => 'cannabis',
		'class' => 'select-picker-copy inputCrimeSelector',
		'id' => 'inputCrimeDrug-',
		'name' => 'inputCrime[]',
		'attributes' => 'required data-live-search="true"',
		'title' => 'Charge',
		'list' => $pg->chargeChooser('drugs'),
		'hint' => '',
		'hintClass' => ''
	));
	// Form - List - Charge Class
	$c->form('list', 'forms', array(
		'size' => 'auto',
		'label' => '',
		'icon' => 'ellipsis-v',
		'class' => 'select-picker-copy inputCrimeClassSelector',
		'id' => 'inputCrimeDrugClass-',
		'name' => 'inputCrimeClass[]',
		'attributes' => 'required',
		'title' => 'Class',
		'list' => '',
		'hint' => '',
		'hintClass' => ''
	));
	// Form - List - Substance Category
	$c->form('list', 'forms', array(
		'size' => 'auto',
		'label' => '',
		'icon' => 'tag',
		'class' => 'select-picker-copy inputCrimeSubstanceCategorySelector',
		'id' => 'inputCrimeDrugSubstanceCategory-',
		'name' => 'inputCrimeSubstanceCategory[]',
		'attributes' => 'required',
		'title' => 'Substance Category',
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
		'id' => 'inputCrimeDrugAddition-',
		'name' => 'inputCrimeAddition[]',
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
		'action' => 'removeDrugCharge',
		'colour' => 'danger',
		'icon' => 'fa-minus-square m-0',
		'text' => ''
	));
	?>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/form-footer.php'; ?>