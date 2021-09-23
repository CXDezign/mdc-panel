<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-skull mr-2"></i>Death Report</h1>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="DeathReport">
		<?php
			// Section - General
			$c->form('general', 'sections', array(
				'g' => $g,
				'c' => $c,
				'time' => true,
				'patrol' => false,
				'callsign' => false
			));
			// Section - Location
			require_once 'sections/location.php';
		?>
		<hr>
		<h4><i class="fas fa-fw fa-skull mr-2"></i>Deceased Information</h4>
		<div class="form-row">
		<?php
			// Form - Textfield - Deceased's Name
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'text',
				'label' => '<label>Full Name</label>',
				'icon' => 'id-card',
				'class' => '',
				'id' => 'inputDeathName',
				'name' => 'inputDeathName',
				'value' => '',
				'placeholder' => 'Firstname Lastname',
				'tooltip' => 'Leave empty if unknown.',
				'attributes' => '',
				'style' => ''
			));
			// Form - Textbox - Death Determination
			$c->form('textbox', 'forms', array(
				'size' => '8',
				'label' => '<label>Death Determination</label>',
				'icon' => 'clipboard',
				'id' => 'inputDeathReason',
				'name' => 'inputDeathReason',
				'rows' => '1',
				'placeholder' => 'Apparent Cause of Death.',
				'attributes' => '',
				'hint' => ''
			));
		?>
		</div>
		<hr>
		<h4><i class="fas fa-eye fa-fw mr-2"></i>Witnesses Information</h4>
		<div class="form-row groupWitness">
		<?php
			// Form - Textfield - Witness's Name
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'text',
				'label' => '<label>Full Name</label>',
				'icon' => 'id-card',
				'class' => '',
				'id' => 'inputWitnessName',
				'name' => 'inputWitnessName[]',
				'value' => '',
				'placeholder' => 'Firstname Lastname',
				'tooltip' => 'Leave empty if none.',
				'attributes' => '',
				'style' => ''
			));
			// Form - Options Add - Witness
			$c->form('options', 'forms', array(
				'size' => '2',
				'label' => '<label>Options</label>',
				'action' => 'addWitness',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Witness'
			));
		?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-clipboard mr-2"></i>Administrative Information</h4>
		<div class="form-row">
		<?php
			// Form - Textfield - First Responding Officer's Name
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'text',
				'label' => '<label>First Responding Officer</label>',
				'icon' => 'id-card',
				'class' => '',
				'id' => 'inputRespondingName',
				'name' => 'inputRespondingName',
				'value' => '',
				'placeholder' => 'Firstname Lastname',
				'tooltip' => 'First Responding Officer - Full Name',
				'attributes' => 'required',
				'style' => ''
			));
			// Form - List - First Responding Officer's Rank
			$c->form('list', 'forms', array(
				'size' => '3',
				'label' => '<label>Rank</label>',
				'icon' => 'user-shield',
				'class' => 'selectpicker',
				'id' => 'inputRespondingRank',
				'name' => 'inputRespondingRank',
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
			// Form - Textfield - Handling Detective / Forensic Analyst's Name
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'text',
				'label' => '<label>Handling Detective / Forensic Analyst</label>',
				'icon' => 'id-card',
				'class' => '',
				'id' => 'inputHandlingName',
				'name' => 'inputHandlingName',
				'value' => '',
				'placeholder' => 'Firstname Lastname',
				'tooltip' => 'Leave empty if none.',
				'attributes' => '',
				'style' => ''
			));
			// Form - List - First Responding Officer's Rank
			$c->form('list', 'forms', array(
				'size' => '3',
				'label' => '<label>Rank</label>',
				'icon' => 'user-shield',
				'class' => 'selectpicker',
				'id' => 'inputHandlingRank',
				'name' => 'inputHandlingRank',
				'attributes' => '',
				'title' => 'Select Rank',
				'list' => $pg->rankChooser(0),
				'hint' => '',
				'hintClass' => ''
			));
		?>
		</div>
		<div class="form-row">
		<?php
			// Form - Textfield - Handling Coroner's Name
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'text',
				'label' => '<label>Handling Coroner</label>',
				'icon' => 'id-card',
				'class' => '',
				'id' => 'inputCoronerName',
				'name' => 'inputCoronerName',
				'value' => '',
				'placeholder' => 'Firstname Lastname',
				'tooltip' => 'Leave empty if none.',
				'attributes' => '',
				'style' => ''
			));
			// Form - Textfield - Coroner Case Number
			$c->form('textfield', 'forms', array(
				'size' => '2',
				'type' => 'number',
				'label' => '<label>Coroner Case Number</label>',
				'icon' => 'hashtag',
				'class' => '',
				'id' => 'inputCaseNumber',
				'name' => 'inputCaseNumber',
				'value' => '',
				'placeholder' => '#####',
				'tooltip' => 'Leave empty if unknown.',
				'attributes' => '',
				'style' => ''
			));
			// Form - Textfield - Relevant MDC Record
			$c->form('textfield', 'forms', array(
				'size' => '6',
				'type' => 'text',
				'label' => '<label>Relevant MDC Record</label>',
				'icon' => 'archive',
				'class' => '',
				'id' => 'inputRecord',
				'name' => 'inputRecord',
				'value' => '',
				'placeholder' => 'https://www.website.com',
				'tooltip' => 'Leave empty if none.',
				'attributes' => '',
				'style' => ''
			));
		?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-camera mr-2"></i>Evidence</h4>
		<div class="form-row groupEvidence">
		<?php
			// Form - Options Add - Evidence Photograph
			$c->form('options', 'forms', array(
				'size' => '2',
				'label' => '',
				'action' => 'addEvidenceImage',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Photograph'
			));
			// Form - Options Add - Evidence Description
			$c->form('options', 'forms', array(
				'size' => '2',
				'label' => '',
				'action' => 'addEvidenceBox',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Description'
			));
		?>
		</div>
		<?php
			// Form - Submit
			$c->form('submit', 'forms', array());
		?>
	</form>
