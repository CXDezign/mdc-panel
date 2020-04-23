<?php
	if ($g->cookieToggleBreadcrumb() == false) {
?>
<nav>
	<ol class="breadcrumb" id="breadcrumb">
		<li class="breadcrumb-item">
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
				$breadcrumb .= '<li class="breadcrumb-item"><a href="'. $root_domain .'">' . $link . '</a></li>';
			}

			return $breadcrumb;
		}
		echo breadcrumbs();
	}
	?>
	</ol>
</nav>