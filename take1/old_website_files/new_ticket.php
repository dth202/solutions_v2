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
<script type="text/javascript">
  function xmlhttpPost(strURL) {
  var xmlHttpReq = false;
  var self = this;
  // Mozilla/Safari
  if (window.XMLHttpRequest) {
  self.xmlHttpReq = new XMLHttpRequest();
  }
  // IE
  else if (window.ActiveXObject) {
  self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
  }
  self.xmlHttpReq.open('POST', strURL, true);
  self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  self.xmlHttpReq.onreadystatechange = function() {
  if (self.xmlHttpReq.readyState == 4) {
  var array = self.xmlHttpReq.responseText.split('==');
  //alert(array[0]);
  //alert(array[1]);
  updatePage(array);

  }
  }
  self.xmlHttpReq.send(strURL);
  }

  function getquerystring() {
  var form     = document.forms['f1'];
  var word = form.word.value;
  qstr = 'w=' + escape(word);  // NOTE: no '?' before querystring
  return qstr;
  }

  function updatePage(arr) {
  document.getElementById("contactOption_id").innerHTML = arr[0];
  document.getElementById("equipment_id").innerHTML = arr[1];
  //document.getElementById("opperatingSystem").innerHTML = arr[3];
  }

function delete()
{
    
}
</script>
<?php
	
	require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
?>
<?php
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
  foreach ($urlVariables as $key => $value)
    echo $key.': '.$value.'<br />';
   */
  if($urlVariables['ticket_id'])
  {
    //echo "Yes, Setup for edit";
    //$ticketInformation = sqlTool->
    echo '<h2>Edit Ticket: '.$urlVariables['ticket_id'].'</h2>';
    
    $ticket = $sqlTool->getTicket2($urlVariables['ticket_id']);
    $ticket = $ticket[0];
   
    $ticket_name = $ticket['ticket_name']; 
    $status = $ticket['status'];
    $company = $ticket['company'];
    $company_id = $ticket['company_id'];
    $date  =  $ticket['date'];
    $hours = $ticket['hours'];
    $drive_time = $ticket['drive_time'];
    $milage = $ticket['milage'];
    $problem_description = $ticket['problem_description'];
    $work_preformed = $ticket['work_preformed'];
    $needs = $ticket['needs'];
    $knowledge_base = $ticket['knowledge_base'];
    $quantity = $ticket['quantity'];
    $vendor = $ticket['vendor'];
    //$ufd-vendor = $ticket['ufd-vendor'];
    $part_id = $ticket['part_id'];
    $part_description = $ticket['part_description'];
    $serial = $ticket['serial'];
    $price = $ticket['price'];
    $contactOption_id = $ticket['contactOption_id'];
    $contactOption = $ticket['contactOption'];
    $equipment_id = $ticket['equipment_id'];
    $equipment = $ticket['equipment'];
    
    $submitText = "Update Ticket";
  }
  else
    $submitText = "Submit Ticket";
  
  
 
