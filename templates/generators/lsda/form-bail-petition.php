<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-user-lock mr-2"></i>Petition for bail Generator</h1>
	<hr>
	<form action="/paperwork-generators/form-processor" method="POST">
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
			
			// Form - List - Bail Options
			$c->form('list', 'forms', array(
				'size' => '3',
				'label' => '<label>Recommended Action</label>',
				'icon' => 'book',
				'class' => 'selectpicker',
				'id' => 'inputApproveBail',
				'name' => 'inputApproveBail',
				'attributes' => 'required',
				'title' => 'Input recommendation',
				'list' => 
					"<option value=\"0\"> Release on Own Recognizance</option>".
					"<option selected value=\"1\"> Recommend bail</option>".
					"<option value=\"2\"> Not Recommend bail</option>"
				,
				'hint' => '',
				'hintClass' => ''
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
<?php $c->form('charge', 'copy-slots', array(
	'g' => $g,
	'pg' => $pg,
	'c' => $c,
	'prefix'=> 'inputCrime'

));

?>
<!-- DRUG CHARGE SLOT -->
<?php $c->form('charge', 'copy-slots', array(
	'g' => $g,
	'pg' => $pg,
	'c' => $c,
	'prefix'=> 'inputCrime',
	'charges_types'=> 'drugs'

));

?>


<script>
	let $recommendBail = $('#inputApproveBail');
	$recommendBail.on('change', '',function() {

		let recommend = $($recommendBail).val()!=2;
		if (recommend) {
			$('.standardCondition').attr("selected", true)
		} else {
			$('.standardCondition').attr("selected", false)
		}
		$('#inputReason').selectpicker('render');

	});
</script>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/form-footer.php'; ?>