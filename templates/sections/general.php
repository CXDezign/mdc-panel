<hr>
<h4 class="mb-2"><i class="fas fa-fw fa-archive mr-2"></i>General Section</h4>
<div class="form-row">
	<?php
		// Form - Textfield - Date
		$c->form('textfield', 'forms', array(
			'size' => '2',
			'type' => 'text',
			'label' => '<label>Date</label>',
			'icon' => 'calendar',
			'class' => '',
			'id' => 'inputDate',
			'name' => 'inputDate',
			'value' => $g->getUNIX('date'),
			'placeholder' => 'DD/MMM/YYYY',
			'tooltip' => 'DD/MMM/YYYY Format',
			'attributes' => 'required',
			'style' => 'text-transform: uppercase;'
		));
		if ($time) {
			// Form - Textfield - Time
			$c->form('textfield', 'forms', array(
				'size' => '2',
				'type' => 'text',
				'label' => '<label>Time</label>',
				'icon' => 'clock',
				'class' => '',
				'id' => 'inputTime',
				'name' => 'inputTime',
				'value' => $g->getUNIX('time'),
				'placeholder' => '00:00',
				'tooltip' => '00:00 Format',
				'attributes' => 'required',
				'style' => 'text-transform: uppercase;'
			));
		}
		if ($patrol) {
			// Form - Textfield - Patrol Start Time
			$c->form('textfield', 'forms', array(
				'size' => '2',
				'type' => 'text',
				'label' => '<label>Patrol Start Time</label>',
				'icon' => 'clock',
				'class' => '',
				'id' => 'inputTime',
				'name' => 'inputTime',
				'value' => $g->getUNIX('time'),
				'placeholder' => '00:00',
				'tooltip' => '00:00 Format',
				'attributes' => 'required',
				'style' => 'text-transform: uppercase;'
			));
			// Form - Textfield - Patrol End Time
			$c->form('textfield', 'forms', array(
				'size' => '2',
				'type' => 'text',
				'label' => '<label>Patrol End Time</label>',
				'icon' => 'clock',
				'class' => '',
				'id' => 'inputTimeEnd',
				'name' => 'inputTimeEnd',
				'value' => '',
				'placeholder' => '00:00',
				'tooltip' => '00:00 Format',
				'attributes' => 'required',
				'style' => 'text-transform: uppercase;'
			));
		}
		if ($callsign) {
			// Form - Textfield - Call Sign
			$c->form('textfield', 'forms', array(
				'size' => '2',
				'type' => 'text',
				'label' => '<label>Call Sign</label>',
				'icon' => 'bullhorn',
				'class' => '',
				'id' => 'inputCallsign',
				'name' => 'inputCallsign',
				'value' => $g->findCookie('callSign'),
				'placeholder' => 'Call Sign',
				'tooltip' => 'E.g: 2-ADAM-1, 2A1',
				'attributes' => 'required',
				'style' => 'text-transform: uppercase;'
			));
		}
	?>
</div>