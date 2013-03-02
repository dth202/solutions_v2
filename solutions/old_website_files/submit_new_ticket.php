<?php
//echo print_r($_POST);
//Connect to mysql

require_once("php_scripts/sql_tool.php");
$sqlTool = new SqlTool();

$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
$username='513061_intuitiv3';
$password='9teen6T9';
$dbname = '513061_intuitive_test_db';
			
$con = mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
mysql_select_db($dbname, $con);

$url = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], "?") + 1);
$url = explode("=", $url);
$type = $url[0];

$term = $_POST[company]; // urldecode($url[1]);
$companyDetails = $sqlTool->getCompanyDetails($type, $term);
$equipmentInfo =  $sqlTool->getEquipmentInfo($_POST[equipment_id]);
//$equipmentInfo = $equipmentInfo[0];
$equipmentNameModel = $equipmentInfo[pc_name].' - '.$equipmentInfo[model];
$contactChoice = $_POST[contactOption_id];

$contactDetails = $sqlTool->getContactInfoById($contactChoice);
$contactName = $contactDetails[first].' '.$contactDetails[last];

/*
echo "<h2>This is the post</h2><hr />";
echo "<table>";
foreach($_POST as $key => $value)
  {
      echo "<tr><td><em>".$key."</em>: </td><td>".$value."</td></tr>";
  }
echo "<tr><td><em>Tech</em>: </td><td>".$_SESSION['user_name']."</td></tr>";

foreach($equipmentInfo as $key => $value)
  {
      echo "<tr><td><em>".$key."</em>: </td><td>".$value."</td></tr>";
  }

echo "</table>";
*/
if($_POST[ticket_id])
{
  $ticket_page = '<script type="text/javascript">window.location = "ticket.php?ticket_id='.$_POST[ticket_id].'";</script>';
  echo 'Update';
  $date = date("Y-m-d");
  $sql = "UPDATE tickets
          SET ticket_name='$_POST[ticket_name]',
              status='$_POST[status]',
              company_id='$companyDetails[companies_id]',
              company='$_POST[company]',
              contactOption_id='$_POST[contactOption_id]',
              contactOption='$contactName',
              date='$_POST[date]',
              equipment_id='$_POST[equipment_id]',
              equipment='$equipmentNameModel',
              problem_description='$_POST[problem_description]',
              work_preformed='$_POST[work_preformed]',
              needs='$_POST[needs]',
              knowledge_base='$_POST[knowledge_base]',
              hours='$_POST[hours]',
              milage='$_POST[milage]',
              drive_time='$_POST[drive_time]',
              update_tech='$_SESSION[user_name]',
              update_date='$date'
          WHERE ticket_id='$_POST[ticket_id]'";
          
    if($_POST[tech] == "ITS-R")
      $sql = "UPDATE tickets
          SET ticket_name='$_POST[ticket_name]',
              status='$_POST[status]',
              tech='$_SESSION[user_name]',
              company_id='$companyDetails[companies_id]',
              company='$_POST[company]',
              contactOption_id='$_POST[contactOption_id]',
              contactOption='$contactName',
              date='$_POST[date]',
              equipment_id='$_POST[equipment_id]',
              equipment='$equipmentNameModel',
              problem_description='$_POST[problem_description]',
              work_preformed='$_POST[work_preformed]',
              needs='$_POST[needs]',
              knowledge_base='$_POST[knowledge_base]',
              hours='$_POST[hours]',
              milage='$_POST[milage]',
              drive_time='$_POST[drive_time]',
              update_tech='$_SESSION[user_name]',
              update_date='$date'
          WHERE ticket_id='$_POST[ticket_id]'";
          
          echo "1 record edited";
}
else
{
    $ticket_page = '<script type="text/javascript">window.location = "tickets.php";</script>';
    $sql = "INSERT INTO tickets 
        (ticket_name, 
        status, 
        tech, 
        company_id, 
        company, 
        contactOption_id, 
        contactOption,
        date, 
        equipment_id,
        equipment,
        problem_description, 
        work_preformed, 
        needs,
        knowledge_base, 
        hours, 
        milage, 
        drive_time)
    VALUES 
        ('$_POST[ticket_name]', 
        '$_POST[status]', 
        '$_SESSION[user_name]', 
        '$companyDetails[companies_id]', 
        '$_POST[company]', 
        '$_POST[contactOption_id]', 
        '$contactName',
        '$_POST[date]', 
        '$_POST[equipment_id]', 
        '$equipmentNameModel',
        '$_POST[problem_description]', 
        '$_POST[work_preformed]', 
        '$_POST[needs]', 
        '$_POST[knowledge_base]', 
        '$_POST[hours]', 
        '$_POST[milage]', 
        '$_POST[drive_time]')";
        //echo "1 record added";
}

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($con);

if(!$_POST[ticket_id])
{
  $newTicketId = $sqlTool->getNewTicketId();  
  $ticket_page = '<script type="text/javascript">window.location = "ticket.php?ticket_id='.$newTicketId[newTicket].'";</script>';
}

echo $ticket_page;

?>