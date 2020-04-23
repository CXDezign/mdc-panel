<div class="container mb-5 pb-5">
	<h1 class="mb-5"><i class="fas fa-fw fa-cog mr-2"></i></i>Settings</h1>

	<form action="/controllers/form-processor.php" method="POST">
	<input type="hidden" id="generatorType" name="generatorType" value="settings">

	<h4><i class="fas fa-globe fa-fw mr-2"></i>Site Preferences</h4>
	<div class="row">
		<div class="form-group col-xl-6">
			<label>Toggle Day/Night Mode</label><br>
			<input
				id="toggleMode"
				type="checkbox"
				data-toggle="toggle"
				data-off="<i class='fas fa-fw fa-sun'></i>"
				data-on="<i class='fas fa-fw fa-moon'></i>"
				data-onstyle="dark"
				data-offstyle="light">
		</div>
	</div>

	<h4><i class="fas fa-user-cog fa-fw mr-2"></i>Character Settings</h4>
	<div class="row mb-5">
		<div class="form-group col-xl-6">
			<label>Full Name</label>
			<input
			class="form-control"
			type="text"
			id="inputName"
			name="inputName[]"
			placeholder="Firstname Lastname"
			value="<?php echo $g->cookieName(); ?>">
		</div>
		<div class="form-group col-xl-4">
			<label>Rank</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
				</div>
				<select
				class="form-control"
				id="inputRank"
				name="inputRank[]">
				<option value="<?php echo $g->cookieRank(); ?>"><?php echo $g->getRank($g->cookieRank());?></option>
				<?php
					$g->rankChooser();
				?>
				</select>
			</div>
		</div>
		<div class="form-group col-xl-2">
			<label>Badge</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-fw fa-hashtag"></i></span>
				</div>
				<input
				class="form-control" 
				type="number"
				id="inputBadge"
				name="inputBadge[]"
				placeholder="####"
				value="<?php echo $g->cookieBadge(); ?>">
			</div>
		</div>
	</div>
	<div class="container my-5 text-center">
		<button id="submit" type="submit" name="submit" class="btn btn-primary px-5">
			<i class="fas fa-save fa-fw mr-2"></i>Save
		</button>
	</div>
	</form>
</div>


<script>

	$(document).on("click", "#toggleMode", function (e) {
		$.ajax({
			url: "controllers/settings.php",
			type: "POST",
			data: {
				type: "toggleMode",
				mode: $('#toggleMode').val()
			},
		});
	});

</script>