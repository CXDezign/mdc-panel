<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-user-lock mr-2"></i>Motion to dismiss for a speedy trial violation</h1>
	<hr>
	<form action="/paperwork-generators/form-processor" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="JSA_SpeedyTrial">
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

			<div class="col-6"></div>
			<?php
			$c->form('textfield', 'forms', array(
				'size' => '2',
				'type' => 'number',
				'label' => '',
				'icon' => 'calendar-check',
				'class' => '',
				'id' => 'petitionNumber',
				'name' => 'petitionNumber',
				'value' => '',
				'placeholder' => '#####',
				'tooltip' => 'Petition Number',
				'attributes' => 'required',
				'style' => 'text-transform: uppercase;'
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
				'value' => $g->findCookie('legalName'),
				'placeholder' => 'Firstname Lastname',
				'tooltip' => 'Employee - Full Name',
				'attributes' => 'required',
				'style' => ''
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

		<?php
		$c->form('textbox', 'forms', array(
			'size' => '9',
			'label' => '<label>Reason for Dismissal</label>',
			'icon' => 'book',
			'id' => 'inputReason',
			'name' => 'inputReason',
			'rows' => '6',
			'placeholder' => '',
			'attributes' => '',
			'value' => 'The petitioner request this court to dismiss the charges as a whole on the basis of speedy trial violations as the arrest occurred on the XX of XX '.date("Y").', it has been more than XX hours with no arraignment as a whole.',
			'hint' => ''
		));
		?>

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
	'prefix' => 'inputCrime'

));

?>

<!-- DRUG CHARGE SLOT -->
<?php $c->form('charge', 'copy-slots', array(
	'g' => $g,
	'pg' => $pg,
	'c' => $c,
	'prefix' => 'inputCrime',
	'charges_types' => 'drugs'
));

?>

</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/form-footer.php'; ?>