<?php
	
	require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	include("php_scripts/url_variables.php");
  
	if( $urlVariables[edit])
		include("edit/contact.php");
	else
		include("display/contact.php");
	  
   
?>
