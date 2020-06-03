<?php

	$json = json_decode(file_get_contents("db/dashboard.json"), true);

	$cards = "";

	foreach ($json as $card) {

		$cardType = $card['type'];
		$cardTitle = $card['title'];
		$cardDescription = $card['description'];
		$cardLink = $card['link'];
		$cardID = $card['ID'];
		$cardIcon = $card['icon'];
		$cardTitleIcon = '';
		$cardLinkTarget = '';

		if ($cardType == "external") {
			$cardLink = $g->getSettings($cardLink);
			$cardLinkTarget = 'target="_blank"';
			$cardTitleIcon = '<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i>';
		}

		$cards .= '<div class="grid-item">
			<div class="card card-panel" id="'.$cardID.'">
				<a href="'.$cardLink.'" '.$cardLinkTarget.' class="d-block">
					<div class="card-body text-center">
						<p><i class="fas fa-fw fa-7x fa-'.$cardIcon.' text-muted"></i></p>
						<h5 class="card-title">'.$cardTitle.$cardTitleIcon.'</h5>
						<p class="card-text card-description">'.$cardDescription.'</p>
					</div>
				</a>
			</div>
		</div>';

	}

?>

<div class="container" data-aos="fade-out" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-th-large mr-2"></i>Dashboard</h1>
	<hr>
	<div class="grid" id="dashboard">
		<div class="grid-col grid-col--1"></div>
		<div class="grid-col grid-col--2"></div>
		<?= $cards ?>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.grid').colcade({
			columns: '.grid-col',
			items: '.grid-item'
		});
	});
</script>