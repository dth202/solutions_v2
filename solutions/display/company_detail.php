<?php


			$companyDetails = $sqlTool->getCompanyDetails($company_id);
			$companyAddress = $sqlTool->getCompanyAddress($company_id);

			$contact = $sqlTool->getCompanyContacts($company_id);
			$equipment = $sqlTool->getCompanyEquipment($company_id);
			$problem = $sqlTool->getCompanyProblem($company_id);

			echo "	<!-- Beginning of company.php -->
					<div >
						<h2 style='font-size:150%;'>$companyDetails[company_name] ($companyDetails[service_type])</h2>
						<a href='/solutions/company.php?edit=update&company_id=$companyDetails[id]'>edit</a>
					</div>";

			echo "	<div class='company_boxes half' style='width: 90%; '> 
						<div class='half'>";
							foreach($companyAddress as $index => $address) 
							{
								echo "	<div style='padding: 0px 0px 10px 10px;'>
											<p>$address[address1]</p><p>$address[city], $address[state] $address[zip]</p>
										</div>
										<a href='http://maps.google.com/maps/?q=$address[address1]+$address[city]+$address[state]'> Google Maps</a>";
							}
			echo "		</div>
						<div class='half'>
							<div style='padding: 0px 0px 10px 10px; width:50%; float:left;'>
								<p>$companyDetails[company_phone]</p>
							</div>
							<div style='padding: 0px 0px 10px 10px; width:50%; float:left;'>
								<p><a href='$companyDetails[website]' target='_new'>$companyDetails[website]</a></p>
							</div>
						</div>";
						echo $companyDetails[notes];
			echo "	</div>";
		// --------------------------------------------------------------------------------
			echo "	<div class='clearfloat'></div>";
			echo "<div class='company_boxes'>
						<div class='company_boxes_titles'>
							<h3 style='float: left;'>Equipment</h3><a style='margin: 5px 0px 0px 10px;' href='equipment.php?company_id=$companyDetails[id]&edit=insert'>Add</a>
						</div>
						<div class='company_sub_boxes'>
							<table>";
								foreach($equipment as $index => $equip) 
								{
									echo "	
											<tr>
												<td><a href= equipment.php?equipment_id=$equip[id]>$equip[device_name]</a></td>
												<td>$equip[model]</td>
											</tr>";
								}
			echo "			</table>
						</div>
					</div>";
			echo "		<div class='company_boxes'>
							<div class='company_boxes_titles'>
								<h3 style='float: left;'>Contact </h3>
								<a style='margin: 5px 0px 0px 10px;' href='contact.php?edit=insert&company_id=$companyDetails[id]'>Add</a>
							</div>";

						echo "<div class='company_sub_boxes'>
							<table>";
								foreach($contact as $index => $contactinfo) 
								{
									echo "	<tr>
												<th colspan=3>
													<a href='contact.php?contact_id=$contactinfo[id]'><strong style='float:left; padding-right:5px;'>$contactinfo[fname] $contactinfo[lname]</strong></a>
												</th>
											</tr>
											<tr>
												<td>$contactinfo[mobile_phone]</td>
												<td>$contactinfo[home_phone]</td>
												<td><a href='mailto:$contactinfo[email_address_uid]'>$contactinfo[email_address_uid]</a></td>
											<tr>
												<td colspan = '3'><hr /></td>
											</tr>";					
								}
			echo "			</table>
						</div>";
					echo "</div>";
					
					// --------------------------------------------
			
			echo "<!-- End of company.php -->";



















?>