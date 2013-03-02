<?php
	if(isset($_POST[submit])){
		require_once("../php_scripts/sql_tool.php");
		$sqlTool = new SqlTool();
		
		echo "<pre>";
			print_r($_POST);
		echo "</pre>";
		
		
		$equipment_id = $_POST[equipment_id];
		$start_time = $_POST[start_time];
		$end_time = $_POST[end_time];
		$work_performed = $_POST[work_performed];
		$travel = $_POST[travel];
		
		//UPDATE equipment work performed
		for ($i = 0; $i < count($equipment_id); $i += 1)
		{
			
			$equipment_array[work_performed_id] = $_POST[work_performed_id];
			$equipment_array[equipment_id] = $equipment_id[$i];
			$equipment_array[start_time] = $start_time[$i];
			$equipment_array[end_time] = $end_time[$i];			
			$equipment_array[work_performed] = $work_performed[$i];		

			
			$updateEwp =  $sqlTool->updateEwp($equipment_array);
			// echo $updateEwp;
			// echo "$i eqp updated<br />";
			
		}
		
		$insertEwp =  $sqlTool->insertEwp($_POST);
		
		
		//If there isn't any record in the travel table, return false
		$exists = $sqlTool->travelExists($_POST[work_performed_id]);
		//echo $exists;
		
		$updateTravel = $sqlTool->updateTravel($travel, $_POST[work_performed_id], $exists);
		//echo $updateTravel;
		
		
		
		
		$incidentDetails = $sqlTool->getIncidentDetails($_POST[incident_id]);
		
		$nextPage = "<script type='text/javascript'>window.location = '../problem.php?work_performed_id=$_POST[work_performed_id]'</script>";
		echo $nextPage;
	}
	else
	{
		$equipment_list = $sqlTool-> getEquipmentList($details[company_id], $details[work_performed_id]);
		
		$currentTime = date('H:i:s'); 
		//echo	"<form id='form1' style='margin-left: 15px;' name='form1' method='post' action='edit/add_ewp.php'>";
		echo	"	<tr>
						<td>
							
							<select name='insert_equipment_id' id='insert_equipment_id' onchange=checkEquipmentSelected()>
								<option value=''>--Select Equipment--</option>";
							
								foreach($equipment_list as $key => $details)
									echo "<option $selected name='insert_equipment_id' value='$details[id]'>$details[device_name]</option>";
								
								echo	"</select></td>
						<td><input name='insert_start_time' id='insert_start_time' style='width: 100%;' disabled='disable' value='$currentTime' /></td>
						<td><input name='insert_end_time' id='insert_end_time' style='width: 100%;' disabled='disable' value='' /></td>
					</tr>
					<tr>
						<td colspan='3' style='padding-left: 50px;'><label>Work Performed</label><textarea disabled='disable' name='insert_work_performed' id='insert_work_performed'></textarea></td>
					</tr>";
		//echo "<tr>
		//			<td><input type='submit' name='submit' id='submit' value='submit' /></td>
		//	</tr>";
		// echo "	</form>";
	}
?>