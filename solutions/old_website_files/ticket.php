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
	
	//echo print_r($urlVariables);
	if ($urlVariables['ticket_id']) {
		$equipment = $sqlTool->getTicket($urlVariables['ticket_id']);
		$equipment = $equipment[0];
   
	}
   /*
  echo '<table>';
  foreach($equipment  as $key => $ticket) {
    echo '<tr>';
    echo  '<td>'.$key.'</td><td>'.$ticket.'</td>';
    echo '</tr>';
    }
  echo '</table>';
  */

	//echo print_r($ticket);
  
  
  if ($urlVariables['delete'])
  {
  /*
    if ($_SESSION['user_name'] == $ticket['tech'])
    echo 'Yes, You can delete';
    else
    echo 'No, you can't delete';
    */
    $hostname='mysql50-60.wc2.dfw1.stabletransit.com';
    $username='513061_intuitiv3';
    $password='9teen6T9';
    $dbname = '513061_intuitive_test_db';
		
    $con = mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
    mysql_select_db($dbname, $con);
    
    $sql = "DELETE FROM tickets WHERE ticket_id='$urlVariables[ticket_id]'";
   
    if (!mysql_query($sql,$con))
    {
    die('Error: ' . mysql_error());
    }

    mysql_close($con);
    echo 'Deleted ticket: '.$urlVariables[ticket_id];
    
  }
	
  else {
     include("i/display_equipment.php"); 
     
      }
?>
</div>