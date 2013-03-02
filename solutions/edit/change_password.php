<?php
	
	if($_POST)
	{
		require_once("../php_scripts/sql_tool.php");
		$sqlTool = new SqlTool();
		
		$changedPass = $sqlTool->changeUserPassword($_POST['new_password'], $_POST['employee_id']);
		
		if ($changedPass == '1') 
		{
			// //mail($_POST['email_address'], 'Password Changed', 'Your password was successfuly changed.');
			//header("Location: /solutions/employee.php?$_POST['employee_id']&changed=true");
			
			echo "<script type='text/javascript'>window.location = '/solutions/employee.php?employee_id=$_POST[employee_id]&changed=true'</script>";
			// echo "$_POST[employee_id]";
		} 
		else 
		{
			// header("Location: /solutions/employee.php?$_POST['employee_id']&changed=false");
			echo "<script type='text/javascript'>window.location = '/solutions/employee.php?employee_id=$_POST[employee_id]&changed=false'</script>";

		}
	}
?>