<?php
	//Used for add incident link
	$company = $sqlTool->getIncidentCompany($incident_id);
	
	if($urlVariables[incident_id])
	{
		$company = $sqlTool->getIncidentCompany($incident_id);
		$company_id = $company[company_id];
	}
	else if($urlVariables[company_id])
	{
		$company_id = $urlVariables[company_id];
	}
	else if($urlVariables[employee_id])
	{
		$employee_id = $urlVariables[employee_id];
	}
	else
	{
		$company_id = false;
	}
	
	$incidentList = $sqlTool->getProblemIncident($problem_id, $company_id, $employee_id);
	//print_r($incidentList);
	
	
	$percent = "100px";
	
	echo "<div id='tableContainer' class='tableContainer'>
			<table class='shadow scrollTable' width='100%'>
			<caption >Incidents ";
			if($company_id && $problem_id)
			{
				echo "<a href='/solutions/incident.php?edit=insert&problem_id=$problem_id&company_id=$company[company_id]'><img src='/images/add.jpg' /></a>";
			}
			echo "</caption>
			<thead class='fixedHeader'>
			  <tr>
				<th><a class='column_title' href='#'>Problem</a>";
				
				if($company_id && !$problem_id)
				{
					echo "<a href='/solutions/problem.php?edit=insert&company_id=$company_id'><img src='/images/add.jpg' width='15px'/></a>";
				}	
				
				echo "</th>
				<th><a class='column_title' href='#'>Incident</a></th>
				<th><a class='column_title' href='#'>Created Date</a></th>
				<th><a class='column_title' href='#'>Completed Date</a></th>
				<th><a class='column_title' href='#'>Company</a></th>    
				<th><a class='column_title' href='#'>Contact</a></th>
				<th><a class='column_title' href='#'>Waiting On</a></th>
				<th><a class='column_title' href='#'>Tech</a></th>
				<th></th>
			  </tr>
			</thead>
			<tbody class='scrollContent'>";
			foreach($incidentList as $key => $incidentListDetails) 
			{         
				//echo incidentListDetails[incident_id];
				$selected_incident = "";
				if($incidentListDetails[incident_id] == $incident_id && ($urlVariables[incident_id] || $urlVariables[work_performed_id]))
				{
					$selected_incident = "selected_incident";
				}

				if ($incidentListDetails['completed_date'] == '' 
					|| !isset($incidentListDetails['completed_date']) 
					|| $incidentListDetails['completed_date'] == '0000-00-00 00:00:00'  ) 
				{ 
					$status = "open"; 
					$completed_date = "<a href='/solutions/incident.php?complete_incident=yes&incident_id=$incidentListDetails[incident_id]'>Complete</a>";
				} else 
				{ 
					$status = "closed"; 
					$completed_date = $sqlTool->convertDate2String($incidentListDetails['completed_date']);
					//$completed_date = date('Y-m-d H:i:s',$incidentListDetails['completed_date']);
					$completed_date = "<a href='/solutions/incident.php?complete_incident=yes&incident_id=$incidentListDetails[incident_id]'>$completed_date</a>";
				}
				$class = "class='$status $selected_incident'";
				// print_r($incidentListDetails);
				// echo "<br />";
				$created_date = $sqlTool->convertDate2String($incidentListDetails[created_date]);
				echo '<tr '.$class.'>';
				echo "<td><a href='problem.php?problem_id=$incidentListDetails[problem_id]'>$incidentListDetails[problem_name]</a></td>";
				echo "<td><a href='incident.php?incident_id=$incidentListDetails[incident_id]&edit=update'> Edit - 
					  $incidentListDetails[incident_id]</a></td>
					  <td><a href='problem.php?incident_id=$incidentListDetails[incident_id]'>$created_date</a></td>";
				echo "<td>$completed_date</td>";
				echo "<td><a href='company.php?company_id=$incidentListDetails[company_id]'>$incidentListDetails[company_name]</a></td>";
				echo "<td><a href='contact.php?contact_id=$incidentListDetails[contact_id]'>$incidentListDetails[contact_name]</a></td>";
				//echo '<td style='width: $percent'><a href="employee.php?employee_id='. urlencode($incidentListDetails['employee_id']) .'">' . $incidentListDetails['employee_id'] . '</a></td>';

				echo "<td>";
				if($status == "open")
				{
					echo $incidentListDetails[status];
				}
				echo "</td>";
				echo "<td><a href='employee.php?employee_id=$incidentListDetails[employee_id]'>$incidentListDetails[employee_id]</a></td>";

				echo '</tr>';
				if($status == "open" && $incidentListDetails[follow_up])
				{
					echo "<tr>
							<td></td>
							<td colspan='6'>$incidentListDetails[follow_up]</td>
						  </tr>";
				}
			}
			echo '</tbody>
			</table>
			</div> <!-- tableContainer-->
		  </div>';
?>