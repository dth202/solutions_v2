<?php
	require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	include("php_scripts/url_variables.php");

	$employeeDetails = $sqlTool->getEmployeeDetails($urlVariables['employee_id']);

	//Delete when going live *********************************************************
	$_SESSION['user_name'] = $employeeDetails[id];
	$_SESSION['user_type'] = $employeeDetails[user_type];
	echo "<script type='text/javascript'>window.location = '$_SESSION[lastPage]'</script>";
	exit;
	//*********************************************************************************

?>