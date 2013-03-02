<?php
    echo "<table class='shadow'>
            <caption >Problems</caption>
            <tr>
  	          <td> <a class='column_title' href='#'>Id</a>  -
              <a class='column_title' href='#'>Name</a></td>
			  <td><a class='column_title' href='#'>Company</td>
              <td><a class='column_title' href='#'>Created Date</a></td>
              <td><a class='column_title' href='#'>Category</a></td>    
              <td><a class='column_title' href='#'>Technician</a></td>
              <td><a class='column_title' href='#'>Status</a></td>
            </tr>";
    $problemList = $sqlTool->getProblemList($company_id);
    
    foreach($problemList as $key => $problemDetails) 
	{	
		$incident_id = $sqlTool->getLatestIncidentId_fromProblem($problemDetails[id]);
		$company = $sqlTool->getIncidentCompany($incident_id);

		// echo "<tr><td>$incident_id</td>
				  // <td>"; 
		// print_r($company); 
		// echo "</td></tr>";

		$date = $sqlTool->convertDate2String($problemDetails[created_date]);
		if ($problemDetails[status] == "Open"){
				$statusColor = 'class="open"'; 
				$problem_status = 'Open';
			} else { 
				$statusColor = 'class="closed"'; 
				$problem_status = 'Closed';
			}
		echo "<tr>
			<td><a href='problem.php?problem_id=$problemDetails[id]'>$problemDetails[id]  -
			$problemDetails[problem_name]</a></td>
			<td><a href='company.php?company_id=$company[company_id]'>$company[company_name]</a></td>
			<td>$date</td>
			<td>$problemDetails[category]</td>
				<td><a href='employee.php?employee_id=$problemDetails[employee_id]'> $problemDetails[employee_id]</a></td>
			<td $statusColor>$problemDetails[status]</td>
			  </tr>";
    }
    echo "</table>";
?>