</div>

<!-- COPY SLOTS -->

<!-- Witness -->
<div class="container copyGroupWitness" style="display: none;">
<?php
	// Form - Textfield - Witness's Name
	$c->form('textfield', 'forms', array(
		'size' => '4',
		'type' => 'text',
		'label' => '',
		'icon' => 'id-card',
		'class' => '',
		'id' => 'inputWitnessName',
		'name' => 'inputWitnessName[]',
		'value' => '',
		'placeholder' => 'Firstname Lastname',
		'tooltip' => 'Leave empty if none.',
		'attributes' => 'required',
		'style' => ''
	));
	// Form - Options Remove - Witness
	$c->form('options', 'forms', array(
		'size' => '2',
		'label' => '',
		'action' => 'removeWitness',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Witness'
	));
?>
</div>
<!-- Evidence Photograph -->
<div class="container groupCopyImage" style="display: none;">
<?php
	// Form - Textfield - Evidence Photograph
	$c->form('textfield', 'forms', array(
		'size' => '10',
		'type' => 'text',
		'label' => '',
		'icon' => 'image',
		'class' => '',
		'id' => 'inputEvidenceImage',
		'name' => 'inputEvidenceImage[]',
		'value' => '',
		'placeholder' => 'https://imgur.com',
		'tooltip' => '',
		'attributes' => 'required',
		'style' => ''
	));
	// Form - Options Remove - Evidence Photograph
	$c->form('options', 'forms', array(
		'size' => '2',
		'label' => '',
		'action' => 'removeImage',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Photograph'
	));
?>
</div>
<!-- Evidence Description -->
<div class="container groupCopyBox" style="display: none;">
<?php
	// Form - Textbox - Evidence Description
	$c->form('textbox', 'forms', array(
		'size' => '10',
		'label' => '',
		'icon' => 'clipboard',
		'id' => 'inputEvidenceBox',
		'name' => 'inputEvidenceBox[]',
		'rows' => '1',
		'placeholder' => 'Brief Description',
		'attributes' => '',
		'hint' => ''
	));
	// Form - Options Remove - Evidence Description
	$c->form('options', 'forms', array(
		'size' => '2',
		'label' => '',
		'action' => 'removeBox',
		'colour' => 'danger',
		'icon' => 'fa-minus-square',
		'text' => 'Description'
	));
?>
</div>
<?php require_once 'form-footer.php'; ?>