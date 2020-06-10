<?php

	$class = '';
	
	if (!$text == '') {
		$class = 'mr-1 ';
	}
	
?>
<div class="form-group col-xl-<?= $size ?>">
	<?= $label ?>
	<div class="input-group-addon"> 
		<button class="btn btn-<?= $colour ?> w-100 <?= $action ?>" type="button">
			<i class="<?= $class ?>fas fa-fw <?= $icon ?>"></i><?= $text ?>
		</button>
	</div>
</div>