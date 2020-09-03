<?php

	$json = json_decode(file_get_contents('db/generators.json'), true);

	$generatorsMDC = '';
	$generatorsForumLSPD = '';

	foreach ($json as $generator) {

		$generatorTitle = $generator['title'];
		$generatorType = $generator['type'];
		$generatorLink = $generator['link'];
		$generatorTooltip = $generator['tooltip'];
		$generatorCard = $generator['card'];
		$generatorIconType = $generator['iconType'];
		$generatorIcon = $generator['icon'];

		if ($generatorIconType == "icon") {
			$generatorIcon = '<i class="fas fa-fw fa-5x fa-'.$generatorIcon.' text-muted"></i>';
		} elseif ($generatorIconType == "image") {
			$generatorIcon = '<img src="'.$generatorIcon.'" width="80px"/>';
		}

		$card = '<div class="grid-item">
					<div class="card card-panel" id="'.$generatorCard.'">
						<a href="'.$generatorLink.'"
							data-toggle="tooltip"
							data-html="true"
							data-placement="bottom"
							title="'.$generatorTooltip.'">
							<div class="card-body text-center">
								<p class="card-text">'.$generatorIcon.'</p>
								<h6 class="card-title">'.$generatorTitle.'</h6>
							</div>
						</a>
					</div>
				</div>';

		switch($generatorType) {

			case 'MDC':
				$generatorsMDC .= $card;
				break;
			case 'ForumLSPD':
				$generatorsForumLSPD .= $card;
				break;

		}

	}

?>

<div class="container" data-aos="fade-out" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-archive mr-2"></i>Paperwork Generators</h1>
	<hr>
	<h5>Mobile Data Computer</h5>
	<div class="grid" id="generators">
		<div class="grid-col grid-col--1"></div>
		<div class="grid-col grid-col--2"></div>
		<div class="grid-col grid-col--3"></div>
		<div class="grid-col grid-col--4"></div>
		<?= $generatorsMDC ?>
	</div>
	<h5>Forum - LSPD</h5>
	<div class="grid" id="generators">
		<div class="grid-col grid-col--1"></div>
		<div class="grid-col grid-col--2"></div>
		<div class="grid-col grid-col--3"></div>
		<div class="grid-col grid-col--4"></div>
		<?= $generatorsForumLSPD ?>
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

		// Hide Charges Table if Accessing Arrest Report Link Directly
		$('body').on('click', '#card-generators-arrest a', function(e) {

			e.preventDefault();

			$.ajax({
				url: '/controllers/form-processor.php',
				type: 'POST',
				data: {
					getType: 'setChargeTable'
				},
				success: function(response) {
					window.location.href = '/paperwork-generators/arrest-report';
				},
			});

		});

	});
</script>