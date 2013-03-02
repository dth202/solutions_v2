<?php
	require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	include("php_scripts/url_variables.php");
	
	if($urlVariables[edit])
	{
		echo "<form id='form1' style='margin-left: 15px;' name='form1' method='post' action='/solutions/edit/company.php'>";
		include("edit/company.php");
		echo "<input style='width:140px; margin: 0px 100px;' type='submit' name='submit' id='submit' value='$submit' />";
	}
	else
	{
		if(!$urlVariables[company_id])
		{
			$list_o_companies = $sqlTool->getCompanyIds();
			$companyList =  $sqlTool->getCompany();
			
			foreach($companyList  as $key => $company_id) 
			{
				//$companyDetails = $sqlTool->getCompanyDetails($company_id);
				echo "<tr>
						<td><a style='font-size:110%;' href='company.php?company_id=$company_id[id]'> $company_id[company_name] </a></td>
						<td>$company_id[city]</td>
						<td>$company_id[company_phone]</td>
					  </tr>";
			}
		}
		else
		{	
			$company_id = $urlVariables[company_id];

			

			include("display/company_detail.php");
			include("display/incident_list.php"); 
			include("display/kbn.php"); 
		}
	}
?>