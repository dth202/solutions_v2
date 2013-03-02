<?php
	require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	include("php_scripts/url_variables.php");
	
	//Contact Signature
	$contactSignature = $sqlTool->getContactSignature($urlVariables['incident_id']);
	
	
	if($urlVariables[complete_incident])
	{
		include("edit/complete_incident.php");
	}
	else if($urlVariables[edit])
	{
		if($urlVariables[incident_id])
			$incidentDetails = $sqlTool->getIncidentDetails($urlVariables[incident_id]);
			
		echo "<form id='form1' style='margin-left: 15px;' name='form1' method='post' onSubmit='return checkIncidentForm();' action='edit/incident.php'>";
			include("edit/incident.php"); 
		echo "<input type='submit' name='submit' id='submit' value='$submitIncident' />
			</form>";
	}
	else
	{
		$work_performed =  $sqlTool->getIncidentWorkPerformed($incident_id);
		
		if($urlVariables[problem_id])
			$problem_id = $urlVariables[problem_id];
		else
			$problem_id = $incidentDetails[problem_id];
			
		include("display/incident_list.php");
		
		//Contact Signature
		$contactSignature = $sqlTool->getContactSignature($incident_id);
		$employeeSignature = $sqlTool->getEmployeeSignature($incident_id,$_SESSION[user_name]);
		
		
		//Validate if this ticket has been signed by either the contact or o the employee.
		if(COUNT($contactSignature) == 0 && COUNT($employeeSignature) == 0)
		{
			echo	"<h1>Work Performed Trip<a href='/solutions/work_performed.php?edit=insert&incident_id=$incident_id'><img class='add' src='/images/add.jpg' /></a></h1>";
		}
		include("display/work_performed.php"); 
	}
  
  ?>