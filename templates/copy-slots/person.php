<div class="container copyGroupSlotPerson" style="display: none;">
	<?php
		// Form - Textfield - Person's Name
		$c->form('textfield', 'forms', array(
			'size' => '4',
			'type' => 'text',
			'label' => '<label>Full Name</label>',
			'icon' => 'id-card',
			'class' => '',
			'id' => 'inputPersonName',
			'name' => 'inputPersonName[]',
			'value' => '',
			'placeholder' => 'Firstname Lastname',
			'tooltip' => 'Person - Full Name',
			'attributes' => 'required',
			'style' => ''
		));
		// Form - List - Classification
		$c->form('list', 'forms', array(
			'size' => '3',
			'label' => '<label>Classification</label>',
			'icon' => 'user-shield',
			'class' => 'selectpicker',
			'id' => 'inputClassification',
			'name' => 'inputClassification[]',
			'attributes' => 'required',
			'title' => 'Select Classification',
			'list' => $pg->pClassificationChooser(),
			'hint' => '',
			'hintClass' => ''
		));
		// Form - Textfield - Date of Birth
		$c->form('textfield', 'forms', array(
			'size' => '2',
			'type' => 'text',
			'label' => '<label>Date of Birth</label>',
			'icon' => 'calendar',
			'class' => '',
			'id' => 'inputDoB',
			'name' => 'inputDoB[]',
			'value' => '',
			'placeholder' => 'DD/MMM/YYYY',
			'tooltip' => 'DD/MMM/YYYY Format',
			'attributes' => 'required',
			'style' => 'text-transform: uppercase;'
		));
		// Form - Textfield - Phone Number
		$c->form('textfield', 'forms', array(
			'size' => '3',
			'type' => 'number',
			'label' => '<label>Phone Number</label>',
			'icon' => 'phone',
			'class' => '',
			'id' => 'inputPhone',
			'name' => 'inputPhone[]',
			'value' => '',
			'placeholder' => '#######',
			'tooltip' => 'Person - Phone',
			'attributes' => 'required',
			'style' => 'text-transform: uppercase;'
		));
		// Form - Textfield - Residence
		$c->form('textfield', 'forms', array(
			'size' => '4',
			'type' => 'text',
			'label' => '<label>Residence</label>',
			'icon' => 'home',
			'class' => '',
			'id' => 'inputResidence',
			'name' => 'inputResidence[]',
			'value' => '',
			'placeholder' => '1000 Grove Street',
			'tooltip' => 'Person - Residence',
			'attributes' => 'required',
			'style' => ''
		));
		// Form - Textfield - Relation to Incident
		$c->form('textfield', 'forms', array(
			'size' => '4',
			'type' => 'text',
			'label' => '<label>Relation to Incident</label>',
			'icon' => 'sticky-note',
			'class' => '',
			'id' => 'inputRelation',
			'name' => 'inputRelation[]',
			'value' => '',
			'placeholder' => 'Suspect attacked officer.',
			'tooltip' => 'Person - Relation',
			'attributes' => 'required',
			'style' => ''
		));
		// Form - Options - Remove Slot
		$c->form('options', 'forms', array(
			'size' => '1',
			'label' => '',
			'action' => 'removePerson',
			'colour' => 'danger',
			'icon' => 'fa-minus-square',
			'text' => 'Slot'
		));
	?>
</div>