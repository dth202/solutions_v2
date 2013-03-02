<?php

// Check if the form variables have set values
	if(isset($_POST[submit]))
	{
		require_once("../php_scripts/sql_tool.php");
		$sqlTool = new SqlTool();
		
		// echo "<pre>";
			// print_r($_POST);
		// echo "</pre>";
		
		// Check to see what the submit button says 
		if($_POST[submit] == "Submit Problem and Incident")
		{
			$_POST[created_date] = date('Y-m-d H:i:s');
			$submitProblem = $sqlTool->insertProblem($_POST);
			$problem_id = $sqlTool->getLatestProblem_id();
			
			$submitIncident = $sqlTool->insertIncident($problem_id, $_POST);
			echo $submitIncident;
    
			$incident_id = $sqlTool->getLatestIncident_id();
			
			//Create work_performed
			// $incident[date] = date('Y-m-d H:i:s'); //date("Y-m-d");
			// $incident[incident_id] = $incident_id;
			// $incident[employee_id] = $_SESSION[user_name];
			// echo $sqlTool->insertWorkPerformed($incident);
			
			$nextPage = "<META HTTP-EQUIV='Refresh' Content='0; URL=/solutions/problem.php?incident_id=$incident_id'>";
			//= "<script type='text/javascript'>window.location = '../incident.php?incident_id=$incident_id&edit=update'</script>";
		}
		else // If problem already exists than update problem		
		{
			$submitProblem = $sqlTool->updateProblem($_POST);
			$problem_id = $_POST[problem_id];
			$nextPage = "<META HTTP-EQUIV='Refresh' Content='0; URL=/solutions/problem.php?problem_id=$problem_id'>";
		}

		echo $submitProblem;
		
		echo $nextPage;
    
	}
	
	// If Variables are empty then display form	
	else 
	{
		// If URL has edit=insert then do this
		if($urlVariables[edit] == "insert")
		{
			$date = date('Y-m-d H:i:s'); //date("Y-m-d");
			$companyList = $sqlTool->getCompanyList();
			$submit = "Submit Problem and Incident";
			$employee = $_SESSION[user_name];
			$insert = true;
		}	
		else {
			$submit = "Update Problem";
			$problemDetails = $sqlTool->getProblemDetails($problem_id);
			$employee = $problemDetails[employee_id];

			$custom_type = 'Y-m-d';
			//$date = date($custom_type, strtotime($problemDetails[created_date]));
			
			echo $date;
		}
		echo $problem_id;
		
		echo "<h2>Problem</h2>
			  <!--<h3>$employee</h3>-->
			  <h3>$problemDetails[problem_id]</h3>
			  <input type='hidden' name='problem_id' value='$problemDetails[problem_id]' />
			  <!--<input name='created_date' type='hidden' id='created_date' value='$date' class='date' type='text' />
			  <input type='hidden' name='employee_id' value='$employee' />-->

			  <!-- Start of Form -->	
				  <div name='problemError' id = 'problemError'>
				  <label>Problem Name</label>
				  <input name='problem_name' id='problem_name' onblur=checkBlankField('problem_name')  class='edit_input' type='text' value='$problemDetails[problem_name]' />
				  <br />
				  <label>Category</label>
				  <select name='category' id='category'>
					<option value='Virus Removal'>Virus Removal</option>
				  </select>
				  <br />
				  
				  <label>Problem Description</label>
				  <textarea name='problem_description' id='problem_description'>$problemDetails[problem_description]</textarea>
				  <br />";
	}
?>