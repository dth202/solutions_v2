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

$companyDetails = $sqlTool->getCompanyDetails_ById($_POST['companies_id']);
$pageDestination = '<script type="text/javascript">window.location = "clients.php?compayn='.$companyDetails[companies_id].'";</script>';


echo "<h2>This is the post</h2><hr />";
echo "<table>";
echo "<tr><td><h3>Post</h3></td></tr>";
foreach($_POST as $key => $value)
  {
      echo "<tr><td><em>".$key."</em>: </td><td>".$value."</td></tr>";
  }
echo "<tr><td><h3>CompanyDetails</h3></td></tr>";
foreach($companyDetails as $key => $value)
  {
      echo "<tr><td><em>".$key."</em>: </td><td>".$value."</td></tr>";
  }
  
echo "</table>";


$sql = "INSERT INTO contacts 
    (company_id, 
    company, 
    first, 
    last, 
    mobile_phone, 
    email_address)
VALUES 
    ('$companyDetails[companies_id]', 
    '$companyDetails[name]', 
    '$_POST[first]', 
    '$_POST[last]', 
    '$_POST[mobile_phone]', 
    '$_POST[email_address]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  
echo "1 record added";

mysql_close($con);


$pageDestination = '<script type="text/javascript">window.location = "clients.php?companies_id='.$companyDetails[companies_id].'";</script>';

//echo '<script type="text/javascript">top.window.close();</script>';

echo $pageDestination; 
?>