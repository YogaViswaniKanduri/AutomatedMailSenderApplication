/* ======================================
    UHC App - Dashboard java script
    
    Validates data before server execution
======================================*/

var uhcapp = {

	/* Validation of Birthday wish type and template variables
		Returns true if all variables are given correct
		Returns false if any one of the variables are not in proper format
	*/
	validateBirthday:function ()
	{
		var id=$(".birthdayWishes #bdtemplate option:selected").attr('value');
		
		if(id==0) //email template selection should not be empty
		{
			$(".birthdayWishes #bdtemplate").css('border-color','red');
			return false;
		}
		$(".birthdayWishes #bdtemplate").css('border-color','#DADADA');		
		$('.birthdayWishes #submit').attr('value','PROCESSING');
		$('.birthdayWishes #submit').attr('disabled','disabled');	
		return true;
	},
	
	/* Validation of Birthday wish type and template variables
		Returns true if all variables are given correct
		Returns false if any one of the variables are not in proper format
	*/
	validateBirthday1:function ()
	{
		var id=$(".birthdayWishes1 #bdtemplate1 option:selected").attr('value');
		var id1=$(".birthdayWishes1 #bdwishtype1 option:selected").attr('value');
		$(".birthdayWishes1 #bdtemplate1").css('border-color','#DADADA');	
		$(".birthdayWishes1 #bdtoday").css('border-color','#DADADA');		
		$(".birthdayWishes1 #bdtoyear").css('border-color','#DADADA');		
		$(".birthdayWishes1 #bdtomonth").css('border-color','#DADADA');
		$(".birthdayWishes1 #bdfromday").css('border-color','#DADADA');		
		$(".birthdayWishes1 #bdfromyear").css('border-color','#DADADA');		
		$(".birthdayWishes1 #bdfrommonth").css('border-color','#DADADA');
		$(".birthdayWishes1 #bdday").css('border-color','#DADADA');		
		$(".birthdayWishes1 #bdyear").css('border-color','#DADADA');		
		$(".birthdayWishes1 #bdmonth").css('border-color','#DADADA');
		if(id1==2){
			var d1=$(".birthdayWishes1 #bdfromday option:selected").attr('value');
			var m1=$(".birthdayWishes1 #bdfrommonth option:selected").attr('value');
			var y1=$(".birthdayWishes1 #bdfromyear option:selected").attr('value');
			var d2=$(".birthdayWishes1 #bdtoday option:selected").attr('value');
			var m2=$(".birthdayWishes1 #bdtomonth option:selected").attr('value');
			var y2=$(".birthdayWishes1 #bdtoyear option:selected").attr('value');
			if(d1<=9)
			{
				d1 = "0"+d1;
			}
			if(d2<=9)
			{
				d2 = "0"+d2;
			}
			if(m1<=9)
			{
				m1 = "0"+m1;
			}
			if(m2<=9)
			{
				m2 = "0"+m2;
			}
			if(y1>y2)
			{
				$(".birthdayWishes1 #bdfromyear").css('border-color','red');		
				return false;
			}
			else 
			{ 
				$(".birthdayWishes1 #bdfromyear").css('border-color','#DADADA');		
				if( m1 > m2 && y1==y2)
				{					
					$(".birthdayWishes1 #bdfrommonth").css('border-color','red');		
					return false;
				}				
				else
				{
					$(".birthdayWishes1 #bdfrommonth").css('border-color','#DADADA');		
					if(m1==m2)
					{
						if(d1>=d2 && y1==y2)
						{
							$(".birthdayWishes1 #bdfromday").css('border-color','red');		
							return false;
						}
					}					
				}
			} 
			
			$(".birthdayWishes1 #bdfromday").css('border-color','#DADADA');		
			$(".birthdayWishes1 #bdfromyear").css('border-color','#DADADA');		
			$(".birthdayWishes1 #bdfrommonth").css('border-color','#DADADA');		

			var myDate=new Date();
			myDate.setFullYear(y2,m2-1,d2);
			var today = new Date();

			if (myDate<today)
			{
				$(".birthdayWishes1 #bdtoday").css('border-color','red');		
				$(".birthdayWishes1 #bdtoyear").css('border-color','red');		
				$(".birthdayWishes1 #bdtomonth").css('border-color','red');	
				return false;
			}
			
			$(".birthdayWishes1 #bdtoday").css('border-color','#DADADA');		
			$(".birthdayWishes1 #bdtoyear").css('border-color','#DADADA');		
			$(".birthdayWishes1 #bdtomonth").css('border-color','#DADADA');	

			if(m1==2 || m1==4 || m1==6 || m1==9 || m1==11)
			{
				
				if(m1==2)
				{
					if(y1%4==0 && (d1==30 || d1==31))
					{
						$(".birthdayWishes1 #bdfromday").css('border-color','red');	
						return false;
					}
					else if(y1%4!=0 && (d1==29 || d1==30 || d1==31))
					{
						$(".birthdayWishes1 #bdfromday").css('border-color','red');	
						return false;
					}
				}
				if(d1==31)
				{
					$(".birthdayWishes1 #bdfromday").css('border-color','red');	
					return false;
				}
			}			
			if(m2==2 || m2==4 || m2==6 || m2==9 || m2==11)
			{
				
				if(m2==2)
				{
					if(y2%4==0 && (d2==30 || d2==31))
					{
						$(".birthdayWishes1 #bdtoday").css('border-color','red');	
						return false;
					}
					else if(y2%4!=0 && (d2==29 || d2==30 || d2==31))
					{
						$(".birthdayWishes1 #bdtoday").css('border-color','red');	
						return false;
					}
				}
				if(d2==31)
				{
					$(".birthdayWishes1 #bdtoday").css('border-color','red');	
					return false;
				}
			}
		}
		else if(id1==3){
			var d1=$(".birthdayWishes1 #bdday option:selected").attr('value');
			var m1=$(".birthdayWishes1 #bdmonth option:selected").attr('value');
			var y1=$(".birthdayWishes1 #bdyear option:selected").attr('value');
			var myDate=new Date();
			myDate.setFullYear(y1,m1-1,d1);
			var today = new Date();

			if (myDate<=today)
			{
				$(".birthdayWishes1 #bdday").css('border-color','red');		
				$(".birthdayWishes1 #bdyear").css('border-color','red');		
				$(".birthdayWishes1 #bdmonth").css('border-color','red');	
				return false;
			}
			$(".birthdayWishes1 #bdday").css('border-color','#DADADA');		
			$(".birthdayWishes1 #bdyear").css('border-color','#DADADA');		
			$(".birthdayWishes1 #bdmonth").css('border-color','#DADADA');
		}
		if(id==0) //email template selection should not be empty
		{
			$(".birthdayWishes1 #bdtemplate1").css('border-color','red');
			return false;
		}
		$(".birthdayWishes1 #bdtoday").css('border-color','#DADADA');		
		$(".birthdayWishes1 #bdtoyear").css('border-color','#DADADA');		
		$(".birthdayWishes1 #bdtomonth").css('border-color','#DADADA');
		$(".birthdayWishes1 #bdfromday").css('border-color','#DADADA');		
		$(".birthdayWishes1 #bdfromyear").css('border-color','#DADADA');		
		$(".birthdayWishes1 #bdfrommonth").css('border-color','#DADADA');
		$(".birthdayWishes1 #bdday").css('border-color','#DADADA');		
		$(".birthdayWishes1 #bdyear").css('border-color','#DADADA');		
		$(".birthdayWishes1 #bdmonth").css('border-color','#DADADA');
		$(".birthdayWishes1 #bdtemplate1").css('border-color','#DADADA');		
		$('.birthdayWishes1 #submit').attr('value','PROCESSING');
		$('.birthdayWishes1 #submit').attr('disabled','disabled');	
		return true;
	},

	/* Validation of Message variables
		Returns true if all variables are given correct
		Returns false if any one of the variables are not in proper format
	*/
	validateMessage: function ()
	{
		var msgnum = $('.sendMessage #msgNumber').val();
		var msgText = $('.sendMessage #msgText').val();
		
		if( (msgnum.length < 12 ) || (msgnum=='')) // mobile number should be a valid one
		{	
			$('.sendMessage #msgNumber').css('border-color','red');
			return false;
		}
					
		var msgnum_an = msgnum.substring(3,13); // actual mobile number extraction
		var msgnum_extn = msgnum.substring(1,3); //mobile number country code extraction
		var msgnum_plus = msgnum.substring(0,1); //mobile number country code should be preceed with "+"
					
		if( isNaN(msgnum_an) || isNaN(msgnum_extn) || !isNaN(msgnum_plus) || (msgnum_plus!="+")) // mobile number should be a valid one with proper extension
		{
			$('.sendMessage #msgNumber').css('border-color','red');
			return false;
		}
		else if ( (msgText.length == 0) || (msgText=='')) // SMS message text should not be empty
		{
			$('.sendMessage #msgNumber').css('border-color','#DADADA');
			$('.sendMessage #msgText').css('border-color','red');
			return false;
		}
		
		$('.sendMessage #msgNumber').css('border-color','#DADADA');
		$('.sendMessage #msgText').css('border-color','#DADADA');
		$('.sendMessage #submit').attr('value','PROCESSING');	
		$('.sendMessage #submit').attr('disabled','disabled');	
		return true;
	},
	
	/* Validation of Announcement variables
		Returns true if all variables are given correct
		Returns false if any one of the variables are not in proper format
	*/
	validateAnnoucement: function ()
	{
		var annSubject = $('.makeAnnouncement #annSubject').val();
		var annBody = $('.makeAnnouncement #annBody').val();
		
		if( ( annSubject.length < 10 ) || ( annSubject == '') ) //Subject of the announcement should not be empty
		{
			$('.makeAnnouncement #annSubject').css('border-color','red');
			return false;
		}
		else if( ( annBody.length < 200 ) || ( annBody == '' )) // Mail body should not be less than 200 characters and should not be empty
		{
			$('.makeAnnouncement #annSubject').css('border-color','#DADADA');
			$('.makeAnnouncement #annBody').css('border-color','red');
			return false;
		}
		
		$('.makeAnnouncement #annSubject').css('border-color','#DADADA');
		$('.makeAnnouncement #annBody').css('border-color','#DADADA');
		$('.makeAnnouncement #submit').attr('value','PROCESSING');	
		$('.makeAnnouncement #submit').attr('disabled','disabled');	
		return true;
	},
	
	/* setting status of feedback form
	*/
	feedback: function ()
	{	
		var id1=$(".feedback #feedbackVisitedOn option:selected").attr('value');
		if(id1==0)
		{
			$(".feedback #feedbackVisitedOn").css('border-color','red');
			return false;
		}
		$('.feedback #submit').attr('value','PROCESSING');			
		return true;
	},
	
	feedback1: function()
	{	
		var id1=$(".feedback1 #feedbackVisitedOn option:selected").attr('value');
		$(".feedback1 #fbtoday").css('border-color','#DADADA');		
		$(".feedback1 #fbtoyear").css('border-color','#DADADA');		
		$(".feedback1 #fbtomonth").css('border-color','#DADADA');
		$(".feedback1 #fbfromday").css('border-color','#DADADA');		
		$(".feedback1 #fbfromyear").css('border-color','#DADADA');		
		$(".feedback1 #fbfrommonth").css('border-color','#DADADA');
		$(".feedback1 #fbday").css('border-color','#DADADA');		
		$(".feedback1 #fbyear").css('border-color','#DADADA');		
		$(".feedback1 #fbmonth").css('border-color','#DADADA');
		if(id1==0)
		{
			$(".feedback1 #feedbackVisitedOn").css('border-color','red');
			return false;
		}
		else if(id1==1)
		{
			var d1=$(".feedback1 #fbfromday option:selected").attr('value');
			var m1=$(".feedback1 #fbfrommonth option:selected").attr('value');
			var y1=$(".feedback1 #fbfromyear option:selected").attr('value');
			var d2=$(".feedback1 #fbtoday option:selected").attr('value');
			var m2=$(".feedback1 #fbtomonth option:selected").attr('value');
			var y2=$(".feedback1 #fbtoyear option:selected").attr('value');
			if(d1<=9)
			{
				d1 = "0"+d1;
			}
			if(d2<=9)
			{
				d2 = "0"+d2;
			}
			if(m1<=9)
			{
				m1 = "0"+m1;
			}
			if(m2<=9)
			{
				m2 = "0"+m2;
			}
			if(y1>y2)
			{
				$(".feedback1 #fbfromyear").css('border-color','red');		
				return false;
			}
			else 
			{ 
				$(".feedback1 #fbfromyear").css('border-color','#DADADA');		
				if( m1 > m2 && y1==y2)
				{					
					$(".feedback1 #fbfrommonth").css('border-color','red');		
					return false;
				}				
				else
				{
					$(".feedback1 #fbfrommonth").css('border-color','#DADADA');		
					if(m1==m2 && y1==y2)
					{
						if(d1>=d2)
						{
							$(".feedback1 #fbfromday").css('border-color','red');		
							return false;
						}
					}					
				}
			} 
			
			$(".feedback1 #fbfromday").css('border-color','#DADADA');		
			$(".feedback1 #fbfromyear").css('border-color','#DADADA');		
			$(".feedback1 #fbfrommonth").css('border-color','#DADADA');		

			var myDate=new Date();
			myDate.setFullYear(y2,m2-1,d2);
			var today = new Date();

			if (myDate>=today)
			{
				$(".feedback1 #fbtoday").css('border-color','red');		
				$(".feedback1 #fbtoyear").css('border-color','red');		
				$(".feedback1 #fbtomonth").css('border-color','red');	
				return false;
			}
			
			$(".feedback1 #fbtoday").css('border-color','#DADADA');		
			$(".feedback1 #fbtoyear").css('border-color','#DADADA');		
			$(".feedback1 #fbtomonth").css('border-color','#DADADA');	

			if(m1==2 || m1==4 || m1==6 || m1==9 || m1==11)
			{
				
				if(m1==2)
				{
					if(y1%4==0 && (d1==30 || d1==31))
					{
						$(".feedback1 #fbfromday").css('border-color','red');	
						return false;
					}
					else if(y1%4!=0 && (d1==29 || d1==30 || d1==31))
					{
						$(".feedback1 #fbfromday").css('border-color','red');	
						return false;
					}
				}
				if(d1==31)
				{
					$(".feedback1 #fbfromday").css('border-color','red');	
					return false;
				}
			}			
			if(m2==2 || m2==4 || m2==6 || m2==9 || m2==11)
			{
				
				if(m2==2)
				{
					if(y2%4==0 && (d2==30 || d2==31))
					{
						$(".feedback1 #fbtoday").css('border-color','red');	
						return false;
					}
					else if(y2%4!=0 && (d2==29 || d2==30 || d2==31))
					{
						$(".feedback1 #fbtoday").css('border-color','red');	
						return false;
					}
				}
				if(d2==31)
				{
					$(".feedback1 #fbtoday").css('border-color','red');	
					return false;
				}
			}
		}
		else if(id1==2){
			var d1=$(".feedback1 #fbday option:selected").attr('value');
			var m1=$(".feedback1 #fbmonth option:selected").attr('value');
			var y1=$(".feedback1 #fbyear option:selected").attr('value');
			var myDate=new Date();
			myDate.setFullYear(y1,m1-1,d1);
			var today = new Date();

			if (myDate>=today)
			{
				$(".feedback1 #fbday").css('border-color','red');		
				$(".feedback1 #fbyear").css('border-color','red');		
				$(".feedback1 #fbmonth").css('border-color','red');	
				return false;
			}
			$(".feedback1 #fbday").css('border-color','#DADADA');		
			$(".feedback1 #fbyear").css('border-color','#DADADA');		
			$(".feedback1 #fbmonth").css('border-color','#DADADA');
		}
		$('.feedback1 #submit').attr('value','PROCESSING');				
		return true;
	},
	
	validateDate: function( d1, m1, y1, d2, m2, y2, isGttoday)
	{
		if(d1<=9)
		{
			d1 = "0"+d1;
		}
		if(d2<=9)
		{
			d2 = "0"+d2;
		}
		if(m1<=9)
		{
			m1 = "0"+m1;
		}
		if(m2<=9)
		{
			m2 = "0"+m2;
		}
		if(y1>y2)
		{
			return false;
		}
		else 
		{ 
			if( m1 > m2 && y1==y2)
			{						
				return false;
			}				
			else
			{					
				if(m1==m2 && y1==y2)
				{
					if(d1>=d2)
					{
						return false;
					}
				}					
			}
		}
			
		var myDate=new Date();
		myDate.setFullYear(y2,m2-1,d2);
		var today = new Date();

		if(isGttoday)
		{
			if (myDate>=today)
			{
				return false;
			}
		}
		else if(m1==2 || m1==4 || m1==6 || m1==9 || m1==11)
		{
			
			if(m1==2)
			{
				if(y1%4==0 && (d1==30 || d1==31))
				{
					return false;
				}
				else if(y1%4!=0 && (d1==29 || d1==30 || d1==31))
				{
					return false;
				}
			}
			if(d1==31)
			{					
				return false;
			}
		}			
		else if(m2==2 || m2==4 || m2==6 || m2==9 || m2==11)
		{
			
			if(m2==2)
			{
				if(y2%4==0 && (d2==30 || d2==31))
				{						
					return false;
				}
				else if(y2%4!=0 && (d2==29 || d2==30 || d2==31))
				{						
					return false;
				}
			}
			if(d2==31)
			{					
				return false;
			}
		}			
		return true;
	},
	
	appointmentRemind1: function()
	{	
		var id1=$(".appReminder1 #remindertime1 option:selected").attr('value');
		$(".appReminder1 #artoday").css('border-color','#DADADA');		
		$(".appReminder1 #artoyear").css('border-color','#DADADA');		
		$(".appReminder1 #artomonth").css('border-color','#DADADA');
		$(".appReminder1 #arfromday").css('border-color','#DADADA');		
		$(".appReminder1 #arfromyear").css('border-color','#DADADA');		
		$(".appReminder1 #arfrommonth").css('border-color','#DADADA');
		$(".appReminder1 #arday").css('border-color','#DADADA');		
		$(".appReminder1 #aryear").css('border-color','#DADADA');		
		$(".appReminder1 #armonth").css('border-color','#DADADA');
		if(id1==0)
		{
			$(".appReminder1 #remindertime1").css('border-color','red');
			return false;
		}
		else if(id1==1)
		{
			var d1=$(".appReminder1 #arfromday option:selected").attr('value');
			var m1=$(".appReminder1 #arfrommonth option:selected").attr('value');
			var y1=$(".appReminder1 #arfromyear option:selected").attr('value');
			var d2=$(".appReminder1 #artoday option:selected").attr('value');
			var m2=$(".appReminder1 #artomonth option:selected").attr('value');
			var y2=$(".appReminder1 #artoyear option:selected").attr('value');
			if(d1<=9)
			{
				d1 = "0"+d1;
			}
			if(d2<=9)
			{
				d2 = "0"+d2;
			}
			if(m1<=9)
			{
				m1 = "0"+m1;
			}
			if(m2<=9)
			{
				m2 = "0"+m2;
			}
			if(y1>y2)
			{
				$(".appReminder1 #arfromyear").css('border-color','red');		
				return false;
			}
			else 
			{ 
				$(".appReminder1 #arfromyear").css('border-color','#DADADA');		
				if( m1 > m2 && y1==y2)
				{					
					$(".appReminder1 #arfrommonth").css('border-color','red');		
					return false;
				}				
				else
				{
					$(".appReminder1 #arfrommonth").css('border-color','#DADADA');		
					if(m1==m2 && y1==y2)
					{
						if(d1>=d2)
						{
							$(".appReminder1 #arfromday").css('border-color','red');		
							return false;
						}
					}					
				}
			} 
			
			$(".appReminder1 #arfromday").css('border-color','#DADADA');		
			$(".appReminder1 #arfromyear").css('border-color','#DADADA');		
			$(".appReminder1 #arfrommonth").css('border-color','#DADADA');		

			var myDate=new Date();
			myDate.setFullYear(y2,m2-1,d2);
			var today = new Date();

			if (myDate<=today)
			{
				$(".appReminder1 #artoday").css('border-color','red');		
				$(".appReminder1 #artoyear").css('border-color','red');		
				$(".appReminder1 #artomonth").css('border-color','red');	
				return false;
			}
			
			$(".appReminder1 #artoday").css('border-color','#DADADA');		
			$(".appReminder1 #artoyear").css('border-color','#DADADA');		
			$(".appReminder1 #artomonth").css('border-color','#DADADA');	

			if(m1==2 || m1==4 || m1==6 || m1==9 || m1==11)
			{
				
				if(m1==2)
				{
					if(y1%4==0 && (d1==30 || d1==31))
					{
						$(".appReminder1 #arfromday").css('border-color','red');	
						return false;
					}
					else if(y1%4!=0 && (d1==29 || d1==30 || d1==31))
					{
						$(".appReminder1 #arfromday").css('border-color','red');	
						return false;
					}
				}
				if(d1==31)
				{
					$(".appReminder1 #arfromday").css('border-color','red');	
					return false;
				}
			}			
			if(m2==2 || m2==4 || m2==6 || m2==9 || m2==11)
			{
				
				if(m2==2)
				{
					if(y2%4==0 && (d2==30 || d2==31))
					{
						$(".appReminder1 #artoday").css('border-color','red');	
						return false;
					}
					else if(y2%4!=0 && (d2==29 || d2==30 || d2==31))
					{
						$(".appReminder1 #artoday").css('border-color','red');	
						return false;
					}
				}
				if(d2==31)
				{
					$(".appReminder1 #artoday").css('border-color','red');	
					return false;
				}
			}
		}
		else if(id1==2){
			var d1=$(".appReminder1 #arday option:selected").attr('value');
			var m1=$(".appReminder1 #armonth option:selected").attr('value');
			var y1=$(".appReminder1 #aryear option:selected").attr('value');
			if(d1<=9)
			{
				d1 = "0"+d1;
			}
			
			if(m1<=9)
			{
				m1 = "0"+m1;
			}
			
			
			var myDate=new Date();
			myDate.setFullYear(y1,m1-1,d1);
			var today = new Date();

			if (myDate<=today)
			{
				$(".appReminder1 #arday").css('border-color','red');		
				$(".appReminder1 #aryear").css('border-color','red');		
				$(".appReminder1 #armonth").css('border-color','red');	
				return false;
			}
			$(".appReminder1 #arday").css('border-color','#DADADA');		
			$(".appReminder1 #aryear").css('border-color','#DADADA');		
			$(".appReminder1 #armonth").css('border-color','#DADADA');
		}
		$('.appReminder1 #submit').attr('value','PROCESSING');				
		return true;
	},
	
	validDate: function( d1, m1, y1)
	{
		if(m1==2 || m1==4 || m1==6 || m1==9 || m1==11)
		{				
			if(m1==2)
			{
				if(y1%4==0 && (d1==30 || d1==31))
				{					
					return false;
				}
				else if(y1%4!=0 && (d1==29 || d1==30 || d1==31))
				{					
					return false;
				}
			}
			if(d1==31)
			{	
				return false;
			}
		}
		return true;
	},
	
	/* setting status of feedback form
	*/
	retrieveFeedback: function ()
	{
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("feedbackstats").innerHTML=xmlhttp.responseText;
				//$('#feedbackViewer #feedbackstats').text = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","ServerStuff/feedback.php",true);
		xmlhttp.send();
	},
	
	/* setting status of Appointment Reminder form
	*/
	appointmentRemind: function ()
	{
		var id1=$(".appReminder #remindertime option:selected").attr('value');
		if(id1==0)
		{
			$(".appReminder #remindertime").css('border-color','red');
			return false;
		}
		$('.appReminder #submit').attr('value','PROCESSING');			
		return true;
	},
	
	/* setting status of Appointment Reminder form
	*/
	validateReports: function ()
	{		
		var downloadstatus = $(".genReports input[name='reporttype']:checked").val();
		$(".genReports select").css('border-color','#DADADA');
		$('.genReports #submit').attr('value','PROCESSING');
		if(downloadstatus==0)
		{
			$.w8n('Success Notification', 'Report generated and file will be downloaded shortly', {timeout: 2000});
			$('.w8n-box').css('background-color','#A4C400');		
		}
		return true;
	},
	
	validateAnnouncement1: function ()
	{	
				
		var annToList = $(".makeAnnouncement1 input[type='radio']:checked").val();
		if(annToList==1)
		{
			var options = new Array();
			var n = $(".makeAnnouncement1 input[type='checkbox']:checked").length;
			$(".makeAnnouncement1 table").css('border-color','#000000');
			
			if (n > 0){
				$(".makeAnnouncement1 input[type='checkbox']:checked").each(function(){
					options.push($(this).val());
				});
			}
			else
			{				
				$(".makeAnnouncement1 table").css('border-color','red');
				return false;
			}
			var err_status = false;
			for(i=0;i<n;i++)
			{					
				if(options[i]==0)
				{
					var d1=$(".makeAnnouncement1 #annappfromday option:selected").attr('value');
					var m1=$(".makeAnnouncement1 #annappfrommonth option:selected").attr('value');
					var y1=$(".makeAnnouncement1 #annappfromyear option:selected").attr('value');
					var d2=$(".makeAnnouncement1 #annapptoday option:selected").attr('value');
					var m2=$(".makeAnnouncement1 #annapptomonth option:selected").attr('value');
					var y2=$(".makeAnnouncement1 #annapptoyear option:selected").attr('value');
					$(".makeAnnouncement1 #annappfromday").css('border-color','#DADADA');		
					$(".makeAnnouncement1 #annappfromyear").css('border-color','#DADADA');		
					$(".makeAnnouncement1 #annappfrommonth").css('border-color','#DADADA');
					if(!(uhcapp.validateDate(d1, m1, y1, d2, m2, y2, false)))
					{							
						$(".makeAnnouncement1 #annappfromday").css('border-color','red');		
						$(".makeAnnouncement1 #annappfromyear").css('border-color','red');		
						$(".makeAnnouncement1 #annappfrommonth").css('border-color','red');	
						err_status =true;
					}
				}
				else if(options[i]==1)
				{
					var d1=$(".makeAnnouncement1 #annappday option:selected").attr('value');
					var m1=$(".makeAnnouncement1 #annappmonth option:selected").attr('value');
					var y1=$(".makeAnnouncement1 #annappyear option:selected").attr('value');					
					$(".makeAnnouncement1 #annappday").css('border-color','#DADADA');		
					$(".makeAnnouncement1 #annappyear").css('border-color','#DADADA');		
					$(".makeAnnouncement1 #annappmonth").css('border-color','#DADADA');
					if(!(uhcapp.validDate(d1, m1, y1)))
					{							
						$(".makeAnnouncement1 #annappday").css('border-color','red');		
						$(".makeAnnouncement1 #annappyear").css('border-color','red');		
						$(".makeAnnouncement1 #annappmonth").css('border-color','red');
						err_status=true;
					}
				}
				else if(options[i]==2)
				{
					var d1=$(".makeAnnouncement1 #annlappfromday option:selected").attr('value');
					var m1=$(".makeAnnouncement1 #annlappfrommonth option:selected").attr('value');
					var y1=$(".makeAnnouncement1 #annlappfromyear option:selected").attr('value');
					var d2=$(".makeAnnouncement1 #annlapptoday option:selected").attr('value');
					var m2=$(".makeAnnouncement1 #annlapptomonth option:selected").attr('value');
					var y2=$(".makeAnnouncement1 #annlapptoyear option:selected").attr('value');
					$(".makeAnnouncement1 #annlappfromday").css('border-color','#DADADA');		
					$(".makeAnnouncement1 #annlappfromyear").css('border-color','#DADADA');		
					$(".makeAnnouncement1 #annlappfrommonth").css('border-color','#DADADA');
					if(!(uhcapp.validateDate(d1, m1, y1, d2, m2, y2, true)))
					{							
						$(".makeAnnouncement1 #annlappfromday").css('border-color','red');		
						$(".makeAnnouncement1 #annlappfromyear").css('border-color','red');		
						$(".makeAnnouncement1 #annlappfrommonth").css('border-color','red');
						err_status=true;
					}
				}
				else if(options[i]==3)
				{
					var d1=$(".makeAnnouncement1 #annlappday option:selected").attr('value');
					var m1=$(".makeAnnouncement1 #annlappmonth option:selected").attr('value');
					var y1=$(".makeAnnouncement1 #annlappyear option:selected").attr('value');					
					$(".makeAnnouncement1 #annlappday").css('border-color','#DADADA');		
					$(".makeAnnouncement1 #annlappyear").css('border-color','#DADADA');		
					$(".makeAnnouncement1 #annlappmonth").css('border-color','#DADADA');
					if(!(uhcapp.validDate(d1, m1, y1)))
					{							
						$(".makeAnnouncement1 #annlappday").css('border-color','red');		
						$(".makeAnnouncement1 #annlappyear").css('border-color','red');		
						$(".makeAnnouncement1 #annlappmonth").css('border-color','red');
						err_status=true;
					}
				}
				else if(options[i]==4)
				{
					var d1=$(".makeAnnouncement1 #annbdfromday option:selected").attr('value');
					var m1=$(".makeAnnouncement1 #annbdfrommonth option:selected").attr('value');
					var y1=$(".makeAnnouncement1 #annbdfromyear option:selected").attr('value');
					var d2=$(".makeAnnouncement1 #annbdtoday option:selected").attr('value');
					var m2=$(".makeAnnouncement1 #annbdtomonth option:selected").attr('value');
					var y2=$(".makeAnnouncement1 #annbdtoyear option:selected").attr('value');
					$(".makeAnnouncement1 #annbdfromday").css('border-color','#DADADA');		
					$(".makeAnnouncement1 #annbdfromyear").css('border-color','#DADADA');		
					$(".makeAnnouncement1 #annbdfrommonth").css('border-color','#DADADA');
					if(!(uhcapp.validateDate(d1, m1, y1, d2, m2, y2, false)))
					{							
						$(".makeAnnouncement1 #annbdfromday").css('border-color','red');		
						$(".makeAnnouncement1 #annbdfromyear").css('border-color','red');		
						$(".makeAnnouncement1 #annbdfrommonth").css('border-color','red');
						err_status=true;
					}
				}
				else if(options[i]==5)
				{
					var d1=$(".makeAnnouncement1 #annbdday option:selected").attr('value');
					var m1=$(".makeAnnouncement1 #annbdmonth option:selected").attr('value');
					var y1=$(".makeAnnouncement1 #annbdyear option:selected").attr('value');					
					$(".makeAnnouncement1 #annbdday").css('border-color','#DADADA');		
					$(".makeAnnouncement1 #annbdyear").css('border-color','#DADADA');		
					$(".makeAnnouncement1 #annbdmonth").css('border-color','#DADADA');
					if(!(uhcapp.validDate(d1, m1, y1)))
					{							
						$(".makeAnnouncement1 #annbdday").css('border-color','red');		
						$(".makeAnnouncement1 #annbdyear").css('border-color','red');		
						$(".makeAnnouncement1 #annbdmonth").css('border-color','red');
						err_status=true;
					}
				}
			}
			if(err_status)
			{	return false;}
			
		}
		var annSubject = $('.makeAnnouncement1 #annSubject').val();
		var annBody = $('.makeAnnouncement1 #annBody').val();
		
		if( ( annSubject.length < 10 ) || ( annSubject == '') ) //Subject of the announcement should not be empty
		{
			$('.makeAnnouncement1 #annSubject').css('border-color','red');
			return false;
		}
		else if( ( annBody.length < 200 ) || ( annBody == '' )) // Mail body should not be less than 200 characters and should not be empty
		{
			$('.makeAnnouncement1 #annSubject').css('border-color','#DADADA');
			$('.makeAnnouncement1 #annBody').css('border-color','red');
			return false;
		}
		
		var id1=$(".makeAnnouncement1 #annTypeSelect input[type='radio']:checked").val();
		
		if(id1==1)
		{
			var d1=$(".makeAnnouncement1 #annfannday option:selected").attr('value');
			var m1=$(".makeAnnouncement1 #annfannmonth option:selected").attr('value');
			var y1=$(".makeAnnouncement1 #annfannyear option:selected").attr('value');					
			$(".makeAnnouncement1 #annfannday").css('border-color','#DADADA');		
			$(".makeAnnouncement1 #annfannmonth").css('border-color','#DADADA');		
			$(".makeAnnouncement1 #annfannyear").css('border-color','#DADADA');			
			if(!(uhcapp.validDate(d1, m1, y1)))
			{							
				$(".makeAnnouncement1 #annfannday").css('border-color','red');		
				$(".makeAnnouncement1 #annfannmonth").css('border-color','red');		
				$(".makeAnnouncement1 #annfannyear").css('border-color','red');
				return false;
			}
			var myDate=new Date();
			myDate.setFullYear(y1,m1-1,d1);
			var today = new Date();			
			if (myDate<today)
			{
				$(".makeAnnouncement1 #annfannday").css('border-color','red');		
				$(".makeAnnouncement1 #annfannmonth").css('border-color','red');		
				$(".makeAnnouncement1 #annfannyear").css('border-color','red');
				return false;
			}	
		}
				
		$(".makeAnnouncement1 #annfannday").css('border-color','#DADADA');		
		$(".makeAnnouncement1 #annfannmonth").css('border-color','#DADADA');		
		$(".makeAnnouncement1 #annfannyear").css('border-color','#DADADA');
		$('.makeAnnouncement1 #annSubject').css('border-color','#DADADA');
		$('.makeAnnouncement1 #annBody').css('border-color','#DADADA');
		$(".makeAnnouncement1 #annappfromday").css('border-color','#DADADA');		
		$(".makeAnnouncement1 #annappfromyear").css('border-color','#DADADA');		
		$(".makeAnnouncement1 #annappfrommonth").css('border-color','#DADADA');
		$(".makeAnnouncement1 #annlappfromday").css('border-color','#DADADA');		
		$(".makeAnnouncement1 #annlappfromyear").css('border-color','#DADADA');		
		$(".makeAnnouncement1 #annlappfrommonth").css('border-color','#DADADA');
		$(".makeAnnouncement1 #annbdfromday").css('border-color','#DADADA');		
		$(".makeAnnouncement1 #annbdfromyear").css('border-color','#DADADA');		
		$(".makeAnnouncement1 #annbdfrommonth").css('border-color','#DADADA');
		$('.makeAnnouncement1 #submit').attr('value','PROCESSING');		
		return true;
	},
	
	validateReports1: function()
	{
		var options = new Array();
		var n = $(".genReports1 input[type='checkbox']:checked").length;
		$(".genReports1 table").css('border-color','#000000');
		
		if (n > 0){
			$(".genReports1 input[type='checkbox']:checked").each(function(){
				options.push($(this).val());
			});
		}
		else
		{				
			$(".genReports1 table").css('border-color','red');
			return false;
		}
		var err_status = false;
		for(i=0;i<n;i++)
		{					
			if(options[i]==0)
			{
				var d1=$(".genReports1 #grappfromday option:selected").attr('value');
				var m1=$(".genReports1 #grappfrommonth option:selected").attr('value');
				var y1=$(".genReports1 #grappfromyear option:selected").attr('value');
				var d2=$(".genReports1 #grapptoday option:selected").attr('value');
				var m2=$(".genReports1 #grapptomonth option:selected").attr('value');
				var y2=$(".genReports1 #grapptoyear option:selected").attr('value');
				$(".genReports1 #grappfromday").css('border-color','#DADADA');		
				$(".genReports1 #grappfromyear").css('border-color','#DADADA');		
				$(".genReports1 #grappfrommonth").css('border-color','#DADADA');
				if(!(uhcapp.validateDate(d1, m1, y1, d2, m2, y2, false)))
				{							
					$(".genReports1 #grappfromday").css('border-color','red');		
					$(".genReports1 #grappfromyear").css('border-color','red');		
					$(".genReports1 #grappfrommonth").css('border-color','red');	
					err_status =true;
				}
			}
			else if(options[i]==1)
			{
				var d1=$(".genReports1 #grappday option:selected").attr('value');
				var m1=$(".genReports1 #grappmonth option:selected").attr('value');
				var y1=$(".genReports1 #grappyear option:selected").attr('value');					
				$(".genReports1 #grappday").css('border-color','#DADADA');		
				$(".genReports1 #grappyear").css('border-color','#DADADA');		
				$(".genReports1 #grappmonth").css('border-color','#DADADA');
				if(!(uhcapp.validDate(d1, m1, y1)))
				{							
					$(".genReports1 #grappday").css('border-color','red');		
					$(".genReports1 #grappyear").css('border-color','red');		
					$(".genReports1 #grappmonth").css('border-color','red');
					err_status=true;
				}
			}
			else if(options[i]==2)
			{
				var d1=$(".genReports1 #grlappfromday option:selected").attr('value');
				var m1=$(".genReports1 #grlappfrommonth option:selected").attr('value');
				var y1=$(".genReports1 #grlappfromyear option:selected").attr('value');
				var d2=$(".genReports1 #grlapptoday option:selected").attr('value');
				var m2=$(".genReports1 #grlapptomonth option:selected").attr('value');
				var y2=$(".genReports1 #grlapptoyear option:selected").attr('value');
				$(".genReports1 #grlappfromday").css('border-color','#DADADA');		
				$(".genReports1 #grlappfromyear").css('border-color','#DADADA');		
				$(".genReports1 #grlappfrommonth").css('border-color','#DADADA');
				if(!(uhcapp.validateDate(d1, m1, y1, d2, m2, y2, true)))
				{							
					$(".genReports1 #grlappfromday").css('border-color','red');		
					$(".genReports1 #grlappfromyear").css('border-color','red');		
					$(".genReports1 #grlappfrommonth").css('border-color','red');
					err_status=true;
				}
			}
			else if(options[i]==3)
			{
				var d1=$(".genReports1 #grlappday option:selected").attr('value');
				var m1=$(".genReports1 #grlappmonth option:selected").attr('value');
				var y1=$(".genReports1 #grlappyear option:selected").attr('value');					
				$(".genReports1 #grlappday").css('border-color','#DADADA');		
				$(".genReports1 #grlappmonth").css('border-color','#DADADA');		
				$(".genReports1 #grlappyear").css('border-color','#DADADA');
				if(!(uhcapp.validDate(d1, m1, y1)))
				{							
					$(".genReports1 #grlappday").css('border-color','red');		
					$(".genReports1 #grlappmonth").css('border-color','red');		
					$(".genReports1 #grlappyear").css('border-color','red');
					err_status=true;
				}
			}
			else if(options[i]==4)
			{
				var d1=$(".genReports1 #grbdfromday option:selected").attr('value');
				var m1=$(".genReports1 #grbdfrommonth option:selected").attr('value');
				var y1=$(".genReports1 #grbdfromyear option:selected").attr('value');
				var d2=$(".genReports1 #grbdtoday option:selected").attr('value');
				var m2=$(".genReports1 #grbdtomonth option:selected").attr('value');
				var y2=$(".genReports1 #grbdtoyear option:selected").attr('value');
				$(".genReports1 #grbdfromday").css('border-color','#DADADA');		
				$(".genReports1 #grbdfrommonth").css('border-color','#DADADA');		
				$(".genReports1 #grbdfromyear").css('border-color','#DADADA');
				if(!(uhcapp.validateDate(d1, m1, y1, d2, m2, y2, false)))
				{							
					$(".genReports1 #grbdfromday").css('border-color','red');		
					$(".genReports1 #grbdfromyear").css('border-color','red');		
					$(".genReports1 #grbdfrommonth").css('border-color','red');
					err_status=true;
				}
			}
			else if(options[i]==5)
			{
				var d1=$(".genReports1 #grbdday option:selected").attr('value');
				var m1=$(".genReports1 #grbdmonth option:selected").attr('value');
				var y1=$(".genReports1 #grbdyear option:selected").attr('value');					
				$(".genReports1 #grbdday").css('border-color','#DADADA');		
				$(".genReports1 #grbdyear").css('border-color','#DADADA');		
				$(".genReports1 #grbdmonth").css('border-color','#DADADA');
				if(!(uhcapp.validDate(d1, m1, y1)))
				{							
					$(".genReports1 #grbdday").css('border-color','red');		
					$(".genReports1 #grbdyear").css('border-color','red');		
					$(".genReports1 #grbdmonth").css('border-color','red');
					err_status=true;
				}
			}
		}
		if(err_status)
		{	return false;}
		$('.genReports1 #submit').attr('value','PROCESSING');		
		return true;
	},
	
	validateSentMailReports: function()
	{
		var options = new Array();
		var n = $(".gensentmailReports input[type='checkbox']:checked").length;
		$(".gensentmailReports table").css('border-color','#000000');
		
		if (n > 0){
			$(".gensentmailReports input[type='checkbox']:checked").each(function(){
				options.push($(this).val());
			});
		}
		else
		{				
			$(".gensentmailReports table").css('border-color','red');
			return false;
		}
		var err_status = false;
		for(i=0;i<n;i++)
		{					
			if(options[i]==0)
			{
				var d1=$(".gensentmailReports #grapprfromday option:selected").attr('value');
				var m1=$(".gensentmailReports #grapprfrommonth option:selected").attr('value');
				var y1=$(".gensentmailReports #grapprfromyear option:selected").attr('value');
				var d2=$(".gensentmailReports #grapprtoday option:selected").attr('value');
				var m2=$(".gensentmailReports #grapprtomonth option:selected").attr('value');
				var y2=$(".gensentmailReports #grapprtoyear option:selected").attr('value');
				$(".gensentmailReports #grapprfromday").css('border-color','#DADADA');		
				$(".gensentmailReports #grapprfromyear").css('border-color','#DADADA');		
				$(".gensentmailReports #grapprfrommonth").css('border-color','#DADADA');
				if(!(uhcapp.validateDate(d1, m1, y1, d2, m2, y2, false)))
				{							
					$(".gensentmailReports #grapprfromday").css('border-color','red');		
					$(".gensentmailReports #grapprfromyear").css('border-color','red');		
					$(".gensentmailReports #grapprfrommonth").css('border-color','red');	
					err_status =true;
				}
			}
			else if(options[i]==1)
			{
				var d1=$(".gensentmailReports #grapprday option:selected").attr('value');
				var m1=$(".gensentmailReports #grapprmonth option:selected").attr('value');
				var y1=$(".gensentmailReports #grappryear option:selected").attr('value');					
				$(".gensentmailReports #grapprday").css('border-color','#DADADA');		
				$(".gensentmailReports #grappryear").css('border-color','#DADADA');		
				$(".gensentmailReports #grapprmonth").css('border-color','#DADADA');
				if(!(uhcapp.validDate(d1, m1, y1)))
				{							
					$(".gensentmailReports #grapprday").css('border-color','red');		
					$(".gensentmailReports #grappryear").css('border-color','red');		
					$(".gensentmailReports #grapprmonth").css('border-color','red');
					err_status=true;
				}
			}
			else if(options[i]==2)
			{
				var d1=$(".gensentmailReports #gradbwfromday option:selected").attr('value');
				var m1=$(".gensentmailReports #gradbwfrommonth option:selected").attr('value');
				var y1=$(".gensentmailReports #gradbwfromyear option:selected").attr('value');
				var d2=$(".gensentmailReports #gradbwtoday option:selected").attr('value');
				var m2=$(".gensentmailReports #gradbwtomonth option:selected").attr('value');
				var y2=$(".gensentmailReports #gradbwtoyear option:selected").attr('value');
				$(".gensentmailReports #gradbwfromday").css('border-color','#DADADA');		
				$(".gensentmailReports #gradbwfromyear").css('border-color','#DADADA');		
				$(".gensentmailReports #gradbwfrommonth").css('border-color','#DADADA');
				if(!(uhcapp.validateDate(d1, m1, y1, d2, m2, y2, true)))
				{							
					$(".gensentmailReports #gradbwfromday").css('border-color','red');		
					$(".gensentmailReports #gradbwfromyear").css('border-color','red');		
					$(".gensentmailReports #gradbwfrommonth").css('border-color','red');
					err_status=true;
				}
			}
			else if(options[i]==3)
			{
				var d1=$(".gensentmailReports #gradbwday option:selected").attr('value');
				var m1=$(".gensentmailReports #gradbwmonth option:selected").attr('value');
				var y1=$(".gensentmailReports #gradbwyear option:selected").attr('value');					
				$(".gensentmailReports #gradbwday").css('border-color','#DADADA');		
				$(".gensentmailReports #gradbwmonth").css('border-color','#DADADA');		
				$(".gensentmailReports #gradbwyear").css('border-color','#DADADA');
				if(!(uhcapp.validDate(d1, m1, y1)))
				{							
					$(".gensentmailReports #gradbwday").css('border-color','red');		
					$(".gensentmailReports #gradbwmonth").css('border-color','red');		
					$(".gensentmailReports #gradbwyear").css('border-color','red');
					err_status=true;
				}
			}
			else if(options[i]==4)
			{
				var d1=$(".gensentmailReports #grbwfromday option:selected").attr('value');
				var m1=$(".gensentmailReports #grbwfrommonth option:selected").attr('value');
				var y1=$(".gensentmailReports #grbwfromyear option:selected").attr('value');
				var d2=$(".gensentmailReports #grbwtoday option:selected").attr('value');
				var m2=$(".gensentmailReports #grbwtomonth option:selected").attr('value');
				var y2=$(".gensentmailReports #grbwtoyear option:selected").attr('value');
				$(".gensentmailReports #grbwfromday").css('border-color','#DADADA');		
				$(".gensentmailReports #grbwfrommonth").css('border-color','#DADADA');		
				$(".gensentmailReports #grbwfromyear").css('border-color','#DADADA');
				if(!(uhcapp.validateDate(d1, m1, y1, d2, m2, y2, false)))
				{							
					$(".gensentmailReports #grbwfromday").css('border-color','red');		
					$(".gensentmailReports #grbwfromyear").css('border-color','red');		
					$(".gensentmailReports #grbwfrommonth").css('border-color','red');
					err_status=true;
				}
			}
			else if(options[i]==5)
			{
				var d1=$(".gensentmailReports #grbwday option:selected").attr('value');
				var m1=$(".gensentmailReports #grbwmonth option:selected").attr('value');
				var y1=$(".gensentmailReports #grbwyear option:selected").attr('value');					
				$(".gensentmailReports #grbwday").css('border-color','#DADADA');		
				$(".gensentmailReports #grbwyear").css('border-color','#DADADA');		
				$(".gensentmailReports #grbwmonth").css('border-color','#DADADA');
				if(!(uhcapp.validDate(d1, m1, y1)))
				{							
					$(".gensentmailReports #grbwday").css('border-color','red');		
					$(".gensentmailReports #grbwyear").css('border-color','red');		
					$(".gensentmailReports #grbwmonth").css('border-color','red');
					err_status=true;
				}
			}
			else if(options[i]==6)
			{
				var d1=$(".gensentmailReports #grfbmfromday option:selected").attr('value');
				var m1=$(".gensentmailReports #grfbmfrommonth option:selected").attr('value');
				var y1=$(".gensentmailReports #grfbmfromyear option:selected").attr('value');
				var d2=$(".gensentmailReports #grfbmtoday option:selected").attr('value');
				var m2=$(".gensentmailReports #grfbmtomonth option:selected").attr('value');
				var y2=$(".gensentmailReports #grfbmtoyear option:selected").attr('value');
				$(".gensentmailReports #grfbmfromday").css('border-color','#DADADA');		
				$(".gensentmailReports #grfbmfromyear").css('border-color','#DADADA');		
				$(".gensentmailReports #grfbmfrommonth").css('border-color','#DADADA');
				if(!(uhcapp.validateDate(d1, m1, y1, d2, m2, y2, false)))
				{							
					$(".gensentmailReports #grfbmfromday").css('border-color','red');		
					$(".gensentmailReports #grfbmfromyear").css('border-color','red');		
					$(".gensentmailReports #grfbmfrommonth").css('border-color','red');	
					err_status =true;
				}
			}
			else if(options[i]==7)
			{
				var d1=$(".gensentmailReports #grfbmday option:selected").attr('value');
				var m1=$(".gensentmailReports #grfbmmonth option:selected").attr('value');
				var y1=$(".gensentmailReports #grfbmyear option:selected").attr('value');					
				$(".gensentmailReports #grfbmday").css('border-color','#DADADA');		
				$(".gensentmailReports #grfbmyear").css('border-color','#DADADA');		
				$(".gensentmailReports #grfbmmonth").css('border-color','#DADADA');
				if(!(uhcapp.validDate(d1, m1, y1)))
				{							
					$(".gensentmailReports #grfbmday").css('border-color','red');		
					$(".gensentmailReports #grfbmyear").css('border-color','red');		
					$(".gensentmailReports #grfbmmonth").css('border-color','red');
					err_status=true;
				}
			}
			else if(options[i]==8)
			{
				var d1=$(".gensentmailReports #grannfromday option:selected").attr('value');
				var m1=$(".gensentmailReports #grannfrommonth option:selected").attr('value');
				var y1=$(".gensentmailReports #grannfromyear option:selected").attr('value');
				var d2=$(".gensentmailReports #granntoday option:selected").attr('value');
				var m2=$(".gensentmailReports #granntomonth option:selected").attr('value');
				var y2=$(".gensentmailReports #granntoyear option:selected").attr('value');
				$(".gensentmailReports #grannfromday").css('border-color','#DADADA');		
				$(".gensentmailReports #grannfromyear").css('border-color','#DADADA');		
				$(".gensentmailReports #grannfrommonth").css('border-color','#DADADA');
				if(!(uhcapp.validateDate(d1, m1, y1, d2, m2, y2, true)))
				{							
					$(".gensentmailReports #grannfromday").css('border-color','red');		
					$(".gensentmailReports #grannfromyear").css('border-color','red');		
					$(".gensentmailReports #grannfrommonth").css('border-color','red');
					err_status=true;
				}
			}
			else if(options[i]==9)
			{
				var d1=$(".gensentmailReports #grannday option:selected").attr('value');
				var m1=$(".gensentmailReports #grannmonth option:selected").attr('value');
				var y1=$(".gensentmailReports #grannyear option:selected").attr('value');					
				$(".gensentmailReports #grannday").css('border-color','#DADADA');		
				$(".gensentmailReports #grannmonth").css('border-color','#DADADA');		
				$(".gensentmailReports #grannyear").css('border-color','#DADADA');
				if(!(uhcapp.validDate(d1, m1, y1)))
				{							
					$(".gensentmailReports #grannday").css('border-color','red');		
					$(".gensentmailReports #grannmonth").css('border-color','red');		
					$(".gensentmailReports #grannyear").css('border-color','red');
					err_status=true;
				}
			}
			else if(options[i]==10)
			{
				var d1=$(".gensentmailReports #grgcrfromday option:selected").attr('value');
				var m1=$(".gensentmailReports #grgcrfrommonth option:selected").attr('value');
				var y1=$(".gensentmailReports #grgcrfromyear option:selected").attr('value');
				var d2=$(".gensentmailReports #grgcrtoday option:selected").attr('value');
				var m2=$(".gensentmailReports #grgcrtomonth option:selected").attr('value');
				var y2=$(".gensentmailReports #grgcrtoyear option:selected").attr('value');
				$(".gensentmailReports #grgcrfromday").css('border-color','#DADADA');		
				$(".gensentmailReports #grgcrfrommonth").css('border-color','#DADADA');		
				$(".gensentmailReports #grgcrfromyear").css('border-color','#DADADA');
				if(!(uhcapp.validateDate(d1, m1, y1, d2, m2, y2, false)))
				{							
					$(".gensentmailReports #grgcrfromday").css('border-color','red');		
					$(".gensentmailReports #grgcrfromyear").css('border-color','red');		
					$(".gensentmailReports #grgcrfrommonth").css('border-color','red');
					err_status=true;
				}
			}
			else if(options[i]==11)
			{
				var d1=$(".gensentmailReports #grgcrday option:selected").attr('value');
				var m1=$(".gensentmailReports #grgcrmonth option:selected").attr('value');
				var y1=$(".gensentmailReports #grgcryear option:selected").attr('value');					
				$(".gensentmailReports #grgcrday").css('border-color','#DADADA');		
				$(".gensentmailReports #grgcryear").css('border-color','#DADADA');		
				$(".gensentmailReports #grgcrmonth").css('border-color','#DADADA');
				if(!(uhcapp.validDate(d1, m1, y1)))
				{							
					$(".gensentmailReports #grgcrday").css('border-color','red');		
					$(".gensentmailReports #grgcryear").css('border-color','red');		
					$(".gensentmailReports #grgcrmonth").css('border-color','red');
					err_status=true;
				}
			}
		}
		if(err_status)
		{	return false;}
		$('.gensentmailReports #submit').attr('value','PROCESSING');		
		return true;
	},
	
	createCronJob: function()
	{		
		var automationname=$(".automation #automationname option:selected").attr('value');
		var automationdays=$(".automation #automationdays option:selected").attr('value');
		var automationmailstate=$(".automation #automationmailstate option:selected").attr('value');
		var automationmailtime=$(".automation #automationmailtime option:selected").attr('value');
		var d1=$(".automation #autofromday option:selected").attr('value');
		var m1=$(".automation #autofrommonth option:selected").attr('value');
		var y1=$(".automation #autofromyear option:selected").attr('value');
		var d2=$(".automation #autotoday option:selected").attr('value');
		var m2=$(".automation #autotomonth option:selected").attr('value');
		var y2=$(".automation #autotoyear option:selected").attr('value');
		$(".automation #autofromday").css('border-color','#dadada');		
		$(".automation #autofromyear").css('border-color','#dadada');		
		$(".automation #autofrommonth").css('border-color','#dadada');
		$(".automation #autotoday").css('border-color','#dadada');		
		$(".automation #autotoyear").css('border-color','#dadada');		
		$(".automation #autotomonth").css('border-color','#dadada');
		if(!(uhcapp.validateDate(d1, m1, y1, d2, m2, y2, false)))
		{							
			$(".automation #autofromday").css('border-color','red');		
			$(".automation #autofromyear").css('border-color','red');		
			$(".automation #autofrommonth").css('border-color','red');
			return false;
		}
		if(d1<=9)
		{
			d1 = "0"+d1;
		}
		if(d2<=9)
		{
			d2 = "0"+d2;
		}
		if(m1<=9)
		{
			m1 = "0"+m1;
		}
		if(m2<=9)
		{
			m2 = "0"+m2;
		}
		var myDate=new Date();
		myDate.setFullYear(y2,m2-1,d2);
		var today = new Date();
		
		if (myDate<today)
		{
			$(".automation #autotoday").css('border-color','red');		
			$(".automation #autotoyear").css('border-color','red');		
			$(".automation #autotomonth").css('border-color','red');
			return false;
		}
		
		var myDate1=new Date();
		myDate1.setFullYear(y1,m1-1,d1);
		var today1 = new Date();
		
		if (myDate1<today1)
		{
			$(".automation #autofromday").css('border-color','red');		
			$(".automation #autofromyear").css('border-color','red');		
			$(".automation #autofrommonth").css('border-color','red');
			return false;
		}
		$(".automation #autofromday").css('border-color','#dadada');		
		$(".automation #autofromyear").css('border-color','#dadada');		
		$(".automation #autofrommonth").css('border-color','#dadada');
		$(".automation #autotoday").css('border-color','#dadada');		
		$(".automation #autotoyear").css('border-color','#dadada');		
		$(".automation #autotomonth").css('border-color','#dadada');
		//alert(m1+"\n"+d1+"\n"+y1+"\n"+m2+"\n"+d2+"\n"+y2);		
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{	
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("jobcreationstatus").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","ServerStuff/createcronjob.php?automationname="+automationname+"&automationdays="+automationdays+"&automationmailstate="+automationmailstate+"&automationmailtime="+automationmailtime+"&autofromday="+d1+"&autofrommonth="+m1+"&autofromyear="+y1+"&autotoday="+d2+"&autotomonth="+m2+"&autotoyear="+y2,true);
		xmlhttp.send();
	},
	
	deletecronjob: function( automation_id )
	{
			
		$.get("deletecronjob.php",
		{
			automationid:automation_id
		},
		function(data,status){
		  alert("Data: " + data + "\nStatus: " + status);		  
		});
	}
};