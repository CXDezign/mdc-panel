<div class="container mb-5 pb-5" data-aos="fade-in" data-aos-duration="1000">
	<h1><i class="fas fa-fw fa-cog mr-2"></i></i>Settings</h1>
	<hr>
	<center><h4><i class="fas fa-globe fa-fw mr-2"></i>Site Preferences</h4></center>
	<form>
		<div class="row">
			<div class="form-group col-xl-4">
				<center>
				<label>Toggle Day/Night Mode</label><br>
					<input
					id="settingsToggleMode"
					name="settingsToggleMode"
					type="checkbox"
					data-toggle="toggle"
					data-off="<i class='fas fa-fw fa-sun'></i>"
					data-on="<i class='fas fa-fw fa-moon'></i>"
					data-onstyle="dark"
					data-offstyle="light"
					data-width="120"
					data-height="20"
					<?php
						$toggleMode = $g->cookieToggleMode();
						if ($toggleMode == false) {
							echo '';
						} else {
							echo 'checked';
						}
					?>
					>
				</center>
			</div>
			<div class="form-group col-xl-4">
				<center>
				<label>Toggle Live Clock</label><br>
					<input
					id="settingsToggleClock"
					name="settingsToggleClock"
					type="checkbox"
					data-toggle="toggle"
					data-off="<i class='fas fa-fw fa-hourglass-half'></i>"
					data-on="<i class='fas fa-fw fa-ban'></i>"
					data-onstyle="danger"
					data-offstyle="success"
					data-width="120"
					data-height="20"
					<?php
						$toggleClock = $g->cookieToggleClock();
						if ($toggleClock == false) {
							echo '';
						} else {
							echo 'checked';
						}
					?>
					>
				</center>
			</div>
			<div class="form-group col-xl-4">
				<center>
				<label>Toggle Breadcrumb</label><br>
					<input
					id="settingsToggleBreadcrumb"
					name="settingsToggleBreadcrumb"
					type="checkbox"
					data-toggle="toggle"
					data-off="<i class='fas fa-fw fa-home'></i>"
					data-on="<i class='fas fa-fw fa-ban'></i>"
					data-onstyle="danger"
					data-offstyle="success"
					data-width="120"
					data-height="20"
					<?php
						$toggleBreadcrumb = $g->cookieToggleBreadcrumb();
						if ($toggleBreadcrumb == false) {
							echo '';
						} else {
							echo 'checked';
						}
					?>
					>
				</center>
			</div>
			<div class="form-group col-xl-4">
				<center>
				<label>Toggle Background Logo</label><br>
					<input
					id="settingsToggleBackgroundLogo"
					name="settingsToggleBackgroundLogo"
					type="checkbox"
					data-toggle="toggle"
					data-off="<i class='fas fa-fw fa-image'></i>"
					data-on="<i class='fas fa-fw fa-ban'></i>"
					data-onstyle="danger"
					data-offstyle="success"
					data-width="120"
					data-height="20"
					<?php
						$toggleBackgroundLogo = $g->cookieToggleBackgroundLogo();
						if ($toggleBackgroundLogo == false) {
							echo '';
						} else {
							echo 'checked';
						}
					?>
					>
				</center>
			</div>
			<div class="form-group col-xl-4">
				<center>
				<label>Toggle Hints</label><br>
					<input
					id="settingsToggleHints"
					name="settingsToggleHints"
					type="checkbox"
					data-toggle="toggle"
					data-off="<i class='fas fa-fw fa-lightbulb'></i>"
					data-on="<i class='fas fa-fw fa-ban'></i>"
					data-onstyle="danger"
					data-offstyle="success"
					data-width="120"
					data-height="20"
					<?php
						$toggleHints = $g->cookieToggleHints();
						if ($toggleHints == false) {
							echo '';
						} else {
							echo 'checked';
						}
					?>
					>
				</center>
			</div>
			<div class="form-group col-xl-4">
				<center>
				<label>Toggle Footer</label><br>
					<input
					id="settingsToggleFooter"
					name="settingsToggleFooter"
					type="checkbox"
					data-toggle="toggle"
					data-off="<i class='fas fa-fw fa-grip-lines'></i>"
					data-on="<i class='fas fa-fw fa-ban'></i>"
					data-onstyle="danger"
					data-offstyle="success"
					data-width="120"
					data-height="20"
					<?php
						$toggleFooter = $g->cookieToggleFooter();
						if ($toggleFooter == false) {
							echo '';
						} else {
							echo 'checked';
						}
					?>
					>
				</center>
			</div>
		</div>
	</form>
	<hr class="my-3"></h1>
	<center><h4><i class="fas fa-user-cog fa-fw mr-2"></i>Character Settings</h4></center>
	<form>
		<div class="row">
			<div class="form-group col-xl-6">
				<center><label>Full Name</label></center>
				<input
				class="form-control"
				type="text"
				id="inputName"
				name="inputName"
				placeholder="Firstname Lastname"
				value="<?php echo $g->cookieName(); ?>">
			</div>
			<div class="form-group col-xl-4">
				<center><label>Rank</label></center>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
					</div>
					<select
					class="form-control"
					id="inputRank"
					name="inputRank">
					<?php
						$pg->rankChooser(1);
					?>
					</select>
				</div>
			</div>
			<div class="form-group col-xl-2">
				<center><label>Badge</label></center>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-hashtag"></i></span>
					</div>
					<input
					class="form-control" 
					type="number"
					id="inputBadge"
					name="inputBadge"
					placeholder="####"
					value="<?php echo $g->cookieBadge(); ?>">
				</div>
			</div>
			<div class="container my-5 text-center">
				<button id="submit" type="submit" name="submit" class="btn btn-primary px-5">
					<i class="fas fa-save fa-fw mr-1"></i>Save Character Settings
				</button>
			</div>
		</div>
	</form>
