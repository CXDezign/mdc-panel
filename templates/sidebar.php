<nav id="sidebar" class="bg-dark">
	<div class="text-center my-3">
		<a href="index.php"><img src="./images/Logo-MDC.png" width="175px"></a>
	</div>
	<hr class="mx-3">
		<div class="container text-white text-center">
			<div id="timestamp"></div>
		</div>
	<hr class="mx-3">
	<ul class="list-unstyled components px-3">
		<li class="nav-item">
			<a class="nav-link" target="_blank" href="https://mdc.gta.world"><i class="fas fa-fw fa-desktop mr-2"></i>Mobile Data Computer</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="index.php"><i class="fas fa-fw fa-th-large mr-2"></i>Dashboard</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="index.php?page=map"><i class="fas fa-fw fa-map-marker-alt mr-2"></i>Street Guide</a>
		</li>
		<li class="nav-item">
			<a class="nav-link dropdown-toggle" href="#generatorSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
				<i class="fas fa-fw fa-archive mr-2"></i>Paperwork Generators
			</a>
			<ul class="collapse list-unstyled" id="generatorSubmenu">
				<li>
					<a class="nav-link" href="index.php?page=arrestCharges"><i class="fas fa-fw fa-landmark mr-2"></i>Arrest Report</a>
				</li>
				<li>
					<a class="nav-link" href="index.php?page=trafficReport"><i class="fas fa-fw fa-car mr-2"></i>Traffic Report</a>
				</li>
				<li>
					<a class="nav-link" href="index.php?page=evidenceLog"><i class="fas fa-fw fa-cannabis mr-2"></i>Evidence Log</a>
				</li>
				<li>
					<a class="nav-link" href="index.php?page=deathReport"><i class="fas fa-fw fa-skull mr-2"></i>Death Report</a>
				</li>
				<li>
					<a class="nav-link" href="index.php?page=tdPatrolReport"><i class="fas fa-fw fa-car-crash mr-2"></i>TD: Patrol Report</a>
				</li>
				<li>
					<a class="nav-link" href="index.php?page=patrolLog"><i class="fas fa-fw fa-clipboard-list mr-2"></i>Patrol Log</a>
				</li>
			</ul>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="index.php?page=resources"><i class="fas fa-fw fa-book mr-2"></i>Resources</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" target="_blank" href="https://forum.gta.world/en/index.php?/topic/20053-san-andreas-penal-code/"><i class="fas fa-fw fa-balance-scale mr-2"></i>San Andreas Penal Code</a>
		</li>
		<li class="nav-item">
			<a class="nav-link dropdown-toggle" href="#lspdSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
				<i class="fas fa-fw fa-building mr-2"></i>LSPD
			</a>
			<ul class="collapse list-unstyled" id="lspdSubmenu">
				<li>
					<a class="nav-link" target="_blank" href="https://lspd.gta.world"><i class="fas fa-fw fa-columns mr-2"></i>Forums</a>
				</li>
				<li>
					<a class="nav-link" target="_blank" href="https://lspd.gta.world/viewtopic.php?f=20&t=1171"><i class="fas fa-fw fa-book mr-2"></i>Manual</a>
				</li>
				<li>
					<a class="nav-link" target="_blank" href="https://lspd.gta.world/viewforum.php?f=434"><i class="fas fa-fw fa-database mr-2"></i>Reports & Records</a>
				</li>
				<li>
					<a class="nav-link" target="_blank" href="https://docs.google.com/spreadsheets/d/1KsdZ5NkI-GC6uI30LlWYOjnF-7_B02CKYx9Z6BcKhrA/edit#gid=380203790"><i class="fas fa-fw fa-warehouse mr-2"></i>Motorpool</a>
				</li>
				<li>
					<a class="nav-link" target="_blank" href="https://lspd.gta.world/viewtopic.php?f=665&t=12522&p=60722"><i class="fas fa-fw fa-landmark mr-2"></i>Court Laws</a>
				</li>
			</ul>
		</li>
		<li class="nav-item">
			<a class="nav-link" target="_blank" href="https://lssd.gta.world"><i class="fas fa-fw fa-star mr-2"></i>LSSD</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" target="_blank" href="https://lsfd.gta.world"><i class="fas fa-fw fa-fire-extinguisher mr-2"></i>LSFD</a>
		</li>
		<li class="nav-item mt-5">
			<a class="nav-link" target="_blank" href="https://lspd.gta.world/viewtopic.php?f=665&t=24968"><i class="fas fa-fw fa-columns mr-2"></i>MDC Panel - Thread</a>
		</li>
	</ul>
</nav>
<script>
	$(document).ready(function() {
		timestamp();
		setInterval(timestamp, 1000);
	});

	function timestamp() {
		$.ajax({
			url: 'controllers/timestamp.php',
			success: function(data) {
				$('#timestamp').html(data);
			},
		});
	}
</script>