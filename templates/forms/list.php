<div class="form-group col-xl-<?= $size ?>">
	<?= $label ?>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-fw fa-<?= $icon ?>"></i></span>
		</div>
		<select
			class="form-control <?= $class ?>"
			id="<?= $id ?>"
			name="<?= $name ?>"
			title="<?= $title ?>"
			<?= $attributes ?>
		>
			<?= $list ?>
		</select>
	</div>
	<small class="form-text text-muted <?= $hintClass ?>">
		<?= $hint ?>
	</small>
</div>