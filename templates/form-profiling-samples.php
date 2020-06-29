<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-dna mr-2"></i>Profiling Samples</h1>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="ProfilingSamples">
		<?php
			// Section - General
			$c->form('general', 'sections', array(
				'g' => $g,
				'c' => $c,
				'time' => true,
				'patrol' => false,
				'callsign' => false
			));
			// Section - Officers
			$c->form('officer', 'sections', array(
				'g' => $g,
				'pg' => $pg,
				'c' => $c,
				'badge' => true,
				'slots' => false
			));
		?>
		<hr>
		<h4><i class="fas fa-fw fa-sync-alt mr-2"></i>Processing Details</h4>
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
			// Form - Datalist - Building
			$c->form('datalist', 'forms', array(
				'size' => '6',
				'label' => '<label>Processing Police Building</label>',
				'icon' => 'building',
				'id' => 'inputBuilding',
				'name' => 'inputBuilding',
				'placeholder' => 'Full Building Name',
				'tooltip' => 'Location - Processing Police Building',
				'attributes' => 'required',
				'list' => 'building_list',
				'listChooser' => $pg->listChooser('buildingsList')
			));
		?>
		</div>
		<?php
			// Form - Submit
			$c->form('submit', 'forms', array());
		?>
	</form>
</div>
<?php
require_once 'form-footer.php';
?>