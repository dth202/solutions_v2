<?php
	session_start();
	
	require('sql_tool.php');
	$sqlTool = new SqlTool();
	
	$changedPass = $sqlTool->changeUserPassword($_POST['new_password'], $_POST['tech_id']);
	if ($changedPass == '1') {
		mail($_POST['email_address'], 'Password Changed', 'Your password was successfuly changed.');
		header("Location: /solutions/employee.php?changed=true");
	} else {
		header("Location: /solutions/employee.php?changed=false");

	}
?>