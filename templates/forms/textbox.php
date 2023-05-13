<div class="form-group col-xl-<?= $size ?>">
	<?= $label ?>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-fw fa-<?= $icon ?>"></i></span>
		</div>
		<textarea
			class="form-control"
			id="<?= $id ?>"
			name="<?= $name ?>"
			rows="<?= $rows ?>"
			placeholder="<?= $placeholder ?>"
			<?= $attributes ?>
			style="min-height: 100px"><?= isset($value)?$value:"" ?></textarea>
	</div>
	<small class="form-text text-muted text-center">
		<?= $hint ?>
	</small>
</div>