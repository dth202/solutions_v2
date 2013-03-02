/**
 * Creats an AJAX object.
 */
function createAjaxObject()
{
    var ajaxObject;
    if(XMLHttpRequest) {
        // Standard method
        ajaxObject = new XMLHttpRequest();
    }
    else {
        // IE proprietary craphola
        ajaxObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return ajaxObject;
}

/**
 * Uses AJAX to fetch the data for, and create, the Items dropdown.
 */
function getItems()
{
    // Get the selected group
    var groupID = document.getElementById('company_id').value;

    // Get the Items select box
    var itemsSelect = document.getElementById('Items');

    // Validate the groupID
    if(isNaN(parseInt(groupID)))
    {
       // The value isn't a valid group ID
       // Hide the items select and stop the function
       itemsSelect.style.display = "none";
       return;
    }

    // Create a new AJAX object
    var ajax = createAjaxObject();

    // Set the code to be exected when the
    // AJAX call is complete.
    ajax.onreadystatechange = function()
    {
        // Make sure the AJAX call was successful
        if(ajax.readyState == 4) {
            // Clear the box of any old options
            itemsSelect.options.length = 0;

            // Add a -Select- option to the box
            var option = new Option("-Select-", "");
            itemsSelect.options.add(option);

            // Get the response text and split it into groups
            var response = ajax.responseText;
            var groups = response.split("\n");

            // Add each group to the items select box
            for(var i = 0; i < groups.length; i++)
            {
                // Split the group into the ID and Name, and validate them
                var parts = groups[i].split(",");
                if(parts.length == 2)
                {
                    // Create and add an option to the select
                    option = new Option(parts[1], parts[0]);
                    itemsSelect.options.add(option);
                }

            }

            // Make the select visible
            itemsSelect.style.display = "inline-block";
        }
        else {
            // Hide the select
            itemsSelect.style.display = "none";
        }
    }

    // Execute the AJAX call
    ajax.open("GET", "getItems.php?gid=" + groupID, true);
    ajax.send(null);
}
//php, ajax, mysql
function showUser(str)
{
	if (str=="")
	  {
		  document.getElementById("txtHint").innerHTML="";
		  return;
	  }
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
			document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
			}
	  }
	xmlhttp.open("GET","getuser.php?q="+str,true);
	xmlhttp.send();
}
function insertTime(elementId)
	{
		//now = new date();
		hour = (new Date()).getHours()
		min = (new Date()).getMinutes();
		var ampm = "am";
		//alert(elementId);
		// if(hour >= 12)
		// {
			// if (hour > 12)
			// {
				// hour = hour - 12;
			// }
			// ampm = "pm"
		// }
		//time = hour + ":" + min + " " + ampm;
		time = hour + ":" + min;
		//alert(time);
		//var time = hour + ":" + min + " " ampm; 
		//alert(hour + ":" + min + " " ampm);
		document.getElementById(elementId).value = time;
	 
	}
function toggle(id) 
{
	var ele = document.getElementById(id);
	//var text = document.getElementById("system_information_label");
	if(ele.style.display == "block" && document.getElementById(id).style.display == "block") 
	{
    		ele.style.display = "none";
			document.getElementById(id).style.display = "none";
		//text.innerHTML = "System Information";
  	}
	else 
	{
		ele.style.display = "block";
		document.getElementById(id).style.display = "block";
		//text.innerHTML = "Hide System Information";
	}
} 

//Form Validation

function checkProblemForm()
  {
    var problem_name = checkBlankField('problem_name');
	var incident = document.getElementById('submit');
	//alert(incident.value);
	if(incident.value == "Submit Problem and Incident")
	{
		var validateIncident = checkIncidentForm();
		//alert(validateIncident);
	}
	
	if (problem_name === true && validateIncident == true) {
		return true;
	} else {
		return false;
	}
  }
  
function checkIncidentForm()
  {
    var company_id = checkBlankSelection('company_id');
	
	if (company_id === true) {
		return true;
	} else {
		return false;
	}
  }

function checkBlankSelection(fieldId) 
{
	//alert(fieldId);
	var field = document.getElementById(fieldId);
	//alert(field.selectedIndex);
	
	// Check for empty Selection	
	if (field.selectedIndex == 0) 
	{
		errorOnField(field, true);
		return false;
	} 
	else 
	{
		errorOnField(field, false);
		return true
	}
 }
 
 function checkEquipmentSelected() 
{
	//alert(fieldId);
	var field = document.getElementById('insert_equipment_id');
	//alert(field.selectedIndex);
	//alert(field.selectedIndex);
	// Check for empty Selection	
	if (field.selectedIndex == 0) 
	{
		
		document.getElementById('insert_start_time').disabled=true;
		document.getElementById('insert_end_time').disabled=true;
		document.getElementById('insert_work_performed').disabled=true;
	} 
	else 
	{
		document.getElementById('insert_start_time').disabled=false;
		document.getElementById('insert_end_time').disabled=false;
		document.getElementById('insert_work_performed').disabled=false;
	}
 }
  
function checkBlankField(fieldId) 
{
	//alert(fieldId);
	var field = document.getElementById(fieldId);
	//alert(field.value);
	// Check for empty fields
	if (field.value == "") 
	{
		errorOnField(field, true);
		//field.focus();
		return false;
	} 
	else 
	{
		errorOnField(field, false);
		return true
	}
  
  // check for valid email address
  // if (fieldName == "email") {
	  // if (valEmail) {
		  // if (field.value.indexOf("@") < 0) {
			  // valEmail = false;
			  // errorOnField(field, true);
			  // document.getElementById('invalid_label').style.display = "";
		  // } else {
			  // var address = field.value.split('@');
			  // if (address[0] != "") {
				  // if (address[1].indexOf('\.') > 0) {
					  // valEmail = true;
					  // errorOnField(field, false);
					  // document.getElementById('invalid_label').style.display = "none";
				  // } else {
					  // valEmail = false;
					  // errorOnField(field, true);
					  // document.getElementById('invalid_label').style.display = "";
				  // }
			  // } else {
				  // valEmail = false;
				  // errorOnField(field, true);
				  // document.getElementById('invalid_label').style.display = "";
			  // }
		  // }
	  // } else {
		  // document.getElementById('invalid_label').style.display = "";
	  // }
  // } 
}

function checkSubmit() {
	//alert(valName + " " + valEmail + " " + valPhone + " " + valCompany);
	if (valName === true && valEmail === true && valPhone === true && valCompany === true) {
		document.getElementById('emailform').submit();
	} else {
		checkField('name', 'contact_name');
		checkField('email', 'email');
		checkField('phone', 'phone');
		checkField('company', 'company');
	}
}

function checkSubmitOk() { 
	//alert(valName + " " + valEmail);
	checkField('name', 'contact_name');
	checkField('email', 'email');
	checkField('phone', 'phone');
	checkField('company', 'company');
	if (valName === true && valEmail === true && valPhone === true && valCompany === true) {
		return true;
	} else {
		return false;
	}
	
}

//When off=true that means there's an error
function errorOnField(f, off) {
	 if (off) {
		f.style.border = "1px red solid";
	} else {
		f.style.border = "";
	} 
}
  
  
  