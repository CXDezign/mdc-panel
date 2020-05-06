<nav id="sidebar">
	<div class="text-center my-3">
		<a class="d-block" href="/"><img src="/images/Logo-MDC.png" width="175px"></a>
	</div>
	<?php
		if ($g->cookieToggleClock() == false) {
			require "includes/clock.php";
		}
		if ($g->cookieToggleLiveVisitorCounter() == false) {
			require("includes/visitors.php");
		}
	?>
	<ul class="list-unstyled components px-3" data-aos="fade-in" data-aos-duration="25" data-aos-delay="100">
		<li class="nav-item">
			<a class="nav-link" href="/">
				<i class="fas fa-fw fa-th-large mr-2"></i>Dashboard
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" target="_blank" href="https://mdc.gta.world">
				<i class="fas fa-fw fa-desktop mr-2"></i>Mobile Data Computer<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/street-guide">
				<i class="fas fa-fw fa-map-marker-alt mr-2"></i>Street Guide
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link dropdown-toggle" href="#generatorSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
				<i class="fas fa-fw fa-archive mr-2"></i>Paperwork Generators
			</a>
			<ul class="collapse list-unstyled" id="generatorSubmenu">
				<li>
					<a class="nav-link" href="/paperwork-generators/arrest-charges">
						<i class="fas fa-fw fa-landmark mr-2"></i>Arrest Report
					</a>
				</li>
				<li>
					<a class="nav-link" href="/paperwork-generators/traffic-report">
						<i class="fas fa-fw fa-car mr-2"></i>Traffic Report
					</a>
				</li>
				<li>
					<a class="nav-link" href="/paperwork-generators/impound-report">
						<i class="fas fa-fw fa-truck-pickup mr-2"></i>Impound Report
					</a>
				</li>
				<li>
					<a class="nav-link" href="/paperwork-generators/parking-ticket">
						<i class="fas fa-fw fa-parking mr-2"></i>Parking Ticket
					</a>
				</li>
				<li>
					<a class="nav-link" href="/paperwork-generators/evidence-registration-log">
						<i class="fas fa-fw fa-cannabis mr-2"></i>Evidence Log
					</a>
				</li>
				<li>
					<a class="nav-link" href="/paperwork-generators/patrol-log">
						<i class="fas fa-fw fa-clipboard-list mr-2"></i>Patrol Log
					</a>
				</li>
				<li>
					<a class="nav-link" href="/paperwork-generators/traffic-division-patrol-report">
						<i class="fas fa-fw fa-car-crash mr-2"></i>TD: Patrol Report
					</a>
				</li>
				<li>
					<a class="nav-link" href="/paperwork-generators/death-report">
						<i class="fas fa-fw fa-skull mr-2"></i>Death Report
					</a>
				</li>
			</ul>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/useful-resources"><i class="fas fa-fw fa-book mr-2"></i>Useful Resources</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" target="_blank" href="https://forum.gta.world/en/index.php?/topic/20053-san-andreas-penal-code/">
				<i class="fas fa-fw fa-balance-scale mr-2"></i>San Andreas Penal Code<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link dropdown-toggle" href="#lspdSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
				<i class="fas fa-fw fa-building mr-2"></i>LSPD
			</a>
			<ul class="collapse list-unstyled" id="lspdSubmenu">
				<li>
					<a class="nav-link" target="_blank" href="https://lspd.gta.world">
						<i class="fas fa-fw fa-columns mr-2"></i>Forums<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i>
					</a>
				</li>
				<li>
					<a class="nav-link" target="_blank" href="https://lspd.gta.world/viewtopic.php?f=20&t=1171">
						<i class="fas fa-fw fa-book mr-2"></i>Manual<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i>
					</a>
				</li>
				<li>
					<a class="nav-link" target="_blank" href="https://lspd.gta.world/viewforum.php?f=434">
						<i class="fas fa-fw fa-database mr-2"></i>Reports & Records<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i>
					</a>
				</li>
				<li>
					<a class="nav-link" target="_blank" href="https://docs.google.com/spreadsheets/d/1KsdZ5NkI-GC6uI30LlWYOjnF-7_B02CKYx9Z6BcKhrA/edit#gid=380203790">
						<i class="fas fa-fw fa-warehouse mr-2"></i>Motorpool<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i>
					</a>
				</li>
				<li>
					<a class="nav-link" target="_blank" href="https://lspd.gta.world/viewtopic.php?f=665&t=12522&p=60722">
						<i class="fas fa-fw fa-landmark mr-2"></i>Court Laws<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i>
					</a>
				</li>
			</ul>
		</li>
		<li class="nav-item">
			<a class="nav-link" target="_blank" href="https://lssd.gta.world">
				<i class="fas fa-fw fa-star mr-2"></i>LSSD<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" target="_blank" href="https://lsfd.gta.world">
				<i class="fas fa-fw fa-fire-extinguisher mr-2"></i>LSFD<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" target="_blank" href="https://lspd.gta.world/viewtopic.php?f=665&t=24968">
				<i class="fas fa-fw fa-columns mr-2"></i>MDC Panel - Thread<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i>
			</a>
		</li>
		<hr class="my-3">
		<li class="nav-item">
			<a class="nav-link" href="/settings">
				<i class="fas fa-fw fa-cog mr-2"></i>Settings
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/changelogs#<?= $g->getVersion() ?>">
				<i class="fas fa-fw fa-plug mr-2"></i>Changelogs<span class="badge badge-danger ml-3"><?= $g->getVersion() ?></span>
			</a>
		</li>
	</ul>
</nav>