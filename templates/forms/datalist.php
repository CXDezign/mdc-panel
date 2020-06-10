<div class="form-group col-xl-<?= $size ?>">
	<?= $label ?>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-fw fa-<?= $icon ?>"></i></span>
		</div>
		<input
			class="form-control"
			type="text"
			id="<?= $id ?>"
			name="<?= $name ?>"
			placeholder="<?= $placeholder ?>"
			list="<?= $list ?>"
			data-placement="bottom" title="<?= $tooltip ?>"
			<?= $attributes ?>
		>
		<datalist id="<?= $list ?>">
			<?= $listChooser ?>
		</datalist>
	</div>
</div>