<?php

	$json = json_decode(file_get_contents("db/generators.json"), true);

	$generators = "";

	foreach ($json as $generator) {

		$generatorTitle = $generator['title'];
		$generatorLink = $generator['link'];
		$generatorTooltip = $generator['tooltip'];
		$generatorCard = $generator['card'];
		$generatorIcon = $generator['icon'];

		$generators .= '<div class="grid-item">
			<div class="card card-panel" id="'.$generatorCard.'">
				<a href="'.$generatorLink.'"
					data-toggle="tooltip"
					data-html="true"
					data-placement="bottom"
					title="'.$generatorTooltip.'">
					<div class="card-body text-center">
						<p class="card-text"><i class="fas fa-fw fa-7x fa-'.$generatorIcon.' text-muted"></i></p>
						<h6 class="card-title">'.$generatorTitle.'</h6>
					</div>
				</a>
			</div>
		</div>';

	}

?>

<div class="container mx-auto" data-aos="fade-out" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-archive mr-2"></i></i>Paperwork Generators</h1>
	<hr>
	<div class="grid" id="generators">
		<div class="grid-col grid-col--1"></div>
		<div class="grid-col grid-col--2"></div>
		<div class="grid-col grid-col--3"></div>
		<div class="grid-col grid-col--4"></div>
		<?= $generators ?>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.grid').colcade({
			columns: '.grid-col',
			items: '.grid-item'
		});

		// Tooltips
		$('a').tooltip();

	});
</script>