<?php
	

if($_POST[submit]){

	require_once("../php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	
	
	//$_test['device_name'] = "test";
	if($_POST[submit] == "Insert Equipment")
	{
		$submitEquipment = $sqlTool->insertEquipment($_POST);
		$equipment_id = $sqlTool->getLatestEquipment_id();
	}
	else
	{
		$submitEquipment = $sqlTool->updateEquipment($_POST);
		$equipment_id = $_POST[equipment_id];
	}

	// foreach ($_POST as $key => $value)
              // echo $key.': '.$value.'<br />';
	
	$nextPage = "<script type='text/javascript'>window.location = '../equipment.php?equipment_id=$equipment_id'</script>";
	//echo $submitEquipment;
	echo $nextPage;
	
 }
else {

	echo "<form id='form1' style='margin-left: 15px;' name='form1' method='post' action='edit/equipment.php'>
			<div class='ticket'>";
     
		if($urlVariables[company_id])
			$companyDetails = $sqlTool->getCompanyDetails($urlVariables[company_id]);
      
		$submitButton = 'Insert Equipment';        
		if($urlVariables['equipment_id']){
			$equipmentInfo =  $sqlTool->getEquipmentInfo($urlVariables['equipment_id']);
			$submitButton = 'Update Equipment';
			$companyDetails = $sqlTool->getCompanyDetails($equipmentInfo[company_id]);
			echo '<input type="hidden" name="equipment_id" id="equipment_id" value="'.$urlVariables['equipment_id'].'" />';
		}
		echo '<input type="hidden" name="company_id" value="'.$companyDetails[id].'" />';
                    
                    echo '<h2>'.$companyDetails[company_name].'</h2>';
       
       
        echo '<label>PC Name</label>';
        echo '<input name="device_name" class="hours" type="text" value="'.$equipmentInfo[device_name].'" />';
      echo '</div>';
    echo '<div>';
        echo '<label>Model</label>';
        echo '<input name="model" class="drive_time" type="text" value="'.$equipmentInfo[model].'" />';
      echo '</div>';
      echo '<div>';
        echo '<label>Serial</label>';
        echo '<input name="serial" class="milage" type="text" value="'.$equipmentInfo[serial].'" />';
      echo '</div>';
     echo ' <div>';
        echo '<label>O.S.</label>';
        echo '<select style="width: auto;" id="os" name="os">';
          echo '<option>'.$equipmentInfo[os].'</option>';
          echo ' <option>Windows XP Pro SP1</option>';
          echo ' <option>Windows XP Pro SP2</option>';
          echo ' <option>Windows XP Pro SP3</option>';
          echo ' <option>Windows Vista Home SP1</option>';
          echo ' <option>Windows Vista Home SP2</option>';
          echo ' <option>Windows Vista Business SP1</option>';
          echo ' <option>Windows Vista Business SP2</option>';
          echo ' <option>Windows 7 Home Prem 32 bit</option>';
          echo ' <option>Windows 7 Home Prem 64 bit</option>';
          echo ' <option>Windows 7 Pro 32 bit</option>';
          echo ' <option>Windows 7 Pro 64 bit</option>';
          echo ' <option>Windows 7 Ultimate 32 bit</option>';
          echo ' <option>Windows 7 Ultimate 64 bit</option>';

        echo '</select>';
        
      echo '</div>';
      echo '<div>';
        echo '<label>Install Date (YYYY-MM-DD)</label>';
        echo '<input name="installed_date" class="milage" type="text" value="'.$equipmentInfo[installed_date].'" />';
      echo '</div>';
echo '      <div>';
echo '        <label>Notes</label>';
echo '        <textarea name="notes" class="milage" type="text">'.$equipmentInfo[notes].'</textarea>';
echo '      </div>';
echo '      <div>';
echo '        <label>System Information</label>';
echo '        <textarea name="system_information" style="height: 200px;" class="milage" type="text">'.$equipmentInfo[system_information].'</textarea>';
echo '      </div>';

echo '      <input style="width:170px; margin: 0px 100px;" type="submit" name="submit" id="submit" value="'.$submitButton.'" />';
echo '    </div>
			</form>';
}
    ?>
  
  


