<?php

	$array = '';

	if ($slots) {
		$array = '[]';
	}

?>
<hr>
<h4 class="mb-2"><i class="fas fa-fw fa-user-shield mr-2"></i>Suspects</h4>
<div class="form-row groupSlotSuspect">
	<?php
		// Form - Textfield - Suspect's Name
		$c->form('textfield', 'forms', array(
			'size' => '4',
			'type' => 'text',
			'label' => '<label>Full Name</label>',
			'icon' => 'id-card',
			'class' => '',
			'id' => 'inputSuspectName',
			'name' => 'inputSuspectName'.$array,
			'value' => '',
			'placeholder' => 'Firstname Lastname',
			'tooltip' => 'Person - Full Name',
			'attributes' => 'required',
			'style' => ''
		));
		// Form - List - Status
		$c->form('list', 'forms', array(
			'size' => '3',
			'label' => '<label>Status</label>',
			'icon' => 'user-shield',
			'class' => 'selectpicker',
			'id' => 'inputSuspectStatus',
			'name' => 'inputSuspectStatus'.$array,
			'attributes' => 'required',
			'title' => 'Select Status',
			'list' => $pg->sStatusChooser(),
			'hint' => '',
			'hintClass' => ''
		));
		if ($slots) {
			// Form - Options Add - Suspect
			$c->form('options', 'forms', array(
				'size' => '1',
				'label' => '<label>Options</label>',
				'action' => 'addSuspect',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Slot'
			));
		}
	?>
</div>