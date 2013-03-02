



<?php //// select company box ////

$companyList = $sqlTool->getCompanyList();


echo "<hr />";
echo "<br />";
echo "<label> Select Company </label>";
							
//break from form to update select options
?>



<select id="company_id"
		 // name="company_id" 
		 // onchange="xmlhttpPost('php_scripts/form_info_loader.php?company_id='+this.options[this.selectedIndex].value+'&equipment=yes')"
		 // onblur="getIttems();">



<?php  //// Load company names into select field ////

echo "<option value''>-Select-</option>";
	foreach($companyList as $key => $companyDetails)
	{
		echo "<option 
			name='$companyDetails[id]' 
			id='$companyDetails[id]' 
			value='$companyDetails[id]'
			>$companyDetails[company_name]</option>";
	}
echo 	"</select>";

?>



<!-- Add update list button -->
<button type='button' onclick='updateList()'>Update List</button>
		


<?php  //// display kbn list /////	
$company_id = 18;		
$kbn = $sqlTool->getKBNList($company_id, $equipment_id);


echo "<br />";
echo "<br />";
echo "  (<a href='kbn.php?edit=insert'>new kbn</a>)";
if(count($kbn) > 0) //&& ($company_id || $equipment_id || $vendor_id))
{

	$kbn = $sqlTool->getKBNList($company_id, $equipment_id, $vendor_id);
			echo "  <table class='shadow'>
							<caption></caption>
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
								
								$description = $sqlTool->nl2br_limit($kbnDetails[description], 1);
								echo "  <tr>
											<td><a href='/solutions/kbn.php?kbn_id=$kbnDetails[id]'>$kbnDetails[kbn_name]</a></td>
											<td><a href='/solutions/company.php?company_id=$kbnDetails[company_id]'>$kbnDetails[company_name]</a></td>";
											if (empty($kbnDetails[description])){
													echo   "<td> (No Description available)</td>"; }
												else {
													echo   "<td>$kbnDetails[description] </td>"; }
								echo "  </tr>";
							}
				echo "		</tbody>
						</table><br />";




	}
?>





<?php  ////// Helpful code /////////////




// echo "<pre>"; 
// print_r($kbnDetails); 
// echo "</pre>"; 






?>