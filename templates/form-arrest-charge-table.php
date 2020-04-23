<?php

	$numCharges = count($_POST['inputCrime']);
	$penal = json_decode(file_get_contents("resources/penalSearch.json"), true);
	$x = 0;
	while ($x < $numCharges) {

		$chargeID = $_POST['inputCrime'][$x];
		$offence = $_POST['inputCrimeOffence'][$x];
		$classType = $_POST['inputCrimeType'][$x];

		if ($classType == 1) {
			$class = "C";
		} else if ($classType == 2) {
			$class = "B";
		} else if ($classType == 3) {
			$class = "A";
		}

		$charge = $penal[$chargeID];
		$chargeNum = $charge['id'];

		$chargeName[] = $charge['type'].$class.' '.$chargeNum.'. '.$charge['charge'];
		$type[] = $charge['type'];

		$multiDimensionalCrimeTimes = array(412);

		if (in_array($chargeID, $multiDimensionalCrimeTimes)) {
			$days[] = $charge['time'][$offence]['days'];
			$hours[] = $charge['time'][$offence]['hours'];
			$mins[] = $charge['time'][$offence]['min'];
		} else {
			$days[] = $charge['time']['days'];
			$hours[] = $charge['time']['hours'];
			$mins[] = $charge['time']['min'];
		}

		$fine[] = $charge['fine'][$offence];

		$impound[] = $charge['impound'][$offence];

		$suspension[] = $charge['suspension'][$offence];

		$court[] = $charge['court'];

		$x++;
	}
?>
<h1 class="my-3">Sentencing Charges & Citations</h1>
<table class="table table-striped table-light table-hover table-sm table-borderless">
	<thead>
		<th scope="col">Charge Title</th>
		<th scope="col">Type</th>
		<th scope="col">Minimum Sentence Time</th>
		<th scope="col">Fine Amount</th>
		<th scope="col">Impounds</th>
		<th scope="col">License Suspensions</th>
		<th scope="col">Court</th>
	</thead>
	<tbody>
		<?php

		$i = 0;
		while ($i < $numCharges) {
			echo '<tr><td>'.$chargeName[$i].'</td><td>';
			if ($type[$i] == 'F') {
				echo '<strong class="text-danger">Felony</strong>';
			} else if ($type[$i] == 'M') {
				echo '<strong class="text-warning">Misdemeanor</strong>';
			} else if($type[$i] == 'I')	{
				echo '<strong class="text-success">Infraction</strong>';
			}
			echo '</td><td>'.$days[$i].' days, '.$hours[$i].' hours, '.$mins[$i].' minutes '.'</td>
			<td class="text-center">$'.number_format($fine[$i]).'</td>
			<td class="text-left">';
			if ($impound[$i] == '0') {
				echo '<span class="badge badge-dark">No</span>';
			} else {
				echo '<span class="badge badge-success">Yes | '.$impound[$i].' Days</span>';
			}
			echo '</td><td class="text-left">';
			if ($suspension[$i] == '0') {
				echo '<span class="badge badge-dark">No</span>';
			} else {
				echo '<span class="badge badge-success">Yes | '.$suspension[$i].' Days</span>';
			}
			echo '</td><td class="text-left">';
			if ($court[$i] == true) {
				echo '<span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i></span>';
			} else {
				echo '<span class="badge badge-dark"><i class="fas fa-fw fa-times-circle"></i></span>';
			}
			echo '</td></tr>';
			$i++;
		}

		?>
	</tbody>
</table>
<hr>
<table class="table table-striped table-light table-hover table-sm table-borderless">
	<thead>
		<th colspan="2">Total Time</th>
		<th colspan="2">Fines</th>
		<th colspan="2">Impound / License Suspension</th>
	</thead>
	<tbody>
		<tr>
			<td colspan="2">
				<?php
					$hoursAdd = 0;
					$d = 0;
					$daysAdd = 0;
					while ($d < $numCharges) {
						$daysAdd=$daysAdd+$days[$d]; $d++;
					}
					echo $daysAdd.' days, ';
					$h = 0;
					$hourssAdd = 0;
					while ($h < $numCharges) {
						$hoursAdd=$hoursAdd+$hours[$h]; $h++;
					}
					echo $hoursAdd. ' hours, ';
					$m = 0;
					$minsAdd = 0;
					while ($m < $numCharges) {
						$minsAdd=$minsAdd+$mins[$m]; $m++;
					}
					echo $minsAdd.' minutes';
				?>
			</td>
			<td colspan="2">
				<?php
				$z = 0;
				while($z < $numCharges)
				{
					if($fine[$z] != '0')
					{
						echo '<h6>'.$chargeName[$z].' - $'.number_format($fine[$z]).'</h6>';
					}
					$z++;
				}
				?>
			</td>
			<td colspan="2">
				<?php 
				$vi = 0; 
				$impoundAdd = 0; 
				while ($vi < $numCharges) {
					$impoundAdd=$impoundAdd+$impound[$vi]; $vi++; 
				}
				if ($impoundAdd != '0') {
					echo '<h6>'.$impoundAdd.' Days Impound</h6>';
				} else {
					echo '<h6>No Impound</h6>';
				}

				$ls = 0; 
				$licenseAdd = 0; 
				while ($ls < $numCharges) {
					$licenseAdd=$licenseAdd+$suspension[$ls]; $ls++; 
				}
				if ($licenseAdd != '0') {
					echo '<h6>'.$licenseAdd.' Days License Suspension</h6>';
				} else {
					echo '<h6>No Suspension</h6>';
				}
				?>
			</td>
		</tr>
	</tbody>
</table>
<hr>
<!-- CHARGES END -->