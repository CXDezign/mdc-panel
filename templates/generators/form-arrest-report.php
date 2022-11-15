<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<?php
		if ($showChargeTable) {
			echo '<h1><i class="fas fa-fw fa-gavel mr-2"></i>Sentencing Charges</h1>';
			require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/form-arrest-charge-table.php';
		}
	?>
	<h1><i class="fas fa-fw fa-landmark mr-2"></i>Arrest Report</h1>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="ArrestReport">
		<?php
			// Section - General
			$c->form('general', 'sections', array(
				'g' => $g,
				'c' => $c,
				'time' => true,
				'patrol' => false,
				'callsign' => true
			));
			// Section - Officers
			$c->form('officer', 'sections', array(
				'g' => $g,
				'pg' => $pg,
				'c' => $c,
				'badge' => true,
				'slots' => true
			));
		?>
		<hr>
		<h4 class="mb-2"><i class="fas fa-fw fa-clipboard mr-2"></i>Arrest Section</h4>
		<div class="form-row">
			<?php
				// Form - Textfield - Suspect's Name
				$c->form('textfield', 'forms', array(
					'size' => '4',
					'type' => 'text',
					'label' => '<label>Suspect&#39;s Full Name</label>',
					'icon' => 'id-card',
					'class' => '',
					'id' => 'inputDefName',
					'name' => 'inputDefName',
					'value' => '',
					'placeholder' => 'Firstname Lastname',
					'tooltip' => 'Suspect - Full Name',
					'attributes' => 'required',
					'style' => ''
				));
			?>
		</div>
		<div class="form-row">
			<?php
				// Form - Textbox - Arrest Narrative
				$c->form('textbox', 'forms', array(
					'size' => '12',
					'label' => '<label>Arrest Narrative</label>',
					'icon' => 'clipboard',
					'id' => 'inputNarrative',
					'name' => 'inputNarrative',
					'rows' => '4',
					'placeholder' => 'Arrest Narrative',
					'attributes' => 'required',
					'hint' => '<strong>Describe the events leading up to the arrest in third person and in chronological order, explaining all charges.</strong>'
				));
			?>
		</div>
		<?php

			require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/sections/location.php';

		?>
		<hr>
		<h4 class="mb-2"><i class="fas fa-fw fa-fingerprint mr-2"></i>Evidence Section</h4>
		<div class="form-row">
			<?php
				// Form - Textbox - Evidence
				$c->form('textbox', 'forms', array(
					'size' => '6',
					'label' => '<label>Supporting Evidence</label>',
					'icon' => 'photo-video',
					'id' => 'inputEvidence',
					'name' => 'inputEvidence',
					'rows' => '4',
					'placeholder' => 'Videos, Photographs, Links, Audio Recordings / Transcripts, Witness Statements & Testimony',
					'attributes' => '',
					'hint' => '<strong>Provide supporting evidence to aid the arrest report.</strong>'
				));
				// Form - Textbox - Dashboard Camera
				$c->form('textbox', 'forms', array(
					'size' => '6',
					'label' => '<label>Dashboard Camera</label>',
					'icon' => 'video',
					'id' => 'inputDashcam',
					'name' => 'inputDashcam',
					'rows' => '4',
					'placeholder' => 'The dashboard camera captures audio and video footage showcasing...',
					'attributes' => 'required',
					'hint' => '<strong>Roleplay what the dashboard camera captures OR provide Streamable/YouTube links.<br>(( <strong style="color: darkred;">Lying in this section will lead to OOC punishments</strong> ))</strong>'
				));
			?>
		</div>
		<hr>
		<h4 class="mb-2"><i class="fas fa-fw fa-landmark mr-2"></i>Processing Section</h4>
		<div class="form-row">
			<?php
				// Form - List - Wristband
				$c->form('list', 'forms', array(
					'size' => '4',
					'label' => '<label>Wristband</label>',
					'icon' => 'ring',
					'class' => 'selectpicker',
					'id' => 'inputWristband',
					'name' => 'inputWristband',
					'attributes' => 'required',
					'title' => 'Select Wristband',
					'list' => $pg->listChooser('wristbandList'),
					'hint' => '<span class="d-block text-center"><strong>N/A</strong>: Only when arresting at Level I Lockups.</span>
					<hr>
					<strong><span style="color: rgba(200,0,0,255)">Red Wristband</span></strong>: Violent charges.<br>
					<strong><span style="color: rgba(0,0,200,255)">Blue Wristband</span></strong>: Non-violent charges.<br>
					<strong><span style="color: #FFBF40;">Yellow Wristband</span></strong>: Medical related concerns. (Terminally Ill, Contageous Disease, etc).',
					'hintClass' => 'text-left'
				));
				// Form - List - Bracelet
				$c->form('list', 'forms', array(
					'size' => '4',
					'label' => '<label>Bracelet</label>',
					'icon' => 'ring',
					'class' => 'selectpicker',
					'id' => 'inputBracelet',
					'name' => 'inputBracelet',
					'attributes' => 'required',
					'title' => 'Select Bracelet',
					'list' => $pg->listChooser('braceletList'),
					'hint' => '<span class="d-block text-center"><strong class="text-center">N/A</strong>: Only when arresting at Level I Lockups.</span>
					<hr>
					<strong><span style="color: #808080;">White Bracelet:</span></strong> General inmate population.<br>
					<strong><span style="color: #FF8000;">Orange Bracelet:</span></strong> Juveniles (Male and Female)<br>',
					'hintClass' => 'text-left'
				));
				// Form - List - Plea
				$c->form('list', 'forms', array(
					'size' => '4',
					'label' => '<label>Plea</label>',
					'icon' => 'balance-scale',
					'class' => 'selectpicker',
					'id' => 'inputPlea',
					'name' => 'inputPlea',
					'attributes' => 'required',
					'title' => 'Select Plea',
					'list' => $pg->listChooser('pleaList'),
					'hint' => 'Please remember to ask for the suspect&#39;s <strong>GTA:W</strong> forum name if pleading <strong>Not Guilty</strong>, <strong>No Contest</strong>, or <strong>Required Case</strong>.',
					'hintClass' => 'text-center'
				));
			?>
		</div>
		<?php
			// Form - Submit
			$c->form('submit', 'forms', array());
		?>
	</form>
	<?php
		// COPY SLOTS

		// OFFICER SLOT
		require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/copy-slots/officer.php';
	?>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/form-footer.php'; ?>