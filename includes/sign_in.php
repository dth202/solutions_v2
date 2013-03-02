<?php
	session_start();
	
	require('../solutions/php_scripts/sql_tool.php');
	$sqlTool = new SqlTool();
  echo $pageDirect;
  
	if(true) {
		$employeeDetails = $sqlTool->getEmployeeDetails($_POST['username']);
		
		//$_SESSION['user_name'] = $sqlTool->getTechId($_POST['username']);
		$_SESSION['user_name'] = $employeeDetails[id];
		$_SESSION['user_type'] = $employeeDetails[user_type];
		if (crypt(md5($_POST['password']), '11') == $sqlTool->getUserPassword($_POST['username'])) { // password will be stored as crypt(md5(), '11') in the database
			$_SESSION['logged_in'] = true;
			if ($_SESSION['direct-to-solutions'] == true) {
				//header("Location: /solutions/employee.php");
				header("Location: ".$_SESSION['pageDirect']); //redirects to the desired page
			} else {
				header("Location: /edit/");
			}
		} else {
			header("Location: /login/");
		}
	} else {
		header("Location: /login/");
	}
?>

