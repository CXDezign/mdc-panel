<div class="container mb-5 pb-5">
	<h1 class="mt-3">Evidence Registration Log - Form</h1>
	<h6 class="mb-4"><a target="_blank" href="https://lspd.gta.world/viewtopic.php?f=388&t=5760">Evidence Locker Registry - Thread</a></h6>
	<form action="/controllers/formProcessor.inc.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="EvidenceRegistrationLog">

		<h4><i class="fas fa-archive fa-fw"></i> General Details</h4>
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
					value="<?php echo $g->getDate();?>"
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
					value="<?php echo $g->getTime();?>"
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
				value="<?php echo $g->cookieName();?>"
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
					class="form-control"
					id="inputRank"
					name="inputRank"
					required>
					<option value="<?php echo $g->cookieRank(); ?>"><?php echo $g->getRank($g->cookieRank());?></option>
					<?php
						$g->rankChooser();
					?>
					</select>
				</div>
			</div>
		</div>

		<h4><i class="fas fa-user-slash fa-fw"></i> Suspect Information</h4>
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


		<h4><i class="fas fa-cannabis fa-fw"></i> Item Registry</h4>
		<div class="form-row">
			<div class="form-group col-xl-2">
				<label>Category</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-clipboard-list"></i></span>
					</div>
					<select
					class="form-control"
					id="inputItemCategory"
					name="inputItemCategory"
					required>
					<?php
						$el->itemCategoryChooser();
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
					<a href="javascript:void(0)" class="btn btn-success w-100 addItemRegistry"><i class="fas fa-plus-square fa-fw"></i> Item</a>
				</div>
			</div>
		</div>


		<h4><i class="fas fa-camera fa-fw"></i> Evidence</h4>
		<div class="form-row groupEvidence">
			<div class="form-group col-xl-10">
				<input
				class="form-control"
				type="text"
				id="inputEvidenceImage"
				name="inputEvidenceImage[]"
				placeholder="https://imgur.com"
				data-placement="bottom" title="Leave empty if none.">
			</div>
			<div class="form-group col-xl-2">
				<div class="input-group-addon"> 
					<a href="javascript:void(0)" class="btn btn-success w-100 addImage"><i class="fas fa-plus-square fa-fw"></i> Photograph</a>
				</div>
			</div>
		</div>


		<div class="container my-5 text-center">
		<button id="submit" type="submit" name="submit" class="btn btn-primary px-5"><i class="fas fa-plus-square fa-fw"></i>Submit</button>
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
				<button class="btn btn-danger w-100 removeItem" type="button" id="button-addon2"><i class="fas fa-minus-square"></i> Item</button>
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
				<button class="btn btn-danger w-100 removeImage" type="button" id="button-addon2"><i class="fas fa-minus-square"></i> Photograph</button>
			</div>
		</div>
	</div>

</div>


<script type="text/javascript">
	$(document).ready(function(){
		var maxItems = 5;
		$(".addItemRegistry").click(function(){
			if($('body').find('.groupItemRegistry').length < maxItems){
				var fieldHTML = '<div class="form-row groupItemRegistry">'+$(".groupCopyItemRegistry").html()+'</div>';
				$('body').find('.groupItemRegistry:last').after(fieldHTML);
			}else{
				alert('Maximum '+maxItems+' items are allowed.');
			}
		});

		$("body").on("click",".removeItem",function(){ 
			$(this).parents(".groupItemRegistry").remove();
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		var maxEvidence = 5;
		$(".addImage").click(function(){
			if($('body').find('.groupEvidence').length < maxEvidence){
				var fieldHTML = '<div class="form-row groupEvidence">'+$(".groupCopyImage").html()+'</div>';
				$('body').find('.groupEvidence:last').after(fieldHTML);
			}else{
				alert('Maximum '+maxEvidence+' evidence slots are allowed.');
			}
		});

		$("body").on("click",".removeImage",function(){ 
			$(this).parents(".groupEvidence").remove();
		});
	});
</script>
<script>
	$(document).ready(function(){
		$('input').tooltip();
	});
</script>