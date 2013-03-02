<script type="text/javascript">
  function xmlhttpPost(strURL)  {
	  var xmlHttpReq = false;
	  var self = this;
	  // Mozilla/Safari
	  if (window.XMLHttpRequest) 
	  {
		self.xmlHttpReq = new XMLHttpRequest();
	  }
	  // IE
	  else if (window.ActiveXObject) 
	  {
		self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  self.xmlHttpReq.open('POST', strURL, true);
	  self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	  self.xmlHttpReq.onreadystatechange = function() 
	  {
		if (self.xmlHttpReq.readyState == 4) 
		{
			  var array = self.xmlHttpReq.responseText.split('==');
			  //alert(array[0]);
			  //alert(array[1]);
			  updatePage(array);
		 }
	  }
	  self.xmlHttpReq.send(strURL);
	  
  }
  function getquerystring() {
  var form     = document.forms['f1'];
  var word = form.word.value;
  qstr = 'w=' + escape(word);  // NOTE: no '?' before querystring
  return qstr;
  }
  function updatePage(arr)  {
	  //document.getElementById("contactOption_id").innerHTML = arr[0];
	  document.getElementById("equipment_id[]").innerHTML = arr[1];
  }
 </script>
<?php

//Check if the form variables have set values
//if(isset($_POST[submit])){
	
		
		// echo "<pre>";
			// print_r($_POST);
		// echo "</pre>";



	//check if Form has information
	if(isset($_POST[submit]))
	{		
		// If it does:
		require_once("../php_scripts/sql_tool.php");
		$sqlTool = new SqlTool();	
		
		// Change equipment from Array to comma separated value in preparation for insert into database
		$_POST[equipment_id] = implode(', ', $_POST[equipment_id]);
		// $Array = explode(', ', $Not_Array);
		
		if($_POST[submit] == "Submit")
		{
			// Add Date to $_POST
			//$_POST[date] =date ('Y-m-d H:i:s');
			$MESSAGE = 'added!';
			$submitKBN = $sqlTool->insertKBN($_POST);
			$kbnDetails = $sqlTool->getLatestKBN();		
			$kbn_id = $kbnDetails[kbn_id];
			$nextPage = "<META HTTP-EQUIV='Refresh' Content='0; URL=/solutions/kbn.php?kbn_id=$kbn_id'>";		
			
	
		}
		else
		{	
			//  echo "<pre>";
// 			 print_r($_POST);
// 			 echo "</pre>";	

			
			require_once("../php_scripts/sql_tool.php");
			$sqlTool = new SqlTool();	
		
			// Change equipment from Array to comma separated value in preparation for insert into database
			$_POST[equipment_id] = implode(', ', $_POST[equipment_id]);
			// $Array = explode(', ', $Not_Array);	
			$MESSAGE = 'updated!';
			$kbn_id = $_POST[kbn_id];
			$submitKBN = $sqlTool->updateKBN($_POST);
			$kbn_id = $_POST[kbn_id];
			$nextPage = "<META HTTP-EQUIV='Refresh' Content='2; URL=/solutions/kbn.php?kbn_id=$kbn_id'>";
			
		}
		
		
		$submitKBN;
		// echo "<pre>";
// 			 print_r($_POST);
// 			 echo "</pre>";	
		echo "Your Entry to the knowledge Base has been $MESSAGE <hr />";
		echo "$nextPage";
		
		//display KBN info
		//include "../display/kbn.php";
			
		
	}
	//If it doesn't, then display the form:
	else
	{
		if($urlVariables[edit] == "insert")
		{
			$submit = "Submit";
			//$SubmitKBN = "insert"
			$GLOBAL = '';
			//$COMPANY = "-Select-"
			echo "Please Enter in your New Knowledge Base Article. Don't forget to check the Global option if This note can apply or help with other companies";
			$DATEADDED =date ('Y-m-d H:i:s');
			
		}
		else
		{
			$submit = "update KBN Article";
			//$SubmitKBN = "update";
			$kbn_id = $urlVariables[kbn_id];
			$KBNdetails = $sqlTool->getKBNDetails($kbn_id);
			if ($KBNdetails[make_global] == 1)
			{
			$GLOBAL = "checked";
			}
			
			
			//check to see if there is a creation date if not add today's date
			if(isset($kbnDetails[date]))
			{
				$DATEADDED = $kbnDetails[date];
			}
			else
			{
				$DATEADDED = date ('Y-m-d H:i:s');
			}
			
			//$COMPANY = $KBNdetails[company_name];
			
			echo "With great power comes great responsability. Don't mess things up or spiderman will come get you";
			// echo "<pre>";
// 			print_r($KBNdetails);
// 			echo "</pre>";
			
		}
		
		
		//If company id is already set then populate equipment list// 
// 		if ($urlVariables['kbn_id'])
// 			{
// 				
// 				echo "<body ";
// 				echo 'onload="xmlhttpPost';
// 				echo "('php_scripts/form_info_loader.php?company_id='+this.options[this.selectedIndex].value+'&equipment=yes')";
// 				echo '">';
// 										
// 			}
// 		
		
		
						
		// This is the form
		echo "<hr />";
		echo "<br>";
		echo "<form action='edit/kbn.php' method='post'>
				<fieldset id='NoteInfo'>
					<legend>Article Information &nbsp;&nbsp;</legend>
					<ul>
						<li>
							<!-- Title -->
							<label><b>Note Title:</b></label>
							<input id='kbn_name' type='text' name='kbn_name' value='$KBNdetails[kbn_name]'>
							<input id='kbn_id' type='hidden' name='kbn_id' value='$kbn_id'>
							
						</li>
						<li>
							<!-- Description -->
							<label id=><b>Note Description:</b></label>
							<input id='description_txt' type='text' name='description' value='$KBNdetails[description]'
>
						</li>
						<li>
							<!-- Tags -->
							<label><b>Tags </b>(separated by commas)<b>:</b></label>
							<input id='tags' type='select' name='tags' value='$KBNdetails[tags]'>
						</li>
						<li>
							<label><b>Date Created:</b> $DATEADDED</label>
							<input id='date' type='hidden' name='date' value='$DATEADDED'>
						</li>
					</ul>
				</fieldset>
				<fieldset id='AppliesTo'>	
					<legend>Who this Article applies to&nbsp;&nbsp;</legend>
					<ul>	
						
						<li>
							<!-- Assigned Company -->
							<label><b>Company:</b></label>";//$company_id";
							$companyList = $sqlTool->getCompanyList();
							//break from form to update select options
							 ?>
							  <select id="company_id"
									 // name="company_id" 
									 // onchange="xmlhttpPost('php_scripts/form_info_loader.php?company_id='+this.options[this.selectedIndex].value+'&equipment=yes')"
									 // onblur="getIttems();">

							<!-- Form Continued -->								
							<?php
							//'xmlhttpPost' switch with 'alert'
							 echo "<option value''>-Select-</option>";
							 
							 if($urlVariables['kbn_id']) 
								{
									$KBNDETAILS = $sqlTool->getKBNDetails($kbn_id);
									foreach($companyList as $key => $companyDetails)	
									{	
										//$KBNDETAILS = $sqlTool->getKBNDetails($kbn_id);
										if($companyDetails[id] == $KBNDETAILS[company_id])
										{
											echo "<option name='$companyDetails[id]' id='$companyDetails[id]' value='$companyDetails[id]' selected>$companyDetails[company_name]</option>";

										}
										else
										{
											echo "<option name='$companyDetails[id]' id='$companyDetails[id]' value='$companyDetails[id]'>$companyDetails[company_name]</option>";
										}
									}	
								}
								else
								{
									foreach($companyList as $key => $companyDetails)
									{
									echo "<option name='$companyDetails[id]' id='$companyDetails[id]' value='$companyDetails[id]'>$companyDetails[company_name]</option>";
									}
								}
								
								
								
								echo 	"</select>";
								
								
						echo "</li>
						<li>
							<!-- Global Checkmark -->
							<label><b>Make article global:</b></label>
							<input id='make_global' name='make_global' type='checkbox' value='1' $GLOBAL>
						</li>";
						// <li>						
// 							<!-- Equipment -->
// 							<label><b>Assign to Equipment: </b></label>
// 							if ($urlVariables['kbn_id'])
// 							{
// 								$KBNDETAILS = $sqlTool->getKBNDetails($kbn_id);
// 								$equipmentList = $sqlTool->getCompanyEquipmentList($KBNDETAILS[company_id]);
// 								
// 								echo "$KBNDETAILS[equipment_id]";
// 								
// 								echo "<select multiple id='equipment_id[]' name='equipment_id[]' >";
// 								foreach($equipmentList as $key => $equipmentDetails)
//  								{
//  									// $equipmentID = $equipmentDetails;
//  									if(in_array($equipmentDetails[id], $KBNDETAILS[equipment_id]))
// 									{
// 										echo "<option value='$equipmentDetails[id]' selected>$equipmentDetails[device_name]</option>";
// 									}
// 									else
// 									{
// 										echo "<option value='$equipmentDetails[id]'>$equipmentDetails[id], $equipmentDetails[device_name]</option>";
// 									}
//  								}
//  								echo "</select>";
// 							
// 							
// 								}
// 							else
// 							{
// 								echo "<select multiple id='equipment_id[]' name='equipment_id[]' >
// 									<option></option>
// 									</select>";
// 							}
// 						</li>
 							echo "
						
						<li>
							<!-- Software -->
							<label><b>Related Software </b>(separated by commas)<b>:</b> </label>
							<input id='software_txt' type='text' name='software' value='$KBNdetails[software]'>
						</li>
					</ul>
				</fieldset>
				<fieldset id='NoteEntry'>
					<legend>Please enter your notes below  &nbsp;&nbsp;</legend>
					<ul>
						<li>
							<!-- Entry -->
							<label><b>Details: </b></label>
							<textarea rows='15' id='details' name='details'>$KBNdetails[details]</textarea>
						</li>
						<li>
							<input type='submit' name='submit' id='submit' value='$submit' />";
							if($urlVariables[edit] == "insert")
							{
								echo "<input type='reset'>";
							}
						echo"</li>
					</ul>
				</fieldset>
			</form>";
		
			//Close the Body tag from above
			// if ($urlVariables['kbn_id'])
// 			{
// 				echo "</body>";
// 			}
		}
		
		// End of form
		
?>