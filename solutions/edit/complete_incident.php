<?php
	if($_POST)
	{
		require_once("../php_scripts/sql_tool.php");
		$sqlTool = new SqlTool();
		include("php_scripts/url_variables.php");
		
		// echo "<pre>";
				// print_r($_POST);
			// echo "</pre>";
		
		$output = filter_input(INPUT_POST, 'output', FILTER_UNSAFE_RAW);
		if (!json_decode($output)) {
		  $errors['output'] = true;
		}
		if(!$errors['output'])
		{
			$submit[sig_hash] = sha1($output);
			$submit[created_date] = time();
			$submit[ip] = $_SERVER['REMOTE_ADDR'];
			$submit[incident_id] = $_POST[incident_id];
			$submit[signature] = $output;
			
			if($_POST[employee_id])
			{
				$submit[employee_id] = $_POST[employee_id];
				$employeeSignatureCount = count($sqlTool->getEmployeeSignature($_POST[incident_id],$_SESSION[user_name]));
				
				if($employeeSignatureCount == 0)
				{
					$submitArray = $sqlTool->insertEmployeeSignature($submit);
				}
			}
			else
			{
				$submit[contact_name] = $_POST[contact_name];
				$submit[contact_id] = $_POST[contact_id];
				$contactSignatureCount = count($sqlTool->getContactSignature($_POST['incident_id']));
				if($contactSignatureCount == 0)
				{
					$submitArray = $sqlTool->insertContactSignature($submit);
				}
			}
			
			
			// echo "<pre>";
				// print_r($submit);
			// echo "</pre>";
			
			echo $submitArray;
			
			// $test = $sqlTool->getEmployeeSignature($_POST[incident_id]);
			// echo $test;
			$contactSignatureCount = count($sqlTool->getContactSignature($_POST[incident_id]));
			$employeeSignatureCount = count($sqlTool->getEmployeeSignature($_POST[incident_id]));
			$incidentEmployeesCount = count($sqlTool->getIncidentEmployees($_POST[incident_id]));
			
			// echo "Concact Signatures: $contactSignatureCount
					// <br />Employee Signatures: $employeeSignatureCount
					// <br />incident Employee: $incidentEmployeesCount";
			if($employeeSignatureCount == $incidentEmployeesCount 
				&& $contactSignatureCount > 0)
			{
				echo $sqlTool->completeIncident($_POST[incident_id]);
			}
			$nextPage = "<script type='text/javascript'>window.location = '/solutions/incident.php?complete_incident=yes&incident_id=$_POST[incident_id]'</script>";
			
			echo $nextPage;
		}
		else
		{
			echo "Error with the signature";
		}
	}
	else
	{
		//Show Incident Details
		$incidentDetails = $sqlTool->getIncidentDetails($urlVariables['incident_id']);
		
		include ("../display/incident_summary.php");
		
		
	}
?>
<script src="/solutions/php_scripts/signature/build/jquery.signaturepad.min.js"></script>
<script src="../build/json2.min.js"></script>
