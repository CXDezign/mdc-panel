<div class="container mb-5 pb-5" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-cannabis mr-2"></i>Evidence Registration Log - Form</h1>
	<h6><a target="_blank" href="https://lspd.gta.world/viewtopic.php?f=388&t=5760">Evidence Locker Registry - Thread<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i></a></h6>
	<hr>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="EvidenceRegistrationLog">

		<h4><i class="fas fa-fw fa-archive mr-2"></i>General Details</h4>
		<div class="form-row">
			<div class="form-group col-xl-2">
				<label>Date</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-calendar"></i></span>
					</div>
					<input
					class="form-control"
					type="text"
					id="inputDate"
					name="inputDate"
					placeholder="DD/MMM/YYYY"
					value="<?= $g->getDate() ?>"
					style="text-transform: uppercase;"
					required
					data-placement="bottom" title="DD/MMM/YYYY Format">
				</div>
			</div>
			<div class="form-group col-xl-2">
				<label>Time</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-clock"></i></span>
					</div>
					<input
					class="form-control"
					type="text"
					id="inputTime"
					name="inputTime"
					placeholder="00:00"
					value="<?= $g->getTime() ?>"
					required
					data-placement="bottom" title="24-Hour Format - 00:00">
				</div>
			</div>
			<div class="form-group col-xl-4">
				<label>Full Name</label>
				<input
				class="form-control"
				type="text"
				id="inputName"
				name="inputName"
				placeholder="Firstname Lastname"
				value="<?= $g->cookieName() ?>"
				required
				data-placement="bottom" title="Officer - Full Name">
			</div>
			<div class="form-group col-xl-3">
				<label>Rank</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
					</div>
					<select
					class="form-control selectpicker"
					id="inputRank"
					name="inputRank"
					required>
					<?php
						$pg->rankChooser(1);
					?>
					</select>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-fw fa-user-slash mr-2"></i>Suspect Information</h4>
		<div class="form-row">
			<div class="form-group col-xl-4">
				<label>Full Name</label>
				<input
				class="form-control"
				type="text"
				id="inputSuspectName"
				name="inputSuspectName"
				placeholder="Firstname Lastname"
				required
				data-placement="bottom" title="Suspect - Full Name">
			</div>
		</div>


		<h4><i class="fas fa-fw fa-cannabis mr-2"></i>Item Registry</h4>
		<div class="form-row">
			<div class="form-group col-xl-2">
				<label>Category</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-clipboard-list"></i></span>
					</div>
					<select
					class="form-control selectpicker"
					id="inputItemCategory"
					name="inputItemCategory"
					required>
					<?php
						$pg->itemCategoryChooser();
					?>
					</select>
				</div>
			</div>
		</div>
		<div class="form-row groupItemRegistry">
			<div class="form-group col-xl-4">
				<label>Name</label>
				<input
				class="form-control"
				type="text"
				id="inputItemRegistry"
				name="inputItemRegistry[]"
				placeholder="Name"
				required
				data-placement="bottom" title="Item Name">
			</div>
			<div class="form-group col-xl-2">
				<label>Amount</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-hashtag"></i></span>
					</div>
					<input
					class="form-control"
					type="number"
					id="inputItemAmount"
					name="inputItemAmount[]"
					placeholder="Amount"
					required
					data-placement="bottom" title="Item Amount">
				</div>
			</div>
			<div class="form-group col-xl-2">
				<label>Options</label>
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addItemRegistry">
						<i class="fas fa-fw fa-plus-square mr-1"></i>Item
					</a>
				</div>
			</div>
		</div>


		<h4><i class="fas fa-fw fa-camera mr-2"></i>Evidence</h4>
		<div class="form-row groupEvidence">
			<div class="form-group col-xl-10">
				<input
				class="form-control"
				type="text"
				id="inputEvidenceImage"
				name="inputEvidenceImage[]"
				placeholder="https://imgur.com"
				data-placement="bottom" title="Leave empty if none.">
				<small class="form-text text-muted"><center>Optional evidence field. Only provide direct URLs to images.</center></small>
			</div>
			<div class="form-group col-xl-2">
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addImage">
						<i class="fas fa-fw fa-plus-square mr-1"></i>Photograph
					</a>
				</div>
			</div>
		</div>


		<div class="container my-5 text-center">
		<button id="submit" type="submit" name="submit" class="btn btn-primary px-5">
			<i class="fas fa-fw fa-plus-square mr-1"></i>Submit
		</button>
	</div>
	</form>


	<!-- COPY SLOTS -->


	<div class="container groupCopyItemRegistry" style="display: none;">
		<div class="form-group col-xl-4">
			<input
			class="form-control"
			type="text"
			id="inputItemRegistry"
			name="inputItemRegistry[]"
			placeholder="Name"
			required
			data-placement="bottom" title="Item Name">
		</div>
		<div class="form-group col-xl-2">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-fw fa-hashtag"></i></span>
				</div>
				<input
				class="form-control"
				type="number"
				id="inputItemAmount"
				name="inputItemAmount[]"
				placeholder="Amount"
				required
				data-placement="bottom" title="Item Amount">
			</div>
		</div>
		<div class="form-group col-xl-2">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeItem" type="button" id="button-addon2">
					<i class="fas fa-fw fa-minus-square mr-1"></i>Item
				</button>
			</div>
		</div>
	</div>

	<div class="container groupCopyImage" style="display: none;">
		<div class="form-group col-xl-10">
			<input
			class="form-control"
			type="text"
			id="inputEvidenceImage"
			name="inputEvidenceImage[]"
			placeholder="https://imgur.com">
		</div>
		<div class="form-group col-xl-2">
			<div class="input-group-addon"> 
				<button class="btn btn-danger w-100 removeImage" type="button" id="button-addon2">
					<i class="fas fa-fw fa-minus-square mr-1"></i>Photograph
				</button>
			</div>
		</div>
	</div>

</div>

<?php
	require "form-footer.php";
?>