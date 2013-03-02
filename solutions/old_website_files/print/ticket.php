<?php 
	session_start();
	$_SESSION['pageDirect'] = $_SERVER['REQUEST_URI'];
	$_SESSION['direct-to-solutions'] = true;
	if (!isset($_SESSION['logged_in'])) {
		header("Location: /login/");
		exit;
	}
	$page = $_SERVER['REQUEST_URI'];
	$page = str_replace("/solutions/", "", $page);

	if ($page == 'index.php') {
		header('Location: /solutions/status.php');
	}

	require_once("../php_scripts/sql_tool.php");
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
    
	$company = $sqlTool->getCompanyDetails_ById($equipment['company_id']);  
	$ticket = $sqlTool->getTicket($equipment['ticket_id']);
	$ticket = $ticket[0];
    $contactInfo = $sqlTool->getContactInfoById($ticket['contactOption_id']);
    $equipmentInfo = $sqlTool->getEquipmentInfo($ticket['equipment_id']);

   if ($equipment['status'] == 'Open') { 
		  $statusColor = 'class="open"'; 
	  } else { 
		  $statusColor = 'class="closed"'; 
	  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>
     <?php echo $equipment['ticket_id'].' - '. $equipment['ticket_name'].'('.$equipment['status'].')'; ?>
    </title>
    <link rel="shortcut icon" href="../../images/imgs/favicon.ico" type="image/x-icon" />
    <style type="text/css">
		blockquote
			{
				font-style:italic;
			}
    </style>
  </head>
  <body>


    <?php
	
    
	
	  echo '<h2>'.$equipment['ticket_id'].' - ';
	  echo $equipment['ticket_name'];
	  echo ' (<span ' . $statusColor . ' style="font-weight:bold;">'.$equipment['status'].'</span>)</h2>';
	  echo $sqlTool->convertDate2String($equipment['date']).'<br />';
	  $employeeDetails = $sqlTool->getEmployeeDetails($equipment['tech']);
	  echo '  Technician: '. $employeeDetails['first'].' '. $employeeDetails['last'];
    

	  echo '<h3 style="margin-bottom: 2px;">'.$company['name'].'</h3>';
	  echo '<div style="padding-left:10px;">'
		.$company['street_address'].'<br> '
		.$company['city'].', '.$company['state'].' '.$company['zip']
		.'<br />'.$company['office_phone'];
	   
	   echo '<br />';
    echo '<strong>' . $contactInfo[first].' '.$contactInfo[last] .'</strong>';
				echo ' | '.$contactInfo[mobile_phone];
				echo ' | '.$contactInfo[email_address];
    
	  echo '</div>';

    echo '<div>';
    if($ticket['equipment_id'])
	{
      echo '<br /><strong>Equipment</strong>';
      echo '<br />'.$equipmentInfo['pc_name'];
	  echo ' | '.$equipmentInfo[model]; // model
	  echo ' | '.$equipmentInfo[os]; //os
	  echo ' | '.$equipmentInfo[notes]; // serial
	  }
    echo '<br />';
	echo '<br />';
	  echo '<strong>Problem Description</strong>';
	  echo '<div class="ticket2">'.$sqlTool->nl2br_limit($ticket['problem_description'], 2).'</div>';
	  echo '</div>';
	  echo '<br />';
	  echo '<div>';
	  echo '<div><strong>Work Preformed</strong></div>';
	  echo '<div class="ticket2">'.$sqlTool->nl2br_limit($ticket['work_preformed'], 2 ).'</div>';
	  echo '</div>';
	  
  
    if($ticket['knowledge_base'])
    {
	  echo '<br />';
      echo '<div>';
	    echo '<div style="padding-top:10px;"><strong>Knowledge Base Notes</strong></div>';
	    echo '<div>'.$sqlTool->nl2br_limit($ticket['knowledge_base'], 2).'</div>';
      echo '</div>';
    }
    if($ticket['needs'])
    {
	  echo '<br />';
      echo '<div class="half">';
	    echo '<div style="padding-top:10px;"><strong>Needs</strong></div>';
	    echo '<div style="color: red;">'.$sqlTool->nl2br_limit($ticket['needs'], 2).'</div>';
      echo '</div>';
    }
    
    
     
    ?>
  </body>
</html>