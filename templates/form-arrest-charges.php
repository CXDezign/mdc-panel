<div class="container mb-5 pb-5" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-landmark mr-2"></i>Arrest Report - Charges</h1>
	<hr>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="ArrestCharges">

		<h4><i class="fas fa-fw fa-receipt mr-2"></i>Charges</h4>
		<div class="form-row chargeGroup">
			<div class="form-group col-xl-6">
				<label>Crime ID, Title, & Classification</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-gavel"></i></span>
					</div>
					<select
					class="form-control selectpicker"
					data-live-search="true"
					id="inputCrime"
					name="inputCrime[]"
					required>
					<?php
						$pg->chargeChooser();
					?>
					</select>
				</div>
			</div>
			<div class="form-group col-xl-2">
				<label>Crime Type</label>
				<select
				class="form-control selectpicker"
				id="inputCrimeType"
				name="inputCrimeType[]"
				required>
				<?php
					$pg->crimeTypeChooser();
				?>
				</select>
			</div>
			<div class="form-group col-xl-2">
				<label>Crime Offence</label>
				<select
				class="form-control selectpicker"
				id="inputCrimeOffence"
				name="inputCrimeOffence[]"
				required>
				<?php
					$pg->offenceChooser();
				?>
				</select>
			</div>
			<div class="form-group col-xl-2">
				<label>Options</label>
				<div class="input-group-addon">
					<a href="javascript:void(0)" class="btn btn-success w-100 addCharge">
						<i class="fas fa-fw fa-plus-square mr-1"></i>Add Charge
					</a>
				</div>
			</div>
		</div>
		
		<div class="container mt-2 text-center">
			<a class="btn btn-info px-5" target="_blank" href="<?= $g->getSettings('url-penal-code'); ?>" role="button">
				<i class="fas fa-archive fa-fw mr-1"></i>Open Penal Code
			</a>
		</div>
		
		<div class="container my-5 text-center">
		<button id="submit" type="submit" name="submit" class="btn btn-primary px-5">
			<i class="fas fa-fw fa-plus-square mr-1"></i>Calculate Arrest
		</button>
	</div>
	</form>

	<div class="container fieldChargeCopy" style="display: none;">
		<div class="form-group col-xl-6">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-fw fa-gavel"></i></span>
				</div>
				<select
				class="form-control select-picker-copy"
				data-live-search="true"
				id="inputCrime"
				name="inputCrime[]"
				required>
				<?php
					$pg->chargeChooser();
				?>
				</select>
			</div>
		</div>
		<div class="form-group col-xl-2">
			<select
			class="form-control select-picker-copy"
			id="inputCrimeType"
			name="inputCrimeType[]"
			required>
			<?php
				$pg->crimeTypeChooser();
			?>
			</select>
		</div>
		<div class="form-group col-xl-2">
			<select
			class="form-control select-picker-copy"
			id="inputCrimeOffence"
			name="inputCrimeOffence[]"
			required>
			<?php
				$pg->offenceChooser();
			?>
			</select>
		</div>
		<div class="form-group col-xl-2">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeCharge" type="button" id="button-addon2">
					<i class="fas fa-fw fa-minus-square mr-1"></i>Remove Charge
				</button>
			</div>
		</div>
	</div>
</div>

<?php
	require_once("form-footer.php");
?>