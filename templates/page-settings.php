<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-cog mr-2"></i>Settings</h1>
	<hr>
	<h4 class="text-center mb-3"><i class="fas fa-globe fa-fw mr-2"></i>Site Preferences</h4>
	<form>
		<div class="row">
			<div class="form-group col-xl-12">
				<label class="text-center d-block">Clear Site Cookies</label>
				<div class="container my-2 text-center">
					<button type="submit" id="clearCookies" name="clearCookies" class="btn btn-danger px-5">
						<i class="fas fa-cookie-bite fa-fw mr-1"></i>Clear Site Cookies
					</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-4 d-flex flex-column mb-3">
				<label class="d-block text-center">Toggle Day/Night Mode</label>
				<div class="mx-auto">
					<input
						id="settingsToggleMode"
						name="settingsToggleMode"
						type="checkbox"
						data-toggle="toggle"
						data-off="<i class='fas fa-fw fa-moon'></i>"
						data-on="<i class='fas fa-fw fa-sun'></i>"
						data-onstyle="light"
						data-offstyle="dark"
						data-width="120"
						data-height="20"
						<?= getToggle('toggleMode') ?>
					>
				</div>
			</div>
			<div class="col-xl-4 d-flex flex-column mb-3">
				<label class="d-block text-center">Toggle Live Clock</label>
				<div class="mx-auto">
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
						<?= getToggle('toggleClock') ?>
					>
				</div>
			</div>
			<div class="col-xl-4 d-flex flex-column mb-3">
				<label class="d-block text-center">Toggle Breadcrumb</label>
				<div class="mx-auto">
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
						<?= getToggle('toggleBreadcrumb') ?>
					>
				</div>
			</div>
			<div class="col-xl-4 d-flex flex-column mb-3">
				<label class="d-block text-center">Toggle Background Logo</label>
				<div class="mx-auto">
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
						<?= getToggle('toggleBackgroundLogo') ?>
					>
				</div>
			</div>
			<div class="col-xl-4 d-flex flex-column mb-3">
				<label class="d-block text-center">Toggle Hints</label>
				<div class="mx-auto">
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
						<?= getToggle('toggleHints') ?>
					>
				</div>
			</div>
			<div class="col-xl-4 d-flex flex-column mb-3">
				<label class="d-block text-center">Toggle Footer</label>
				<div class="mx-auto">
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
						<?= getToggle('toggleFooter') ?>
					>
				</div>
			</div>
			<div class="col-xl-4 d-flex flex-column mb-3">
				<label class="d-block text-center">Toggle Live Visitor Counter</label>
				<div class="mx-auto">
					<input
						id="settingsToggleLiveVisitorCounter"
						name="settingsToggleLiveVisitorCounter"
						type="checkbox"
						data-toggle="toggle"
						data-off="<i class='fas fa-fw fa-users'></i>"
						data-on="<i class='fas fa-fw fa-ban'></i>"
						data-onstyle="danger"
						data-offstyle="success"
						data-width="120"
						data-height="20"
						<?= getToggle('toggleLiveVisitorCounter') ?>
					>
				</div>
			</div>
		</div>
	</form>
	<hr class="my-3">
	<h4 class="d-block text-center mb-3"><i class="fas fa-user-cog fa-fw mr-2"></i>Character Settings</h4>
	<form>
		<div class="row">
			<div class="form-group col-xl-6">
				<label class="d-block text-center">Full Name</label>
				<input
				class="form-control"
				type="text"
				id="inputName"
				name="inputName"
				placeholder="Firstname Lastname"
				value="<?= $g->findCookie('officerName') ?>"
				required>
			</div>
			<div class="form-group col-xl-4">
				<label class="d-block text-center">Rank</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
					</div>
					<select
					class="form-control selectpicker"
					id="inputRank"
					name="inputRank"
					title="Select Rank"
					required>
					<?= $pg->rankChooser(1) ?>
					</select>
				</div>
			</div>
			<div class="form-group col-xl-2">
				<label class="d-block text-center">Badge</label>
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
					value="<?= $g->findCookie('officerBadge') ?>"
					required>
				</div>
			</div>
		</div>
		<hr>

	<h4 class="d-block text-center mb-3"><i class="fas fa-gavel fa-fw mr-2"></i>Legal Character Settings</h4>
		<div class="row">
			<div class="form-group col-xl-6">
				<label class="d-block text-center">Full Name</label>
				<input
				class="form-control"
				type="text"
				id="l_inputName"
				name="l_inputName"
				placeholder="Firstname Lastname"
				value="<?= $g->findCookie('legalName') ?>"
				required>
			</div>
			<div class="form-group col-xl-4">
				<label class="d-block text-center">Rank</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-user-shield"></i></span>
					</div>
					<select
					class="form-control selectpicker"
					id="l_inputRank"
					name="l_inputRank"
					title="Select Rank"
					required>
					<?= $pg->rankChooser(2, ["LSDA", "JSA"]) ?>
					</select>
				</div>
			</div>
			<div class="form-group col-xl-2">
				<label class="d-block text-center">Badge</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-fw fa-hashtag"></i></span>
					</div>
					<input
					class="form-control" 
					type="number"
					id="l_inputBadge"
					name="l_inputBadge"
					placeholder="####"
					value="<?= $g->findCookie('legalBadge') ?>"
					required>
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
<?php
	function getToggle($input) {

		global $g;

		$toggle = $g->findCookie($input);

		if (!$toggle) {
			return '';
		} else {
			return 'checked';
		}

	}
?>
<script>

	$(document).ready(function() {

		$('#clearCookies').click(function(e) {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: 'controllers/settings.php',
				data: {
					type: "settingsClearCookies"
				},
				success: function () {
					setTimeout(function() {
						location.reload();
					}, 400);
				},
			});
		});

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

		$('#settingsToggleLiveVisitorCounter').change(function() {
			$.ajax({
				type: 'POST',
				url: 'controllers/settings.php',
				data: {
					type: "settingsToggleLiveVisitorCounter"
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

			name = $.trim($("#inputName").val());
			rank = $.trim($("#inputRank").val());
			badge = $.trim($("#inputBadge").val());
			l_name = $.trim($("#l_inputName").val());
			l_rank = $.trim($("#l_inputRank").val());
			l_badge = $.trim($("#l_inputBadge").val());

			if ((name === "" || rank === "" || badge === "") & (l_name === "" || l_rank === "" || l_badge === "")) {

				$('#submit').tooltip({
					trigger : 'click',
					placement : 'bottom',
					title : '<i class="mr-1 fas fa-fw fa-exclamation-triangle"></i>Empty Fields!',
					html : true
				});

				$('#submit').tooltip('show');

				setTimeout(function() {
					$('#submit').tooltip('hide');
				}, 800);

			} else {

				$.ajax({
					type: 'POST',
					url: 'controllers/settings.php',
					data: {
						type: "settingsCharacter",
						name: $("#inputName").val(),
						rank: $("#inputRank").val(),
						badge: $("#inputBadge").val(),
						l_name: $("#l_inputName").val(),
						l_rank: $("#l_inputRank").val(),
						l_badge: $("#l_inputBadge").val()
					},
					success: function () {
						setTimeout(function() {
							location.reload();
						}, 400);
					},
				});

			}

		});

	});

</script>