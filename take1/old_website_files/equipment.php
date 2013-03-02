<style type="text/css">
.half {
	padding:10px 0px 0px 0px;
	margin:0px;
	overflow:auto;
}
</style>
<div style="padding:10px;">
<?php
	
  require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
		
	$urlVariables = explode("&", substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?') + 1));
	$urlVariablestemp = explode("=", $urlVariables[0]);
	$urlVariablestemp2 = explode("=", $urlVariables[1]);
	$urlVariables = array();
	$urlVariables[$urlVariablestemp[0]] = $urlVariablestemp[1];
	$urlVariables[$urlVariablestemp2[0]] = $urlVariablestemp2[1];
	
  $equipmentTickets = $sqlTool->getEquipmentTickets($urlVariables['equipment_id']);
  $equipmentInfo =  $sqlTool->getEquipmentInfo($urlVariables['equipment_id']);
  
   echo '<div>'; //style="position:fixed; left:275px; top:250px; background-color: white; border: 2px solid black;">';
    echo '<a href="new_equipment.php?equipment_id='.$equipmentInfo[failed_equipment_id].'">Edit</a>';
    echo '<div><h1>'.$equipmentInfo[pc_name].'</h1>'; //user
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
	  echo $equipmentInfo[install_date_varchar]; 
    echo '</td></tr>';
    echo '<tr><td>Notes</td><td>';
	  echo $sqlTool->nl2br_limit($equipmentInfo[notes], 2); 
    echo '</td></tr>';
    echo '</table>';
    echo '<h4 class="clearfloat">System Information</h4>';
    echo '<div class="system_information shadow" style="margin: 10px;">'.$sqlTool->toTable($equipmentInfo[system_information]).'</div>';
	  echo '</div></div>';
	  echo '<div class="clearfloat"></div>';
	 /*
  $ticket = $sqlTool->getTicket($equipmentInfo[ticket_id]);
  $ticket = $ticket[0];
  echo '<div class="half">';
	  echo '	<a style="font-size:16px;" href="clients.php?companies_id='.$ticket['companies_id'].'">'.$ticket['company'].'</a>';
	  echo '	<div style="padding-left:10px;">'.$ticket['street_address'].'<br> '.$ticket['city'].', '.$ticket['state'].' '.$ticket['zip'].'</div>';
	  echo '</div>';
  */
  //echo '<br/><br/><br/><br/><br/><br/>';
  foreach($equipmentTickets as $key => $equipment){
    include("i/display_equipment.php"); 
    }
  
?>
</div>