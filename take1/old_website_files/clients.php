<?php
	require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	$list_o_companies = $sqlTool->getCompanyIds();
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
			foreach($list_o_companies as $i => $companyId) {
				//echo '<div style="padding:10px; float:left; width:30%;"><a style="font-size:110%;" href="clients.php?'. $filter .'='. urlencode($companyName) .'">' . $companyName . '</a></div>';
				$companyDetails = $sqlTool->getCompanyDetails_ById($companyId);
				//echo '<div style="padding:10px; float:left; width:30%;"><a style="font-size:110%;" href="clients.php?companies_id='.$companyId.'">' . $companyDetails[name] . '</a></div>';
				echo '<tr>';
					echo '<td><a style="font-size:110%;" href="clients.php?companies_id='.$companyId.'">' . $companyDetails[name] . '</a></td>';
					echo '<td>'.$companyDetails[city].'</td>';
					echo '<td>'.$companyDetails[office_phone].'</td>';
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
		//$companyDetails = $sqlTool->getCompanyDetails($type, $term);
		$companyDetails = $sqlTool->getCompanyDetails_ById($term);
		
		$contacts = $sqlTool->getCompanyContactsByID($companyDetails['companies_id']);
		$equipment = $sqlTool->getCompanyEquipment($companyDetails['name']);
		$tickets = $sqlTool->getCompanyTickets($companyDetails['name']);

		echo '<div>';
		echo '	<div><h2 style="font-size:150%;">'.$companyDetails['name'].'</h2><a href="new_company.php?companies_id='.$companyDetails['companies_id'].'">edit</a></div>';
		echo '	<div style="padding: 0px 0px 10px 10px; width:47%; float:left;"><p>'.$companyDetails['street_address'].'</p><p>'.$companyDetails['city'].', '.$companyDetails['state'].' '.$companyDetails['zip'].'</p></div>';
		echo '	<div style="padding: 0px 0px 10px 10px; width:50%; float:left;"><p>'.$companyDetails['office_phone'].'</p></div>';
		echo '	<div style="padding: 0px 0px 10px 10px; width:50%; float:left;"><p><a href="'.$companyDetails['website'].'" target="_new">'.$companyDetails['website'].'</a></p></div>';
		echo '	<div class="clearfloat">';
		
		echo '		<div class="company_boxes">';
		echo '			<div class="company_boxes_titles"><h3 style="float: left;">Contacts </h3><a style="margin: 5px 0px 0px 10px;" href="new_contact.php?company='.$companyDetails['companies_id'].'">Add</a></div>';
		
		echo '			<div class="company_sub_boxes">';
		echo '<table>';
			foreach($contacts as $index => $contact) {
				echo '<th colspan=3>';
				echo '<strong style="float:left; padding-right:5px;">' . $contact[1] . ' ' . $contact[2] .'</strong></th>';
				echo '<tr>';
				echo '<td>'. $contact[4] .'</td>';
				echo '<td>'. $contact[5] .'</td>';
				echo '<td><a href="mailto:'.$contact[6].'">'. $contact[6] .'</a></td>';
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
			echo		'<a href= equipment.php?equipment_id='.$equip['failed_equipment_id'].'>'.$equip['pc_name'].'</a>';
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
		
		echo '	<div>';
		echo '		<div class="company_boxes">';
		echo '			<div class="company_boxes_titles"><h3 style="cursor:pointer;" onclick="loadPage(\'tickets.php?company='.urlencode($companyDetails['name']).'\')">Tickets</h3></div>';
		echo '			<div class="company_sub_boxes">';
		echo '<table>';
		foreach($tickets as $index => $ticket) {
			if ($ticket['status'] == 'Open') { 
				$statusColor = 'class="open"'; 
			} else { 
				$statusColor = 'class="closed"'; 
			}
			echo '<tr>';
			
			/*
			if($ticket['case'])
				echo '	<td><a href="tickets.php?case='.$ticket['case'].'">'.(float)$ticket['case'].'</a></td>';
			else
				echo '	<td><a href="tickets.php?case='.$ticket['case'].'">'.$ticket['case'].'</a></td>';
			*/
			echo '	<td><a href="ticket.php?ticket_id='.$ticket['ticket_id'].'">'.$ticket['ticket_id'].' - ';
			if(!$ticket['ticket_name'])
				echo $ticket['ticket_id'].'</a></td>';
			else
				echo $ticket['ticket_name'].'</a></td>';
			echo '	<td>'.$sqlTool->convertDate2String($ticket['date']).'</td>';
			echo '	<td '.$statusColor.'>';
			echo		$ticket['status'];
			echo '	</td>';
			echo '	<td><a href="employee.php?tech_id='. urlencode($ticket['tech']) .'">' . $ticket['tech'] . '</a></td>';
			echo '</tr>';
		}
		echo '</table>';
		echo '			</div>';
		echo '		</div>';
		echo '		<div class="company_boxes">';
		echo '			<div class="company_boxes_titles"><h3>Notes</h3></div>';
		echo '			<div class="company_sub_boxes">&nbsp;</div>';
		echo '		</div>';
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