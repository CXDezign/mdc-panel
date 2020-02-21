<!-- CHARGES -->
	<?php 
	  $numCharges = count($_POST['inputCrime']);
		$penal = json_decode(file_get_contents("resources/penalSearch.json"), true);
	      $x = 0;
	      while ($x < $numCharges)
		  {
		  	 $chargeID = $_POST['inputCrime'][$x];
			 $offence = $_POST['inputCrimeOffence'][$x];
			 $classType = $_POST['inputCrimeType'][$x];
			 
			 if ($classType == 1)
			 {
			 	$class = "C";
			 } else if ($classType == 2) {
			 	$class = "B";
			 } else if ($classType == 3) {
			 	$class = "A";
			 }
			 
			 $charge = $penal[$chargeID];
			 $chargeNum = $charge['id'];
			 
			 $chargeName[] =  $charge['type'].$class.' '.$chargeNum.'. '.$charge['charge'];
			 $type[] = $charge['type'];
			 
			 if($chargeID == '69')
			 {
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
			 
			$x++;
		  }  
	  ?>
	<h1 class="my-3">Charges and Fines</h1>
	<table class="table table-striped" style="background-color: white">
	  <thead>
	  	<th scope="col">Charge Name</th>
	  	<th scope="col">Type</th>
	  	<th scope="col">Minimum Time</th>
	  	<th scope="col">Fine</th>
	  	<th scope="col">Impound?</th>
	  	<th scope="col">License Suspension?</th>
  	  </thead>
  	  <tbody>
	    <?php
  		$i = 0;
          while ($i < $numCharges)
		  {
		  	echo '
		  	<tr>
	            <td>
	              '.$chargeName[$i].'
	            </td>
	            <td>
	            ';
	            if($type[$i] == 'F')
				{
					echo '<strong class="text-danger">Felony</strong>';
				} else if($type[$i] == 'M')
				{
					echo '<strong class="text-warning">Misdemeanor</strong>';
				} else if($type[$i] == 'I')
				{
					echo '<strong class="text-success">Infraction</strong>';
				}
	            echo '
	              
	            </td>
	            <td>
	              '.$days[$i].'D '.$hours[$i].'H '.$mins[$i].'M '.'
	            </td>
	            <td class="text-center">
	              $'.number_format($fine[$i]).'
	            </td>
	            <td class="text-right">';
	              if ($impound[$i] == '0')
				  {
				  	echo '<button class="mr-2 mb-2 btn btn-danger" type="button"> No</button>';
				  } else {
				  	echo '<button class="mr-2 mb-2 btn btn-success" type="button"> Yes | '.$impound[$i].' Days</button>';
				  }
	            echo '</td>
	            <td class="text-right">';
	              if ($suspension[$i] == '0')
				  {
				  	echo '<button class="mr-2 mb-2 btn btn-danger" type="button"> No</button>';
				  } else {
				  	echo '<button class="mr-2 mb-2 btn btn-success" type="button"> Yes | '.$suspension[$i].' Days</button>';
				  }
	            echo '</td>
	          </tr>
		  	';
			$i++;
		  }
	  	?>
	  	<tr>
	  		<td colspan="2">Total Time</td>
	  		<td colspan="2">Fines</td>
	  		<td colspan="2">Impound / License Suspension</td>
	  	</tr>
	  	<tr>
	  		<td colspan="2"><strong><?php $d = 0; $daysAdd = 0; while ($d < $numCharges){ $daysAdd=$daysAdd+$days[$d]; $d++; } echo $daysAdd;?> Days | <?php $h = 0; $hourssAdd = 0; while ($h < $numCharges){ $hoursAdd=$hoursAdd+$hours[$h]; $h++; } echo $hoursAdd;?> Hours | <?php $m = 0; $minsAdd = 0; while ($m < $numCharges){ $minsAdd=$minsAdd+$mins[$m]; $m++; } echo $minsAdd;?> Mins</strong></td>
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
						while ($vi < $numCharges)
						{
							 $impoundAdd=$impoundAdd+$impound[$vi]; $vi++; 
						} 
						if($impoundAdd != '0')
						{
							echo '<h6>'.$impoundAdd.' Days Impound</h6>';
						} else {
							echo '<h6>No Impound</h6>';
						}

						$ls = 0; 
						$licenseAdd = 0; 
						while ($ls < $numCharges)
						{
							 $licenseAdd=$licenseAdd+$suspension[$ls]; $ls++; 
						} 
						if($licenseAdd != '0')
						{
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