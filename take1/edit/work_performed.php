<?php
  
  if(isset($_POST[submit])){
    require_once("../php_scripts/sql_tool.php");
	  $sqlTool = new SqlTool();
    foreach ($_POST as $key => $value)
      echo $key.': '.$value.'<br />';
      
    if($_POST[edit] == insert){
      $submitIncident = $sqlTool->insertWorkPerformed($_POST);
      $incident_id = $_POST[incident_id];
      $nextPage = "<script type='text/javascript'>window.location = '../incident.php?incident_id=$incident_id'</script>";
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
  
  
  
    $date = date('Y-m-d H:i:s'); //date("Y-m-d");
    $incident_id = $urlVariables[incident_id];
    
    
    echo "<form id='form1' style='margin-left: 15px;' name='form1' method='post' action='edit/work_performed.php'>";
               if($urlVariables[edit] == "insert" && $urlVariables[incident_id]) {
                echo "<h2>Work Performed</h2>
                      <input type='hidden' name='edit' value='insert' />
                      <input type='hidden' name='incident_id' value='$incident_id' />
                      <input type='hidden' name='employee_id' value='$_SESSION[user_name]' />
                      <label>Date</label><input name='created_date' value='$date' />
                      <br />";
                 $submit = "Insert Work Performed";
                 echo "<input type='submit' name='submit' id='submit' value='$submit' />";
               }
               else if ($_SESSION[user_name] == $work_performed_details[employee_id]){
                 $submit = "Update Work Performed";
                  echo $incidentDetails[company_name];
                  echo "<h2>$work_performed_details[employee_id]</h2>
                          <label>Date</label><input name='date' value='$work_performed_details[date]' />
                          <br />
                          <input type='hidden' name='edit' value='update' />
                          <input type='hidden' name='incident_id' value='$incident_id' />
                          <input type='hidden' name='employee_id' value='$_SESSION[user_name]' />";
                          echo "<input type='submit' name='submit' id='submit' value='$submit' />";
                  }
              
                  else
                    echo "You must sign in as $_SESSION[user_name] to edit this";
              
     echo "</form>";
  
 /*
  {
      $date = date('Y-m-d H:i:s'); //date("Y-m-d");
      $submit = "Insert Work Performed";
      echo "<form id='form1' style='margin-left: 15px;' name='form1' method='post' action='edit/work_performed.php'>
      
            <label>Date</label><input name='created_date' value='$date' />
            <input type='hidden' name='incident_id' value='$incident_id' />
            <input type='hidden' name='employee_id' value='$_SESSION[user_name]' />
            
            <input type='submit' name='submit' id='submit' value='$submit' />";
  }
     */
            
          
      
  //}
?>