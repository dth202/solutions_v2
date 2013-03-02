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

//echo '<h3>Still under Construction</h3>';



echo "<table>";

foreach($_POST as $key => $value)
  {
      echo "<tr><td><em>".$key."</em>: </td><td>".$value."</td></tr>";
  }
  
echo "</table>";
//echo "<tr><td><em>Tech</em>: </td><td>".$_SESSION['user_name']."</td></tr>";

    

if ($_POST[companies_id])
{
  $term = $_POST['companies_id']; // urldecode($url[1]);
  $companyDetails = $sqlTool->getCompanyDetails_ById($term);
     
  $sql = "UPDATE companies
          SET name = '$_POST[name]',
              office_phone = '$_POST[office_phone]',
              street_address = '$_POST[street_address]',
              city = '$_POST[city]',
              state = '$_POST[state]',
              zip = '$_POST[zip]',
              website = '$_POST[website]'

          WHERE companies_id='$_POST[companies_id]'";
          
  if (!mysql_query($sql,$con))
    {
    die('Error: ' . mysql_error());
    }
    
  echo "1 record edited";
  $companies_Id = $_POST[companies_id];
  $page = '<script type="text/javascript">window.location = "clients.php?companies_id='.$companies_Id.'";</script>';
  
}
else
{
  
  //$page = '<script type="text/javascript">window.location = "clients.php";</script>';
  //$page = '<script type="text/javascript">window.location = "clients.php?'. $filter .'='. urlencode($companyName) .''";</script>';
  $companies_Id = $_POST[companies_id];
  $page = '<script type="text/javascript">window.location = "clients.php";</script>';
  
  $sql = "INSERT INTO companies 
      (name,
       office_phone,
       street_address,
       city,
       state,	
       zip,	
       website     
        )
  VALUES 
      (
        '$_POST[name]',
        '$_POST[office_phone]',
        '$_POST[street_address]',
        '$_POST[city]',
        '$_POST[state]',
        '$_POST[zip]',
        '$_POST[website]'      
       )";

  if (!mysql_query($sql,$con))
    {
    die('Error: ' . mysql_error());
    }
  
  echo "1 record added";
  
  echo 'new';
}

echo $page;
mysql_close($con);
?>