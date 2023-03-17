<?php

	$array = '';

	if ($slots) {
		$array = '[]';
	}

	if(!isset($faction)) $faction = "all"

?>
<hr>
<h4 class="mb-2"><i class="fas fa-fw fa-user-shield mr-2"></i>Officer Section</h4>
<div class="form-row groupSlotOfficer">
	<?php
		// Form - Textfield - Officer's Name
		$c->form('textfield', 'forms', array(
			'size' => '4',
			'type' => 'text',
			'label' => '<label>Full Name</label>',
			'icon' => 'id-card',
			'class' => '',
			'id' => 'inputName',
			'name' => 'inputName'.$array,
			'value' => $g->findCookie('officerName'),
			'placeholder' => 'Firstname Lastname',
			'tooltip' => 'Officer - Full Name',
			'attributes' => 'required',
			'style' => ''
		));
		// Form - List - Officer's Rank
		$c->form('list', 'forms', array(
			'size' => '3',
			'label' => '<label>Rank</label>',
			'icon' => 'user-shield',
			'class' => 'selectpicker',
			'id' => 'inputRank',
			'name' => 'inputRank'.$array,
			'attributes' => 'required',
			'title' => 'Select Rank',
			'list' => $pg->rankChooser(1, $faction),
			'hint' => '',
			'hintClass' => ''
		));
		if ($badge) {
			// Form - Textfield - Officer's Badge
			$c->form('textfield', 'forms', array(
				'size' => '2',
				'type' => 'number',
				'label' => '<label>Badge</label>',
				'icon' => 'shield-alt',
				'class' => '',
				'id' => 'inputBadge',
				'name' => 'inputBadge'.$array,
				'value' => $g->findCookie('officerBadge'),
				'placeholder' => '#####',
				'tooltip' => 'Officer - Badge',
				'attributes' => 'required',
				'style' => 'text-transform: uppercase;'
			));
		}
		if ($slots) {
			// Form - Options Add - Officer
			$c->form('options', 'forms', array(
				'size' => '1',
				'label' => '<label>Options</label>',
				'action' => 'addOfficer',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Slot'
			));
		}
	?>
</div>