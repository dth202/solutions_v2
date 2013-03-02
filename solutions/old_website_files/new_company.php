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
  
	$urlVariables = explode("&", substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?') + 1));
	$urlVariablestemp = explode("=", $urlVariables[0]);
	$urlVariablestemp2 = explode("=", $urlVariables[1]);
	$urlVariables = array();
	$urlVariables[$urlVariablestemp[0]] = $urlVariablestemp[1];
	$urlVariables[$urlVariablestemp2[0]] = $urlVariablestemp2[1];
  /*
  foreach($urlVariables as $key=>$value){
    echo $key.': '.$value.'<br />';
    }
  
    if( $urlVariables['companies_id'])
      {echo $urlVariables['companies_id'];}
    else
      {echo 'No Company';}
 
   */
   
  
  /*
      foreach($companyDetails as $key=>$value)
      {
          echo $key.': '.$value.'<br />';
      }
  */
?>
<form id="form1" style="margin-left: 15px;" name="form1" method="post" action="submit_new_company.php">
  <div class="ticket">
    <?php
        if($urlVariables['company_id'])
        {
          $companyDetails = $sqlTool->getCompanyDetails($urlVariables['company_id']);
          echo '<input type="hidden" name="company_id" value="'.$urlVariables['company_id'].'" />';
        }
    ?>
    <div style="clear: both" class="half">
      <label>Company Name</label>
      <input name="name" class="hours" type="text" value="<?php echo $companyDetails['company_name'];?>"/>
    <div>
        <label>Office Phone</label>
        <input name="office_phone" class="hours" type="text" value="<?php echo $companyDetails['office_phone'];?>"/>
    </div>
    <div>
      <label>Website</label>
      <input name="website" class="milage" type="text" value="<?php echo $companyDetails[website];?>" />
    </div>
      <?php
        $companyAddress = $sqlTool->getCompanyAddress($urlVariables['company_id']);
      
        foreach($companyAddress as $index => $address) {
          echo '<br />'.$address[address1].'</p><p>'.$address['city'].', '.$address['state'].' '.$address['zip'].'</p>';
        }
      ?>
      <!-- 
      <div>
        <label>Street Address</label>
        <input name="street_address" class="drive_time" type="text" value="<?php echo $companyDetails['street_address'];?>"/>
      </div>
      <div>
        <label>City</label>
        <input name="city" class="milage" type="text" value="<?php echo $companyDetails['city'];?>"/>
      </div>
      <div>
        <label>State</label>
        <input name="state" class="milage" type="text" value="<?php echo $companyDetails['state'];?>"/>
      </div>
      <div>
        <label>Zip</label>
        <input name="zip" class="milage" type="text" value="<?php echo $companyDetails['zip'];?>"/>
      </div>
      -->
      <?php
       $submitValue = 'Submit Company';
       if($urlVariables['companies_id'])
        $submitValue = 'Update Company';
       
        echo '<input style="width:140px; margin: 0px 100px;" type="submit" name="submit" id="submit" value="'.$submitValue.'" />';
        ?>
    </div>
    
  </div>
  
  

</form>
<script type="text/javascript">
 $("#companies").ufd({submitFreeText:true});
 $("#Support_Plan").ufd({submitFreeText:true});
</script>