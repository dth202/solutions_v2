<?php
 
	  foreach($tickets as $key => $ticket) {   
		  if ($ticket['status'] == 'Open') { 
			  $statusColor = 'class="open"'; 
		  } else { 
			  $statusColor = 'class="closed"'; 
		  }
     // $type = "";
      //$term = $ticket['company'];
      //$ticketCompanyId = $sqlTool -> getCompanyDetails($type, $term);
		  echo '<tr>';
    
      echo '<td><a href="ticket.php?ticket_id='. urlencode($ticket['ticket_id']) .'">' . $ticket['ticket_id'] . ' - ';
      if($ticket['ticket_name'])
          echo $ticket['ticket_name'] . '</a></td>';
      else
          echo $ticket['ticket_id'] . '</a></td>';
      echo '<td>' . $sqlTool->convertDate2String($ticket['date']) . '</td>';
		  //echo '<td><a href="clients.php?company='. urlencode($ticket['company']) .'">' . $ticket['company'] . '</a></td>';
      if($ticket[company_id] == 83)
      echo '<td>' . $ticket['OR_temp_company'] . '</td>';	
      else{
      echo '<td><a href="clients.php?companies_id='.$ticket['company_id'].'">' . $ticket['company'] . '</a></td>';
		  }
		  echo '<td ' . $statusColor . ' style="font-weight:bold;">' . $ticket['status'] . '</td>';
      if( $_SERVER['QUERY_STRING'] != 'page=employee')
      echo '<td><a href="employee.php?tech_id='. urlencode($ticket['tech']) .'">' . $ticket['tech'] . '</a></td>';
		  echo '</tr>';
	  }
 
?>