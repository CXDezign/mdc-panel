<div class="container copyGroupSlotOfficer" style="display: none;">
	<?php
		// Form - Textfield - Officer's Name
		$c->form('textfield', 'forms', array(
			'size' => '4',
			'type' => 'text',
			'label' => '',
			'icon' => 'id-card',
			'class' => '',
			'id' => 'inputName',
			'name' => 'inputName[]',
			'value' => '',
			'placeholder' => 'Firstname Lastname',
			'tooltip' => 'Officer - Full Name',
			'attributes' => 'required',
			'style' => ''
		));
		// Form - List - Officer's Rank
		$c->form('list', 'forms', array(
			'size' => '3',
			'label' => '',
			'icon' => 'user-shield',
			'class' => 'select-picker-copy',
			'id' => 'inputRank',
			'name' => 'inputRank[]',
			'attributes' => 'required',
			'title' => 'Select Rank',
			'list' => $pg->rankChooser(0),
			'hint' => '',
			'hintClass' => ''
		));
		// Form - Textfield - Officer's Badge
		$c->form('textfield', 'forms', array(
			'size' => '2',
			'type' => 'number',
			'label' => '',
			'icon' => 'shield-alt',
			'class' => '',
			'id' => 'inputBadge',
			'name' => 'inputBadge[]',
			'value' => '',
			'placeholder' => '#####',
			'tooltip' => 'Officer - Badge',
			'attributes' => 'required',
			'style' => 'text-transform: uppercase;'
		));
		// Form - Options - Remove Slot
		$c->form('options', 'forms', array(
			'size' => '1',
			'label' => '',
			'action' => 'removeOfficer',
			'colour' => 'danger',
			'icon' => 'fa-minus-square',
			'text' => 'Slot'
		));
	?>
</div>