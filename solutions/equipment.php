<?php
	require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	include("php_scripts/url_variables.php");
	
	if($urlVariables[company_id] || $urlVariables[edit])
	{
		include("edit/equipment.php");
	}
	else 
	{
		$equipment_id = $urlVariables[equipment_id];
		$equipmentInfo =  $sqlTool->getEquipmentInfo($equipment_id);
		
		$companyInfo = $sqlTool->getCompanyDetails($equipmentInfo[company_id]);
		echo "<h2><a href='company.php?company_id=$companyInfo[id]'>$companyInfo[company_name]</a></h2>";
		echo '<div>'; //style="position:fixed; left:275px; top:250px; background-color: white; border: 2px solid black;">';
		echo "<div><h3>$equipmentInfo[device_name]</h3><a href='equipment.php?equipment_id=$equipmentInfo[id]&edit=update' title='Edit $equipmentInfo[device_name]'> Edit</a>";
		echo '<table class="half">';
		echo '<tr><td>Model</td><td>';
		echo $equipmentInfo[model]; // model
		echo '</td></tr>';
		echo '<tr><td>OS</td><td>';
		echo $equipmentInfo[os]; //os
		echo '</td></tr>';
		echo '<tr><td>Serial #</td><td>';
		echo $equipmentInfo[serial]; 
		echo '</td></tr>';
		echo '<tr><td>Install Date</td><td>';
		echo $equipmentInfo[installed_date]; 
		echo '</td></tr>';
		echo '<tr><td>Notes</td><td>';
		echo $sqlTool->nl2br_limit($equipmentInfo[notes], 2); 
		echo '</td></tr>';
		echo '</table>';
		echo '<h4 class="clearfloat">System Information</h4>';
		echo '<div class="system_information shadow" style="margin: 10px;">'.$sqlTool->toTable($equipmentInfo[system_information]).'</div>';
		echo '</div></div>';
		echo '<div class="clearfloat"></div>';
		
		include("display/kbn.php"); 
	}
	
	

?>