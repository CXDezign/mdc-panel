<?php

	$json = json_decode(file_get_contents('db/resources.json'), true);

	$resources = '';

	foreach ($json as $resource) {

		$resourceType = $resource['type'];
		$resourceTitle = $resource['title'];
		$resourceID = $resource['id'];

		if ($resourceType == 'link') {

			$resourceLink = $resource['link'];
			$resourceIcon = $resource['icon'];
			$resourceDescription = $resource['description'];

			$resources .= '<div class="grid-item shadow-lg">
				<a target="_blank" rel="noopener noreferrer" href="'.$g->getSettings($resourceLink).'">
					<div class="card card-resource" id="'.$resourceID.'">
						<div class="card-body">
							<p class="card-text card-icon"><i class="fas fa-fw fa-3x fa-'.$resourceIcon.' text-muted"></i></p>
							<h5 class="card-title">'.$resourceTitle.'<i class="fas fa-fw fa-xs fa-ss fa-external-link-alt ml-2"></i></h5>
							<p class="card-text card-description">'.$resourceDescription.'</p>
						</div>
					</div>
				</a>
			</div>';
		}

		if ($resourceType == 'text') {

			$resourceText = $resource['text'];

			$resources .= '<div class="grid-item">
				<div class="card card-resource">
					<div class="card-body">
						<h5 class="card-title">'.$resourceTitle.'</h5>
						'.$resourceText.'
					</div>
				</div>
			</div>';

		}

		if ($resourceType == 'copy') {

			$resourceText = $resource['text'];

			$resources .= '<div class="grid-item">
				<div class="card card-resource">
					<div class="card-body">
						<h5 class="card-title">'.$resourceTitle.'</h5>
						<textarea
						class="form-control shadow mb-3"
						id="'.$resourceID.'"
						name="'.$resourceID.'"
						rows="4"
						readonly>'.$resourceText.'</textarea>
						<a class="btn btn-primary text-white" data-clipboard-target="#'.$resourceID.'" data-toggle="tooltip" title="Copied!">Copy '.$resourceTitle.'</a>
					</div>
				</div>
			</div>';

		}

		if ($resourceType == 'roleplay' && !$resource['disabled']) {

			$resourceText = $resource['text'];

			$roleplayLines = '';
			foreach ($resourceText as $roleplayLineCount => $roleplayLine) {
				$roleplayLines .= '<textarea class="form-control textboxRP" id="'.$resourceID.$roleplayLineCount.'" readonly>'.$roleplayLine.'</textarea>
				<a class="btn btn-primary text-white mb-3" data-clipboard-target="#'.$resourceID.$roleplayLineCount.'" data-toggle="tooltip" title="Copied!">Copy '.$resourceTitle.' - Line '.$roleplayLineCount.'</a>';
			}

			$resources .= '<div class="grid-item">
				<div class="card card-resource">
					<div class="card-body">
						<h5 class="card-title">'.$resourceTitle.'</h5>
						'.$roleplayLines.'
					</div>
				</div>
			</div>';

		}

	}

?>

<div class="container" data-aos="fade-out" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-book mr-2"></i>Useful Resources</h1>
	<hr>
	<div class="grid" id="resources">
		<div class="grid-col grid-col--1"></div>
		<div class="grid-col grid-col--2"></div>
		<?= $resources ?>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('a[data-toggle="tooltip"]').tooltip({
			delay: { "show": 100, "hide": 100 },
			animated: 'fade',
			placement: 'top',
			trigger: 'click'
		});

		$('.grid').colcade({
			columns: '.grid-col',
			items: '.grid-item'
		});
	});
	$(function () {
		$(document).on('shown.bs.tooltip', function (e) {
			setTimeout(function () {
				$(e.target).tooltip('hide');
			}, 500);
		});
	});
</script>