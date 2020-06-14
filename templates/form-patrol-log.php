<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-clipboard-list mr-2"></i>Patrol Log - Form</h1>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="PatrolLog">
		<?php
			// Section - General
			$c->form('general', 'sections', array(
				'g' => $g,
				'c' => $c,
				'time' => false,
				'patrol' => true,
				'callsign' => true
			));
		?>
		<hr>
		<h4><i class="fas fa-fw fa-user-friends mr-2"></i>Partner Details</h4>
		<div class="form-row">
			<?php
				// Form - Textfield - Partner's Name
				$c->form('textfield', 'forms', array(
					'size' => '4',
					'type' => 'text',
					'label' => '<label>Partner&#39;s Full Name</label>',
					'icon' => 'id-card',
					'class' => '',
					'id' => 'inputPartner',
					'name' => 'inputPartner',
					'value' => '',
					'placeholder' => 'Firstname Lastname',
					'tooltip' => 'Leave empty if on solo patrol.',
					'attributes' => '',
					'style' => ''
				));
				// Form - List - Partner's Rank
				$c->form('list', 'forms', array(
					'size' => '3',
					'label' => '<label>Partner&#39;s Rank</label>',
					'icon' => 'user-shield',
					'class' => 'selectpicker',
					'id' => 'inputRank',
					'name' => 'inputRank',
					'attributes' => '',
					'title' => 'Select Rank',
					'list' => $pg->rankChooser(0),
					'hint' => '',
					'hintClass' => ''
				));
			?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-calendar-plus mr-2"></i>Add Events</h4>
		<div class="form-row groupSlotEvent">
			<?php
				// Form - Options Add - Event - Generic
				$c->form('options', 'forms', array(
					'size' => '3',
					'label' => '',
					'action' => 'addSlotEventGeneric',
					'colour' => 'success',
					'icon' => 'fa-plus-square',
					'text' => 'Add Generic Event'
				));
				// Form - Options Add - Event - Traffic Stop
				$c->form('options', 'forms', array(
					'size' => '3',
					'label' => '',
					'action' => 'addSlotEventTraffic',
					'colour' => 'success',
					'icon' => 'fa-plus-square',
					'text' => 'Add Traffic Event'
				));
				// Form - Options Add - Event - Arrest
				$c->form('options', 'forms', array(
					'size' => '3',
					'label' => '',
					'action' => 'addSlotEventArrest',
					'colour' => 'success',
					'icon' => 'fa-plus-square',
					'text' => 'Add Arrest Event'
				));
			?>
		</div>
		<hr>
		<h4><i class="fas fa-fw fa-clipboard mr-2"></i>Notes Section</h4>
		<div class="form-row">
			<?php
				// Form - Textbox - Notes
				$c->form('textbox', 'forms', array(
					'size' => '12',
					'label' => '<label>Notes</label>',
					'icon' => 'clipboard',
					'id' => 'inputNotes',
					'name' => 'inputNotes',
					'rows' => '2',
					'placeholder' => 'Any optional and extra notes regarding the patrol.',
					'attributes' => '',
					'hint' => ''
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

<!-- COPY SLOT - GENERAL EVENT -->
<div class="container copyGroupSlotEventGeneric" style="display: none;">
	<div class="col-xl-12 text-center">
		<hr>
		<input type="hidden" id="type" name="type[]" value="1">
		<label class="font-weight-bold">Generic Event</label>
	</div>
	<?php
		// Form - Textfield - Time - Generic Event
		$c->form('textfield', 'forms', array(
			'size' => '2',
			'type' => 'text',
			'label' => '',
			'icon' => 'clock',
			'class' => 'timeSlot',
			'id' => 'inputTimeEvent',
			'name' => 'inputTimeEvent[]',
			'value' => '',
			'placeholder' => '00:00',
			'tooltip' => '00:00 Format',
			'attributes' => 'required',
			'style' => 'text-transform: uppercase;'
		));
		// Form - Textfield - Generic Event
		$c->form('textfield', 'forms', array(
			'size' => '8',
			'type' => 'text',
			'label' => '',
			'icon' => 'clipboard',
			'class' => '',
			'id' => 'inputReasonInfo',
			'name' => 'inputReasonInfo[]',
			'value' => '',
			'placeholder' => 'Generic Event Details',
			'tooltip' => 'E.g: Handled emergency call ID ####<br>E.g: Provided perimeter on X scene.',
			'attributes' => 'required',
			'style' => ''
		));
		// Form - Options Remove - Generic Event
		$c->form('options', 'forms', array(
			'size' => '2',
			'label' => '',
			'action' => 'removeSlotEventGeneric',
			'colour' => 'danger',
			'icon' => 'fa-minus-square',
			'text' => 'Event'
		));
	?>
</div>
<!-- COPY SLOT - EVENT TRAFFIC -->
<div class="container copyGroupSlotEventTraffic" style="display: none;">
	<div class="col-xl-12 text-center">
		<hr>
		<input type="hidden" id="type" name="type[]" value="2">
		<label class="font-weight-bold">Traffic Event</label>
	</div>
	<div class="form-row col-xl-12">
		<?php
			// Form - Textfield - Time - Traffic Event
			$c->form('textfield', 'forms', array(
				'size' => '2',
				'type' => 'text',
				'label' => '',
				'icon' => 'clock',
				'class' => 'timeSlot',
				'id' => 'inputTimeEvent',
				'name' => 'inputTimeEvent[]',
				'value' => '',
				'placeholder' => '00:00',
				'tooltip' => '00:00 Format',
				'attributes' => 'required',
				'style' => 'text-transform: uppercase;'
			));
			// Form - Textfield - Name - Traffic Event 
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'text',
				'label' => '',
				'icon' => 'id-card',
				'class' => '',
				'id' => 'inputDriverName',
				'name' => 'inputDriverName[]',
				'value' => '',
				'placeholder' => 'Firstname Lastname',
				'tooltip' => 'Driver - Firstname Lastname',
				'attributes' => 'required',
				'style' => ''
			));
			// Form - Textfield - Traffic Stop ID - Traffic Event 
			$c->form('textfield', 'forms', array(
				'size' => '4',
				'type' => 'number',
				'label' => '',
				'icon' => 'hashtag',
				'class' => '',
				'id' => 'inputTrafficID',
				'name' => 'inputTrafficID[]',
				'value' => '',
				'placeholder' => 'Traffic Report ID',
				'tooltip' => 'Traffic Report ID',
				'attributes' => 'required',
				'style' => ''
			));
			// Form - Options Remove - Traffic Event
			$c->form('options', 'forms', array(
				'size' => '2',
				'label' => '',
				'action' => 'removeSlotEventTraffic',
				'colour' => 'danger',
				'icon' => 'fa-minus-square',
				'text' => 'Event'
			));
		?>
	</div>
