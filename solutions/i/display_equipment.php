<?php 
    $company = $sqlTool->getCompanyDetails_ById($equipment['company_id']);  
      //echo $key.' - '.$value.'<br />';
      //echo $value[ticket_id].'<br />';
      $ticket = $sqlTool->getTicket($equipment['ticket_id']);
		  $ticket = $ticket[0];
      echo '<br /><hr class="clearfloat" /><br />';
   
   if ($equipment['status'] == 'Open') { 
		  $statusColor = 'class="open"'; 
	  } else { 
		  $statusColor = 'class="closed"'; 
	  }
    
    echo '<div class="ticket2">';
	  echo '<div class="half"><h2 style="margin-bottom:2px; float: left;">';
	  echo ''.$equipment['ticket_id'].' - ';
	  echo $equipment['ticket_name'];
	  echo ' (<span ' . $statusColor . ' style="font-weight:bold;">'.$equipment['status'].'</span>)</h2>';
    echo '<a href="new_ticket.php?ticket_id='. urlencode($equipment['ticket_id']) .'">Edit</a>';
    echo '<a href="ticket.php?ticket_id='. urlencode($equipment['ticket_id']) .'&delete=yes" style="margin: 0 30px;">Delete</a>';?>

    <br class="clearfloat"/><a href="print/ticket.php?ticket_id=<?php echo $equipment['ticket_id'] ?>"
      onclick="return popitup('print/ticket.php?ticket_id=<?php echo $equipment['ticket_id'] ?>')" >Print View</a>
    <?php
	  echo '	<div style="font-size:11px; color:#666; padding-left:5px; clear: left;">'.$sqlTool->convertDate2String($equipment['date']).'<br />';
	  echo '  Submitted by: <a href="employee.php?tech_id='. urlencode($equipment['tech']) .'">' . $equipment['tech'] . '</a>';
    if( $equipment['update_tech'] )
      {
        echo '  <br />Last Updated by: <a href="employee.php?tech_id='. urlencode($equipment['update_tech']) .'">' . $equipment['update_tech'] . '</a>';
        echo '  On '.$sqlTool->convertDate2String($equipment['update_date']);
      }
    echo '</div>';
    echo '</div>';
    
    echo '<div class="half">';
	  echo '	<a style="font-size:16px;" href="clients.php?companies_id='.$company['companies_id'].'">'.$company['name'].'</a>';
	  //echo '	<div style="padding-left:10px;">'.$ticket['street_address'].'<br> '.$ticket['city'].', '.$ticket['state'].' '.$ticket['zip'].'</div>';
	  
  
    $contactInfo = $sqlTool->getContactInfoById($ticket['contactOption_id']);
    //$contactInfo = $contactInfo[0];
    /*
    foreach($contactInfo as $key => $value){
      echo $key.' - '.$value.'<br />';
      }
    */
	  //echo '<br /><strong>Contact </strong>';
    echo '<table>';
			  echo '<th colspan=2>';
				echo '<strong>' . $contactInfo[first].' '.$contactInfo[last] .'</strong></th>';
				echo '<tr>';
				echo '<td>'. $contactInfo[mobile_phone] .'</td>';
				echo '<td><a href="mailto:'.$contactInfo[email_address].'">'. $contactInfo[email_address] .'</a></td>';
				echo '</tr>';
		echo '</table>';
    echo '</div></div>';
    
	  echo '<div class="clearfloat"></div>';
   
	  
   
    $equipmentInfo = $sqlTool->getEquipmentInfo($ticket['equipment_id']);
    //$equipmentInfo = $equipmentInfo[0];
    /*
    foreach($equipmentInfo as $key1 => $value1){
      echo $key1.' '.$value1.'<br />';
      }
    */ 
    
    echo '<div style="margin-left: 20px;">';
    if($urlVariables['equipment_id'] == false)
    {
      if($ticket['equipment_id'] != 0){
        echo '<div class="half">';
        echo '<div class="half"><div><strong>Equipment</strong></div>';
        //echo $equipmentInfo[pc_name].'</div>'; //user
        echo '<a href= equipment.php?equipment_id='.$equipmentInfo['failed_equipment_id'].'>'.$equipmentInfo['pc_name'].'</a></div>';
	      echo '<div class="half"><div><strong>&nbsp;</strong></div>'.$equipmentInfo[model].'</div>'; // model
	      echo '</div>';
	      echo '<div class="half">';
	      echo '<div class="half"><div><strong>&nbsp;</strong></div>'.$equipmentInfo[os].'</div>'; //os
	      echo '<div class="half"><div><strong>&nbsp;</strong></div>'.$equipmentInfo[notes].'</div>'; // serial
	      echo '</div>';
      }
	  }
    
	  echo '<div class="half" style="padding: 5px;">';
	  echo '<div><strong>Problem Description</strong></div>';
	  echo '<div class="ticket2">'.$sqlTool->nl2br_limit($ticket['problem_description'], 2).'</div>';
	  echo '</div>';
	  echo '<div class="half" style="padding: 5px;">';
	  echo '<div><strong>Work Preformed</strong></div>';
	  echo '<div class="ticket2">'.$sqlTool->nl2br_limit($ticket['work_preformed'], 2 ).'</div>';
	  echo '</div>';
	  echo '<div class="clearfloat"></div>';
  
    if($ticket['knowledge_base'])
    {
      echo '<div class="half " style="padding: 5px;">';
	    echo '<div style="padding-top:10px;"><strong>Knowledge Base Notes</strong></div>';
	    echo '<div>'.$sqlTool->nl2br_limit($ticket['knowledge_base'], 2).'</div>';
      echo '</div>';
    }
    if($ticket['needs'])
    {
      echo '<div class="half" style="padding: 5px;">';
	    echo '<div style="padding-top:10px;"><strong>Needs</strong></div>';
	    echo '<div style="color: red;">'.$sqlTool->nl2br_limit($ticket['needs'], 2).'</div>';
      echo '</div>';
    }
    echo '</div>';
    echo '</div>';
	  echo '</div>';
     
?>
</div>