<script type="text/javascript">
  function xmlhttpPost(strURL) 
  {
	  var xmlHttpReq = false;
	  var self = this;
	  // Mozilla/Safari
	  if (window.XMLHttpRequest) 
	  {
		self.xmlHttpReq = new XMLHttpRequest();
	  }
	  // IE
	  else if (window.ActiveXObject) 
	  {
		self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  self.xmlHttpReq.open('POST', strURL, true);
	  self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	  self.xmlHttpReq.onreadystatechange = function() 
	  {
		if (self.xmlHttpReq.readyState == 4) 
		{
			  var array = self.xmlHttpReq.responseText.split('==');
			  //alert(array[0]);
			  //alert(array[1]);
			  updatePage(array);
		 }
	  }
	  self.xmlHttpReq.send(strURL);
	  
  }

  function getquerystring() {
  var form     = document.forms['f1'];
  var word = form.word.value;
  qstr = 'w=' + escape(word);  // NOTE: no '?' before querystring
  return qstr;
  }

  function updatePage(arr) 
  {
	  document.getElementById("contactOption_id").innerHTML = arr[0];
	  //document.getElementById("equipment_id").innerHTML = arr[1];
	  //document.getElementById("opperatingSystem").innerHTML = arr[3];
  }
 </script>
 
<?php

	if(isset($_POST[submit]))
	{
		require_once("../php_scripts/sql_tool.php");
		$sqlTool = new SqlTool();
		
		// foreach ($_POST as $key => $value)
		  // echo $key.': '.$value.'<br />';
		  
		if($_POST[submit] == "insert")
		{
			$submitIncident = $sqlTool->insertIncident($_POST[problem_id], $_POST);
			$incident_id = $sqlTool->getLatestIncident_id();
			
			$nextPage = "<script type='text/javascript'>window.location = '/solutions/problem.php?incident_id=$incident_id'</script>";
		}
		else
		{
			$submitIncident = $sqlTool->updateIncident($_POST);
				  
			$incident_id = $_POST[incident_id];
			$nextPage = "<script type='text/javascript'>window.location = '/solutions/problem.php?incident_id=$incident_id'</script>";
		}
		//echo $submitIncident;
		echo $nextPage;
	}
	else // not from post
	{
		$date = date('Y-m-d'); //date("Y-m-d");
		$companyList = $sqlTool->getCompanyList();
		$contactList = $sqlTool->getContactList($incidentDetails[company_id]);
		
		
		if($urlVariables[edit] == "insert") 
			{
				$submitIncident = "insert";
			}
			else 
			{
				$submitIncident = "update";
			}
			
		  //$manager = false;
		
		echo "<label>Tech</label>";
		if($manager)
		{
			$technicians = $sqlTool->getEmployees();
			//echo $incidentDetails[employee_id];
			echo "<select name='employee_id' id='employee_id'>";
			foreach($technicians as $key => $value) 
			{
				if($incidentDetails)
				{
					if($value[id] == $incidentDetails[employee_id])
					{
						$selected = "selected";
					}
					else
					{
						$selected = "";
					}
				}
				else if($value[id] == $_SESSION[user_name])
				{
					$selected = "selected";
				}
				else
				{
					$selected = "";
				}
			
				echo "<option $selected value='$value[id]'>$value[fname] $value[lname]</option>";
			}
			echo "</select><br/>";
		}
		else
		{
			if($incidentDetails)
			{
				// echo "<pre>";
				// print_r($incidentDetails);
				// echo "</pre>";
				$employee = $sqlTool->getEmployeeDetails($incidentDetails[employee_id]);
			}
			else
			{
				$employee = $sqlTool->getEmployeeDetails($_SESSION[user_name]);
			}
			// echo "<pre>";
				// print_r($employee);
			// echo "</pre>";
			
			echo "$employee[id] - $employee[fname] $employee[lname]";
			echo "<input type='hidden' name='employee_id' id='employee_id' value='$employee[id]'/><br />";
		}

		echo "<label>Company</label>$company_id";
?>
        
		<select id="company_id"
				name="company_id" 
				onchange="xmlhttpPost('php_scripts/form_info_loader.php?company_id='+this.options[this.selectedIndex].value)"
				onblur="getIttems();">
<?php
		
		if($submitIncident == "insert") 
		{
			echo "<option value=''>-Select-</option>";
			
			foreach($companyList as $key => $companyDetails) 
			{
				if($companyDetails[id] == $incidentDetails[company_id] || $companyDetails[id] == $urlVariables[company_id])
					$selected = "selected";
				else
					$selected = "";
				
				echo "<option $selected name='$companyDetails[id]' id='$companyDetails[id]' value='$companyDetails[id]'>$companyDetails[company_name]</option>";
			}
		}
		else
		{
			$companyDetails = $sqlTool->getCompanyDetails($incidentDetails[company_id]);
			echo "<option name='$companyDetails[id]' id='$companyDetails[id]' value='$companyDetails[id]'>$companyDetails[company_name]</option>";
			
		}
		echo 	"</select>";
			
		
		//Contacts------------------------------------------------
		echo	"<br /><label>Contact</label>
				 <select name='contactOption_id' id='contactOption_id'>";
		
		if($urlVariables[company_id])
		{
			$company_id = $urlVariables[company_id];
		}
		else
		{
			$company_id = $incidentDetails[company_id];
		}
		$contacts = $sqlTool->getCompanyContacts($company_id);
		
		foreach($contacts as $key => $value) 
		{
			if($incidentDetails[contact_id] == $value[id])
			{
				$selected = 'selected';
			}
			else 
			{
				$selected = '';
			}
			echo '<option '.$selected.' value='.$value[id].'>'.$value[fname].' '.$value[lname].'</option>';
		}
		echo	"</select>";
		
		
		if($incidentDetails[status] == "Other")
		{
			$other = "selected";
		}
			else if ($incidentDetails[status] == "Client")
			{
				$client = "selected";
			}
			else
			{
				$tech = "selected";
			}
		
		
		if($submitIncident == "insert") 
		{
			$created_date = $date;
			echo "<input name='created_date' type='hidden' value='$created_date' />";
		}
		else
		{
			$created_date = date('Y-m-d', strtotime($incidentDetails[created_date]));
		}
		
		
		if ($incidentDetails[completed_date] == '' || !isset($incidentDetails[completed_date]) || $incidentDetails[completed_date] == '0000-00-00 00:00:00'  )
		{
			$completed_date = '';
		}
		else
		{
			$completed_date = date('Y-m-d', strtotime($incidentDetails[completed_date]));
		}

		echo "</select>
			<br />
			<label>Follow up</label><textarea name='follow_up' id='follow_up'>$incidentDetails[follow_up]</textarea>

			<label>Waiting on</label>
			<select name='status' id='status'>
			<option $tech>Tech</option>
			<option $client>Client</option>
			<option $other>Other</option>
			</select>";
		if($submitIncident == "insert")
		{
			echo "<input type='hidden' name='problem_id' value='$urlVariables[problem_id]' />";
		}
		else
		{
			echo "<input type='hidden' name='incident_id' value='$urlVariables[incident_id]' />
				  <input type='hidden' name='problem_id' value='$incidentDetails[problem_id]' />
				  <input type='hidden' name='company_id' value='$incidentDetails[company_id]' />";
		}
				
		
			  
		  
	}
?>