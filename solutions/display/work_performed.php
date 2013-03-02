<?php

	
	
	//for kbn
	
	// echo "<pre>";
		// print_r($work_performed);
	// echo "</pre>";
	
	foreach($work_performed as $key => $details) 
	{	
		// echo "<pre>";
			// print_r($details);
		// echo "</pre>";
		$employeeSignature = $sqlTool->getEmployeeSignature($details[incident_id] ,$details[employee_id]);
		$contactSignature = $sqlTool->getContactSignature($details[incident_id]);
		
		unset($equipment_id);
		//If the employee created this trip...
		$employeeEdit = false;
		if ($_SESSION[user_name] == $details[employee_id] 
			&& COUNT($employeeSignature) == 0)
		{
			$employeeEdit = true;
			
			$travelDetails = array();
			
			$exists = $sqlTool->travelExists($details[work_performed_id]);
			if($exists == 1)
			{
				$travelDetails = $sqlTool->getTravelDetails($details[work_performed_id]);
			}
		}
		
		if($_SESSION[user_name] == $details[employee_id])
		{
			$currentEmployee = true;
		}
		else
		{
			$currentEmployee = false;
		}
		
		//if work_performed_id = this id, display edit details
		if($details[work_performed_id] == $work_performed_id)
		{
			
			echo "<form id='form1' name='form1' method='post' action='edit/add_ewp.php'>
				<table class='shadow' style='width: 100%; margin: 10px 0px;'>
					<tr>
						<td>
							<table>
								<caption id=$work_performed_id style='text-align: left;'>
									$details[employee_id]<br />";
									$date = $sqlTool->convertDate2String($details[date]);
									
									if ($employeeEdit){
										$total_time = $sqlTool->getWorkPerformedTotalTime($details[work_performed_id], $_SESSION[user_name]);
										echo "<a title='Edit Trip' href='problem.php?work_performed_id=$details[work_performed_id]#$details[work_performed_id]'>$date</a>
											<br />Work Hours: $total_time";
									}
									else
										echo "$date";

								echo "</caption> ";
								if($employeeEdit)
								{
									echo "<tr >
											<input type='hidden' name='work_performed_id' value='$details[work_performed_id]' />
											<input type='hidden' name='incident_id' value='$details[incident_id]' />
											<td colspan='3'>
												<div class='travel'>
													<div>
														<h4>Travel To</h4>
															<label>Depart Time</label><input id='travel[depart_time1]' name='travel[depart_time1]' value='$travelDetails[depart_time1]' />
															<input type='button' onclick=insertTime('travel[depart_time1]')  value='Insert Time'>
														<hr class='clearfloat'/>
														<label >Arrive Time</label>
															<input class='clearfloat' id='travel[arrive_time1]' name='travel[arrive_time1]' value='$travelDetails[arrive_time1]' />
															<input type='button' onclick=insertTime('travel[arrive_time1]') value='Insert Time'>
														<hr class='clearfloat'/>
														<label class='travel_label'>Depart Milage</label><input name='travel[depart_milage1]' value='$travelDetails[depart_milage1]' />
														<hr class='clearfloat'/>
														<label class='travel_label'>Arrive Milage</label><input name='travel[arrive_milage1]' value='$travelDetails[arrive_milage1]' />
													</div>
													<div>
														<h4>Travel From</h4>
														<label>Depart Time</label>
															<input id='travel[depart_time2]' name='travel[depart_time2]' value='$travelDetails[depart_time2]' />
															<input type='button' onclick=insertTime('travel[depart_time2]') value='Insert Time'>
														<hr class='clearfloat'/>
														<label>Arrive Time</label>
															<input id='travel[arrive_time2]' name='travel[arrive_time2]' value='$travelDetails[arrive_time2]' />
															<input type='button' onclick=insertTime('travel[arrive_time2]') value='Insert Time'>
														<hr class='clearfloat'/>
														<label>Depart Milage</label><input name='travel[depart_milage2]' value='$travelDetails[depart_milage2]' />
														<hr class='clearfloat'/>
														<label>Arrive Milage</label><input name='travel[arrive_milage2]' value='$travelDetails[arrive_milage2]' />
													</div>
												</div>
											</td>
										</tr>";
								}
								echo "
								<tr>       
									<th>Equipment<a href='work_performed.php?edit=insert&work_performed_id=$details[id]'></th>
									<th>Start Time</th>
									<th>End Time</th>
								</tr>
								<tr><td colspan='3'><hr /></td></tr>";
				  
								$equipment = $sqlTool->equipment_work_performed($details[work_performed_id]);      
								$i = 0;
								foreach($equipment as $key => $equipment_details) {   
									$work_performed_br = $sqlTool->nl2br_limit($equipment_details[work_performed]);
									
									//for kbn
									$equipment_id[] = $equipment_details[equipment_id];
									
									if ($employeeEdit && COUNT($contactSignature) == 0){
										echo "<tr>
												<td ><a href='equipment.php?equipment_id=$equipment_details[equipment_id]'>$equipment_details[device_name] - $equipment_details[model]</a></td>
												<input type='hidden' name='equipment_id[]' value='$equipment_details[equipment_id]' />
												<td>
													<input id='start_time[$i]' name='start_time[$i]' style='width: 100%;' value='$equipment_details[start_time]' />
													<input type='button' onclick=insertTime('start_time[$i]')  value='Insert Time'>
													
												</td>
												<td>
													<input id='end_time[$i]' name='end_time[$i]' style='width: 100%;' value='$equipment_details[end_time]' />
													<input type='button' onclick=insertTime('end_time[$i]')  value='Insert Time'>
												</td>
											  </tr>
											  <tr>
												<td colspan='3' style='padding-left: 50px;' ><textarea name='work_performed[]'>$equipment_details[work_performed]</textarea></td>
											  </tr>";
									}
									else 
									{
										echo "<tr>
											<td ><a href='equipment.php?equipment_id=$equipment_details[equipment_id]'>$equipment_details[device_name] - $equipment_details[model]</a></td>
											<td>$equipment_details[start_time]</td>
											<td>$equipment_details[end_time]</td>
										  </tr>
										  <tr>
											<td colspan='3' style='padding-left: 50px;' >$equipment_details[work_performed]</td>
										  </tr>";
									}
									$i++;
								}
								if ($employeeEdit && COUNT($contactSignature) == 0)
								{
									 include("../edit/add_ewp.php");
								}
							
								if ($employeeEdit)
								{
									echo "<tr><td><input type='submit' name='submit' value='Update' /></td></ tr>";
								}

								echo "
							</table>
						</td>
					</tr>
				</table>
			</form>";
		}
		
		//else display details
		else
		{
			echo "<table class='shadow' style='width: 100%; margin: 10px 0px;'>
					<tr>
						<td>
							<table>
								<caption style='text-align: left;'>
									$details[employee_id]<br />";
									$date = $sqlTool->convertDate2String($details[date]);
									
									if ($currentEmployee){
										$total_time = $sqlTool->getWorkPerformedTotalTime($details[work_performed_id], $_SESSION[user_name]);
										echo "<a title='Edit Trip' href='problem.php?work_performed_id=$details[work_performed_id]#$details[work_performed_id]'>$date</a>
											<br />Work Hours: $total_time";
									}
									else
										echo "$date";

								echo "</caption> ";
								if($currentEmployee)
								{
									$disabled = "yes";
									echo "<tr >
											<td colspan='3'>
												<div class='travel'>
													<div>
														<h4>Travel To</h4>
														<label>Depart Time</label>$travelDetails[depart_time1]
															<hr class='clearfloat'/>
														<label >Arrive Time</label>$travelDetails[arrive_time1]
														<hr class='clearfloat'/>
														<label class='travel_label'>Depart Milage</label>$travelDetails[depart_milage1]
														<hr class='clearfloat'/>
														<label class='travel_label'>Arrive Milage</label>$travelDetails[arrive_milage1]
													</div>
													<div>
														<h4>Travel From</h4>
														<label>Depart Time</label>$travelDetails[depart_time2]
														<hr class='clearfloat'/>
														<label>Arrive Time</label>$travelDetails[arrive_time2]
														<hr class='clearfloat'/>
														<label>Depart Milage</label>$travelDetails[depart_milage2]
														<hr class='clearfloat'/>
														<label>Arrive Milage</label>$travelDetails[arrive_milage2]
													</div>
												</div>
											</td>
										</tr>";
								}
								echo "
								<tr>       
									<th>Equipment<a href='work_performed.php?edit=insert&work_performed_id=$details[id]'></th>
									<th>Start Time</th>
									<th>End Time</th>
								</tr>
								<tr><td colspan='3'><hr /></td></tr>";
								
								$equipment = $sqlTool->equipment_work_performed($details[work_performed_id]);      
							
								foreach($equipment as $key => $equipment_details) 
								{   
								
									//for kbn
									$equipment_id[] = $equipment_details[equipment_id];
									
									$work_performed_br = $sqlTool->nl2br_limit($equipment_details[work_performed]);
									if ($currentEmployee){
										echo "<tr>
												<td ><a href='equipment.php?equipment_id=$equipment_details[equipment_id]'>$equipment_details[device_name] - $equipment_details[model]</a></td>
												<td>$equipment_details[start_time]</td>
												<td>$equipment_details[end_time]</td>
											  </tr>
											  <tr>
												<td colspan='3' style='padding-left: 50px;' >$equipment_details[work_performed]</td>
											  </tr>";
									}
									else {
										echo "<tr>
											<td ><a href='equipment.php?equipment_id=$equipment_details[equipment_id]'>$equipment_details[device_name] - $equipment_details[model]</a></td>
											<td>$equipment_details[start_time]</td>
											<td>$equipment_details[end_time]</td>
										  </tr>
										  <tr>
											<td colspan='3' style='padding-left: 50px;' >$equipment_details[work_performed]</td>
										  </tr>";
									}
								}
								
								echo "
							</table>
						</td>
					</tr>
				</table>";
				// if($urlVariables[complete_incident])
				// {
					// //Validate that all times have been closed
					// $validateWorkPerformedTimes = $sqlTool->validateWorkPerformedTimes($urlVariables['incident_id']);

					// if($validateWorkPerformedTimes == 0)
					// {
						
						// $employeeSignature = $sqlTool->getEmployeeSignature($urlVariables['incident_id'],$details[employee_id]);
						
						// $incidentEmployeesDetails = $sqlTool->getEmployeeDetails($details[employee_id]);
						
						// //Does the employee have a signature already?
						// if(count($employeeSignature) == 0)
						// {
							// if($employeeEdit)
							// {
								// include("../edit/employee_signature.php");
								
							// }
							// else
							// {
								// echo "<p>Needs to sign</p>";
							// }
						// }
						// else
						// {
							// foreach($employeeSignature as $key => $employeeSignatureDetails) 
							// {
								// include("../display/employee_signature.php"); 
							// }
						// }
						
						
					// }
					// //End Validation
					// else
					// {
						// echo "The following still need to finish their work/Travel times:<br />";
						// foreach($validateWorkPerformedTimes as $key => $validateWorkPerformedTimesDetails) 
						// {	
							// echo "<a href='/solutions/employee.php?employee_id=$validateWorkPerformedTimesDetails[employee_id]'>$validateWorkPerformedTimesDetails[employee_name]</a><br />";
						// }
					// }
				// }
				
		}
		//include("kbn.php"); 
	}
	if($urlVariables[work_performed_id])
	{
		//echo "<META HTTP-EQUIV='Refresh' Content='0; URL=#$urlVariables[work_performed_id]'>";
	
		echo "<script type='text/javascript'>document.work_performed_table.form1.insert_equipment_id.focus();</script>";
	}
	
?>
