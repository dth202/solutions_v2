<?php
	require_once("sql_tool.php");
	$sqlTool = new SqlTool();
	include("url_variables.php");
	
	
	// echo "<pre>";
		// print_r($urlVariables);
	// echo "</pre>";
	if($urlVariables[company_id]) 
	{
		$contacts = $sqlTool->getContactList($urlVariables[company_id]);
				
		foreach($contacts as $key => $value) 
		{
			echo "<option value='$value[id]'>$value[fname] $value[lname]</option>";
		}
	}
	if($urlVariables[equipment])
	{
		echo '==';
		
		$equipment = $sqlTool->getCompanyEquipmentList($urlVariables[company_id]);
		//echo '<option></option>';
		foreach($equipment as $key => $value) 
		{
			echo "<option value='$value[id]'>$value[device_name]</option>";
		}
	}
?>