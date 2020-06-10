<div class="form-group col-xl-<?= $dateSize ?>">
	<label>Date</label>
	<div class="input-group">
		<input
			class="form-control"
			type="text"
			id="inputDateFrom"
			name="inputDateFrom"
			value="<?= $dateValue ?>"
			placeholder="DD/MMM/YYYY"
			required
			style="<?= $style ?>"
		>
		<div class="input-group-prepend input-group-append">
			<span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
		</div>
		<input
			class="form-control"
			type="text"
			id="inputDateTo"
			name="inputDateTo"
			value=""
			placeholder="DD/MMM/YYYY"
			style="<?= $style ?>"
		>
	</div>
</div>
<div class="form-group col-xl-<?= $timeSize ?>">
	<label>Time</label>
	<div class="input-group">
		<input
			class="form-control"
			type="text"
			id="inputTimeFrom"
			name="inputTimeFrom"
			value="<?= $timeValue ?>"
			placeholder="00:00"
			required
			style="<?= $style ?>"
		>
		<div class="input-group-prepend input-group-append">
			<span class="input-group-text"><i class="fa fa-fw fa-clock"></i></span>
		</div>
		<input
			class="form-control"
			type="text"
			id="inputTimeTo"
			name="inputTimeTo"
			placeholder="24:00"
			required
			style="<?= $style ?>"
		>
	</div>
</div>