<script type="text/javascript">

	// Alert prior to closing tab/window
	window.onbeforeunload = function(e) {
		return "Woah! Slow down there cowboy, are you sure you want to lose that report?";
	};

	$(document).ready(function(){

		// Allow redirects without alerts
		$('a').click(function () {
			window.onbeforeunload = null;
		});
		$('form').submit(function () {
			window.onbeforeunload = null;
		});

		// Tooltips
		$('input').tooltip();

		// Traffic Division: Patrol Report

			// Traffic Stops
			var maxSlotTS = 30;
			$(".addSlotTS").click(function(){
				if($('body').find('.groupSlotTS').length < maxSlotTS){
					var fieldHTML = '<div class="form-row groupSlotTS">'+$(".groupCopySlotTS").html()+'</div>';
					$('body').find('.groupSlotTS:last').after(fieldHTML);
				} else {
					alert('Maximum '+maxSlotTS+' traffic stop slots are allowed.');
				}
			});
			$("body").on("click",".removeSlotTS",function(){ 
				$(this).parents(".groupSlotTS").remove();
			});

		// Traffic Report & Arrest Report

			// Officers
			var maxSlots = 4;
			$(".addOfficer").click(function(){
				if($('body').find('.officerGroup').length < maxSlots){
					var fieldHTML = '<div class="form-row officerGroup">'+$(".fieldGroupCopy").html()+'</div>';
					$('body').find('.officerGroup:last').after(fieldHTML);
					var Last = $('body').find('.officerGroup:last');
					Last.find('.select-picker-copy').addClass("selectpicker");
					$(".selectpicker").selectpicker('refresh');
				} else {
					alert('Maximum '+maxSlots+' officer slots are allowed.');
				}
			});
			$("body").on("click",".removeOfficer",function(){ 
				$(this).parents(".officerGroup").remove();
			});

			// Citations
			var maxCitations = 10;
			$(".addCitation").click(function(){
				if($('body').find('.citationGroup').length < maxCitations){
					var fieldHTML = '<div class="form-row citationGroup">'+$(".fieldCitationCopy").html()+'</div>';
					$('body').find('.citationGroup:last').after(fieldHTML);
					var Last = $('body').find('.citationGroup:last');
					Last.find('.select-picker-copy').addClass("selectpicker");
					$(".selectpicker").selectpicker('refresh');
				} else {
					alert('Maximum '+maxCitations+' citation slots are allowed.');
				}
			});
			$("body").on("click",".removeCitation",function(){ 
				$(this).parents(".citationGroup").remove();
			});

			// Charges
			var maxCharges = 30;
			$(".addCharge").click(function(){
				if($('body').find('.chargeGroup').length < maxCharges){
					var fieldHTML = '<div class="form-row chargeGroup">'+$(".fieldChargeCopy").html()+'</div>';
					$('body').find('.chargeGroup:last').after(fieldHTML);
					var Last = $('body').find('.chargeGroup:last');
					Last.find('.select-picker-copy').addClass("selectpicker");
					$(".selectpicker").selectpicker('refresh');
				} else {
					alert('Maximum '+maxCharges+' charges are allowed.');
				}
			});
			$("body").on("click",".removeCharge",function(){ 
				$(this).parents(".chargeGroup").remove();
			});

		// Patrol Log

			// Initial Time + Function
			function updateTime() {
				$.ajax({
					url: '/resources/time.php',
					success: function(time) {
					$('.groupCopySlotInfo').find('.timeSlot').attr("value", time);
					$('.groupCopySlotTraffic').find('.timeSlot').attr("value", time);
					$('.groupCopySlotArrest').find('.timeSlot').attr("value", time);
					},
				});
			}
			updateTime();
			// Update Time every 30 seconds
			setInterval(updateTime, 30000);
		
			var event = 1;
			// Maximum Slots
			var maxSlotGeneric = 50;

			// Event - Generic
			$(".addSlotInfo").click(function(){
				if($('body').find('.groupSlotEvent').length < maxSlotGeneric){
					$('.groupCopySlotInfo label').text('Generic Event');
					var fieldHTML = '<div class="form-row groupSlotEvent">'+$(".groupCopySlotInfo").html()+'</div>';
					$('body').find('.groupSlotEvent:last').after(fieldHTML);
					event++;
				} else {
					alert('Maximum '+maxSlotGeneric+' Info slots are allowed.');
				}
			});
			$("body").on("click",".removeSlotInfo",function(){ 
				$(this).parents(".groupSlotEvent").remove();
				event--;
			});


			// Event - Traffic Stop
			$(".addSlotEventTS").click(function(){
				if($('body').find('.groupSlotEvent').length < maxSlotGeneric){
					$('.groupCopySlotTraffic label').text('Traffic Stop');
					var fieldHTML = '<div class="form-row groupSlotEvent">'+$(".groupCopySlotTraffic").html()+'</div>';
					$('body').find('.groupSlotEvent:last').after(fieldHTML);
					event++;
				} else {
					alert('Maximum '+maxSlotGeneric+' Traffic Stop slots are allowed.');
				}
			});
			$("body").on("click",".removeSlotTS",function(){ 
				$(this).parents(".groupSlotEvent").remove();
				event--;
			});

			// Event - Arrest
			$(".addSlotArrest").click(function(){
				if($('body').find('.groupSlotEvent').length < maxSlotGeneric){
					$('.groupCopySlotArrest label').text('Arrest');
					var fieldHTML = '<div class="form-row groupSlotEvent">'+$(".groupCopySlotArrest").html()+'</div>';
					$('body').find('.groupSlotEvent:last').after(fieldHTML);
					event++;
				} else {
					alert('Maximum '+maxSlotGeneric+' Arrest slots are allowed.');
				}
			});	
			$("body").on("click",".removeSlotArrest",function(){ 
				$(this).parents(".groupSlotEvent").remove();
				event--;
			});

		// Evidence Registration Log

			// Items
			var maxItems = 5;
			$(".addItemRegistry").click(function(){
				if($('body').find('.groupItemRegistry').length < maxItems){
					var fieldHTML = '<div class="form-row groupItemRegistry">'+$(".groupCopyItemRegistry").html()+'</div>';
					$('body').find('.groupItemRegistry:last').after(fieldHTML);
				} else {
					alert('Maximum '+maxItems+' items are allowed.');
				}
			});
			$("body").on("click",".removeItem",function(){ 
				$(this).parents(".groupItemRegistry").remove();
			});

			// Evidence
			var maxEvidence = 5;
			$(".addImage").click(function(){
				if($('body').find('.groupEvidence').length < maxEvidence){
					var fieldHTML = '<div class="form-row groupEvidence">'+$(".groupCopyImage").html()+'</div>';
					$('body').find('.groupEvidence:last').after(fieldHTML);
				} else {
					alert('Maximum '+maxEvidence+' evidence slots are allowed.');
				}
			});
			$("body").on("click",".removeImage",function(){ 
				$(this).parents(".groupEvidence").remove();
			});

		// Death Report

			// Witnesses
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

			// Evidence - Images
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

			// Evidence - Descriptions
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

	});
</script>
