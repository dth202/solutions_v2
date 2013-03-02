<?php
require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
		
	include("php_scripts/url_variables.php");
  $incident_id = $urlVariables['incident_id'];
  $work_performed =  $sqlTool->getIncidentWorkPerformed($incident_id);
  $incidentDetails = $sqlTool->getIncidentDetails($incident_id);
  
  if($urlVariables[problem_id])
    $problem_id = $urlVariables[problem_id];
  else
    $problem_id = $incidentDetails[problem_id];
  
	include("display/problem_detail.php"); 
  include("display/incident_detail.php");
  if($urlVariables[edit])
    include("edit/incident.php"); 
  else
    include("display/work_performed.php"); 
  
  ?>