<?php
  require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
		
	include("php_scripts/url_variables.php");
	if($urlVariables[work_performed_id]){
		$work_performed_details =  $sqlTool->getWorkPerformedDetails($urlVariables[work_performed_id]);
		$incident_id = $work_performed_details[incident_id];
		$problem_id = $work_performed_details[problem_id];
	}
	else {
		$incidentDetails = $sqlTool->getIncidentDetails($urlVariables[incident_id]);
		$problem_id = $incidentDetails[problem_id];
		$incident_id = $urlVariables[incident_id];
	}
	$work_performed =  $sqlTool->getIncidentWorkPerformed($incident_id);

	include("display/problem_detail.php"); 
	include("display/incident_detail.php");

	if($urlVariables[edit] = "insert")
	{
		$incident[date] = date('Y-m-d H:i:s'); //date("Y-m-d");
		$incident[incident_id] = $urlVariables[incident_id];
		$incident[employee_id] = $_SESSION[user_name];
		
		echo $sqlTool->insertWorkPerformed($incident);
		
		echo "<script type='text/javascript'>window.location = 'problem.php?incident_id=$incident_id'</script>";
	}
	
	else
		include("display/work_performed.php"); 
  
  ?>