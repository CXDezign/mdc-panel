<?php
if ($g->findCookie('notificationVersion') != $g->getSettings('site-version')) {
?>
<div id="notification">
	<div class="container">
		<i class="mr-1 fas fa-fw fa-plug"></i>Update
		<a class="mx-1" href="/changelogs#<?= $g->getSettings('site-version') ?>">
			<span class="badge badge-dark"><?= $g->getSettings('site-version') ?></span>
		</a>
		is now out!
		<a class="ml-3" id="notification-dissmiss"><span class="badge badge-trans p-2"><i class="fas fa-fw fa-times"></i></span></a>
	</div>
</div>
<?php
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		// Hide notification
		$('body').on('click', '#notification-dissmiss', function (e) {

			e.preventDefault();

			$.ajax({
				url: '/controllers/form-processor.php',
				type: 'POST',
				data: {
					getType: 'setNotificationVersion'
				},
				success: function(response) {
					$('#notification').css('transform', 'translateY(-48.5px)');
					$('#notification').css('opacity', '0');
					$('#breadcrumb').css('transform', 'translateY(-48.5px)');
					$('.container-page').css('transform', 'translateY(-48.5px)');
					$('#footer').css('transform', 'translateY(-48.5px)');
				},
			});

		});

	});
</script>