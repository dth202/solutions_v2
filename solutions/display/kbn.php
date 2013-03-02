<?php

	//////////////////////////////////////////////////////////
	//  Display Specific KNB Article  if ID is defined      //
	//////////////////////////////////////////////////////////
	
	
	if ($kbn_id)
	{
		//Get KBN details
		$kbnDetails = $sqlTool->getKBNdetails($kbn_id);
		
		echo "Feel free to edit information as it becomes available";
		
		echo "<hr />";
		echo "<br>";
		
		
		// This is the form
		echo "
		 <form action='/solutions/kbn.php?kbn_id=$kbn_id&edit=update' method='post'>
				 <fieldset id='NoteInfo'>
					<legend>General&nbsp;&nbsp;</legend>
					<ul>
						<li>
							<!-- Title -->
							<label><b>Note Title:</b></label>
							<label>$kbnDetails[kbn_name] </label>
							<input id='kbn_id' type='hidden' name='kbn_id' value='$kbn_id'>
							
						</li>
						<li>
							<!-- Description -->
							<label><b>Note Description:</b></label>";
							if (empty($kbnDetails[description])){echo "<label> None</label>"; }// display "none" if there is no discription
								else {echo "<label> $kbnDetails[description]</label>"; }		
							echo "
						</li>
						<li>
							<!-- Tags -->
							<label><b>Tags </b>(separated by commas)<b>:</b></label>
							<label> $kbnDetails[tags]</label>
						</li>
						<li>
							<!-- Date Added -->
							<label><b>Date Created:</b> $DATEADDED</label>
							<label>$kbnDetails[date]</label>
						</li>
					</ul>
				</fieldset>
				<fieldset id='AppliesTo'>	
					<legend>Applies To&nbsp;&nbsp;</legend>
					<ul>	
						
						<li>
							<!-- Assigned Company -->
							<label><b>Company:</b></label>
							<label> $kbnDetails[company_name]</label>
						</li>
						<!--li-->
							<!-- Equipment -->
							<!--label><b>Assign to Equipment: </b></label-->
							<!--label> $kbnDetails[device_name]</label-->
						<!--/li-->
						<li>
							<!-- Global Checkmark -->
							<label><b>Make article global:</b></label>";
							if ($kbnDetails[make_global]==1) {echo "<label> Yes</label>";}
								else { echo "<label> No </label>";}
							echo "
						</li>
						<li>
							<!-- Software -->
							<label><b>Related Software </b>(separated by commas)<b>:</b> </label>
							<label>$kbnDetails[software]</label>
						</li>
					</ul>
				</fieldset>
				<fieldset id='NoteEntry'>
					<legend>Notes&nbsp;&nbsp;</legend>
					<ul>
						<li>
							<!-- Entry -->
							
							<blockquote>$kbnDetails[details]</blockquote>
						</li>
						<li>
							<input type='submit' value='Edit' />						
						</li>
					</ul>
				</fieldset>
			 </form>";
		
		
		
		// End of form
		
		
		//Display KBN List
		include("kbnList.php");
		
		

	
	
	}
	//If no KBN ID is selected then just display the KBN List
	else {
			include("kbnList.php");
		}

		

	
	
	
	///Helpful troubleshooting code
		
	// echo "<pre>"; 
	// print_r(get_defined_vars()); 
	// echo "</pre>"; 
	
	//$company_id, $equipment_id, $vendor_id
	// $company_id = 24;
	// echo "$company_id, $equipment_id, $vendor_id";
	
	// echo "<pre>"; 
	// print_r($equipment_id); 
	// echo "</pre>"; 
	
	// 		 echo "<pre>"; 
	// 		 print_r($kbn); 
	// 		 echo "</pre>"; 
	
?>