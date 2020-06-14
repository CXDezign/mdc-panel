<div class="form-group col-xl-<?= $size ?> <?= $class ?>">
	<label><?= $label ?></label>
	<div>
		<input
			id="<?= $id ?>"
			type="checkbox"
			data-toggle="toggle"
			data-off="<?= $dataOff ?>"
			data-on="<?= $dataOn ?>"
			data-offstyle="<?= $dataOffStyle ?>"
			data-onstyle="<?= $dataOnStyle ?>"
			data-width="<?= $dataWidth ?>"
			data-height="<?= $dataHeight ?>"
			<?= $attributes ?>
		>
		<input
			type="hidden"
			id="<?= $id ?>Hidden"
			name="<?= $name ?>"
			value="0"
		>
	</div>
</div>
<script>
	$(document).ready(function() {

		(function() {

			let toggleID = '#<?= $id ?>';
			let toggleIDHidden = toggleID+'Hidden';

			$(toggleID).change(function() {

				let checkChecked = $(toggleID).is(':checked');

				if (checkChecked == false) {
					$(toggleIDHidden).val(0);
				}
				if (checkChecked == true) {
					$(toggleIDHidden).val(1);
				}

			});

		})();

	});
</script>