</div>


<script>

	$(function () {

		$('#settingsToggleMode').change(function() {
			$.ajax({
				type: 'POST',
				url: 'controllers/settings.php',
				data: {
					type: "settingsToggleMode"
				},
				success: function () {
					setTimeout(function() {
						location.reload();
					}, 400);
				},
			});
		});

		$('#settingsToggleClock').change(function() {
			$.ajax({
				type: 'POST',
				url: 'controllers/settings.php',
				data: {
					type: "settingsToggleClock"
				},
				success: function () {
					setTimeout(function() {
						location.reload();
					}, 400);
				},
			});
		});

		$('#settingsToggleBreadcrumb').change(function() {
			$.ajax({
				type: 'POST',
				url: 'controllers/settings.php',
				data: {
					type: "settingsToggleBreadcrumb"
				},
				success: function () {
					setTimeout(function() {
						location.reload();
					}, 400);
				},
			});
		});

		$('#settingsToggleBackgroundLogo').change(function() {
			$.ajax({
				type: 'POST',
				url: 'controllers/settings.php',
				data: {
					type: "settingsToggleBackgroundLogo"
				},
				success: function () {
					setTimeout(function() {
						location.reload();
					}, 400);
				},
			});
		});

		$('#settingsToggleHints').change(function() {
			$.ajax({
				type: 'POST',
				url: 'controllers/settings.php',
				data: {
					type: "settingsToggleHints"
				},
				success: function () {
					setTimeout(function() {
						location.reload();
					}, 400);
				},
			});
		});

		$('#settingsToggleFooter').change(function() {
			$.ajax({
				type: 'POST',
				url: 'controllers/settings.php',
				data: {
					type: "settingsToggleFooter"
				},
				success: function () {
					setTimeout(function() {
						location.reload();
					}, 400);
				},
			});
		});

		$('#submit').click(function(e) {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: 'controllers/settings.php',
				data: {
					type: "settingsCharacter",
					name: $("#inputName").val(),
					rank: $("#inputRank").val(),
					badge: $("#inputBadge").val()
				},
				success: function () {
					setTimeout(function() {
						location.reload();
					}, 400);
				},
			});
		});

	});

</script>