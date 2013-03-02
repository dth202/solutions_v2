<style type="text/css">
.separator {
	background-color:#036;
	height:1px; 
	margin:auto; 
	width:100%;
	margin-bottom:5px;
	margin-top:10px;
}
</style>
<?php
	
	require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
  
	// Connect to mysql
	$dbLink = new mysqli('mysql50-60.wc2.dfw1.stabletransit.com', '513061_intuitiv3', '9teen6T9', '513061_intuitive_test_db');
	if(mysqli_connect_errno()) {
	    echo 'MySQL connection failed:', mysqli_connect_error();
	}
	
	// Fetch groups for the first drop-down.
	$sql = "SELECT * FROM companies ORDER BY name";
	$result = $dbLink->query($sql) or die("Query failed: ". $dbLink->error);
	
	$companies = array();
	while($row = $result->fetch_assoc()) {
	    $companies[$row['companies_id']] = $row['name'];
	}
  
	$result->close();
	$dbLink->close();
  
  $urlVariables = explode("&", substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?') + 1));
	$urlVariablestemp = explode("=", $urlVariables[0]);
	$urlVariablestemp2 = explode("=", $urlVariables[1]);
	$urlVariables = array();
	$urlVariables[$urlVariablestemp[0]] = $urlVariablestemp[1];
	$urlVariables[$urlVariablestemp2[0]] = $urlVariablestemp2[1];
  /*
  $companyDetails = $sqlTool->getCompanyDetails_ById($urlVariables['company']);
      foreach($companyDetails as $key=>$value)
      {
          echo $key.': '.$value.'<br />';
      }
  
  foreach($urlVariables as $key=>$value){
    echo $key.': '.$value.'<br />';
    }
    if( $urlVariables['company'])
      {echo $urlVariables['company'];}
    else
      {echo 'No Company';}
   */
?>
<form id="form1" style="margin-left: 15px;" name="form1" method="post" action="submit_new_contact.php">
  <div class="ticket">

    <div style="clear: both" class="half">
      <!--
      <label>Company</label>
      <select id="company" name="company"
              onchange="xmlhttpPost('http://www.intuitivetest.com/solutions/php_scripts/form_info_loader.php?company='+encodeURIComponent(this.options[this.selectedIndex].text))"
              onblur="getIttems();">
      -->
        
        <?php
        /*
        
                if( $urlVariables['company'])
                {
                   $companyDetails = $sqlTool->getCompanyDetails_ById($urlVariables['company']);
                   $companyKey = $companyDetails['companies_id'];
                   $companyValue = $companyDetails['name'];
                    //echo '<option value='.$companyDetails['companies_id'].'>'.$companyDetails['name'].'</option>';
                    echo "<option value=\"{$companyValue}\">{$companyValue}</option>";
                    
                    
                 }
                else
                {
                  echo "<option value=\"\">-Select-</option>";
						      foreach($companies as $_companies_id => $_name) {
								      echo "<option value=\"{$_name}\">{$_name}</option>"; //$_companies_id
						          }
                }
              
          */      
						?>
      <!--
      </select>
      -->
     <?php
     
       //if( $urlVariables[company])
                {
                    echo '<input type="hidden" name="companies_id" id="companies_id" value="'.$urlVariables[company].'" />';
                    $companyDetails = $sqlTool->getCompanyDetails_ById($urlVariables['company']);
                    echo '<h2>'.$companyDetails[name].'</h2>';
                }
     
     ?>
     
     
    <div>
        <label>First name</label>
        <input name="first" class="hours" type="text" />
      </div>
    <div>
        <label>Last Name</label>
        <input name="last" class="drive_time" type="text" />
      </div>
      <div>
        <label>Mobile Phone</label>
        <input name="mobile_phone" class="milage" type="text" />
      </div>
      <div>
        <label>Email</label>
        <input name="email_address" class="milage" type="text" />
      </div>
      <input style="width:120px; margin: 0px 100px;" type="submit" name="submit" id="submit" value="Submit Contact" />
    </div>
    
  </div>
  
  

</form>
<script type="text/javascript">
 $("#companies").ufd({submitFreeText:true});
 $("#Support_Plan").ufd({submitFreeText:true});
</script>