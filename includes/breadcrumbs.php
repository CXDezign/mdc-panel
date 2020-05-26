<?php
	if ($g->findCookie('toggleBreadcrumb') == false) {
?>
<nav>
	<ol class="breadcrumb" id="breadcrumb">
		<div data-aos="flip-up" data-aos-duration="25" data-aos-delay="100">
		<li class="breadcrumb-item d-inline-block">
			<a href="/">
				<i class="fa fa-fw fa-th-large mr-1"></i>Dashboard
			</a>
		</li>
		<?php

			function breadcrumbs() {

				$breadcrumb = '';
				$root_domain = "/";
				$breadcrumbs = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

				foreach ($breadcrumbs as $crumb) {
					$link = ucwords(str_replace(array(".php","-","_"), array(""," "," "), $crumb));
					$root_domain .= $crumb.'/';
					$breadcrumb .= '<li class="breadcrumb-item d-inline-block" data-aos="fade-in" data-aos-duration="25" data-aos-delay="100"><a href="'. $root_domain .'">' . $link . '</a></li>';
				}

				return $breadcrumb;
			}
			echo breadcrumbs();
			echo "</div>";
			?>
	</ol>
</nav>

<?php

	}

?>