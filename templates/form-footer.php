<script type="text/javascript">

	// Alert Prior to Closing Tab/Window
	window.onbeforeunload = function(e) {
		return 'Woah! Slow down there cowboy, are you sure you want to lose that report?';
	};

	$(document).ready(function() {

		// Allow redirects without alerts
		$('a').click(function () {
			window.onbeforeunload = null;
		});
		$('form').submit(function () {
			window.onbeforeunload = null;
		});

		// Functions

		// Initialise Tooltips Function - Initialise tooltips on copy slots
		function initialiseTooltips() {
			$('input').tooltip();
		}
		initialiseTooltips();

		// Initialise Select Picker Function - Initialise select picker on copy slots
		function copySlotSelectPicker($input) {
			$input.find('.select-picker-copy').addClass('selectpicker');
			$('.selectpicker').selectpicker('refresh');
		};

		// Alert Function - Popup message when max slots is reached for copy slots
		function maxSlots($maxSlots) {
			alert('Maximum '+$maxSlots+' slots are allowed.');
		}

		// Update Time Function - Update time field for copy slots
		function updateTime() {

			$.ajax({
				url: '/controllers/form-processor.php',
				type: 'POST',
				data: {
					typeUNIX: 'time',
					getType: 'getUNIX'
				},
				success: function(time) {
					$('.groupSlotEvent:Last').find('.timeSlot').attr("value", time);
				},
			});

		}

		// Traffic Report & Arrest Report Generators

			//  Traffic Report & Arrest Report Generators - Dynamic Crime Selector
			$(document).on('change', 'select.inputCrimeSelector', function (e) {

				e.preventDefault();

				var clickedElementID = '#'+e.target.id;
				var crimeClassSelector = $(clickedElementID).parents('.crimeSelectorGroup').find('.inputCrimeClassSelector select').attr('id');
				var crimeOffenceSelector = $(clickedElementID).parents('.crimeSelectorGroup').find('.inputCrimeOffenceSelector select').attr('id');
				var crimeAdditionSelector = $(clickedElementID).parents('.crimeSelectorGroup').find('.inputCrimeAdditionSelector select').attr('id');

				$.ajax({
					url: '/controllers/form-processor.php',
					type: 'POST',
					dataType: 'text',
					data: {
						crimeID: $(clickedElementID).val(),
						getType: 'getCrime'
					},
					success: function(response) {
						var classSelector = '#'+crimeClassSelector;
						var offenceSelector = '#'+crimeOffenceSelector;
						var additionSelector = '#'+crimeAdditionSelector;
						var response = $.parseJSON(response);

						$(classSelector).find('option').remove();
						$(classSelector).append(response[0]);
						$(classSelector).attr('required', true).selectpicker({title: ''}).trigger('change').selectpicker('refresh').selectpicker('render');

						$(offenceSelector).find('option').remove();
						$(offenceSelector).append(response[1]);
						$(offenceSelector).attr('required', true).selectpicker({title: ''}).trigger('change').selectpicker('refresh').selectpicker('render');

						$(additionSelector).find('option.bs-title-option').remove();
						$(additionSelector).selectpicker({title: ''}).selectpicker('refresh').selectpicker('render');
					},
				});

			});

			// Traffic Report & Arrest Report Generators - Officers Slots
			(function() {
				
				let $maxSlots = 4;
				let $group = '.groupSlotOfficer';
				let $class = $group.replace('.', '');
				let $add = '.addOfficer';
				let $remove = '.removeOfficer';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupSlotOfficer').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length < $maxSlots) {
						$('body').find($group+':last').after($copyGroup);
						copySlotSelectPicker($('body').find($group+':last'));
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $remove, function() { 
					$(this).parents($group).remove();
				});

			})();

		// Traffic Report Generator

			// Traffic Report Generator - Citations Slots
			(function() {

				let $maxSlots = 10;
				let $group = '.groupSlotCitation';
				let $class = $group.replace('.', '');
				let $add = '.addCitation';
				let $remove = '.removeCitation';
				let $copyGroup = '<div class="form-row '+$class+' crimeSelectorGroup">'+$('.copyGroupSlotCitation').html()+'</div>';
				let $count = 2;

				$('body').on('click', $add, function() {
					if ($('body').find($group).length < $maxSlots) {
						$('body').find($group+':last').after($copyGroup);
						var Last = $('body').find($group+':last');
						Last.find("#inputCrime-").attr("id", "inputCrime-"+$count);
						Last.find("#inputCrimeClass-").attr("id", "inputCrimeClass-"+$count);
						$count++;
						copySlotSelectPicker(Last);
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $remove, function() { 
					$(this).parents($group).remove();
				});

			})();

			// Traffic Report Generator - Registration & Insurance Toggle Logic
			(function() {

				let $copyGroupRegistered = $('.copyGroupSlotRegistered').html();
				let $copyGroupInsurance = $('.copyGroupSlotInsurance').html();
				let $groupRegistered = '.groupSlotRegistered';
				let $groupInsurance = '.groupSlotInsurance';
				let $slotInsuranceDate = '.slotInsuranceDate';
				let $slotInsuranceTime = '.slotInsuranceTime';
				let $idRegistered = '#inputVehRegistered';
				let $idInsurance = '#inputVehInsurance';
				let $checkRegistered = $($idRegistered).is(':checked');
				let $checkInsurance = $($idInsurance).is(':checked');

				// Append Registered Detail Fields On Load
				if ($checkRegistered == false) {
					$('body').find($groupRegistered).append($copyGroupRegistered);
					initialiseTooltips();
				}

				// Registered Toggle
				$($idRegistered).change(function() {

					let $checkRegistered = $($idRegistered).is(':checked');

					// Registered Status
					if ($checkRegistered == false) {
						// Append Registered Detail Fields
						$('body').find($groupRegistered).append($copyGroupRegistered);
						initialiseTooltips();
						// Show Insurance Row
						$($groupInsurance).css('display', 'flex');
						// Check if Insurance Was Checked
						if ($($idInsurance).is(':checked')) {
							// Append Insurance Date Field
							$('body').find($groupInsurance).append($copyGroupInsurance);
							initialiseTooltips();
						}
					}
					// Unregistered Status
					if ($checkRegistered == true) {
						// Remove Registered Detail Fields
						$('.slotVehRO').remove();
						$('.slotVehPlate').remove();
						// Remove Insurance Date Field
						$($slotInsuranceDate).remove();
						$($slotInsuranceTime).remove();
						// Set Insurance Toggle to Insured
						$($idInsurance).bootstrapToggle('off');
						// Hide Insurance Row
						$($groupInsurance).css('display', 'none');
					}

				});

				// Insurance Toggle
				$($idInsurance).change(function() {

					let $checkInsurance = $($idInsurance).is(':checked');

					if ($checkInsurance == false) {
						$('body').find($groupInsurance).children($slotInsuranceDate+':last').remove();
						$('body').find($groupInsurance).children($slotInsuranceTime+':last').remove();
					}
					if ($checkInsurance == true) {
						$('body').find($groupInsurance).append($copyGroupInsurance);
						initialiseTooltips();
					}

				});

			})();

		// Arrest Report Generator

			// Arrest Report Generator - Charge Slots
			(function() {

				let $maxSlots = 30;
				let $group = '.groupSlotCharge';
				let $class = $group.replace('.', '');
				let $add = '.addCharge';
				let $remove = '.removeCharge';
				let $copyGroup = '<div class="form-row '+$class+' crimeSelectorGroup">'+$('.copyGroupSlotCharge').html()+'</div>';
				let $count = 0;

				$($add).click(function() {
					if ($('body').find($group).length < $maxSlots) {
						$('body').find($group+':last').after($copyGroup);
						var Last = $('body').find($group+':last');
						Last.find("#inputCrime-").attr("id", "inputCrime-"+$count);
						Last.find("#inputCrimeClass-").attr("id", "inputCrimeClass-"+$count);
						Last.find("#inputCrimeOffence-").attr("id", "inputCrimeOffence-"+$count);
						Last.find("#inputCrimeAddition-").attr("id", "inputCrimeAddition-"+$count);
						$count++;
						copySlotSelectPicker(Last);
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $remove, function() { 
					$(this).parents($group).remove();
				});

			})();

		// Patrol Log Generator
		
			// Patrol Log Generator - Event Slots
			(function() {

				let $maxSlots = 50;
				let $group = '.groupSlotEvent';
				let $class = $group.replace('.', '');
				let $addGeneric = '.addSlotEventGeneric';
				let $addTraffic = '.addSlotEventTraffic';
				let $addArrest = '.addSlotEventArrest';
				let $removeGeneric = '.removeSlotEventGeneric';
				let $removeTraffic = '.removeSlotEventTraffic';
				let $removeArrest = '.removeSlotEventArrest';
				let $copyGroupGeneric = '<div class="form-row '+$class+'">'+$('.copyGroupSlotEventGeneric').html()+'</div>';
				let $copyGroupTraffic = '<div class="form-row '+$class+'">'+$('.copyGroupSlotEventTraffic').html()+'</div>';
				let $copyGroupArrest = '<div class="form-row '+$class+'">'+$('.copyGroupSlotEventArrest').html()+'</div>';

				// Event - Generic
				$($addGeneric).click(function() {
					if ($('body').find($group).length < $maxSlots) {
						$('body').find($group+':last').after($copyGroupGeneric);
						updateTime();
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $removeGeneric, function() { 
					$(this).parents($group).remove();
				});

				// Event - Traffic
				$($addTraffic).click(function() {
					if ($('body').find($group).length < $maxSlots) {
						$('body').find($group+':last').after($copyGroupTraffic);
						updateTime();
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $removeTraffic, function() { 
					$(this).parents($group).remove();
				});

				// Event - Arrest
				$($addArrest).click(function() {
					if ($('body').find($group).length < $maxSlots) {
						$('body').find($group+':last').after($copyGroupArrest);
						updateTime();
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});	
				$('body').on('click', $removeArrest, function() { 
					$(this).parents($group).remove();
				});

			})();

		// Evidence Registration Log

			// Evidence Registration Log - Item Registry
			(function() {
				
				let $maxSlots = 10;
				let $group = '.groupItemRegistry';
				let $class = $group.replace('.', '');
				let $add = '.addItemRegistry';
				let $remove = '.removeItemRegistry';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupItemRegistry').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length < $maxSlots) {
						$('body').find($group+':last').after($copyGroup);
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $remove, function() { 
					$(this).parents($group).remove();
				});

			})();

			// Evidence Registration Log Generator - Evidence
			(function() {
				
				let $maxSlots = 5;
				let $group = '.groupEvidencePhotograph';
				let $class = $group.replace('.', '');
				let $add = '.addEvidencePhotogrtaph';
				let $remove = '.removeEvidencePhotogrtaph';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupEvidencePhotograph').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length < $maxSlots) {
						$('body').find($group+':last').after($copyGroup);
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $remove, function() { 
					$(this).parents($group).remove();
				});

			})();

		// Death Report Generator

			// Death Report Generator - Witnesses
			(function() {
				
				let $maxSlots = 5;
				let $group = '.groupWitness';
				let $class = $group.replace('.', '');
				let $add = '.addWitness';
				let $remove = '.removeWitness';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupWitness').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length-1 < $maxSlots) {
						$('body').find($group+':last').after($copyGroup);
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $remove, function() { 
					$(this).parents($group).remove();
				});

			})();

			// Death Report Generator - Evidence
			(function() {
				
				let $maxSlots = 5;
				let $group = '.groupEvidence';
				let $class = $group.replace('.', '');
				let $addImage = '.addEvidenceImage';
				let $addBox = '.addEvidenceBox';
				let $removeImage = '.removeImage';
				let $removeBox = '.removeBox';
				let $copyGroupImage = '<div class="form-row '+$class+'">'+$('.groupCopyImage').html()+'</div>';
				let $copyGroupBox = '<div class="form-row '+$class+'">'+$('.groupCopyBox').html()+'</div>';

				$('body').on('click', $addImage, function() {
					if ($('body').find($group).length-1 < $maxSlots) {
						$('body').find($group+':last').after($copyGroupImage);
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $removeImage, function() { 
					$(this).parents($group).remove();
				});

				$('body').on('click', $addBox, function() {
					if ($('body').find($group).length-1 < $maxSlots) {
						$('body').find($group+':last').after($copyGroupBox);
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $removeBox, function() { 
					$(this).parents($group).remove();
				});

			})();

		// Traffic Division: Patrol Report Generator

			// Traffic Division: Patrol Report Generator - Traffic Stops
			(function() {
				
				let $maxSlots = 30;
				let $group = '.groupSlotTDTrafficStop';
				let $class = $group.replace('.', '');
				let $add = '.addSlotTS';
				let $remove = '.removeSlotTS';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupSlotTDTrafficStop').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length < $maxSlots) {
						$('body').find($group+':last').after($copyGroup);
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $remove, function() { 
					$(this).parents($group).remove();
				});

			})();

			// Traffic Division: Patrol Report Generator - Patrol Vehicle
			(function() {

				let $copyGroupModel = $('.copyGroupSlotModel').html();
				let $id = '#inputPatrolVehicle';
				let $checkModel = $($id).is(':checked');

				// Unmarked/Marked Patrol Vehicle Toggle
				$($id).change(function() {

					let $checkModel = $($id).is(':checked');

					console.log($checkModel);

					if ($checkModel == false) {
						$('body').find('.groupSlotTDPatrolDetails').children('.slotTDPatrolVehicle:last').remove();
					}
					if ($checkModel == true) {
						$('body').find('.groupSlotTDPatrolDetails').append($copyGroupModel);
						initialiseTooltips();
					}

				});

			})();

		// Metropolitan Division: Deployment Log Generator

			// Metropolitan Division: Deployment Log Generator - Team Leader Slots
			(function() {

				let $maxSlots = 4;
				let $group = '.groupSlotPlatoonTeamLeader';
				let $class = $group.replace('.', '');
				let $add = '.addPlatoonTeamLeader';
				let $remove = '.removePlatoonTeamLeader';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupSlotPlatoonTeamLeader').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length < $maxSlots) {
						$('body').find($group+':last').after($copyGroup);
						var Last = $('body').find($group+':last');
						copySlotSelectPicker(Last);
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $remove, function() { 
					$(this).parents($group).remove();
				});

			})();

			// Metropolitan Division: Deployment Log Generator - Metropolitan Members Slots
			(function() {

				let $maxSlots = 30;
				let $group = '.groupSlotMetropolitanMembers';
				let $class = $group.replace('.', '');
				let $add = '.addMetropolitanMember';
				let $remove = '.removeMetropolitanMember';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupSlotMetropolitanMembers').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length < $maxSlots) {
						$('body').find($group+':last').after($copyGroup);
						var Last = $('body').find($group+':last');
						copySlotSelectPicker(Last);
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $remove, function() { 
					$(this).parents($group).remove();
				});

			})();

			// Metropolitan Division: Deployment Log Generator - Deployment Event Slots
			(function() {

				let $maxSlots = 20;
				let $group = '.groupDeploymentEvent';
				let $class = $group.replace('.', '');
				let $add = '.addDeploymentEvent';
				let $remove = '.removeDeploymentEvent';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupDeploymentEvent').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length < $maxSlots) {
						$('body').find($group+':last').after($copyGroup);
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $remove, function() { 
					$(this).parents($group).remove();
				});

			})();

			// Metropolitan Division: Deployment Log Generator - Injured Member Slots
			(function() {

				let $maxSlots = 30;
				let $group = '.groupSlotInjuredTeamMember';
				let $class = $group.replace('.', '');
				let $add = '.addInjuredTeamMember';
				let $remove = '.removeInjuredTeamMember';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupSlotInjuredTeamMember').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length < $maxSlots) {
						$('body').find($group+':last').after($copyGroup);
						var Last = $('body').find($group+':last');
						copySlotSelectPicker(Last);
						initialiseTooltips();
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $remove, function() { 
					$(this).parents($group).remove();
				});

			})();

	});
</script>