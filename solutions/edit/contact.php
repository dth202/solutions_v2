<?php
if($_POST)
{
	require_once("../php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	include("php_scripts/url_variables.php");

	if($_POST[submit] == 'Submit Contact')
	{
		$submitContact = $sqlTool->insertContact($_POST);
		echo $submitContact;
	
		$contact_id = $sqlTool->getLatestContact_id();
	}
	else
	{
		$submitContact = $sqlTool->updateContact($_POST);
		//echo $submitContact;
		$contact_id = $_POST[contact_id];
	}
	
	
	$nextPage = "<script type='text/javascript'>window.location = '../contact.php?contact_id=$contact_id'</script>";
	echo $nextPage;


	
}
	
else
{
	echo "<form id='form1' style='margin-left: 15px;' name='form1' method='post' action='edit/contact.php'>
			<div class='ticket'>

				<div style='clear: both' class='half'>";
					if($urlVariables[edit] == 'insert')
					{						
						$companyDetails = $sqlTool->getCompanyDetails($urlVariables[company_id]);
						$submit = "Submit Contact";
						
					}
					else
					{
						$contactDetails = $sqlTool->getContactDetails($urlVariables[contact_id]);
						$companyDetails[id] = $contactDetails[company_id];
						$companyDetails[company_name] = $contactDetails[company_name];
						$submit = "Update Contact";
					}
				
					echo "<input type='hidden' name='company_id' id='company_id' value='$urlVariables[company_id]' />
						  <input type='hidden' name='contact_id' id='contact_id' value='$urlVariables[contact_id]' />
							<h2><a href='company.php?company_id=$companyDetails[id]'>$companyDetails[company_name]</a></h2>
					<div>
						<label>First name</label>
						<input name='fname' class='hours' type='text' value='$contactDetails[fname]' />
					  </div>
					<div>
						<label>Last Name</label>
						<input name='lname' class='drive_time' type='text' value='$contactDetails[lname]' />
					  </div>
					  <div>
						<label>Email</label>
						<input name='email_address_uid' class='milage' type='text' value='$contactDetails[email_address_uid]' />
					  </div>
					  <div>
						<label>Mobile Phone</label>
						<input name='mobile_phone' class='milage' type='text' value='$contactDetails[mobile_phone]' />
					  </div>
					  <div>
						<label>Home Phone</label>
						<input name='home_phone' class='milage' type='text' value='$contactDetails[home_phone]' />
					  </div>
					  <div>
						<label>Office Phone</label>
						<input name='office_phone' class='milage' type='text' value='$contactDetails[office_phone]' />
					  </div>
					  <input style='width:120px; margin: 0px 100px;' type='submit' name='submit' id='submit' value='$submit' />
					</div>
    
			  </div>
		</form>";
}

?>