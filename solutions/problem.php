<?php

	require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	include("php_scripts/url_variables.php");
	
	if($urlVariables[edit])
	{
		echo "<form id='form1' style='margin-left: 15px;' name='form1' method='post' onSubmit='return checkProblemForm();' action='edit/problem.php'>"; 
		if($urlVariables[edit] == "insert")
		{
			include("edit/problem.php");
			include("edit/incident.php"); 
		}
		else
		{
			$problem_id = $urlVariables['problem_id'];
			if($urlVariables[edit])
			{ 
				include("edit/problem.php");
				
			} 
		}
		echo "<input type='submit' name='submit' id='submit' value='$submit' />
			  </form>";
	}
	else if( $urlVariables['problem_id'] )
	{
		$incident_id = $sqlTool->getLatestIncidentId_fromProblem($urlVariables['problem_id']);
		if($incident_id)
		{
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=/solutions/problem.php?incident_id=$incident_id'>";  
		}
		else
		{
			echo "Need to add an incident";
		}
}
	
	else if ($urlVariables['incident_id'] || $urlVariables['work_performed_id'])
	{
		if($urlVariables['incident_id'])
		{
			$incident_id = $urlVariables['incident_id'];
			$work_performed_id = $sqlTool->getLatestIncidentWorkPerformedId($incident_id);	
		}
		else
		{
			$work_performed_id = $urlVariables['work_performed_id'];
			$work_performed_details = $sqlTool->getWorkPerformedDetails($work_performed_id);
		
			$incident_id = $work_performed_details[incident_id];
		}
		
		$incidentDetails = $sqlTool->getIncidentDetails($incident_id);
		$problem_id = $incidentDetails['problem_id'];
		
		
		
		include("display/problem_detail.php"); 
		include("incident.php"); 
	}
	else 
	{ 
		$company_id = 0;
		//echo $problem_id;
		//include("display/problem_list.php"); 
		include("display/incident_list.php"); 
	}
?>

</table>