function validateAll(fields,fieldNames){
	//var fields = new Array(document.contact_name,document.last
	var emptyFields="";
	var foundEmpty=false;
	for(var i=0; i<fields.length; i++){
		var value=fields[i].value;
		if(value==null||value==""){
			emptyFields+=fieldNames[i] +" \n";
			foundEmpty=true;
		}
		
		//validate_required(fields[i],'You didn\'t fill out the '+fieldNames[i]+' field.');	
	}
	if(foundEmpty){
		//return1();
		alert("MESSAGE NOT SENT!\n\nYou must first enter the following prior to submitting this form: \n" + emptyFields);
		return false;
	}
		else(foundEmpty)
		{	
			//alert("Thanks for emailing us.\n We will contact you as soon as possible.");
			return true;
		}
}

/* new Array(contact_name,last_name,company,email,subject,message),new Array('First Name','Last Name','Company','Email','Subject','Message */

function validate_email(field,alerttxt)
{
with (field)
  {
  apos=value.indexOf("@");
  dotpos=value.lastIndexOf(".");
  if (apos<1||dotpos-apos<2)
    {alert(alerttxt);return false;}
  else 
  	{return true;}
  }
}

function validate_form(thisform)
{

with (thisform)
	{
	fields = new Array(contact_name,company,phone,email,subject,messageContent);
	fieldNames = new Array('Contact Name','Company Name','Phone Number','Email Address','Subject','Message');
		if(validateAll(fields, fieldNames)==false)
		{
			return false;
		}
	}
with (thisform)
  {
  if (validate_email(email,"MESSAGE NOT SENT!\n\nYou must first enter a valid email address (i.e. someone@domain.com) prior to submitting this form.")==false)
    {
  	  email.focus();
 	   return false;
 	 }
  }


}



function validate_form_request(thisform)
{
	
	with (thisform)
		{
		fields = new Array(contact_name,company,phone,email,affected,problem);
		fieldNames = new Array('Contact Name','Company Name','Phone Number','Email Address','Affected Equipment','Problem Description');
			if(validateAll(fields, fieldNames)==false)
			{
				return false;
			}
		}
	with (thisform)
	  {
	  if (validate_email(email,"MESSAGE NOT SENT!\n\nYou must first enter a valid email address (i.e. someone@domain.com) prior to submitting this form.")==false)
	    {
	  	  email.focus();
	 	   return false;
	 	 }
	  }
}

var RecaptchaOptions = {
    theme : 'blackglass'
 };


function focusonme()
{
	contact_name.focus();

}

function recaptchafocus()
{
	focus_response_field();
}