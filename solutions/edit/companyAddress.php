<?php
	$companyAddress = $sqlTool->getCompanyAddress($urlVariables[company_id]);
	
	foreach($companyAddress as $key => $companyAddress_details) 
	{
		echo "  <input name='address_id[]' class='hours' type='hidden' value='$companyAddress_details[id]'/>
				<div style='clear: both' class='half'>
					<label>Address1</label>
					<input name='address1[]' class='hours' type='text' value='$companyAddress_details[address1]'/>
				<div>
					<label>address2</label>
					<input name='address2[]' class='hours' type='text' value='$companyAddress_details[address2]'/>
				</div>
				<div>
					<label>city</label>
					<input name='city[]' class='hours' type='text' value='$companyAddress_details[city]'/>
				</div>
				<div>
					<label>State</label>
					<input name='state[]' class='hours' type='text' value='$companyAddress_details[state]'/>
				</div>
				<div>
					<label>Zip</label>
					<input name='zip[]' class='hours' type='text' value='$companyAddress_details[zip]'/>
				</div>
				<div>
				<label>Address notes</label>
					<textarea name='address_notes[]' type='text'>$companyAddress_details[notes]</textarea>
				</div>";
	}
	
	echo "  <div id='InsertAddress' style='background-color:grey'>
				<h3>Insert New Address</h3><div style='clear: both' class='half'>
					<label>Address1</label>
					<input name='insertAddress1' class='hours' type='text' value=''/>
				<div>
					<label>address2</label>
					<input name='insertAddress2' class='hours' type='text' value=''/>
				</div>
				<div>
					<label>city</label>
					<input name='insertCity' class='hours' type='text' value=''/>
				</div>
				<div>
					<label>State</label>
					<input name='insertState' class='hours' type='text' value=''/>
				</div>
				<div>
					<label>Zip</label>
					<input name='insertZip' class='hours' type='text' value=''/>
				</div>
				<div>
				<label>notes</label>
					<textarea name='insertNotes' type='text'></textarea>
				</div>
			</div>";
?>