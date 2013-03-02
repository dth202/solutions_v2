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
$filter = NULL;
$kbcompanies = $sqlTool->getKBCompanies();


//echo print_r($kbnotes);
?>

<div style="padding-left:10px;" id="top">
<?php
foreach($kbcompanies as $index => $note) 
{ echo '<a href="#'.$note[company_id].'">'.$note[CompanyName].'</a> | ';
}
foreach($kbcompanies as $index => $note) 
{
  echo '<div class ="shadow" style="margin: 5px; padding: 5px;">';
  echo '<h2 id="'.$note['company_id'].'"><a href="clients.php?companies_id='.$note['company_id'].'">'.$note['CompanyName'].'</a></h2>';
  
  $kbnotes = $sqlTool->getKBNotes('company_id', $note['company_id']);
  foreach($kbnotes as $index => $note) {
      if($note['KBN'])
      {
		    echo '<div style="margin-left: 20px;"><p><strong><a href="ticket.php?ticket_id='.$note['ticket_id'].'">'.$note['ticket_name'].'</a></strong></p>';
        echo '<div style="padding-left:10px;">'.$sqlTool->nl2br_limit($note['KBN'], 2).'</div><br></div>';
        //echo '<div><p><strong><a href="ticket.php?ticket_id='. urlencode($note['ticket_id']) .'">' .$note['ticket_name'].'</a></strong></p><div style="padding-left:10px;">'.$sqlTool->nl2br_limit($note['KBN'], 2).'</div><br></div>';
      }
  }
  echo '<a href="knowledge_base.php">Top</a>';
  echo '</div>';
}
?>
</div>

<script type="text/javascript">
function loadPage(page) {
	document.location = page;
}
</script>