<?php
	require_once("sql_tool.php");
	$sqlTool = new SqlTool();
	
	$url = $_SERVER['REQUEST_URI'];
	$arr = split("=", $url);
	$variable = urldecode($arr[1]);
  $variable_id = urldecode($arr[0]);
	$url = $arr[0];
	$arr = split("\?", $url);
	$type = $arr[1];
	if ($type == "company") {
		//echo $variable;
		
		$contacts = $sqlTool->getCompanyContacts($variable);
		foreach($contacts as $key => $value) {
			echo '<option value='.$value[0].'>'.$value[1]." ".$value[2].'</option>';
		}
		
		echo '==';
		
		$equipment = $sqlTool->getCompanyEquipment($variable);
      echo '<option></option>';
		foreach($equipment as $key => $value) {
      echo '<option value='.$value[0].'>'.$value[1]." - ".$value[4].'</option>'; //
    
    
  /*
    if($equipment == "")
    {
        echo '==';
        $equipmentOS = $sqlTool->getCompanyEquipment($variable);
		    foreach($equipmentOS as $key => $value) {
			  echo '<option value='.$value.'>'.$value[2].'</option>';  
     }
	*/	
		}
	}
?>