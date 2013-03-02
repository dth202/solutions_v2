<?php
	$contactDetails = $sqlTool->getContactDetails($urlVariables[contact_id]);
	
	echo "<h2><a href='company.php?company_id=$contactDetails[company_id]'>$contactDetails[company_name]</a></h2>
			<h3>$contactDetails[fname] $contactDetails[lname]</h3><a href='contact.php?edit=update&contact_id=$urlVariables[contact_id]'> Edit</a>
			<table>
				<tr><td>email_address_uid</td><td>$contactDetails[email_address_uid]</td></tr>
				<tr><td>mobile_phone</td><td>$contactDetails[mobile_phone]</td></tr>
				<tr><td>home_phone</td><td>$contactDetails[home_phone]</td></tr>
				<tr><td>office_phone</td><td>$contactDetails[office_phone]</td></tr>
			</table>";

?>