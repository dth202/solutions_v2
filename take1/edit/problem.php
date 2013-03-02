<?php
  require_once("../php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
  
  if(isset($_POST[submit])){
    foreach ($_POST as $key => $value)
      echo $key.': '.$value.'<br />';
      
    $submitProblem = $sqlTool->submitProblem($_POST);
    $problem_id = $sqlTool->getLatestProblem_id();
    
    $submitIncident = $sqlTool->insertIncident($problem_id[problem_id], $_POST);
    
    echo $submitProblem;
    echo $submitIncident;
    
    $incident_id = $sqlTool->getLatestIncident_id();
    $incident_id = $incident_id[incident_id];
    $nextPage = "<script type='text/javascript'>window.location = '../incident.php?incident_id=$incident_id&edit=update'</script>";
    echo $nextPage;
    
  }
  else {
    $date = date('Y-m-d H:i:s'); //date("Y-m-d");
    $companyList = $sqlTool->getCompanyList();
    
    echo "<form id='form1' style='margin-left: 15px;' name='form1' method='post' action='problem.php'>";
            echo "<h2>Problem</h2>
                  <h3>$_SESSION[user_name]</h3>
                  <input type='hidden' name='employee_id' value='$_SESSION[user_name]' />
                  <label>Problem Name</label><input name='problem_name' class='edit_input' type='text' value='' />
                  <br />
                  <label>Date Created</label><input name='created_date' id='created_date' value='$date' class='date' type='text' />
                  <br />
                  <label>Category</label><select name='category' id='category'>
                    <option value='Virus Removal'>Virus Removal</option>
                  </select>
                  <br />
                  <label>Problem Description</label><textarea name='problem_description' id='problem_description'></textarea>
                  <br />
                  
                  <hr />";
            echo "<h2>Incident</h2>
                  <label>Company</label><select name='company_id' id='company_id'>";
                    foreach($companyList as $key => $companyDetails) {
								      echo "<option name='$companyDetails[company_name]' id='$companyDetails[company_name]' value='$companyDetails[id]'>$companyDetails[company_name]</option>";
						          }
                  echo "</select>
                  <br />
                <input type='submit' name='submit' id='submit' value='Submit Problem and Incident' />
          </form>";
  }
?>