?>
	<form id="form1" style="margin-left: 15px;" name="form1" method="post" action="submit_new_ticket.php">
		<div>
			<!--<label><h2 style="float: left; margin-right: 3px; margin-bottom: 3px;">Ticket #</h2></label>
      
			<input name="ticket_id" class="text_input" style="width: 35px; text-align: right;" value="" type="text" />
      
			
			<label style="margin-left:5px; font-weight: bold;">Case Number</label>
			<input name="case" class="text_input" style="width: 35px;" type="text" />
			-->
      
      <?php 
     
      
      if($urlVariables['ticket_id'])
      {
          echo '<input type="hidden" name="ticket_id" value="'.$urlVariables['ticket_id'].'" />';
          echo '<input type="hidden" name="tech" value="'.$ticket['tech'].'" />';
          }
      ?>
      
      <label>Ticket Name</label>
			<?php 
          echo '<input name="ticket_name" class="text_input" type="text" value="'.$ticket_name.'" />';
      ?>
			
			<label>Status</label>
      <select id="status" name="status">
        <?php if($urlVariables['ticket_id'])
            if($status == 'Open') {
              $open = 'selected';
              $closed = '';
            }
            else {
              $closed = 'selected';
              $open = '';
            }
				    echo '<option '.$open.' value="Open">Open</option>';
				    echo '<option '.$closed.' value="Closed">Closed</option>';
        ?>		
			</select>
			
		</div>
		<div class="ticket">
			
			<div style="clear: both" class="half">
									
					<label>Company</label>
        
					<select id="company" name="company" 
                  onchange="xmlhttpPost('php_scripts/form_info_loader.php?company='+encodeURIComponent(this.options[this.selectedIndex].text))"
        onblur="getIttems();">

        <?php 
              if($urlVariables['ticket_id'])
                {
                             
                  echo '<option value="'.$company.'">'.$company.'</option>';
                  
                }
            ?>      
             
						<option value="">-Select-</option>
						<?php
						    foreach($companies as $_companies_id => $_name) {
								echo "<option value=\"{$_name}\">{$_name}</option>"; //$_companies_id
						    }
						?>
					</select>
				
					<!-- Item select. Hidden, initially -->
				  <label>Contact</label>
          
				  <select name="contactOption_id" id="contactOption_id">
            <?php 
            if($urlVariables['ticket_id'])
                {
                   // echo '<option value="'.$contactOption_id.'">'.$contactOption.'</option>';
                    $contacts = $sqlTool->getCompanyContacts($company);
		                  foreach($contacts as $key => $value) {
                        if($contactOption_id == $value[0])
                          $selected = 'selected';
                        else 
                          $selected = '';
			                  echo '<option '.$selected.' value='.$value[0].'>'.$value[1]." ".$value[2].'</option>';
		                  }
                }
            
            ?>
            
          </select>
          </div>
		</div>
		
		<div class="ticket date">
			<!--<h2>Date</h2>-->
			<div class="half">
					<label>Date (Y-M-D)</label>
          <?php
            if($urlVariables['ticket_id'])
            {
                //$date = $sqlTool->convertDate2String($ticket['date']);
                echo "<input name='date' value='$date' class='date' type='text' />";
            }
               else
               {
                  $date = date('Y-m-d H:i:s'); //date("Y-m-d");
                  echo "<input name='date' value='$date' class='date' type='text' />";
               }
          ?>

        
        <!--
				<div class ="clearfloat">
					<label>Work Hours</label>
          <?php
            echo '<input name="hours" class="hours" type="text" value="'.(float)$hours.'" />';
          ?>
					
				</div>
			</div>
			<div class="half">
				<div>
					<label>Drive Time</label>
          <?php
            echo '<input name="drive_time" class="drive_time" type="text" value='.(float)$drive_time.' />';
          ?>
					</div>
				<div>
					<label>Milage</label>
          <?php
            echo '<input name="milage" class="milage" type="text" value='.(float)$milage.' />';
          ?>
					
				</div>
     	</div>
      -->
		</div>
		<hr class="clearfloat" />
    <div class="ticket equipment names">
      <h2>Equipment</h2>
      <!--<img src="../system/images/add.png" style="float: left;" alt="" width="15px" />-->
	    <select name="equipment_id" id="equipment_id" style="width: 45%;">
        <?php
            if($urlVariables['ticket_id'])
            {
              //echo '<option value="'.$equipment_id.'">'.$equipment.'</option>';
              echo '<option></option>';
              $equipmentList = $sqlTool->getCompanyEquipment($company);
                  foreach($equipmentList as $key => $value) {
                      if($equipment_id == $value[0])
                        $selected = 'selected';
                      else 
                        $selected = '';
                      echo '<option '.$selected.' value='.$value[0].'>'.$value[1]." - ".$value[4].'</option>';
                  }
            }
        ?>

      </select>
      
      <!--<select name="opperatingSystem" id = "opperatingSystem"></select>-->
      
    </div>
			
		<hr class="clearfloat" />
		<div class="ticket">
			<h2>Description</h2>
			<div class="half">
				<label style="width: auto">Problem(s)</label>
          <?php
              echo '<textarea name="problem_description" id="problem_description" style="height:90px; width:95%;">'.$problem_description.'</textarea>';
            ?>
					
				<label style="width: auto">Work Preformed</label>
           <?php
					    echo '<textarea name="work_preformed" id="work_preformed" style="height:90px; width:95%;">'.$work_preformed.'</textarea>';
            ?>
			</div>
			<div class="half">
        <label style="width: auto">Needs</label>
        <?php
              echo '<textarea name="needs" id="needs" style="height:90px; width:95%;">'.$needs.'</textarea>';
            ?>
        <label style="width: auto">Knowledge Base</label>
        <?php
              echo '<textarea name="knowledge_base" id="knowledge_base" style="height:90px; width:95%;">'.$knowledge_base.'</textarea>';
            ?>
       </div> 
		</div>
		<hr class="clearfloat" />
    <!-- 
    <div class="ticket parts">
			<h2>Parts</h2>
			
			<img src="../system/images/add.png" style="float: left" alt="" width="15px" />
			<div style="width: 10%">
				<label>Qty</label>
        <?php
				    echo '<input name="quantity" class="text_input" type="text" style="width: 70%;" value="'.$quantity.'"/>';
				?>
			</div>
			<div style="width: 15%;">
				<label>Vendor</label>
				<select style="width: auto;" name="vendor" id="vendor">
          <?php
              if($urlVariables['ticket_id'])
                if($ticket['vendor'])
                echo '<option>'.$vendor.'</option>';
            ?>
          <option value="">-Select-</option>
          <option value="dell">Dell</option>
					<option value="hp">HP</option>
					<option value="linksys">Linksys</option>
				</select>
        
			</div>
			<div style="width: 10%;">
				<label>Part #</label>
        <?php
            echo '<input name="part_id" class="text_input" type="text" value="'.$part_id.'"/>';
            ?>
				
			</div>
			<div style="margin-left: 4px; width: 30%;">
				<label>Description</label>
        <?php
            echo '<input name="part_description" class="text_input" type="text" value="'.$part_description.'"/>';
            ?>
				
			</div>
			<div style="width: 15%;">
				<label>Serial</label>
        <?php
            echo '<input name="serial" class="text_input" type="text" value="'.$serial.'"/>';
            ?>
				
			</div>
			<div style="width: 10%;">
				<label>Price</label>
        <?php
				    echo '<input name="price" class="text_input" type="text" value="'.$price.'"/>';
        ?>
			</div>
		</div>
		
		<hr class="clearfloat" style="margin-top: 75px;"/>
    -->
    <?php
		    echo '<input style="position: fixed; right: 50px; bottom: 10px;
        width:130px; float: right; margin: 15px 100px;" type="submit" name="submit" id="submit" value="'.$submitText.'" />';
    ?>
		
	</form>


<script type="text/javascript">
  
	$("#companies_id").ufd({submitFreeText:true});
	$("#service_type").ufd({submitFreeText:true});
	$("#Items").ufd({submitFreeText:true});
	$("#start_time").ufd({submitFreeText:true});
	$("#start_time2").ufd({submitFreeText:true});
	$("#start_time3").ufd({submitFreeText:true});
	$("#start_time4").ufd({submitFreeText:true});
	$("#date").ufd({submitFreeText:true, manualWidth:147});
	$("#date2").ufd({submitFreeText:true, manualWidth:147});
	$("#minutes").ufd({submitFreeText:false});
	$("#equiptment").ufd({submitFreeText:true});
	$("#serial_number").ufd({submitFreeText:true});
	$("#model_number").ufd({submitFreeText:true});
	$("#quantity").ufd({submitFreeText:true});
	$("#vendor").ufd({submitFreeText:true});
  
</script>