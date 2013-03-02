<?php
	require_once("php scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	$contact_info = Array();
	$array = $sqlTool->getcontactinfo();
	foreach($array as $k => $v) {
		$tempArray = Array();
		foreach($v as $field => $value) {
			$tempArray[$field] = $value;
		}
		$contact_info[] = $tempArray;
	}
?>
<style type="text/css">
.item {
	padding:5px;
	width:32%;
	font-size:105%;
	float:left;
	color:black;
}
</style>
<table style="padding-left:15px;" width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>
  <td colspan="2"><h1 style="margin-bottom:0px;">Clients</h1></td>
</tr>
<tr>
  <td width="50%" align="center" style="vertical-align:middle;">
  	<?php
		if (strrpos($_SERVER['REQUEST_URI'], "company") > 0) {
			$companySelect = 'selected="selected"';
		} elseif (strrpos($_SERVER['REQUEST_URI'], "last") > 0) {
			$firstSelect = 'selected="selected"';
		} elseif (strrpos($_SERVER['REQUEST_URI'], "phone") > 0) {
			$phoneSelect = 'selected="selected"';
		}
		if (strrpos($_SERVER['REQUEST_URI'], "filter") > 0 or strrpos($_SERVER['REQUEST_URI'], "?") == false) {
			echo 'Sort By: ';
			echo '<select name="filter" onchange="changeFilter(this.value)">';
			echo '<option '.$companySelect.' value="company">Company</option>';
			echo '<option '.$firstSelect.'value="last">Main Contact</option>';
			echo '<option '.$phoneSelect.' value="phone">Phone</option>';
			echo '</select>';
		} else {
			echo '&nbsp;';
		}
	?>
  </td>
  <td width="50%">
    <img src="images/edit_button.png" alt="" onclick="editClients()" ondblclick="myPrinter()" style="float:right; padding-left:10px;" height="30px" />
  	<img src="images/all_clients_button.png" alt="" onclick="showAllClients()" style="float:right;" height="30px" />
  </td>
</tr>
<tr>
  <td colspan="2">
  	<div>
        <?php
			$url = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], "?") + 1);
			$arr = explode("=", $url);
			if (strrpos($_SERVER['REQUEST_URI'], "=") > 0 and strrpos($_SERVER['REQUEST_URI'], "?") > 0 and strrpos($_SERVER['REQUEST_URI'], "filter") > 0 or strrpos($_SERVER['REQUEST_URI'], "?") == false) {
				$filter = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], "="));
				$filter = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], "filter=") + 7);
				$filter = trim($filter, '&');
				if (strrpos($_SERVER['REQUEST_URI'], "filter=") == false) {
					$filter = 'company';
				}
				foreach($contact_info as $i => $row) {
					if ($row[$filter]) {
						if ($filter == "last") { $first = $row['first'] . " "; }
						echo '<div class="item"><a href="/system/clients.php?'.strtolower($filter).'=' . urlencode($row[$filter]) . '">' . $first . $row[$filter] . '</a></div>';
					}
				}
			} elseif ($arr[0] !== 'filter' and strrpos($_SERVER['REQUEST_URI'], "?")) {
				$multiple = false;
				foreach($contact_info as $i => $row) {
					$filtername = $arr[0];
					if ($row[$filtername] == urldecode($arr[1])) {
						if (!$multiple) {
							echo '<div style="padding:10px; padding-bottom:20px; height:130px;">';
							echo '<h2>'.$row['company'].'</h2>';
							if ($row['street_address']) {
								echo '<p style="padding-bottom:10px;">'. $row['street_address'] . ' ' . $row['city'] . ' ' . $row['zip'] . '</p>';
							}
							echo '<div style="padding-left:10px;"><h3>Contacts</h3>';
							$multiple = true;
						}
						$phone = $row['phone'];
						if ($phone == null) {
							$phone = $row['mobile_phone'];
						}
						echo '<p style="padding-left:20px; padding-top:10px;"><b>'.$row['first'].' '.$row['last'].'</b><br>'. $phone .'<br>'. $row['email_address'] .'</p>';
					}
				}
				echo '</div></div>';
			}
		?>
  	</div>
    <div style="clear:both;">&nbsp;</div>
  </td>
</tr>
</table>
<script type="text/javascript">

var url = window.location;


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