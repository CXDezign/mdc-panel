<div class="col-xl-<?= $size ?>">
	<label class=""><?= $label ?></label>
	<div class="">
		<input
			id="formToggle"
			type="checkbox"
			data-toggle="toggle"
			data-off="<?= $dataOff ?>"
			data-on="<?= $dataOn ?>"
			data-offstyle="<?= $dataOffStyle ?>"
			data-onstyle="<?= $dataOnStyle ?>"
			data-width="<?= $dataWidth ?>"
			data-height="<?= $dataHeight ?>"
		>
		<input
			type="hidden"
			id="formToggleHidden"
			name="<?= $name ?>"
			value="0"
		>
	</div>
</div>
<script>
	$(document).ready(function() {

		$('#formToggle').change(function() {

			var checkChecked = document.getElementById('formToggle').checked;

			if (checkChecked == false) {
				$('#formToggleHidden').val(0);
			}
			if (checkChecked == true) {
				$('#formToggleHidden').val(1);
			}

		});

	});
</script>