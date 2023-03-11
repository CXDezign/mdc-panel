<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-user-lock mr-2"></i>Petition for Dismissal</h1>
	<hr>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="DA_DismissalPetition">
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
				'value' => $g->findCookie('legalName') ,
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
				'list' => $pg->rankChooser(2, 'LSDA') ,
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

		<div class="container mt-5 text-center">
			<a class="btn btn-info px-5" target="_blank" href="<?= $g->getSettings('url-penal-code'); ?>" role="button">
				<i class="fas fa-archive fa-fw mr-1"></i>Open Penal Code
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

<!-- COPY SLOTS -->

<?php $c->form('charge', 'copy-slots', array(
	'g' => $g,
	'pg' => $pg,
	'c' => $c,
	'prefix'=> 'inputCrime'

));

?>


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