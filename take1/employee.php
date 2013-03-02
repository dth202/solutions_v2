<?php
require_once("php_scripts/sql_tool.php");
$sqlTool = new SqlTool();

$urlVariables = explode("&", substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?') + 1));
$urlVariablestemp = explode("=", $urlVariables[0]);
$urlVariablestemp2 = explode("=", $urlVariables[1]);
$urlVariables = array();
$urlVariables[$urlVariablestemp[0]] = $urlVariablestemp[1];
$urlVariables[$urlVariablestemp2[0]] = $urlVariablestemp2[1];

if ($urlVariables['tech_id'] == '') {
	$urlVariables['tech_id'] = $_SESSION['user_name'];
}
$tickets = $sqlTool->getTechTickets($urlVariables['tech_id']);
$employeeDetails = $sqlTool->getEmployeeDetails($urlVariables['tech_id']);

echo '<div>';
echo '	<div><h2 style="font-size:150%;">'.$employeeDetails['first'].' '.$employeeDetails['last'].'</h2></div>';
echo '	<div style="padding: 0px 0px 10px 10px; width:47%; float:left;"><p>'.$employeeDetails['address'].'</p><p>'.$employeeDetails['city'].', '.$employeeDetails['state'].' '.$employeeDetails['zip'].'</p></div>';
echo '	<div style="padding: 0px 0px 10px 10px; width:50%; float:left;"><p>'.$employeeDetails['phone'].'</p><p>'.$employeeDetails['email_address'].'</p></div>';
echo '	<div class="clearfloat">';

echo '		<div class="company_boxes">';
echo '			<div class="company_boxes_titles"><h3>Message</h3></div>';
echo '			<div class="company_sub_boxes">';
foreach($contacts as $index => $contact) {
    echo '<div style="float:left; padding-right:25px;">';
    echo '<strong>' . $contact[1] . ' ' . $contact[2] .'</strong>';
    echo '<div>'. $contact[4] .'</div>';
    echo '<div>'. $contact[5] .'</div>';
    echo '<div>'. $contact[6] .'</div>';
    echo '<div>&nbsp;</div>';
    echo '</div>';
}
echo '			<image src="/images/imgs/slogan.jpg" /></div>';
echo '		</div>';
echo '		<div class="company_boxes">';
echo '			<div class="company_boxes_titles"><h3>Password</h3></div>';
echo '			<div class="company_sub_boxes">';

echo '<form enctype="multipart/form-data" action="php_scripts/change_password.php" method="post">';
echo '<input type="hidden" value="'.$urlVariables['tech_id'].'" name="tech_id" />';
echo '<input type="hidden" value="'.$employeeDetails['email_address'].'" name="email_address" />';
echo '<table>';
if ($urlVariables['tech_id'] == $_SESSION['user_name']) {
echo '  <tr>';
echo '	  <td colspan="4"><strong>Change Password</strong></td>';
echo '  </tr>';
echo '  <tr>';
echo '	  <td>&nbsp;</td>';
echo '	  <td style="text-align:right;">New Password </td>';
echo '	  <td style="text-align:left;"><input type="password" name="new password" style="width:120px; height 32px;" /></td>';
echo '	  <td><input type="submit" name="submit" value="Change" style="width: 100px;" /></td>';
echo '  </tr>';
echo '  <tr>';
echo '	  <td colspan="4">&nbsp;</td>';
echo '  </tr>';

if (strpos($_SERVER['REQUEST_URI'], 'changed=') < 0) { $changedPass = ' style="display:none;"'; }
echo '  <tr'. $changedPass .'>';
$change = explode("=", substr($_SERVER['REQUEST_URI'], "changed="));

if ($change[1] == true) {
echo '	  <td colspan="4" style="text-align:center;"><strong>Password successfuly changed</strong></td>';
} elseif (strpos($_SERVER['REQUEST_URI'], 'changed=') > 0) {
echo '	  <td colspan="4" style="text-align:center;"><strong>Password NOT changed</strong></td>';
} else {
echo '	  <td colspan="4">&nbsp;</td>';
}
echo '  </tr>';
} else {
echo '  <tr>';
echo '	  <td colspan="4"><strong>Login as '.$urlVariables['tech_id'].' to change your password</strong></td>';
echo '  </tr>';
}
echo '</table>';
echo '</form>';

echo '			</div>';
echo '		</div>';
echo '	</div>';

echo '	<div>';
echo '		<div class="company_boxes">';
echo '			<div class="company_boxes_titles"><h3 style="cursor:pointer;" onclick="loadPage(\'tickets.php?tech_id='.urlencode($urlVariables['tech_id']).'\')">Tickets</h3></div>';
echo '			<div class="company_sub_boxes">';
echo '<table>';
  
  include("i/display_tickets.php");
  
echo '</table>';
echo '			</div>';
echo '		</div>';
echo '		<div class="company_boxes">';
echo '			<div class="company_boxes_titles"><h3>Hours</h3></div>';
echo '			<div class="company_sub_boxes">';

if($urlVariables['tech_id'] == $_SESSION['user_name'])
echo 'Total: '.$sqlTool->getEmployeeHours($urlVariables['tech_id']);
else
echo '<strong>Login as '.$urlVariables['tech_id'].' to view your hours</strong>';

echo '			</div>';
echo '		</div>';
echo '	</div>';

echo '</div>';

?>
<script type="text/javascript">
function loadPage(page) {
	document.location = page;
}
</script>