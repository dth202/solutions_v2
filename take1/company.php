<?php
	require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	$list_o_companies = $sqlTool->getCompanyIds();
	$companyList =  $sqlTool-> getCompany();
	$list = false;
	if (strrpos($_SERVER['REQUEST_URI'], "filter") > 0 or strrpos($_SERVER['REQUEST_URI'], "?") == false) {
		$list = true;
	}
?>
<!--
<div style="border-bottom:1px white solid; text-align:center; font-size:120%; font-weight:bold; padding-bottom:10px; <?php if (!$list) { echo 'display:none;'; } ?>">
	<a style="color:black;" href="clients.php?filter=company">Company</a> |
    <a style="color:black;" href="clients.php?filter=office_phone">Phone</a> |
    <a style="color:black;" href="clients.php?filter=street_address">Location</a>
    -->
</div>
<div style="padding-left:15px; padding-top:10px;">
  <?php
	if ($list) {
		$filter = null;
		$filter = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], "filter=") + 7);
		$filter = trim($filter, '&');
		$filterValue = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], "?") + 1);
		$filterANDvalue = explode("=", $filterValue);
		$filterValue = $filterANDvalue[1];
		if (strrpos($_SERVER['REQUEST_URI'], "filter=") == false) {
			$filter = 'company';
		}
		if ($filter == 'company') {
			  echo '<table class="twothirds">';
			    echo '<tr>';
				    echo '<th><a class="column_title" href="#">Company</a></th>';
				    echo '<th><a class="column_title" href="#">City</a></th>';
				    echo '<th><a class="column_title" href="#">Office Phone</a></th>';
			    echo '</tr>';
      
          foreach($companyList  as $key => $company_id) {
            //$companyDetails = $sqlTool->getCompanyDetails($company_id);
				      echo '<tr>';
					      echo '<td><a style="font-size:110%;" href="company.php?company_id='.$company_id[id].'">' . $company_id[company_name] . '</a></td>';
					      echo '<td>'.$company_id[city].'</td>';
					      echo '<td>'.$company_id[office_phone].'</td>';
				      echo '</tr>';
             }
      echo '</table>';
		} else {
			$items = $sqlTool->getCompanyListByFilterValue($filter);
			foreach($items as $i => $item) {
				echo '<div style="padding:10px; float:left; width:30%;"><a style="font-size:110%;" href="clients.php?'. $filter .'='. urlencode($item) .'">' . $item . '</a></div>';
			}
		}	
	} else {
		$url = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], "?") + 1);
		$url = explode("=", $url);
		$type = $url[0];
		$term = urldecode($url[1]);
		$company_id = urldecode($url[1]);

		//$companyDetails = $sqlTool->getCompanyDetails($type, $term);
		$companyDetails = $sqlTool->getCompanyDetails($term);
		$companyAddress = $sqlTool->getCompanyAddress($term);
		
		$contact = $sqlTool->getCompanyContacts($company_id);
		$equipment = $sqlTool->getCompanyEquipment($company_id);
		$problem = $sqlTool->getCompanyProblem($company_id);
     
		echo '<div>';
		echo '	<div ><h2 style="font-size:150%;">'.$companyDetails[company_name].'</h2><a href="new_company.php?company_id='.$companyDetails['id'].'">edit</a></div>';
		
		echo '<div class="company_boxes" style="width: 90%; "> <div class="half">';
			foreach($companyAddress as $index => $address) {
				echo '	<div style="padding: 0px 0px 10px 10px;"><p>'.$address[address1].'</p><p>'.$address['city'].', '.$address['state'].' '.$address['zip'].'</p></div>';
			}
			echo '</div>';
			echo '<div class="half">';
			echo '	<div style="padding: 0px 0px 10px 10px; width:50%; float:left;"><p>'.$companyDetails['office_phone'].'</p></div>';
				echo '	<div style="padding: 0px 0px 10px 10px; width:50%; float:left;"><p><a href="'.$companyDetails['website'].'" target="_new">'.$companyDetails['website'].'</a></p></div>';
			echo '</div>';
		echo '</div>';
    
		
		echo '	<div class="clearfloat">';
		
		echo '		<div class="company_boxes">';
		echo '			<div class="company_boxes_titles"><h3 style="float: left;">Contact </h3><a style="margin: 5px 0px 0px 10px;" href="new_contact.php?company='.$companyDetails['companies_id'].'">Add</a></div>';
		
		echo '			<div class="company_sub_boxes">';
		echo '<table>';
			foreach($contact as $index => $contactinfo) {
				
				echo '<th colspan=3>';
				echo '<strong style="float:left; padding-right:5px;">' . $contactinfo[fname] . ' ' . $contactinfo[lname] .'</strong></th>';
				echo '<tr>';
				echo '<td>'. $contactinfo[mobile_phone] .'</td>';
				echo '<td>'. $contactinfo[home_phone] .'</td>';
				echo '<td><a href="mailto:'.$contactinfo[email_address_uid].'">'. $contactinfo[email_address_uid] .'</a></td>';
				echo '<tr><td colspan = "3"><hr /></td></tr>';
				echo '</tr>';
				
			}
		echo '</table>';
		echo '			</div>';
		echo '		</div>';
		echo '		<div class="company_boxes">';
		echo '			<div class="company_boxes_titles"><h3 style="float: left;">Equipment</h3><a style="margin: 5px 0px 0px 10px;" href="new_equipment.php?company='.$companyDetails['companies_id'].'">Add</a></div>';
		echo '			<div class="company_sub_boxes">';
		echo '<table>';
		foreach($equipment as $index => $equip) {
			echo '<tr>';
			echo '	<td>';
			echo		'<a href= equipment.php?equipment_id='.$equip['id'].'>'.$equip['device_name'].'</a>';
			echo '	</td>';
			echo '	<td>';
			echo		$equip['model'];
			echo '	</td>';
			echo '</tr>';
		}
		echo '</table>';
		echo '			</div>';
		echo '		</div>';
		echo '	</div>';
		
		
		
		include("display/problem_list.php"); 

		/*
		echo '<table>';
				
		foreach($problem as $index => $problemDetail) {
			
			if ($problemDetail['completed_date'] == '0000-00-00 00:00:00' || !isset($problemDetail['completed_date'])) { 
				$statusColor = 'class="open"'; 
				$problem_status = 'Open';
			} else { 
				$statusColor = 'class="closed"'; 
				$problem_status = 'Closed';
			}
			
			echo '<tr>';
			
			echo '	<td><a href="problem.php?problem_id='.$problemDetail['problem_id'].'">';
			if(!$problemDetail['problem_name'])
				echo $problemDetail['problem_id'].'</a></td>';
			else
				echo $problemDetail['problem_name'].'</a></td>';

			echo '	<td>'.$sqlTool->convertDate2String($problemDetail['created_date']).'</td>';
			echo '	<td '.$statusColor.'>';
			echo		$problem_status;
			echo '	</td>';
			echo '	<td><a href="employee.php?tech_id='. urlencode($problemDetail['employee_id']) .'">' . $problemDetail['employee_id'] . '</a></td>';
			echo '</tr>';
		}
		echo '</table>';
		*/

		
		/*
		echo '		<div class="company_boxes">';
		echo '			<div class="company_boxes_titles"><h3>Notes</h3></div>';
		echo '			<div class="company_sub_boxes">&nbsp;</div>';
		echo '		</div>';
		*/
		echo '	</div>';
		
		echo '</div>';
	}
?>
</div>
<script type="text/javascript">

  var url = window.location;

  function loadPage(page) {
  document.location = page;
  }

  function changeFilter(value) {
  //alert(value);
  window.location = 'clients.php?filter='+value;

  }

  function showAllClients() {
  window.location = 'clients.php';
  }

  function editClients() {
  window.location = 'clients.php?edit=true';
  }

  function myPrinter() {
  if (window.print()) {
  window.print
  } else {
  alert("Your browser does not support automatic printing. Please select \"Print\" from the file menu");
  }
  }
</script>