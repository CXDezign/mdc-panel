<div class="form-group col-xl-<?= $size ?>">
	<?= $label ?>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-fw fa-<?= $icon ?>"></i></span>
		</div>
		<input
			class="form-control <?= $class ?>"
			type="<?= $type ?>"
			id="<?= $id ?>"
			name="<?= $name ?>"
			value="<?= $value ?>"
			placeholder="<?= $placeholder ?>"
			data-placement="bottom" title="<?= $tooltip ?>"
			data-html="true"
			<?= $attributes ?>
			style="<?= $style ?>"
		>
	</div>
</div>