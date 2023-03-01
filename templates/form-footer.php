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

		// Charging Guidelines Dropdown
		$('#guidelineDropdown').on('toggle', function() {
			let openStatus = 0;
			if($('#guidelineDropdown').prop('open')){
				openStatus = 1;
			} else {
				openStatus = 0;
			}

			$.ajax({
				type: "POST",
				url: "/controllers/form-processor.php",
				data: {
					openStatus: openStatus
				},
				dataType: "text",
				success: function (response) {
					
				}
			});
		})

		// Traffic Report & Arrest Report Generators

			//  Traffic Report & Arrest Report Generators - Dynamic Crime Selector
			$(document).on('change', 'select.inputCrimeSelector', function(e) {

				e.preventDefault();

				let clickedElementID = '#'+e.target.id;
				let crimeClassSelector = $(clickedElementID).parents('.crimeSelectorGroup').find('.inputCrimeClassSelector select').attr('id');
				let crimeOffenceSelector = $(clickedElementID).parents('.crimeSelectorGroup').find('.inputCrimeOffenceSelector select').attr('id');
				let crimeSubstanceCategorySelector = $(clickedElementID).parents('.crimeSelectorGroup').find('.inputCrimeSubstanceCategorySelector select').attr('id');
				let crimeAdditionSelector = $(clickedElementID).parents('.crimeSelectorGroup').find('.inputCrimeAdditionSelector select').attr('id');

				$.ajax({
					url: '/controllers/form-processor.php',
					type: 'POST',
					dataType: 'text',
					data: {
						crimeID: $(clickedElementID).val(),
						getType: 'getCrime'
					},
					success: function(response) {
						let classSelector = '#'+crimeClassSelector;
						let offenceSelector = '#'+crimeOffenceSelector;
						let substanceCategorySelector = '#'+crimeSubstanceCategorySelector;
						let additionSelector = '#'+crimeAdditionSelector;
						response = $.parseJSON(response);

						$(classSelector).find('option').remove();
						$(classSelector).append(response[0]);
						$(classSelector).attr('required', true).selectpicker({title: ''}).trigger('change').selectpicker('refresh').selectpicker('render');

						$(offenceSelector).find('option').remove();
						$(offenceSelector).append(response[1]);
						$(offenceSelector).attr('required', true).selectpicker({title: ''}).trigger('change').selectpicker('refresh').selectpicker('render');

						$(substanceCategorySelector).find('option').remove();
						$(substanceCategorySelector).append(response[2]);
						$(substanceCategorySelector).attr('required', true).selectpicker({title: ''}).trigger('change').selectpicker('refresh').selectpicker('render');

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
					if ($('body').find($group).length <= $maxSlots) {
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


		// Person & Suspect Handling

			// Person Slots
			(function() {
				
				let $maxSlots = 4;
				let $group = '.groupSlotPerson';
				let $class = $group.replace('.', '');
				let $add = '.addPerson';
				let $remove = '.removePerson';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupSlotPerson').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length <= $maxSlots) {
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

			// Suspect Slots
			(function() {
				
				let $maxSlots = 8;
				let $group = '.groupSlotSuspect';
				let $class = $group.replace('.', '');
				let $add = '.addSuspect';
				let $remove = '.removeSuspect';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupSlotSuspect').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length <= $maxSlots) {
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
					if ($('body').find($group).length <= $maxSlots) {
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

			var $universalChargeCount = 0;

			// Arrest Report Generator - Charge Slots
			(function() {

				let $maxSlots = 30;
				let $group = '.groupSlotCharge';
				let $class = $group.replace('.', '');
				let $add = '.addCharge';
				let $remove = '.removeCharge';
				let $copyGroup = '<div class="form-row '+$class+' crimeSelectorGroup">'+$('.copyGroupSlotCharge').html()+'</div>';

				$($add).click(function() {
					if ($('body').find($group).length <= $maxSlots) {
						$('body').find($group+':last').after($copyGroup);
						var Last = $('body').find($group+':last');
						Last.find("#inputCrime-").attr("id", "inputCrime-"+$universalChargeCount);
						Last.find("#inputCrimeClass-").attr("id", "inputCrimeClass-"+$universalChargeCount);
						Last.find("#inputCrimeOffence-").attr("id", "inputCrimeOffence-"+$universalChargeCount);
						Last.find("#inputCrimeAddition-").attr("id", "inputCrimeAddition-"+$universalChargeCount);
						$universalChargeCount++;
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

			// Arrest Report Generator - Drug Charge Slots
			(function() {

				let $maxSlots = 30;
				let $group = '.groupSlotCharge';
				let $class = $group.replace('.', '');
				let $add = '.addDrugCharge';
				let $remove = '.removeDrugCharge';
				let $copyGroup = '<div class="form-row '+$class+' crimeSelectorGroup">'+$('.copyGroupSlotDrugCharge').html()+'</div>';

				$($add).click(function() {
					if ($('body').find($group).length <= $maxSlots) {
						$('body').find($group+':last').after($copyGroup);
						var Last = $('body').find($group+':last');
						Last.find("#inputCrimeDrug-").attr("id", "inputCrimeDrug-"+$universalChargeCount);
						Last.find("#inputCrimeDrugClass-").attr("id", "inputCrimeDrugClass-"+$universalChargeCount);
						Last.find("#inputCrimeDrugSubstanceCategory-").attr("id", "inputCrimeSubstanceDrugCategory-"+$universalChargeCount);
						Last.find("#inputCrimeDrugAddition-").attr("id", "inputCrimeDrugAddition-"+$universalChargeCount);
						$universalChargeCount++;
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

		// Parking Ticket Generator

			// Parking Ticket Generator - Evidence Photograph
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
					if ($('body').find($group).length <= $maxSlots) {
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
					if ($('body').find($group).length <= $maxSlots) {
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
					if ($('body').find($group).length <= $maxSlots) {
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
				
				let $maxSlots = 100;
				let $group = '.groupSlotTDTrafficStop';
				let $class = $group.replace('.', '');
				let $add = '.addSlotTS';
				let $remove = '.removeSlotTS';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupSlotTDTrafficStop').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length <= $maxSlots) {
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

			// Traffic Division: Patrol Report Generator - Enforcement Speed
			(function() {
				
				let $maxSlots = 15;
				let $group = '.groupSlotTDEnforcementSpeed';
				let $class = $group.replace('.', '');
				let $add = '.addEnforcementSpeed';
				let $remove = '.removeEnforcementSpeed';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupSlotEnforcementSpeed').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length <= $maxSlots) {
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

			// Traffic Division: Patrol Report Generator - Enforcement Parking
			(function() {
				
				let $maxSlots = 15;
				let $group = '.groupSlotTDEnforcementParking';
				let $class = $group.replace('.', '');
				let $add = '.addEnforcementParking';
				let $remove = '.removeEnforcementParking';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupSlotEnforcementParking').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length <= $maxSlots) {
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

			// Traffic Division: Patrol Report Generator - Enforcement Yielding
			(function() {
				
				let $maxSlots = 15;
				let $group = '.groupSlotTDEnforcementYielding';
				let $class = $group.replace('.', '');
				let $add = '.addEnforcementYield';
				let $remove = '.removeEnforcementYield';
				let $copyGroup = '<div class="form-row '+$class+'">'+$('.copyGroupSlotEnforcementYielding').html()+'</div>';

				$('body').on('click', $add, function() {
					if ($('body').find($group).length <= $maxSlots) {
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

	});
</script>