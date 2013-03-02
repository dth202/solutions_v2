<?php
	echo "<br />Incident Details for: $incidentDetails[incident_id]";
	
	// echo "<pre>";
		// print_r($incidentDetails);
	// echo "</pre>";
	
	$problem_id = $incidentDetails[problem_id];
	include("../display/problem_detail.php");
	
	
	
	//Validate that all times have been closed
	$validateWorkPerformedTimes = $sqlTool->validateWorkPerformedTimes($urlVariables['incident_id']);

	if($validateWorkPerformedTimes == 0)
	{
		$incidentEmployee = $sqlTool->getIncidentEmployees($urlVariables['incident_id']);
		
		// echo "<pre>";
			// print_r($incidentEmployee);
		// echo "</pre>";
		
		//Split up between employees
		foreach($incidentEmployee as $key => $incidentEmployeeDetails) 
		{ 
			$incident_summary_detail = $sqlTool->getIncidentEmployeeSummary($urlVariables[incident_id], $incidentEmployeeDetails[employee_id]);
			
			$employeeDetails = $sqlTool->getEmployeeDetails($incidentEmployeeDetails[employee_id]);
			
			// echo "<pre>";
				// print_r($employeeDetails);
			// echo "</pre>";
			
			$employeeSignature = $sqlTool->getEmployeeSignature($urlVariables['incident_id'],$incidentEmployeeDetails[employee_id]);
			
			echo "	<a href='employee.php?employee_id=$employeeDetails[id]'>
						<h4>$employeeDetails[fname] $employeeDetails[lname]</h4>
					</a>
					<div id='employeeDivider' name='employeeDivider' style='width: 75%px; margin-left: 10%'>";
					
					echo '<a href="javascript:toggle(\'details'.$employeeDetails[id].'\')">Show Details</a><br />';
					
					$work_performed =  $sqlTool->getIncidentWorkPerformed($urlVariables[incident_id],$incidentEmployeeDetails[employee_id]); 
					
					echo "<div id='details$employeeDetails[id]' name = 'details$employeeDetails[id]' style='display: none;'>";
					include("../display/work_performed.php"); 
					echo "</div>";
					
					if(COUNT($incident_summary_detail) > 0)
					{
						echo "	Work Time: $incident_summary_detail[work_time]
								<br />Travel Time: $incident_summary_detail[travel_time]
								<br />Milage: $incident_summary_detail[milage]
							";
					}
					else
					{
						echo "No time has been logged";
					}
					
					
					//Does the employee have a signature already?
					if(count($employeeSignature) == 0)
					{
						if($incidentEmployeeDetails[employee_id] == $_SESSION[user_name])
						{
							include("../edit/employee_signature.php");
							
						}
						else
						{
							echo "<p class='flag'>Needs to sign</p>";
						}
					}
					else
					{
						foreach($employeeSignature as $key => $employeeSignatureDetails) 
						{
							include("../display/employee_signature.php"); 
						}
					}
					echo "</div>"; //employeeDivider
		} // End foreach
		
		//Contact Signature
		$contactSignature = $sqlTool->getContactSignature($urlVariables['incident_id']);
		
		echo "<h3>Contact Signature</h3>";
		if(count($contactSignature) == 0)
		{
			include("../edit/contact_signature.php");
		}
		else
		{
			include("../display/contact_signature.php"); 
		}
	} // End Validation
	else
	{
		echo "The following still need to finish their work/Travel times:<br />";
		foreach($validateWorkPerformedTimes as $key => $validateWorkPerformedTimesDetails) 
		{	
			echo "<a href='/solutions/employee.php?employee_id=$validateWorkPerformedTimesDetails[employee_id]'>$validateWorkPerformedTimesDetails[employee_name]</a><br />";
		}
	}
	
	
	//Validate that all times have been closed
	/*
	$validateWorkPerformedTimes = $sqlTool->validateWorkPerformedTimes($urlVariables['incident_id']);
	
	if($validateWorkPerformedTimes == 0)
	{
		$contactSignature = $sqlTool->getContactSignature($urlVariables['incident_id']);
		$incidentEmployees = $sqlTool->getIncidentEmployees($urlVariables['incident_id']);
		
		echo "<h3>Contact Signature</h3>";
		if(count($contactSignature) == 0)
		{
			echo "	<form method='post' action='/solutions/edit/complete_incident.php' class='sigPad sigPadContactForm'>
						<input type='hidden' id='contact_id' name='contact_id' value='$incidentDetails[contact_id]'>
						<input type='hidden' id='incident_id' name='incident_id' value='$incidentDetails[incident_id]'>
						<label for='name'>Print your name</label>
						<input type='text' name='contact_name' id='contact_name' class='name'>
						<!--<p class='typeItDesc'>Review your signature</p>-->
						<p class='drawItDesc'>Draw your signature</p>
						<ul class='sigNav'>
							<!--<li class='typeIt'><a href='#type-it' class='current'>Type It</a></li>-->
							<li class='drawIt'><a href='#draw-it' >Draw It</a></li>
							<li class='clearButton'><a href='#clear'>Clear</a></li>
						</ul>
						<div class='sig sigWrapper'>
							<div class='typed'></div>
							<canvas class='pad' width='498' height='155'></canvas>
							<input type='hidden' name='output' class='output'>
						</div>
						<button type='submit'>I accept the terms of this agreement.</button>
					</form>

  
					  <script>
						var ContactOptions = {
							defaultAction : 'drawIt'
							, drawOnly : true
						};
						
						$(document).ready(function() {
						  $('.sigPadContactForm').signaturePad(ContactOptions);
						});
					  </script>";
		}
		else
		{
			// echo "<pre>";
				// print_r($contactSignature);
			// echo "</pre>";
			
			echo "<div class='sigPadContact signed'>
					  <div class='sigWrapper'>
						<!--<div class='typed'></div>-->
						<canvas class='pad' width='498' height='155'></canvas>
					  </div>
					  <p>$contactSignature[contact_name]<br>$contactSignature[created_date]</p>
					</div>

			<script>
				var sigContact =  $contactSignature[signature];
				
				$(document).ready(function () {
				  $('.sigPadContact').signaturePad({displayOnly:true}).regenerate(sigContact);
				});

			</script>";
			
			// //Display PNG ------------
			// $source = "../../solutions/php_scripts/sigtoimage/images/contact_$contactSignature[incident_id].png";
			// if(!file_exists($source))
			// {
				// require_once '../php_scripts/sigtoimage/signature-to-image.php';

				// $json = $contactSignature[signature];
				// $img = sigJsonToImage($json);
				// //echo $img;
				
				
				// //$source = "test";
				// imagepng($img, $source);
				// //imagepng($img, '../../solutions/php_scripts/sigtoimage/contact_signature.png');
				
				// header('Content-Type: image/png');
				// //echo "<img src='../../solutions/php_scripts/sigtoimage/contact_signature.png'>";
				// //imagepng($img);
				
				// imagedestroy($img);
			// }
			// echo "<img src='$source'>";
		}
		
		
		echo "<h3>Employee Signature</h3>";
		foreach($incidentEmployees as $key => $incidentEmployeesDetails) 
		{	
			$employeeSignature = $sqlTool->getEmployeeSignature($urlVariables['incident_id'],$incidentEmployeesDetails[employee_id]);
			
			include("../display/wp_summary.php");
			
			echo "<h4>$incidentEmployeesDetails[fname] $incidentEmployeesDetails[lname]</h4>";
			if(count($employeeSignature) == 0)
			{
				if($incidentEmployeesDetails[employee_id] == $_SESSION[user_name])
				{
					//include("../edit/employee_signature.php");
					
				}
				else
				{
					echo "<p>Needs to sign</p>";
				}
			}
			else
			{
				foreach($employeeSignature as $key => $employeeSignatureDetails) 
				{
					//include("../display/employee_signature.php"); 
				}
			}
		}
	} //End Validation
	else
	{
		// echo "<pre>";
			// print_r($validateWorkPerformedTimes);
		// echo "</pre>";
		echo "The following still need to finish their work/Travel times:<br />";
		foreach($validateWorkPerformedTimes as $key => $validateWorkPerformedTimesDetails) 
		{	
			echo "<a href='/solutions/employee.php?employee_id=$validateWorkPerformedTimesDetails[employee_id]'>$validateWorkPerformedTimesDetails[employee_name]</a><br />";
			
		}
		
	}
	*/
?>