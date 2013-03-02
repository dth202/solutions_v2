<?php
	// echo "<pre>"; 
	// print_r(get_defined_vars()); 
	// echo "</pre>"; 
	
	//$company_id, $equipment_id, $vendor_id
	// $company_id = 24;
	// echo "$company_id, $equipment_id, $vendor_id";
	
	// echo "<pre>"; 
	// print_r($equipment_id); 
	// echo "</pre>"; 
	if ($kbn_id)
	{
		$kbnDetails = $sqlTool->getKBNdetails($kbn_id);
		
		echo "<h3><b>Title:</b> $kbnDetails[kbn_name]</h3>";

		// display "none" if there is no discription
		if (empty($kbnDetails[description])){
				echo "<h3><b>Description:</b> None <br /></h3>"; }
			else {
				echo "<h3><b>Description:</b> $kbnDetails[description] </h3>"; }
		
		echo "<br />";
		echo "<b>Company:</b> $kbnDetails[company_name]<br />";
		echo "<b>Equipment:</b> $kbnDetails[device_name] - $kbnDetails[model] <br />";
		if ($kbnDetails[make_global]==1) {
				echo "<b>Applies to Other/All Companies:</b> Yes <br />";}
			else { echo "<b>Applies to Other/All Companies:</b> No <br />";}
		echo "<b>Date Added:</b> $kbnDetails[date] <br />";
		echo "<br />";
		echo "<b>Details:</b> <br />";
		echo "<blockquote> $kbnDetails[details] </blockquote>";	
	
		
//			
			

	
	
	}
	else {
		$kbn = $sqlTool->getKBNList($company_id, $equipment_id, $vendor_id);
// 		 echo "<pre>"; 
// 		 print_r($kbn); 
// 		 echo "</pre>"; 
		
		if(count($kbn) > 0) //&& ($company_id || $equipment_id || $vendor_id))
		{
			echo "  <table class='shadow'>
						<caption>KBN</caption>
						<thead class='fixedHeader threecolumntable'>
							<tr>
								<th><a class='column_title' href='#'>KBN Title</a></th>
								<th><a class='column_title' href='#'>Company</a></th> 
								<th><a class='column_title' href='#'>Description</a></th>  
							</tr>
						</thead>
						<tbody class='scrollContent scrollContentKBN threecolumntable'>";
					
						foreach($kbn as $key => $kbnDetails) 
						{         
							// echo "<pre>"; 
							// print_r($kbnDetails); 
							// echo "</pre>"; 
							
// 							$details = $sqlTool->nl2br_limit($kbnDetails[details], 1);
							$description = $sqlTool->nl2br_limit($kbnDetails[description], 1);
							echo "  <tr>
										<td><a href='kbn.php?kbn_id=$kbnDetails[id]'>$kbnDetails[kbn_name]</a></td>
										<td><a href='company.php?company_id=$kbnDetails[company_id]'>$kbnDetails[company_name]</a></td>";
										if (empty($kbnDetails[description])){
												echo   "<td> (No Description available)</td>"; }
											else {
												echo   "<td>$kbnDetails[description] </td>"; }
							echo "  </tr>";
						}
			echo "		</tbody>
					</table>";
		}
		else
		{
			echo "<a href='#'>Add KBN</a>";
		}
	}
?>