<?php
require_once("php_scripts/sql_tool.php");
$sqlTool = new SqlTool();
		
	$urlVariables = explode("&", substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?') + 1));
	$urlVariablestemp = explode("=", $urlVariables[0]);
	$urlVariablestemp2 = explode("=", $urlVariables[1]);
	$urlVariables = array();
	$urlVariables[$urlVariablestemp[0]] = $urlVariablestemp[1];
	$urlVariables[$urlVariablestemp2[0]] = $urlVariablestemp2[1];
  
  
	
  if( $urlVariables['problem_id']){
    $problem_id = $urlVariables['problem_id'];
      
    include("display/problem_detail.php"); 
    include("display/incident_detail.php"); 
    }
    else { 
      $company_id = 0;
      include("display/problem_list.php"); 
    }
        
  
 
  
  ?>

</table>