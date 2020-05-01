<?php

	$json = json_decode(file_get_contents("db/generators.json"), true);

	$generators = "";

	foreach ($json as $generator) {

		$generatorTitle = $generator['title'];
		$generatorLink = $generator['link'];
		$generatorTooltip = $generator['tooltip'];
		$generatorCard = $generator['card'];
		$generatorIcon = $generator['icon'];

		$generators .= '
		<div class="col-xl-3 mb-4">
			<a href="'.$generatorLink.'"
			data-toggle="tooltip"
			data-html="true"
			data-placement="bottom"
			title="'.$generatorTooltip.'">
				<div class="card card-panel bg-dark text-white" id="'.$generatorCard.'">
					<div class="card-body text-center shadow">
						<h6 class="card-title">'.$generatorTitle.'</h6>
						<p class="card-text"><i class="fas fa-fw fa-7x fa-'.$generatorIcon.' text-muted"></i></p>
					</div>
				</div>
			</a>
		</div>';

	}

?>

<div class="container mb-5 pb-5" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-archive mr-2"></i></i>Paperwork Generators</h1>
	<hr>
	<div class="row">
		<?= $generators ?>
	</div>
</div>

<script type="text/javascript">

	// Tooltips
		$('a').tooltip();
		
</script>