</div>
<!-- COPY SLOT - EVENT ARREST -->
<div class="container copyGroupSlotEventArrest" style="display: none;">
	<div class="col-xl-12 text-center">
		<hr>
		<input type="hidden" id="type" name="type[]" value="3">
		<label class="font-weight-bold">Arrest Event</label>
	</div>
	<?php
		// Form - Textfield - Time - Arrest Event
		$c->form('textfield', 'forms', array(
			'size' => '2',
			'type' => 'text',
			'label' => '',
			'icon' => 'clock',
			'class' => 'timeSlot',
			'id' => 'inputTimeEvent',
			'name' => 'inputTimeEvent[]',
			'value' => '',
			'placeholder' => '00:00',
			'tooltip' => '00:00 Format',
			'attributes' => 'required',
			'style' => 'text-transform: uppercase;'
		));
		// Form - Textfield - Name - Arrest Event
		$c->form('textfield', 'forms', array(
			'size' => '4',
			'type' => 'text',
			'label' => '',
			'icon' => 'id-card',
			'class' => '',
			'id' => 'inputArrestee',
			'name' => 'inputArrestee[]',
			'value' => '',
			'placeholder' => 'Firstname Lastname',
			'tooltip' => 'Arrestee - Firstname Lastname',
			'attributes' => 'required',
			'style' => ''
		));
		// Form - Textfield - Arrest Report ID - Arrest Event
		$c->form('textfield', 'forms', array(
			'size' => '4',
			'type' => 'number',
			'label' => '',
			'icon' => 'hashtag',
			'class' => '',
			'id' => 'inputArrestID',
			'name' => 'inputArrestID[]',
			'value' => '',
			'placeholder' => 'Arrest Report ID',
			'tooltip' => 'Arrest Report ID',
			'attributes' => 'required',
			'style' => ''
		));
		// Form - Options Remove - Arrest Event
		$c->form('options', 'forms', array(
			'size' => '2',
			'label' => '',
			'action' => 'removeSlotEventArrest',
			'colour' => 'danger',
			'icon' => 'fa-minus-square',
			'text' => 'Event'
		));
	?>
</div>
<?php require_once 'form-footer.php'; ?>