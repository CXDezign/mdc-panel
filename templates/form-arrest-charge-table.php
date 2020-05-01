<?php
	
	require("includes/session-variables.php");

?>
<hr>
<table class="table table-striped table-light table-hover table-sm table-borderless">
	<thead>
		<th scope="col">Title</th>
		<th scope="col">Classification</th>
		<th scope="col">Time</th>
		<th scope="col">Fine</th>
		<th scope="col">Impound</th>
		<th scope="col">License Suspension</th>
		<th scope="col">Court</th>
	</thead>
	<tbody>
		<?= $chargeTable ?>
	</tbody>
</table>
<hr>
<table class="table table-striped table-light table-hover table-sm table-borderless">
	<thead>
		<th>Total Time</th>
		<th>Total Fines</th>
		<th>Total Impound Time</th>
		<th>Total Suspension Time</th>
	</thead>
	<tbody>
		<?= $chargeTableTotals ?>
	</tbody>
</table>
<hr>