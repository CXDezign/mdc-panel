<script type="text/javascript">

	// Alert Prior to Closing Tab/Window
	window.onbeforeunload = function(e) {
		return "Woah! Slow down there cowboy, are you sure you want to lose that report?";
	};

	$(document).ready(function() {

		// Allow redirects without alerts
		$('a').click(function () {
			window.onbeforeunload = null;
		});
		$('form').submit(function () {
			window.onbeforeunload = null;
		});

		// Initialise Tooltips
		$('input').tooltip();

		// Functions

		// Initialise tooltips on copy slots
		function initialiseTooltips() {
			$('input').tooltip();
		}

		// Initialise select picker on copy slots
		function copySlotSelectPicker($input) {
			$input.find('.select-picker-copy').addClass('selectpicker');
			$('.selectpicker').selectpicker('refresh');
		};

		// Popup message when max slots is reached for slot section
		function maxSlots($maxSlots) {
			alert('Maximum '+$maxSlots+' slots are allowed.');
		}


		// Traffic Report & Arrest Report Generators

			// Dynamic Crime Selector - Traffic Report & Arrest Report Generators
			$(document).on('change', 'select.inputCrimeSelector', function (e) {

				e.preventDefault();

				var clickedElementID = '#'+e.target.id;
				var crimeClassSelector = $(clickedElementID).parents('.crimeSelectorGroup').find('.inputCrimeClassSelector select').attr('id');
				var crimeOffenceSelector = $(clickedElementID).parents('.crimeSelectorGroup').find('.inputCrimeOffenceSelector select').attr('id');

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
						var response = $.parseJSON(response);

						$(classSelector).find('option').remove();
						$(classSelector).append(response[0]);
						$(classSelector).attr('required', true).trigger('change').selectpicker('refresh').selectpicker('render');

						$(offenceSelector).find('option').remove();
						$(offenceSelector).append(response[1]);
						$(offenceSelector).attr('required', true).trigger('change').selectpicker('refresh').selectpicker('render');
					},
				});

			});

			// Officers Slots - Traffic Report & Arrest Report Generators
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

			// Citations Slots - Traffic Report Generator
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

			// Registration & Insurance Toggle Logic - Traffic Report Generator
			(function() {

				let $copyGroupRegistered = $('.copyGroupSlotRegistered').html();
				let $copyGroupInsurance = $('.copyGroupSlotInsurance').html();
				let $idRegistered = '#inputVehRegistered';
				let $idInsurance = '#inputVehInsurance';
				let $checkRegistered = $($idRegistered).is(':checked');
				let $checkInsurance = $($idInsurance).is(':checked');

				// Append Registered Detail Fields
				if ($checkRegistered == false) {
					$('body').find('.groupSlotRegistered').append($copyGroupRegistered);
					initialiseTooltips();
				}

				// Registered Toggle
				$($idRegistered).change(function() {

					let $checkRegistered = $($idRegistered).is(':checked');

					// Registered Status
					if ($checkRegistered == false) {
						// Append Registered Detail Fields
						$('body').find('.groupSlotRegistered').append($copyGroupRegistered);
						initialiseTooltips();
						// Show Insurance Row
						$('.groupSlotInsurance').css('display', 'flex');
						// Check if Insurance Was Checked
						if ($($idInsurance).is(':checked')) {
							// Append Insurance Date Field
							$('body').find('.groupSlotInsurance').append($copyGroupInsurance);
							initialiseTooltips();
						}
					}
					// Unregistered Status
					if ($checkRegistered == true) {
						// Remove Registered Detail Fields
						$('.slotVehRO').remove();
						$('.slotVehPlate').remove();
						// Remove Insurance Date Field
						$('.slotInsuranceDate').remove();
						$('.slotInsuranceTime').remove();
						// Set Insurance Toggle to Insured
						$($idInsurance).bootstrapToggle('off');
						// Hide Insurance Row
						$('.groupSlotInsurance').css('display', 'none');
					}

				});

				// Insurance Toggle
				$($idInsurance).change(function() {

					let $checkInsurance = $($idInsurance).is(':checked');

					if ($checkInsurance == false) {
						$('body').find('.groupSlotInsurance').children('.slotInsuranceDate:last').remove();
						$('body').find('.groupSlotInsurance').children('.slotInsuranceTime:last').remove();
					}
					if ($checkInsurance == true) {
						$('body').find('.groupSlotInsurance').append($copyGroupInsurance);
						initialiseTooltips();
					}

				});

			})();

			// Charge Slots - Arrest Report Generator
			var maxCharges = 30;
			var chargeCount = 2;
			$(".addCharge").click(function() {
				if ($('body').find('.chargeGroup').length < maxCharges) {
					var fieldHTML = '<div class="form-row chargeGroup crimeSelectorGroup">'+$(".fieldChargeCopy").html()+'</div>';
					$('body').find('.chargeGroup:last').after(fieldHTML);
					var Last = $('body').find('.chargeGroup:last');
					Last.find("#inputCrime-").attr("id", "inputCrime-"+chargeCount);
					Last.find("#inputCrimeClass-").attr("id", "inputCrimeClass-"+chargeCount);
					Last.find("#inputCrimeOffence-").attr("id", "inputCrimeOffence-"+chargeCount);
					Last.find("#inputCrimeAddition-").attr("id", "inputCrimeAddition-"+chargeCount);
					chargeCount++;
					Last.find('.select-picker-copy').addClass("selectpicker");
					$(".selectpicker").selectpicker('refresh');
				} else {
					alert('Maximum '+maxCharges+' charges are allowed.');
				}
			});
			$("body").on("click",".removeCharge",function() {
				$(this).parents(".chargeGroup").remove();
			});

		// Patrol Log

			// Update Time Function - Called On Add Slot Button
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
		
			// Maximum Slots
			var maxSlotGeneric = 50;

			// Event - Generic - Patrol Log
			$(".addSlotInfo").click(function() {
				if ($('body').find('.groupSlotEvent').length < maxSlotGeneric) {
					var fieldHTML = '<div class="form-row groupSlotEvent">'+$(".groupCopySlotInfo").html()+'</div>';
					$('body').find('.groupSlotEvent:last').after(fieldHTML);
					updateTime();
				} else {
					alert('Maximum '+maxSlotGeneric+' Info slots are allowed.');
				}
			});
			$("body").on("click",".removeSlotInfo",function() { 
				$(this).parents(".groupSlotEvent").remove();
			});

			// Event - Traffic Stop - Patrol Log
			$(".addSlotEventTS").click(function() {
				if ($('body').find('.groupSlotEvent').length < maxSlotGeneric) {
					updateTime();
					var fieldHTML = '<div class="form-row groupSlotEvent">'+$(".groupCopySlotTraffic").html()+'</div>';
					$('body').find('.groupSlotEvent:last').after(fieldHTML);
				} else {
					alert('Maximum '+maxSlotGeneric+' Traffic Stop slots are allowed.');
				}
			});
			$("body").on("click",".removeSlotTS",function() { 
				$(this).parents(".groupSlotEvent").remove();
			});

			// Event - Arrest - Patrol Log
			$(".addSlotArrest").click(function() {
				if ($('body').find('.groupSlotEvent').length < maxSlotGeneric) {
					updateTime();
					var fieldHTML = '<div class="form-row groupSlotEvent">'+$(".groupCopySlotArrest").html()+'</div>';
					$('body').find('.groupSlotEvent:last').after(fieldHTML);
				} else {
					alert('Maximum '+maxSlotGeneric+' Arrest slots are allowed.');
				}
			});	
			$("body").on("click",".removeSlotArrest",function(){ 
				$(this).parents(".groupSlotEvent").remove();
			});

		// Evidence Registration Log

			// Items - Evidence Registration Log
			var maxItems = 5;
			$(".addItemRegistry").click(function() {
				if ($('body').find('.groupItemRegistry').length < maxItems) {
					var fieldHTML = '<div class="form-row groupItemRegistry">'+$(".groupCopyItemRegistry").html()+'</div>';
					$('body').find('.groupItemRegistry:last').after(fieldHTML);
				} else {
					alert('Maximum '+maxItems+' items are allowed.');
				}
			});
			$("body").on("click",".removeItem",function(){ 
				$(this).parents(".groupItemRegistry").remove();
			});

			// Evidence - Evidence Registration Log
			var maxEvidence = 5;
			$(".addImage").click(function() {
				if ($('body').find('.groupEvidence').length < maxEvidence) {
					var fieldHTML = '<div class="form-row groupEvidence">'+$(".groupCopyImage").html()+'</div>';
					$('body').find('.groupEvidence:last').after(fieldHTML);
				} else {
					alert('Maximum '+maxEvidence+' evidence slots are allowed.');
				}
			});
			$("body").on("click",".removeImage",function() { 
				$(this).parents(".groupEvidence").remove();
			});

		// Death Report

			// Witnesses - Death Report
			var maxWitness = 5;
			$(".addWitness").click(function(){
				if($('body').find('.groupWitness').length < maxWitness){
					var fieldHTML = '<div class="form-row groupWitness">'+$(".groupCopyWitness").html()+'</div>';
					$('body').find('.groupWitness:last').after(fieldHTML);
				}else{
					alert('Maximum '+maxWitness+' witnesses are allowed.');
				}
			});
			$("body").on("click",".removeWitness",function(){ 
				$(this).parents(".groupWitness").remove();
			});

			// Evidence - Images - Death Report
			var maxEvidence = 5;
			$(".addEvidenceImage").click(function(){
				if($('body').find('.groupEvidence').length < maxEvidence){
					var fieldHTML = '<div class="form-row groupEvidence">'+$(".groupCopyImage").html()+'</div>';
					$('body').find('.groupEvidence:last').after(fieldHTML);
				}else{
					alert('Maximum 4 evidence slots are allowed.');
				}
			});
			$("body").on("click",".removeImage",function(){ 
				$(this).parents(".groupEvidence").remove();
			});

			// Evidence - Descriptions - Death Report
			$(".addEvidenceBox").click(function(){
				if($('body').find('.groupEvidence').length < maxEvidence){
					var fieldHTML = '<div class="form-row groupEvidence">'+$(".groupCopyBox").html()+'</div>';
					$('body').find('.groupEvidence:last').after(fieldHTML);
				}else{
					alert('Maximum 4 evidence slots are allowed.');
				}
			});
			$("body").on("click",".removeBox",function(){ 
				$(this).parents(".groupEvidence").remove();
			});

		// Traffic Division: Patrol Report Generator

			// Traffic Stops - Traffic Division: Patrol Report Generator
			var maxSlotTS = 30;

			$(".addSlotTS").click(function() {
				if ($('body').find('.groupSlotTS').length < maxSlotTS) {
					var fieldHTML = '<div class="form-row groupSlotTS">'+$(".groupCopySlotTS").html()+'</div>';
					$('body').find('.groupSlotTS:last').after(fieldHTML);
				} else {
					alert('Maximum '+maxSlotTS+' traffic stop slots are allowed.');
				}
			});
			$("body").on("click",".removeSlotTS",function() { 
				$(this).parents(".groupSlotTS").remove();
			});

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
					}

				});

			})();

		// Metropolitan Division: Deployment Log - Generator

			// Team Leader Slots - Metropolitan Division: Deployment Log - Generator
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
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $remove, function() { 
					$(this).parents($group).remove();
				});

			})();

			// Metropolitan Members Slots - Metropolitan Division: Deployment Log - Generator
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
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $remove, function() { 
					$(this).parents($group).remove();
				});

			})();

			// Deployment Event Slots - Metropolitan Division: Deployment Log - Generator
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
					} else {
						maxSlots($maxSlots);
					}
				});
				$('body').on('click', $remove, function() { 
					$(this).parents($group).remove();
				});

			})();

			// Injured Member Slots - Metropolitan Division: Deployment Log - Generator
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