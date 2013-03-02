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
 
 
  ?>
 

<form id="form1" style="margin-left: 15px;" name="form1" method="post" action="submit_new_equipment.php">
  <div class="ticket">

    <div style="clear: both">
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
              
                
						
                foreach($companies as $_companies_id => $_name) {
								echo "<option value=\"{$_name}\">{$_name}</option>"; //$_companies_id
						    }
                
                */
						?>
      <!--
        </select>
      -->
    <div>
      <?php
      if($urlVariables[company])
        $companyDetails = $sqlTool->getCompanyDetails_ById($urlVariables['company']);
      
          $submitButton = 'Submit Equipment';        
          if($urlVariables['equipment_id']){
            $equipmentInfo =  $sqlTool->getEquipmentInfo($urlVariables['equipment_id']);
            $submitButton = 'Update Equipment';
            $companyDetails = $sqlTool->getCompanyDetails_ById($equipmentInfo[company_id]);
            echo '<input type="hidden" name="equipment_id" id="equipment_id" value="'.$urlVariables['equipment_id'].'" />';
            }
       echo '<input type="hidden" name="companies_id" id="companies_id" value="'.$companyDetails[companies_id].'" />';
                    
                    echo '<h2>'.$companyDetails[name].'</h2>';
       
       
        echo '<label>PC Name</label>';
        echo '<input name="pc_name" class="hours" type="text" value="'.$equipmentInfo[pc_name].'" />';
      echo '</div>';
    echo '<div>';
        echo '<label>Model</label>';
        echo '<input name="model" class="drive_time" type="text" value="'.$equipmentInfo[model].'" />';
      echo '</div>';
      echo '<div>';
        echo '<label>Serial</label>';
        echo '<input name="serial" class="milage" type="text" value="'.$equipmentInfo[serial].'" />';
      echo '</div>';
     echo ' <div>';
        echo '<label>O.S.</label>';
        echo '<select style="width: auto;" id="os" name="os">';
          echo '<option>'.$equipmentInfo[os].'</option>';
          echo ' <option>Windows XP Pro SP1</option>';
          echo ' <option>Windows XP Pro SP2</option>';
          echo ' <option>Windows XP Pro SP3</option>';
          echo ' <option>Windows Vista Home SP1</option>';
          echo ' <option>Windows Vista Home SP2</option>';
          echo ' <option>Windows Vista Business SP1</option>';
          echo ' <option>Windows Vista Business SP2</option>';
          echo ' <option>Windows 7 Home Prem 32 bit</option>';
          echo ' <option>Windows 7 Home Prem 64 bit</option>';
          echo ' <option>Windows 7 Pro 32 bit</option>';
          echo ' <option>Windows 7 Pro 64 bit</option>';
          echo ' <option>Windows 7 Ultimate 32 bit</option>';
          echo ' <option>Windows 7 Ultimate 64 bit</option>';

        echo '</select>';
        
      echo '</div>';
      echo '<div>';
        echo '<label>Install Date (YYYY-MM-DD)</label>';
        echo '<input name="install_date" class="milage" type="text" value="'.$equipmentInfo[install_date].'" />';
      echo '</div>';
echo '      <div>';
echo '        <label>Notes</label>';
echo '        <textarea name="notes" class="milage" type="text">'.$equipmentInfo[notes].'</textarea>';
echo '      </div>';
echo '      <div>';
echo '        <label>System Information</label>';
echo '        <textarea name="system_information" style="height: 200px;" class="milage" type="text">'.$equipmentInfo[system_information].'</textarea>';
echo '      </div>';

echo '      <input style="width:170px; margin: 0px 100px;" type="submit" name="submit" id="submit" value="'.$submitButton.'" />';
echo '    </div>';

    ?>
  </div>
  
  

</form>
<script type="text/javascript">
  $("#companies").ufd({submitFreeText:true});
  $("#Support_Plan").ufd({submitFreeText:true});
  $("#os").ufd({submitFreeText:true});
</script>