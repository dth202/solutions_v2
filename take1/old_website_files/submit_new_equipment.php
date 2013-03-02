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
$term = $_POST['company']; // urldecode($url[1]);
//$companyDetails = $sqlTool->getCompanyDetails($type, $term);

$companyDetails = $sqlTool->getCompanyDetails_ById($_POST['companies_id']);
$next_page = '<script type="text/javascript">window.location = "clients.php?company='.$_POST[company].'";</script>';
/*
echo "<h2>This is the post</h2><hr />";
echo "<table>";
echo "<tr><td><h3>Post</h3></td></tr>";
foreach($_POST as $key => $value)
  {
      echo "<tr><td><em>".$key."</em>: </td><td>".$value."</td></tr>";
  }
 
echo "<tr><td><h3>companyDetails</h3></td></tr>";
foreach($companyDetails as $key => $value)
  {
      echo "<tr><td><em>".$key."</em>: </td><td>".$value."</td></tr>";
  }
echo "</table>";
 */
if($_POST[equipment_id])
{
  $sql = "UPDATE equipment 
          SET pc_name = '$_POST[pc_name]'
              , model = '$_POST[model]'
              , serial = '$_POST[serial]'
              , os = '$_POST[os]'
              , install_date = '$_POST[install_date]'
              , notes = '$_POST[notes]'
              , system_information = '$_POST[system_information]'
          WHERE failed_equipment_id = $_POST[equipment_id]";
}
else{
  $sql = "INSERT INTO equipment 
      (company_id
      , company
      , pc_name
      , model
      , serial
      , os
      , install_date
      , notes
      , system_information)
  VALUES 
      ('$companyDetails[companies_id]', 
      '$companyDetails[name]', 
      '$_POST[pc_name]', 
      '$_POST[model]', 
      '$_POST[serial]', 
      '$_POST[os]',
      '$_POST[install_date]',
      '$_POST[notes]',
      '$_POST[system_information]')";
}
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  
echo "1 record added";

mysql_close($con);


$pageDestination = '<script type="text/javascript">window.location = "clients.php?companies_id='.$companyDetails[companies_id].'";</script>';

//echo '<script type="text/javascript">top.window.close();</script>';

echo $pageDestination; 

//echo $next_page;
?>