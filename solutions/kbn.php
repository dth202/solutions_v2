<?php
	require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	include("php_scripts/url_variables.php");
	
	if($urlVariables[edit])
	{
		include("edit/kbn.php");
	}
	else
	{
		if($urlVariables[kbn_id]){
			$kbn_id = $urlVariables[kbn_id];
		}
		include("display/kbn.php"); 
	}
?>