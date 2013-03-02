<?php
	session_start();
	
	require('sql_tool.php');
	$sqlTool = new SqlTool();
	
	$changedPass = $sqlTool->changeUserPassword($_POST['new_password'], $_POST['tech_id']);

	if ($changedPass) {
		mail($_POST['email_address'], 'Password Changed', 'Your password was successfuly changed.');
		header("Location: /solutions/employee.php");
	}
	if(false) {
		$_SESSION['user_name'] = $sqlTool->getTechId($_POST['username']);
		if (crypt(md5($_POST['password']), '11') == $sqlTool->getUserPassword($_POST['username'])) { // password will be stored as crypt(md5(), '11') in the database
			$_SESSION['logged_in'] = true;
			if ($_SESSION['direct-to-solutions'] == true) {
				header("Location: /solutions/employee.php");
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