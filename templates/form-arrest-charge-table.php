<hr>
<table class="table table-striped table-light table-hover table-sm table-borderless">
	<thead>
		<th scope="col">Title</th>
		<th scope="col" class="text-center">Sentencing</th>
		<th scope="col" class="text-center">Offence</th>
		<th scope="col">Type</th>
		<th scope="col">Time</th>
		<th scope="col" class="text-center">Points</th>
		<th scope="col">Fine</th>
		<th scope="col" class="text-center">Impound</th>
		<th scope="col" class="text-center">Suspension</th>
		<th scope="col" class="text-center">Extra</th>
		<th scope="col" class="text-center">Auto Bail</th>
		<th scope="col" class="text-center">Bail</th>
	</thead>
	<tbody style="font-size: 75%!important">
		<?= $chargeTable ?>
	</tbody>
</table>
<hr>
<table class="table table-striped table-light table-hover table-sm table-borderless">
	<thead>
		<th>Total Time</th>
		<th>Total Points</th>
		<th>Total Fines</th>
		<th>Total Impound Time</th>
		<th>Total Suspension Time</th>
		<th>Total Bail Cost</th>
		<th>Bail Status</th>
	</thead>
	<tbody>
		<?= $chargeTableTotals ?>
	</tbody>
</table>
<div class="card text-white bg-info">
	<div class="card-body">
		<h4 class="card-title text-center font-weight-bold"><i class="mr-2 fas fa-fw fa-info-circle"></i>Important Court Notice</h4>
		<div class="card-text text-center">
			<h6>The following only applies to <strong>Not Guilty</strong> pleas:</h6>
			<div class="row">
				<div class="col-8 mx-auto text-left">
					<ul>
						<li>If they are eligible for bail, you must give it to them.</li>
						<li>They <strong>must</strong> pay the bail in full before released.</li>
						<li>If they do not wish to take bail, or are unable to pay it, jail them for <strong>9999</strong> days.</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="card-text text-center">
			<h6>The following only applies to <strong>No Contest</strong> and <strong>Guilty</strong> pleas:</h6>
			<div class="row">
				<div class="col-8 mx-auto text-left">
					<ul>
						<li>No arrest can exceed <strong>20 Days</strong>. This is the maximum arrest length.</li>
						<li>Do not impound vehicles for longer then <strong>7 Days</strong>. This is the maximum impound length.</li>
						<li>Do not suspend licenses for longer then <strong>7 Days</strong>. This is the maximum suspension length.</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<hr>