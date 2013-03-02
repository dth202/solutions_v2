<?php

  require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
  
  
	$new_company = $sqlTool->getCompany();

	foreach($new_company as $key => $company) {
		$hostname='mysql50-33.wc2.dfw1.stabletransit.com';
		$username='513061_solutions';
		$password='Motiv8me';
		$dbname = '513061_solutions';
			
		$con = mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname, $con);
               
		$sql = "INSERT INTO equipment (company_id
									, device_name)
				VALUES 
					(   '$company[id]'
					, 'Other')";

		if (!mysql_query($sql,$con))
		{
		die('Error: ' . mysql_error());
		}
		
//Set the equipment_id = 1 to the new 'other' equipment that was just created
		//$sql2 = "INSERT INTO equipment (company_id
		//							, device_name)
		//		VALUES 
		//			(   '$company[id]'
		//			, 'Other')";

		//if (!mysql_query($sql2,$con))
		//{
		//die('Error: ' . mysql_error());
		//}
		//echo "1 record added";
	}

	echo '<br />Other equipment inserted for each company';    
?>