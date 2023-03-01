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
<details id="guidelineDropdown" class="card text-white bg-info p-2 text-center"
<?php
	$openStatus = $g->findCookie('openStatus');
	if ($openStatus == 1) {
		echo "open";
	}
?>
>
	<summary>Arrest & Charging Guidelines</summary>
	<div class="card text-white bg-info">
		<div class="card-body">
			<h4 class="card-title text-center font-weight-bold"><i class="mr-2 fas fa-fw fa-info-circle"></i>Arresting & Charging</h4>
			<h5 class="card-title text-center">Rules & Guidelines</h5>
			<div class="card-text text-center">			
				<div class="row">				
					<div class="col-8 mx-auto text-centre">
						<h6>When arresting & charging someone, the following guidelines must be followed by the Law Enforcement Personnel performing the arrest. This will act as a barrier for protection and failure to follow these rules may result in administrative punishment.</h6>
						
					</div>
				</div>
			</div>
			<hr>
			<div class="card-text text-center">			
				<div class="row">								
					<div class="col-8 mx-auto text-centre">	
					<h5>The following only applies to <strong>Not Guilty</strong> pleas:</h6>
					</div>	
					<div class="col-8 mx-auto text-left">
						<ul>
							<li>If they are eligible for bail as outlined by the <a href="https://docs.google.com/spreadsheets/d/1jlu8AltrHmOR192CAhznfsfZBxrv6_EMGuXFW7SwRdU/edit#gid=35191157"> <strong>outlined conditions</strong></a>, the defendant must be presented with the option to bail out of prison. </a></li>
							<li>They <strong>must</strong> pay the bail in full prior to being released.</li>
							<li>If they do not wish to take bail, are unable to pay it or do not meet conditions for bail. they are to be imprisoned for <strong>9999</strong> days.</li>
							<li>The District Attorney's Office must be informed (via the Post Arrest Submission system) that the defendant has pled Not Guilty and the bail conditions must be relayed to the District Attorney's Office.</li>
						</ul>
					</div>
				</div>
			</div>
			<hr>
			<div class="card-text text-center">			
				<div class="row">								
					<div class="col-8 mx-auto text-centre">	
					<h5>The following only applies to <strong>No Contest</strong> and </strong>Guilty</strong> pleas:</h6>
					</div>	
					<div class="col-8 mx-auto text-left">
						<ul>
							<li>No arest can exceed <strong>20 days</strong> This is the maximum arrest length.</li>
							<li>Do not impound vehicles for longer then <strong>14 days</strong> This is the maximum impound length.</li>
							<li>Do not suspend licenses for longer then <strong>14 days</strong> This is the maximum suspension length.</li>
						</ul>
					</div>
				</div>
			</div>
			<hr>
			<div class="card-text text-center">			
				<div class="row">								
					<div class="col-8 mx-auto text-centre">	
					<h5>The following only applies to <strong>No Contest</strong> pleas:</h6>
					</div>	
					<div class="col-8 mx-auto text-left">
						<ul>
							<li>The defendant must be charged with the <strong>maximum sentence</strong> for each of the charges brought against them.</li>
							<li>The District Attorney's Office must be informed (Via the Post Arrest Submission system) that the defendant has pled No Contest.</li>
						</ul>
					</div>
				</div>
			</div>
			<hr>
			<div class="card-text text-center">			
				<div class="row">								
					<div class="col-8 mx-auto text-centre">	
					<h5>The following only applies to <strong>No Contest</strong> pleas:</h6>
					</div>	
					<div class="col-8 mx-auto text-left">
						<ul>
							<li>The defendant must be charged with the <strong>minimum sentence</strong> for each of the charges brought against them.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</details>
<hr>
