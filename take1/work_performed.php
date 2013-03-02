<?php
  require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
		
	include("php_scripts/url_variables.php");
  if($urlVariables[work_performed_id]){
    $work_performed_details =  $sqlTool->getWorkPerformedDetails($urlVariables[work_performed_id]);
    $incident_id = $work_performed_details[incident_id];
    $problem_id = $work_performed_details[problem_id];
    $work_performed =  $sqlTool->getIncidentWorkPerformed($incident_id);
  }
  else {
    $incidentDetails = $sqlTool->getIncidentDetails($urlVariables[incident_id]);
    $problem_id = $incidentDetails[problem_id];
    $work_performed =  $sqlTool->getIncidentWorkPerformed($urlVariables[incident_id]);
  }
   
	include("display/problem_detail.php"); 
  include("display/incident_detail.php");
  if($urlVariables[edit])
    include("edit/work_performed.php"); 
  else
    include("display/work_performed.php"); 
  
  ?>