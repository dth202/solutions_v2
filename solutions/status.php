<table>
  <tr>
    <!--<td><a class="column_title" href="#">No.</a></td>-->
    <td><a class="column_title" href="#">Ticket</a>    </td>
    <td><a class="column_title" href="#">Date</a></td>
    <td><a class="column_title" href="#">Company</a></td>
    
    <td><a class="column_title" href="#">Status</a></td>
    <td><a class="column_title" href="#">Technician</a></td>
  </tr>
<?php
	require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	$tickets = $sqlTool->getTickets($urlVariables['sort'], $urlVariables['status'], 5);
		  
  include("i/display_tickets.php");  
  
  /*
	foreach($tickets as $key => $ticket) {
		if ($ticket['status'] == 'Open') { 
			$statusColor = 'class="open"'; 
		} else { 
			$statusColor = 'class="closed"'; 
		}
    
  
  
		echo '<tr>';
		echo '<td><a href="ticket.php?ticket_id='. urlencode($ticket['ticket_id']) .'">' . $ticket['ticket_id'] . '</a></td>';
    //echo '<td><a href="ticket.php?ticket_id='. urlencode($ticket['ticket_id']) .'">' . $ticket['ticket_name'] . '</a></td>';
    if($ticket['ticket_name'])
        echo '<td><a href="ticket.php?ticket_id='. urlencode($ticket['ticket_id']) .'">' . $ticket['ticket_name'] . '</a></td>';
    else
        echo '<td><a href="ticket.php?ticket_id='. urlencode($ticket['ticket_id']) .'">' . $ticket['ticket_id'] . '</a></td>';
		echo '<td>' . $sqlTool->convertDate2String($ticket['date']) . '</td>';
    if($ticket[company_id] == 83)
    echo '<td>' . $ticket['OR_temp_company'] . '</td>';		
    else
    {
		  echo '<td><a href="clients.php?companies_id='.$ticket['company_id'].'">' . $ticket['company'] . '</a></td>';		
    }
		echo '<td ' . $statusColor . ' style="font-weight:bold;">' . $ticket['status'] . '</td>';
		echo '<td><a href="employee.php?tech_id='. urlencode($ticket['tech']) .'">' . $ticket['tech'] . '</a></td>';
		echo '</tr>';
    
	}
  */
?>
</table>
<div style="vertical-align:bottom;">
  <div class="half" style="vertical-align:bottom; padding-top:40px;">
  	<?php 
      
      echo 'Newest Ticket: <a href="ticket.php?ticket_id='. urlencode($tickets[0]['ticket_id']) .'">'.$tickets[0]['ticket_name'].'</a>, <a href="clients.php?company='. urlencode($tickets[0]['company']) .'">'.$tickets[0]['company'].'</a>'; 
          
    ?>
  </div>
  <div class="half" style="vertical-align:bottom; text-align:right;">
      <table id="tech_status" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><strong>Tech. ID</strong></td>
          <td><strong>Hours</strong></td>
          <td><strong>Closed</strong></td>
          <td><strong>Open</strong></td>
        </tr>
        <tr>
          <?php 
            $hours = $sqlTool->getEmployeeHours($_SESSION['user_name']);
            $closed = $sqlTool->getEmployeeStatusCount($_SESSION['user_name'], 'Closed');
            $open = $sqlTool->getEmployeeStatusCount($_SESSION['user_name'], 'Open');
            
            echo '<td><a href="employee.php">'.ucwords($_SESSION['user_name']).'</a></td>';
            echo '<td>'.$hours.'</td>';
            echo '<td><a href="tickets.php?&status=closed">'.$closed.'</a></td>';
            echo '<td><a href="tickets.php?&status=open">'.$open.'</a></td>';
              
            ?>
         </tr>
            
      </table>
  </div>
  <div class="clear">&nbsp;</div>
</div>