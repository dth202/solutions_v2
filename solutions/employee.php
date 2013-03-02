<?php
	require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	include("php_scripts/url_variables.php");

	if ($urlVariables['employee_id'] == '') {
		$urlVariables['employee_id'] = $_SESSION['user_name'];
	}

	$employeeDetails = $sqlTool->getEmployeeDetails($urlVariables['employee_id']);
	$employee_id = $employeeDetails['id'];
	$tickets = $sqlTool->getTechTickets($urlVariables['tech_id']);


	echo "	<div>
				<div>
					<h2 style='font-size:150%;'>$employeeDetails[fname] $employeeDetails[lname]</h2>
				</div>
				<div style='padding: 0px 0px 10px 10px; width:47%; float:left;'>
					<p>$employeeDetails[address]</p><p>$employeeDetails[city], $employeeDetails[state] $employeeDetails[zip]</p>
				</div>
				<div style='padding: 0px 0px 10px 10px; width:50%; float:left;'>
					<p>$employeeDetails[phone]</p><p>$employeeDetails[email_address]</p>
				</div>
			</div>
			<div class='clearfloat'></div>";
	//Validate if current user can change passwords
	if($employeeDetails[id] == $_SESSION[user_name] OR $_SESSION[user_type] == 'manager')
	{	
		//echo "<a href='#'>Change Password</a><br />";
		echo '<a href="javascript:toggle(\'password\')">Change Password</a><br />';
		echo "	<div class='company_boxes' id='password' name='password' style='display: none'>
					<div class='company_boxes_titles'>
						<h3>Password</h3>
					</div>
					<div class='company_sub_boxes'>
						<form enctype='multipart/form-data' action='/solutions/edit/change_password.php' method='post'>
							<input type='hidden' value='$employeeDetails[id]' name='employee_id' />
							<input type='hidden' value='$employeeDetails[email_address]' name='email_address' />
							<table>";
								echo "	<tr>
											<td colspan='4'><strong>Change Password</strong></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td style='text-align:right;'>New Password </td>
											<td style='text-align:left;'><input type='password' name='new password' style='width:120px; height 32px;' /></td>
											<td><input type='submit' name='submit' value='Change' style='width: 100px;' /></td>
										</tr>
										<tr>
											<td colspan='4'>&nbsp;</td>
										</tr>";

								if (strpos($_SERVER['REQUEST_URI'], 'changed=') < 0) 
								{ 
									$changedPass = ' style="display:none;"'; 
								}
								echo '  <tr'. $changedPass .'>';
											if ($urlVariables[changed] == "true") 
											{
												echo '	  <td colspan="4" style="text-align:center;"><strong>Password successfuly changed</strong></td>';
											} 
											else if ($urlVariables[changed] == "false")
											{
												echo '	  <td colspan="4" style="text-align:center;"><strong>Password NOT changed</strong></td>';
											} 
											else 
											{
												echo '	  <td colspan="4">&nbsp;</td>';
											}
								echo '  </tr>';
								
					echo "	</table>
						</form>
					</div><!-- end company_sub_boxes-->
				</div> <!--company_boxes-->";
	} // End Validation of password Change
	
	include("display/incident_list.php"); 
?>