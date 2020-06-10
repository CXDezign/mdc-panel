<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-cannabis mr-2"></i>Evidence Registration Log - Form</h1>
	<h6><a target="_blank" rel="noopener noreferrer" href="https://lspd.gta.world/viewtopic.php?f=388&t=5760">Evidence Locker Registry - Thread<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i></a></h6>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="EvidenceRegistrationLog">
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
				'badge' => false,
				'slots' => false
			));
		?>
		<hr>
		<h4><i class="fas fa-fw fa-user-slash mr-2"></i>Suspect Information</h4>
		<div class="form-row">
			<?php
				// Form - Textfield - Suspect's Name
				$c->form('textfield', 'forms', array(
					'size' => '4',
					'type' => 'text',
					'label' => '<label>Full Name</label>',
					'icon' => 'id-card',
					'class' => '',
					'id' => 'inputSuspectName',
					'name' => 'inputSuspectName',
					'value' => '',
					'placeholder' => 'Firstname Lastname',
					'tooltip' => 'Suspect - Full Name',
					'attributes' => 'required',
					'style' => ''
				));
			?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-cannabis mr-2"></i>Item Registry</h4>
		<div class="form-row">
			<?php
				// Form - List - Item Category
				$c->form('list', 'forms', array(
					'size' => '3',
					'label' => '<label>Category</label>',
					'icon' => 'clipboard-list',
					'class' => 'selectpicker',
					'id' => 'inputItemCategory',
					'name' => 'inputItemCategory',
					'attributes' => 'required',
					'title' => 'Select Item Category',
					'list' => $pg->listChooser('itemCategoryList'),
					'hint' => '',
					'hintClass' => ''
				));
			?>
		</div>
		<div class="form-row groupItemRegistry">
			<?php
				// Form - Textfield - Item Tag
				$c->form('textfield', 'forms', array(
					'size' => '4',
					'type' => 'text',
					'label' => '<label>Item Tag</label>',
					'icon' => 'tag',
					'class' => '',
					'id' => 'inputItemRegistry',
					'name' => 'inputItemRegistry[]',
					'value' => '',
					'placeholder' => 'Item Tag',
					'tooltip' => 'Item Tag',
					'attributes' => 'required',
					'style' => ''
				));
				// Form - Textfield - Item Amount
				$c->form('textfield', 'forms', array(
					'size' => '2',
					'type' => 'number',
					'label' => '<label>Item Amount</label>',
					'icon' => 'hashtag',
					'class' => '',
					'id' => 'inputItemAmount',
					'name' => 'inputItemAmount[]',
					'value' => '',
					'placeholder' => '#',
					'tooltip' => 'Item Amount',
					'attributes' => 'required',
					'style' => ''
				));
				// Form - Options Add - Item
				$c->form('options', 'forms', array(
					'size' => '2',
					'label' => '<label>Options</label>',
					'action' => 'addItemRegistry',
					'colour' => 'success',
					'icon' => 'fa-plus-square',
					'text' => 'Item'
				));
			?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-camera mr-2"></i>Evidence Section</h4>
		<div class="form-row groupEvidence">
			<?php
				// Form - Textfield - Photograph
				$c->form('textfield', 'forms', array(
					'size' => '10',
					'type' => 'text',
					'label' => '<label>Photograph</label>',
					'icon' => 'camera',
					'class' => '',
					'id' => 'inputEvidenceImage',
					'name' => 'inputEvidenceImage[]',
					'value' => '',
					'placeholder' => 'https://i.imgur.com/example.png',
					'tooltip' => 'Leave empty if none.',
					'attributes' => '',
					'style' => ''
				));
				// Form - Options Add - Photograph
				$c->form('options', 'forms', array(
					'size' => '2',
					'label' => '<label>Options</label>',
					'action' => 'addImage',
					'colour' => 'success',
					'icon' => 'fa-plus-square',
					'text' => 'Photograph'
				));
			?>
		</div>
		<?php
			// Form - Submit
			$c->form('submit', 'forms', array());
		?>
	</form>

	<!-- COPY SLOTS -->
	<div class="container groupCopyItemRegistry" style="display: none;">
		<?php
			// Form - Textfield - Item Tag
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'text',
				'label' => '',
				'icon' => 'tag',
				'class' => '',
				'id' => 'inputItemRegistry',
				'name' => 'inputItemRegistry[]',
				'value' => '',
				'placeholder' => 'Item Tag',
				'tooltip' => 'Item Tag',
				'attributes' => 'required',
				'style' => ''
			));
			// Form - Textfield - Item Amount
			$c->form('textfield', 'forms', array(
				'size' => '2',
				'type' => 'number',
				'label' => '',
				'icon' => 'hashtag',
				'class' => '',
				'id' => 'inputItemAmount',
				'name' => 'inputItemAmount[]',
				'value' => '',
				'placeholder' => '#',
				'tooltip' => 'Item Amount',
				'attributes' => 'required',
				'style' => ''
			));
			// Form - Options Add - Item
			$c->form('options', 'forms', array(
				'size' => '2',
				'label' => '',
				'action' => 'removeItem',
				'colour' => 'danger',
				'icon' => 'fa-minus-square',
				'text' => 'Item'
			));
		?>
	</div>
	<div class="container groupCopyImage" style="display: none;">
		<?php
			// Form - Textfield - Photograph
			$c->form('textfield', 'forms', array(
				'size' => '10',
				'type' => 'text',
				'label' => '',
				'icon' => 'camera',
				'class' => '',
				'id' => 'inputEvidenceImage',
				'name' => 'inputEvidenceImage[]',
				'value' => '',
				'placeholder' => 'https://i.imgur.com/example.png',
				'tooltip' => 'Leave empty if none.',
				'attributes' => '',
				'style' => ''
			));
			// Form - Options Add - Photograph
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
</div>
<?php require_once 'form-footer.php'; ?>