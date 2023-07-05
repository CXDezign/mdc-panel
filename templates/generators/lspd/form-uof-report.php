<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-fist-raised mr-2"></i>Use of Force Report</h1>
	<h6><a target="_blank" rel="noopener noreferrer" href="https://lspd.gta.world/viewforum.php?f=1830">Use of Force Reports - Forum<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i></a></h6>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="LSPD_UOFReport">
		<input type="hidden" id="generatorSubType" name="generatorSubType" value="0">
		<?php
		// Section - General
		$c->form('general', 'sections', array(
			'g' => $g,
			'c' => $c,
			'time' => true,
			'patrol' => false,
			'callsign' => false
		));
		$c->form('toggle', 'forms', array(
			'size' => '3',
			'label' => 'Type Of Report',
			'class' => '',
			'attributes' => '',
			'id' => 'inputReportType',
			'name' => 'inputReportType',
			'dataOff' => "<i class='mr-1 fas fa-fw fa-check-circle'></i>Initial Report",
			'dataOn' => "<i class='mr-1 fas fa-fw fa-times-circle'></i>Supplementary Report",
			'dataOffStyle' => 'primary',
			'dataOnStyle' => 'secondary',
			'dataWidth' => '100%',
			'dataHeight' => '38'
		));
		
		// Section - Officers
		$c->form('officer', 'sections', array(
			'g' => $g,
			'pg' => $pg,
			'c' => $c,
			'badge' => false,
			'slots' => true
		));
		
		?>
		<div class="VisibleInitial">
		<?php
		// Section - Location
		require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/sections/location.php';
		// Section - Involved Persons
		$c->form('suspect', 'sections', array(
			'g' => $g,
			'pg' => $pg,
			'c' => $c,
			'slots' => true,
		));
		?>
		<hr>
		
		</div>
		
		<h4><i class="fas fa-fw fa-receipt mr-2"></i>Incident Details</h4>
		<div class="form-row">
			<?php
			// Form - Textbox - Narrative & Notes
			$c->form('textbox', 'forms', array(
				'size' => '12',
				'label' => '<label>Narrative</label>',
				'icon' => 'clipboard',
				'id' => 'inputNarrative',
				'name' => 'inputNarrative',
				'rows' => '4',
				'placeholder' => 'On September 11th of 20XX, there was an incident that took place in XXXXX where X shot X.',
				'attributes' => 'required',
				'hint' => '<strong>Enter a detailed account of the incident.</strong>'
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
<?php
// OFFICER SLOT
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/copy-slots/officer-nobadge.php';

// PERSON SLOT
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/copy-slots/suspect.php';
?>

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

<script>
	$('#inputReportType').on('change', '', function() {

		let value = $('#inputReportType').is(':checked');
		$('#generatorSubType').val(value?1:0);
		$('.VisibleInitial').css("display", value?"none":"block");
		$('.VisibleInitial input, .VisibleInitial select').attr("required", !value);
		
	});
</script>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/form-footer.php'; ?>