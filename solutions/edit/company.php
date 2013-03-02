<?php
	if($_POST)
	{
		require_once("../php_scripts/sql_tool.php");
		$sqlTool = new SqlTool();
		
		// print_r($_POST);
		// foreach ($_POST as $key => $value)
              // echo $key.': '.$value.'<br />';
		$company_id = "";
		
		if($_POST[submit] == "insert")
		{
			$submitCompany =  $sqlTool->insertCompany($_POST);
			$latestId =  $sqlTool->getLatestId();
			$company_id = $latestId[company_id];
			
			$nextPage = "<script type='text/javascript'>window.location = '/solutions/company.php?company_id=$latestId[company_id]'</script>";
		}
		else
		{
			$submitCompany =  $sqlTool->updateCompany($_POST);
			
			//Create Arrays
			$address_id_array = $_POST[address_id];
			$address1_array = $_POST[address1];
			$address2_array = $_POST[address2];
			$city_array = $_POST[city];
			$state_array = $_POST[state];
			$zip_array = $_POST[zip];
			$notes_array = $_POST[address_notes];
			
			for($i = 0; $i < count($address_id_array); $i += 1)
			{
				$companyAddressArray[address_id] = $address_id_array[$i];
				$companyAddressArray[address1] = $address1_array[$i];
				$companyAddressArray[address2] = $address2_array[$i];
				$companyAddressArray[city] = $city_array[$i];
				$companyAddressArray[state] = $state_array[$i];
				$companyAddressArray[zip] = $zip_array[$i];
				$companyAddressArray[notes] = $notes_array[$i];
							
				$submitCompanyAddress = $sqlTool->updateCompanyAddress($companyAddressArray);
			}
			
			$company_id = $_POST[company_id];
			$nextPage = "<script type='text/javascript'>window.location = '/solutions/company.php?company_id=$_POST[company_id]'</script>";
		}
		
		//if insert is not blank, insert new companyAddress
		//Insert Address
			if($_POST[insertAddress1] || 
			   $_POST[insertAddress2] || 
			   $_POST[insertCity] || 
			   $_POST[insertState] || 
			   $_POST[insertZip] || 
			   $_POST[insertNotes])
			{
				echo "Submit New Company Address";
				$submitCompanyAddress =  $sqlTool->insertCompanyAddress($_POST, $company_id);
			}
		
		// echo $submitCompany;
		//echo $submitCompanyAddress;
		echo $nextPage;
	}
	else
	{
		$submit = $urlVariables[edit];
		
		if($urlVariables[company_id])
		{
			$companyDetails = $sqlTool->getCompanyDetails($urlVariables[company_id]);
			// print_r($companyDetails);
		}
		echo "<input type='hidden' name='company_id' id='company_id' value='$urlVariables[company_id]' />
			<div style='clear: both' class='half'>
			  <label>Company</label>
			  <input name='company_name' class='hours' type='text' value='$companyDetails[company_name]'/>
			<div>
				<label>company_phone</label>
				<input name='company_phone' class='hours' type='text' value='$companyDetails[company_phone]'/>
			  </div>
			<div>
				<label>website</label>
				<input name='website' class='milage' type='text' value='$companyDetails[website]' />
			</div>
			<div>
				<label>notes</label>
				<textarea name='notes' class='milage' type='text'>$companyDetails[notes]</textarea>
			</div>
			<div>
				<label>service_type</label>";
			
		$selected[fullySupported] = "";
		$selected[partiallySupported] = "";
		$selected[hourly] = "";
		$selected[onCall] = "";
		
		switch($companyDetails[service_type])
		{
			case 'Fully Supported':
				$selected[fullySupported] = "selected";
				break;
			case "Partially Supported":
				$selected[partiallySupported] = "selected";
				break;
			case "Hourly":
				$selected[hourly] = "selected";
				break;
			case "On-Call":
				$selected[onCall] = "selected";
				break;
			default:
				echo "";
		}
		// print_r($selected);
		
			echo "<select name='service_type'>
				<option value=''>--Select Service Type--</option>
				<option $selected[fullySupported] value='Fully Supported'>Fully Supported</option>
				<option $selected[partiallySupported] value='Partially Supported'>Partially Supported</option>
				<option $selected[hourly] value='Hourly'>Hourly</option>
				<option $selected[onCall] value='On-Call'>On-Call</option>
			</select>
		</div>";
		
		include("companyAddress.php");
	}
?>