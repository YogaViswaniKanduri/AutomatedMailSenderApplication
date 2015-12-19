/*======================================
Designed for Windows tile animation and
script validations
========================================*/

$( document ).ready(function() {
    console.log( " User your console is ready!" );
	$(".birthdayWishes #bdtemplate").change( function(){
		var id=$(".birthdayWishes #bdtemplate option:selected").attr('value');
		if(id==0){
			$('#emailTemplateViewer').css('background-color','');
			$('#emailTemplateViewer img').attr('src','');
		}		
		else if(id==1){
			var img = 'email'+id+'.jpg';
			$(".birthdayWishes #bdtemplate").css('border-color','#DADADA');
			$('#emailTemplateViewer').hide("blind");
			$('#emailTemplateViewer').show("blind");
			$('#emailTemplateViewer').css('background-color','#EEE');
			$('#emailTemplateViewer').css('border-radius','0 30px 0 30px');						
			$('#emailTemplateViewer img').attr('src','img/templates/email/'+img);
		}
		else if(id==2){
			var img = 'email'+id+'.jpg';
			$(".birthdayWishes #bdtemplate").css('border-color','#DADADA');
			$('#emailTemplateViewer').hide("blind");
			$('#emailTemplateViewer').show("blind");
			$('#emailTemplateViewer').css('background-color','#EEE');
			$('#emailTemplateViewer').css('border-radius','0 30px 0 30px');			
			$('#emailTemplateViewer img').attr('src','img/templates/email/'+img);			
		}
		
	});	
	
	$(".birthdayWishes #bdwishtype").change( function(){
		var id=$(".birthdayWishes #bdwishtype option:selected").attr('value');
		if(id>1){
			ui.birthday();
		}
	});
	
	$(".feedback #feedbackVisitedOn").change( function(){
		var id=$(".feedback #feedbackVisitedOn option:selected").attr('value');
		if(id>0){
			ui.feedback();
		}
	});
	
	$(".appReminder #remindertime").change( function(){
		var id=$(".appReminder #remindertime option:selected").attr('value');
		if(id>0){
			ui.appointmentremind();
		}
	});
	
	$(".birthdayWishes1 #bdwishtype1").change( function(){
		var id=$(".birthdayWishes1 #bdwishtype1 option:selected").attr('value');
		if(id==1){
			$(".birthdayWishes1 #bd_advance_between_dates").hide();
			$(".birthdayWishes1 #bd_particular_date").hide();
		}
		else if(id==2){
			$(".birthdayWishes1 #bd_advance_between_dates").show();
			$(".birthdayWishes1 #bd_particular_date").hide();
		}
		else if(id==3){
			$(".birthdayWishes1 #bd_advance_between_dates").hide();
			$(".birthdayWishes1 #bd_particular_date").show();
		}
	});
	
	$(".birthdayWishes1 #bdtemplate1").change( function(){
		var id=$(".birthdayWishes1 #bdtemplate1 option:selected").attr('value');
		if(id==0){
			$('#emailTemplateViewer1').css('background-color','');
			$('#emailTemplateViewer1 img').attr('src','');
		}		
		else if(id==1){
			var img = 'email'+id+'.jpg';
			$(".birthdayWishes1 #bdtemplate1").css('border-color','#DADADA');
			$('#emailTemplateViewer1').hide("blind");
			$('#emailTemplateViewer1').show("blind");
			$('#emailTemplateViewer1').css('background-color','#EEE');
			$('#emailTemplateViewer1').css('border-radius','0 30px 0 30px');						
			$('#emailTemplateViewer1 img').attr('src','../img/templates/email/'+img);
		}
		else if(id==2){
			var img = 'email'+id+'.jpg';
			$(".birthdayWishes1 #bdtemplate1").css('border-color','#DADADA');
			$('#emailTemplateViewer1').hide("blind");
			$('#emailTemplateViewer1').show("blind");
			$('#emailTemplateViewer1').css('background-color','#EEE');
			$('#emailTemplateViewer1').css('border-radius','0 30px 0 30px');			
			$('#emailTemplateViewer1 img').attr('src','../img/templates/email/'+img);			
		}
		
	});		
	
	$(".feedback1 #feedbackVisitedOn").change( function(){
		var id=$(".feedback1 #feedbackVisitedOn option:selected").attr('value');
		if(id==0){
			$(".feedback1 #fb_advance_between_dates").hide();
			$(".feedback1 #fb_particular_date").hide();
		}
		else if(id==1){
			$(".feedback1 #fb_advance_between_dates").show();
			$(".feedback1 #fb_particular_date").hide();
		}
		else if(id==2){
			$(".feedback1 #fb_advance_between_dates").hide();
			$(".feedback1 #fb_particular_date").show();
		}
	});
	
	$(".appReminder1 #remindertime1").change( function(){
		var id=$(".appReminder1 #remindertime1 option:selected").attr('value');
		if(id==0){
			$(".appReminder1 #ar_advance_between_dates").hide();
			$(".appReminder1 #ar_particular_date").hide();
		}
		else if(id==1){
			$(".appReminder1 #ar_advance_between_dates").show();
			$(".appReminder1 #ar_particular_date").hide();
		}
		else if(id==2){
			$(".appReminder1 #ar_advance_between_dates").hide();
			$(".appReminder1 #ar_particular_date").show();
		}
	});
	
	$(".makeAnnouncement #annToList").change( function(){
		var id=$(".makeAnnouncement #annToList option:selected").attr('value');
		if(id==1){
			ui.announcement();
		}
	});
	
	$(".makeAnnouncement1 #annType").change( function(){
		
		var id=$(".makeAnnouncement1 #annTypeSelect input[type='radio']:checked").val();
		
		if(id==0){
			$(".makeAnnouncement1 #annlater").hide('slow');
		}
		else
		{
			$(".makeAnnouncement1 #annlater").slideDown('slow');
		}
	});
	
	$(".makeAnnouncement1 #annToList").change( function(){
		var id=$(".makeAnnouncement1 input[type='radio']:checked").val();
		if(id==0){
			$(".makeAnnouncement1 #options").hide('slow');
		}
		else
		{
			$(".makeAnnouncement1 #options").slideDown('slow');
		}
	});
	
	$(".genReports #reports").change( function(){
		var id=$(".genReports #reports option:selected").val();
		if(id==7){
			ui.generateReports();
		}
	});
});



