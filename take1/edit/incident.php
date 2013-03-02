<?php
  require_once("../php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
  
  if(isset($_POST[submit])){
    foreach ($_POST as $key => $value)
      echo $key.': '.$value.'<br />';
      
    if($_POST[edit] == insert){
      $submitIncident = $sqlTool->insertIncident($_POST[problem_id], $_POST);
      $incident_id = $sqlTool->getLatestIncident_id();
      $nextPage = "<script type='text/javascript'>window.location = '../incident.php?incident_id=$incident_id[incident_id]&edit=update'</script>";
    }
    else{
      $submitIncident = $sqlTool->updateIncident($_POST);
      //echo $_POST[incident_id];
      $incident_id = $_POST[incident_id];
      $nextPage = "<script type='text/javascript'>window.location = '../incident.php?incident_id=$incident_id'</script>";
    }
    
    echo $submitIncident;
    
    echo $nextPage;
    
  }
  else {
    $date = date('Y-m-d H:i:s'); //date("Y-m-d");
    $companyList = $sqlTool->getCompanyList();
    $contactList = $sqlTool->getContactList($incidentDetails[company_id]);
       
    echo "<form id='form1' style='margin-left: 15px;' name='form1' method='post' action='edit/incident.php'>";
           if($urlVariables[edit] == "insert") {
            echo "<h2>Incident - $incidentDetails[incident_id]</h2>
                  <label>Company</label><select name='company_id' id='company_id'>";
                    foreach($companyList as $key => $companyDetails) {
                      if($incidentDetails[company_id] == $companyDetails[id])
                        $selected = "selected";
                      else
                        $selected = "";
                        
								      echo "<option $selected name='$companyDetails[id]' id='$companyDetails[id]' value='$companyDetails[id]'>$companyDetails[company_name]</option>";
                      }
                  echo "</select>
                  <input type='hidden' name='edit' value='insert' />
                  <input type='hidden' name='problem_id' value='$problem_id' />
                  <label>Date</label><input name='created_date' value='$date' />";
             $submit = "Insert Incident";
           }
           else {
             $submit = "Update Incident";
              echo $incidentDetails[company_name];
              echo "<br />
                    <label>Contact</label>
                    <select name='contact_id' id='contact_id'>";
                      foreach($contactList as $key => $contactDetails) {
                          $selected = "";
                          if($contactDetails[id] == $incidentDetails[contact_id])
                          $selected = "selected";
								          echo "<option $selected name='$contactDetails[id]' id='$contactDetails[id]' value='$contactDetails[id]'>$contactDetails[fname] $contactDetails[lname]</option>";
						              }
                    
                                     
                      if($incidentDetails[status] == "Other")
                        $other = "selected";
                      else if ($incidentDetails[status] == "Client")
                        $client = "selected";
                        else
                         $tech = "selected";
                       
                      echo "</select>
                      <br />
                      <label>Created Dated</label><input name='created_date' value='$incidentDetails[created_date]' />
                      <br />
                      <label>Completed Date</label><input name='completed_date' value='$incidentDetails[completed_date]' />
                      <br />
                      <label>Follow up</label><textarea name='follow_up' id='follow_up'>$incidentDetails[follow_up]</textarea>
                      
                      <label>Waiting on</label>
                      <select name='status' id='status'>
                        <option $tech>Tech</option>
                        <option $client>Client</option>
                        <option $other>Other</option>
                      </select>
                      <input type='hidden' name='edit' value='update' />
                      <input type='hidden' name='incident_id' value='$incident_id' />
                      <input type='hidden' name='problem_id' value='$incidentDetails[problem_id]' />
                      <input type='hidden' name='company_id' value='$incidentDetails[company_id]' />";
              }
              
              
              
                echo "<input type='submit' name='submit' id='submit' value='$submit' />
             </form>";
            
          
      
  }
?>