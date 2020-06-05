<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-receipt mr-2"></i>Arrest Report - Charges</h1>
	<hr>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="ArrestCharges">

		<div class="form-row chargeGroup">
			<div class="form-group col-xl-2 mx-auto">
				<div class="input-group-addon">
					<a href="javascript:void(0)" class="btn btn-success w-100 addCharge">
						<i class="fas fa-fw fa-plus-square mr-1"></i>Add Charge
					</a>
				</div>
			</div>
		</div>

		<div class="container mt-5 text-center">
			<a class="btn btn-info px-5" target="_blank" href="<?= $g->getSettings('url-penal-code'); ?>" role="button">
				<i class="fas fa-archive fa-fw mr-1"></i>Open Penal Code
			</a>
		</div>
		
		<div class="container my-5 text-center">
			<button id="submitCharges" type="submit" name="submit" class="btn btn-primary px-5">
				<i class="fas fa-fw fa-plus-square mr-1"></i>Calculate Arrest
			</button>
		</div>
	</form>
	<div class="container fieldChargeCopy" style="display: none;">
		<div class="form-group col-5">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-fw fa-gavel"></i></span>
				</div>
				<select
				class="form-control select-picker-copy inputCrimeSelector"
				data-live-search="true"
				id="inputCrime-"
				name="inputCrime[]"
				required>
				<?= $pg->chargeChooser(); ?>
				</select>
			</div>
		</div>
		<div class="form-group col-auto">
			<select
			class="form-control select-picker-copy inputCrimeClassSelector"
			id="inputCrimeClass-"
			name="inputCrimeClass[]"
			required>
			</select>
		</div>
		<div class="form-group col-auto">
			<select
			class="form-control select-picker-copy inputCrimeOffenceSelector"
			id="inputCrimeOffence-"
			name="inputCrimeOffence[]"
			required>
			</select>
		</div>
		<div class="form-group col-xl-2">
			<select
			class="form-control select-picker-copy"
			id="inputCrimeAddition-"
			name="inputCrimeAddition[]"
			required>
			<?= $pg->listChooser('sentencingAdditionsList') ?>
			</select>
		</div>
		<div class="form-group col-auto">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeCharge" type="button" id="button-addon2">
					<i class="fas fa-fw fa-minus-square"></i>
				</button>
			</div>
		</div>
	</div>
</div>

<?php
	require_once 'form-footer.php';
?>