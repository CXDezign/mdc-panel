<hr>
<h4 class="mb-2"><i class="fas fa-fw fa-map-marked-alt mr-2"></i>Location Details</h4>
<div class="form-row">
	<?php
		// Form - Datalist - District
		$c->form('datalist', 'forms', array(
			'size' => '4',
			'label' => '<label>District</label>',
			'icon' => 'map-marked-alt',
			'id' => 'inputDistrict',
			'name' => 'inputDistrict',
			'placeholder' => 'District',
			'tooltip' => 'Location - District',
			'attributes' => 'required',
			'list' => 'district_list',
			'listChooser' => $pg->listChooser('districtsList')
		));
		// Form - Datalist - Street Name
		$c->form('datalist', 'forms', array(
			'size' => '4',
			'label' => '<label>Street Name</label>',
			'icon' => 'road',
			'id' => 'inputStreet',
			'name' => 'inputStreet',
			'placeholder' => 'Street Name',
			'tooltip' => 'Location - Street Name',
			'attributes' => 'required',
			'list' => 'street_list',
			'listChooser' => $pg->listChooser('streetsList')
		));
	?>
</div>