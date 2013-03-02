<?php

if($urlVariables[edit])
  $incidentList = $sqlTool->getProblemIncident($problem_id, $incident_id);
else
  $incidentList = $sqlTool->getProblemIncident($problem_id, 0);

echo "<table class='shadow'>
  <caption >Incidents <a href='/solutions/incident.php?edit=insert&problem_id=$problem_id'><img src='/images/add.jpg' /></a></caption>
  <tr>
    <td><a class='column_title' href='tickets.php?sort=ticket_name'>Incident</a></td>
  	<td><a class='column_title' href='tickets.php?sort=ticket_name'>Created Date</a></td>
    <td><a class='column_title' href='tickets.php?sort=date'>Completed Date</a></td>
    <td><a class='column_title' href='tickets.php?sort=company'>Company</a></td>    
    <td><a class='column_title' href='#'>Contact</a></td>
    <td><a class='column_title' href='tickets.php?sort=tech'>Technician</a></td>
    <td><a class='column_title' href='tickets.php?sort=tech'>Waiting On</a></td>
  </tr>";
        
  foreach($incidentList as $key => $incidentListDetails) {         
      //echo incidentListDetails[incident_id];
      $selected_incident = "";
      if($incidentListDetails[incident_id] == $incident_id)
        $selected_incident = "selected_incident";
      
      if ($incidentListDetails['completed_date'] == '' || !isset($incidentListDetails['completed_date']) || $incidentListDetails['completed_date'] == '0000-00-00 00:00:00'  ) { 
			  $status = "open"; 
        $completed_date = '-';
		  } else { 
			  $status = "closed"; 
        $completed_date = $sqlTool->convertDate2String($incidentListDetails['completed_date']);
		  }
      $class = "class='$status $selected_incident'";
      
      $created_date = $sqlTool->convertDate2String($incidentListDetails[created_date]);
		  echo '<tr '.$class.'>';
        echo "<td><a href='incident.php?incident_id=$incidentListDetails[incident_id]&edit=update'> Edit - 
              $incidentListDetails[incident_id]</a></td>
              <td><a href='incident.php?incident_id=$incidentListDetails[incident_id]'>View - $created_date</a></td>";
        echo '<td>' . $completed_date . '</td>';
		    echo '<td><a href="company.php?company_id='.$incidentListDetails['company_id'].'">' . $incidentListDetails['company_name'] . '</a></td>';
		    echo '<td><a href=contact.php?contact_id='.$incidentListDetails[contact_id].'>'.$incidentListDetails['contact_name'].'</td>';
        echo '<td><a href="employee.php?employee_id='. urlencode($incidentListDetails['employee_id']) .'">' . $incidentListDetails['employee_id'] . '</a></td>';
        
        echo "<td>";
        if($status == "open")
          echo $incidentListDetails[status];
        echo "</td>";
        
		  echo '</tr>';
      if($status == "open"){
        echo "<tr>
                <td></td>
                <td colspan='6'>$incidentListDetails[follow_up]</td>
              </tr>";
       }
    }
echo '</table>';
?>