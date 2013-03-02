<?php
      /*
      $hostname='mysql50-60.wc2.dfw1.stabletransit.com';
      $username='513061_intuitiv3';
      $password='Motiv8me';
      $dbname = '513061_intuitive_test_db';

  */    
$hostname='mysql50-33.wc2.dfw1.stabletransit.com';
$username='513061_solutions';
$password='Motiv8me';
$dbname = '513061_solutions';

/*
$hostname='mysql51-016.wc2.dfw1.stabletransit.com';
$username='513061_user';
$password='9teen6T9';
$dbname = '513061_solutions2';
*/
$hostname_old='mysql50-60.wc2.dfw1.stabletransit.com';
$username_old='513061_intuitiv3';
$password_old='Motiv8me';
$dbname_old = '513061_intuitive_test_db';

class SqlTool {

  /*Template
    public function methodName() {
		  mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  	mysql_select_db($GLOBALS['dbname']);
      
		  $query = 'SELECT * FROM table';
		  $result = mysql_query($query);
		  if($result) {
			  // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			  while($roww = mysql_fetch_array($result)){
				  return $roww;
			  }
		  } else {
			  return "SQL TOOL ERROR -> methodName()";
		  }
	  }
  //Tools
  //View Pretty array
	echo "<pre>";
		print_r($incidentDetails);
	echo "</pre>";
	
	//Return error Format
	die("SQL TOOL ERROR -> getIncidentWorkPerformed($incident_id, $employee_id)<br />". mysql_error() . "<br /><br />SQL Query<br />$query");
			
  foreach ($incidentDetails as $key => $value)
              echo $key.': '.$value.'<br />';
  */
	public function toTable($string){
        $string = str_replace("\n", "</td></tr><tr><td>", $string);
        $string = str_replace("	", "</td><td>", $string);
        if(preg_match_all('/\<pre\>(.*?)\<\/pre\>/', $string, $match)){
            foreach($match as $a){
                foreach($a as $b){
                $string = str_replace('<pre>'.$b.'</pre>', "<pre>".str_replace("<br />", "", $b)."</pre>", $string);
                }
            }
        }
       $string = '<table><tr><td>'.$string.'</td></tr></table>';
    return $string;
    }
	public function getUserPassword($user) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
		$query = 'SELECT site_password FROM employee WHERE id="'.$user.'" OR email_address="'.$user.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			$passArray = mysql_fetch_row($result);
			return $passArray[0];
		} else {
			return "SQL TOOL ERROR -> getUserPassword($user)";
		}
	}
	public function getTechId($user) {
  
		mysql_connect($GLOBALS['hostname'] , $GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
   
		$query = 'SELECT id FROM employee WHERE id="'.$user.'" OR email_address="'.$user.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			$passArray = mysql_fetch_row($result);
			return $passArray[0];
		} else {
			return "SQL TOOL ERROR -> getTechId($user)";
		}
	} 
	public function getCompany() {
        mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  	  mysql_select_db($GLOBALS['dbname']);
      
		    $query = 'SELECT * 
                  FROM company 
                    
                  ORDER BY company_name';
			  
        $result = mysql_query($query);
		    if($result) {
			    // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			    while($row = mysql_fetch_array($result)){
				    $company[] = $row;
			    }
			    return $company;
		    } else {
			    return "SQL TOOL ERROR -> getCompany()";
		    }
    }
	public function getCompanyDetails($company_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);

		$query = 'SELECT * 
				FROM company 
				WHERE id = '.$company_id;
		  
		$result = mysql_query($query);
		if($result) 
		{
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result))
			{
				return $roww;
			}
		} 
		else 
		{
			return "SQL TOOL ERROR -> getCompanyDetails($company_id)";
		}
    }
	public function getCompanyAddress($company_id) {
	    mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);

		$query = "SELECT * 
				  FROM company_address
				  WHERE company_id = $company_id";
				
				//JOIN company ON company_address.company_id = company.id
		$result = mysql_query($query);
		if($result) 
		{
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
			$company[] = $row;
			}
			return $company;
		} 
		else 
		{
			return "SQL TOOL ERROR -> getCompanyAddress($company_id)";
		}
	  }
	public function getCompanyContacts($company_id)  {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);

		$query = 'SELECT * FROM contact WHERE company_id='.$company_id.' ORDER BY fname';
		$result = mysql_query($query);
		if($result) 
		{
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result))
			{
				$company[] = $row;
			}
			return $company;
		} 
		else 
		{
			return "SQL TOOL ERROR -> getCompanyContacts($company_id)";
		}
	}
	public function getCompanyEquipment($company_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
    
		$query = 'SELECT * FROM equipment WHERE company_id="'.$company_id.'" ORDER BY device_name';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> getCompanyEquipment($company_id)";
		}
	}
	public function getCompanyProblem($company_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
    
		$query = 'SELECT p.id AS problem_id
                    , problem_name
                    , p.created_date
                    , problem_description
                    , category
                    , employee_id
                    , completed_date
              FROM problem AS p JOIN incident ON p.id = incident.problem_id
              WHERE company_id="'.$company_id.'" ORDER BY p.created_date DESC';
          
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> getCompanyProblem($company_id)";
		}
	}
  	public function getProblemIncident($problem_id, $company_id, $employee_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
		// if($incident_id != 0)
		// $incident_id = "AND incident.id = $incident_id";
		// else
		// $incident_id = "";
		
		if($problem_id)
		{
			$where = "WHERE problem.id=$problem_id";
		}
		else if($company_id)
		{
			$where = "WHERE company.id=$company_id";
		}
		else if($employee_id)
		{
			$where = "WHERE incident.employee_id = '$employee_id' 
            OR  incident.id IN
                (
                    SELECT DISTINCT incident_id 
                    FROM work_performed wp 
                    WHERE wp.employee_id = '$employee_id' 
                    ORDER BY id DESC
                )";
		}
		else
		{
			$where = "";
		}
		
		$query = "SELECT problem.id AS problem_id
					, problem_name
					, incident.id AS incident_id
					, incident.created_date
					, completed_date
					, status
					, company_name
					, company.id AS company_id
					, employee_id
					, CONCAT(fname, ' ', lname) contact_name
					, contact_id
					, follow_up
			  FROM incident
				JOIN problem ON problem.id = incident.problem_id
				JOIN company ON company_id = company.id
				LEFT JOIN contact ON incident.contact_id = contact.id
				
			  $where
			  ORDER BY FIELD(status, 'In Progress', 'Tech', 'Client', 'Purchasing', 'ApptSet', 'Closed'), incident.created_date DESC
			  LIMIT 100";
		  
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			die("SQL TOOL ERROR -> getProblemIncident($problem_id)<br />". mysql_error() . "<br />$query");
			//return "SQL TOOL ERROR -> getProblemIncident($problem_id)";
		}
	}
  	public function getProblemDetails($problem_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);

		$query = "SELECT id AS problem_id
					, problem_name
					, created_date
					, problem_description
					, category
			FROM problem
			WHERE id = $problem_id";
		  
		$result = mysql_query($query);
		if($result) 
		{
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
			  return $roww;
			}
		} 
		else 
		{
			return "SQL TOOL ERROR -> getProblemDetails($problem_id)";
		}
	}
	public function getIncidentDetails($incident_id) {
      mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  	mysql_select_db($GLOBALS['dbname']);
      
      if($incident_id == '')
      $where = '';
      $where = "WHERE incident.id = $incident_id";
      
		  $query = "SELECT incident.id AS incident_id
                      , problem_id
                      , company_id
                      , contact_id
                      , follow_up
                      , source
                      , incident.created_date
                      , incident.completed_date
                      , status AS stt
                      , company_name
                      , status
					  , employee_id
                FROM incident 
                  JOIN company ON incident.company_id = company.id
                WHERE incident.id = $incident_id";
			  
      $result = mysql_query($query);
		  if($result) {
			  // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			  while($roww = mysql_fetch_array($result)){
				  return $roww;
			  }
		  } else {
			  return "SQL TOOL ERROR -> getIncidentDetails($incident_id)";
		  }
    }
	public function getContactSignature($incident_id) {
      mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  	mysql_select_db($GLOBALS['dbname']);
      
      $query = "SELECT *
				FROM contact_signature 
				  JOIN incident ON incident.id = contact_signature.incident_id
				WHERE incident.id = $incident_id";
			  
      $result = mysql_query($query);
		  if($result) {
			  // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			  while($roww = mysql_fetch_array($result))
			  {
				  return $roww;
			  }
		  } else {
			  return "SQL TOOL ERROR -> getContactSignature($incident_id)";
		  }
    }
	public function getEmployeeSignature($incident_id, $employee_id)	{
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);

		$where = "WHERE incident.id = $incident_id";
		if(isset($employee_id))
		{
			$where .= " AND employee_signature.employee_id = '$employee_id'";
		}
		
		$query =   "SELECT *
					FROM employee_signature 
					JOIN incident ON incident.id = employee_signature.incident_id
					$where";

		$result = mysql_query($query);
		if($result) 
		{
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result))
			{
				$contacts[] = $row;
			}	
			return $contacts;
		} 
		else 
		{
			die("SQL TOOL ERROR -> getEmployeeSignature($incident_id, $employee_id = 0)<br />". mysql_error() . "<br />$query");
		}
	}
	public function getTravelDetails($work_performed_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
      
      
		$query = "SELECT *
                FROM travel 
                WHERE work_performed_id = $work_performed_id";
			  
		$result = mysql_query($query);
		if($result) 
		{
			  // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			  while($roww = mysql_fetch_array($result))
			  {
				  return $roww;
			  }
		} else {
			return "SQL TOOL ERROR -> getTravelDetails($work_performed_id)";
		}
    }
	public function getIncidentWorkPerformed($incident_id, $employee_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
		
		$where = " WHERE incident_id= $incident_id ";
		if(isset($employee_id))
		{
			$where .= " AND w.employee_id = '$employee_id' ";
		}
		
		$query = "SELECT w.id AS work_performed_id
						, i.id AS incident_id
						, w.date
						, w.employee_id
						, company_id
				  FROM work_performed AS w
					JOIN incident AS i ON w.incident_id = i.id
				  $where
				  ORDER BY date DESC";
          
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			//return "SQL TOOL ERROR -> getIncidentWorkPerformed($incident_id)";
			die("SQL TOOL ERROR -> getIncidentWorkPerformed($incident_id, $employee_id)<br />". mysql_error() . "<br /><br />SQL Query<br />$query");
		}
	}
	public function getIncidentEmployeeSummary($incident_id, $employee_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
    
		$query = "  SELECT i.id
						, wp.employee_id
						, e.fname
						, e.lname
						, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(ewp.end_time,ewp.start_time)))) AS work_time
						, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(t.arrive_time1,t.depart_time1))) 
							+ SUM(TIME_TO_SEC(TIMEDIFF(t.arrive_time2,t.depart_time2)))) AS travel_time
						, SUM(t.arrive_milage1 - t.depart_milage1) 
							+ SUM(t.arrive_milage2 - t.depart_milage2) AS milage
							
					FROM work_performed wp
						JOIN incident i on wp.incident_id = i.id
						JOIN equipment_work_performed ewp ON ewp.work_performed_id = wp.id
						JOIN travel t ON wp.id = t.work_performed_id
						JOIN employee e ON wp.employee_id = e.id
					WHERE i.id = $incident_id
						AND e.id = '$employee_id'
						AND ewp.end_time >= ewp.start_time
						AND t.arrive_time1 >= t.depart_time1
						AND t.arrive_time2 >= t.depart_time2
						AND t.arrive_milage1 >= t.depart_milage1
						AND t.arrive_milage2 >= t.depart_milage2
					GROUP BY i.id, wp.employee_id
					ORDER BY i.id DESC, e.id DESC";
          
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result))
			{
				return $roww;
			}
		} else {
			//return "SQL TOOL ERROR -> getIncidentSummary($incident_id)";
			die("SQL TOOL ERROR -> getIncidentEmployeeSummary($incident_id, $employee_id)<br />". mysql_error() . "<br /><br />SQL Query<br />$query");
		}
	}
	public function getWorkPerformedDetails($work_performed_id) {
      mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  	mysql_select_db($GLOBALS['dbname']);
      
      $query = "SELECT incident_id
                    , wp.id AS work_performed_id
                    , problem_id
                    , wp.date
                    , wp.employee_id
                FROM work_performed AS wp
                  JOIN incident ON wp.incident_id = incident.id
                  JOIN problem ON incident.problem_id = problem.id
                WHERE wp.id = $work_performed_id";
			  
      $result = mysql_query($query);
		  if($result) {
			  // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			  while($roww = mysql_fetch_array($result)){
				  return $roww;
			  }
		  } else {
			  return "SQL TOOL ERROR -> getWorkPerformedDetails($work_performed_id)";
		  }
    }
	public function validateWorkPerformedTimes($incident_id, $employee_id) {
      mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  	mysql_select_db($GLOBALS['dbname']);
      
      $query = "SELECT  start_time, end_time, wp.employee_id, wp.id, CONCAT(e.fname, ' ', e.lname) AS 'employee_name'
				FROM equipment_work_performed ewp
					JOIN work_performed wp ON ewp.work_performed_id = wp.id
					JOIN incident i ON wp.incident_id = i.id
					JOIN employee e ON wp.employee_id = e.id
				WHERE i.id = $incident_id 
					AND ((start_time = '00:00:00' AND end_time <> '00:00:00') 
						OR (start_time <> '00:00:00' AND end_time = '00:00:00'))";
			  
      $result = mysql_query($query);
		  if($result) {
			  // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			  while($row = mysql_fetch_array($result))
				{
					$company[] = $row;
				}
				return $company;
		  } else {
			  //return "SQL TOOL ERROR -> getWorkPerformedDetails($work_performed_id)";
			  die("SQL TOOL ERROR -> validateWorkPerformedTimes($incident_id, $employee_id)<br />". mysql_error() . "<br />$query");
		  }
    }
  	public function equipment_work_performed($work_performed_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
    
		$query = "SELECT * 
              FROM equipment_work_performed
                JOIN equipment ON equipment_work_performed.equipment_id = equipment.id
              WHERE work_performed_id = $work_performed_id
			  ORDER BY device_name";
          
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> equipment_work_performed($work_performed_id)";
		}
	}
	public function getKBNList($company_id, $equipment_id, $vendor_id) 	{
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
		
		$where = "";
		
		if(!empty($company_id)) //|| !empty($equipment_id) || !empty($vendor_id))
		{
			if(strpos($where, "WHERE") == 0)
			{
				$where = $where." WHERE ";
			}
			else 
			{
				$where = $where." AND ";
			}
		
			$where = $where."kbn.company_id = $company_id";
		}
			
		if(!empty($equipment_id))
		{	
			if(strpos($where, "WHERE") == 0)
			{
				$where = $where." WHERE ";
			}
			else 
			{
				$where = $where." AND ";
			}
				
			for($i = 0; $i < count($equipment_id); $i++)
			{
				
				if(count($equipment_id) > 1)
				{
					if(!strpos($where, "IN"))
					{
						$where = $where." kbn.equipment_id IN (";
					}
					if(strpos($where, "kbn.equipment_id"))
					{
						$where = $where."$equipment_id[$i]";
					}
					if($i < count($equipment_id) - 1)
					{
						$where = $where.",";
					}
					if($i == count($equipment_id) - 1)
					{
						$where = $where.")";
					}
					if($i == count($equipment_id))
					{
						$where = $where.")";
					}
				}
				else 
				{
					if(!$equipment_id[1])
					{
						$where = $where." kbn.equipment_id = $equipment_id[0] ";
					}
					else
					{
						$where = $where." kbn.equipment_id = $equipment_id ";
					}
				}
			}
		}
		
		if(!empty($vendor_id))
		{
			if(strpos($where, "WHERE") == 0)
			{
				$where = $where." WHERE ";
			}
			else 
			{
				$where = $where." AND ";
			}
			
			$where = $where."vendor_id = $vendor_id";
		}
		
		$query = "SELECT kbn.id as id
						, kbn.company_id as company_id
						, kbn.equipment_id as equipment_id
						, vendor_id
						, kbn_name
						, description
						, date
						, company.company_name
						, equipment.device_name
				  FROM kbn
				  Left JOIN company ON company.id = kbn.company_id
				  Left JOIN equipment ON equipment.id = kbn.equipment_id
				  $where
				  Order by kbn_name";
		  
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$contacts[] = $row;
			}
			return $contacts;
			// return $query;
		} else {
			die("SQL TOOL ERROR -> getKBNList($company_id, $equipment_id, $vendor_id)<br />". mysql_error() . "<br />$query");
			//return "SQL TOOL ERROR -> getKBNList($incident_id)";
		}
	}
	public function getKBNDetails($kbn_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);

		$query = "SELECT kbn.id AS kbn_id
					, kbn_name
					, description
					, tags
					, make_global
					, company_name
					, kbn.company_id
					, equipment_id
					, device_name
					, model
					, software
					, details
					, date
			FROM kbn 
				Left JOIN company ON kbn.company_id = company.id
				Left JOIN equipment ON kbn.equipment_id = equipment.id
			WHERE kbn.id = $kbn_id";
		  
		$result = mysql_query($query);
		if($result) 
		{
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
			  return $roww;
			}
		} 
		else 
		{
			//die(mysql_error());
			die("SQL TOOL ERROR ->  getKBNDetails($kbn_id)<br />". mysql_error() . "<br />$query");
			//return "SQL TOOL ERROR -> getProblemDetails($problem_id)";
		}
	}
  	public function insertProblem($problem) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "INSERT INTO problem ( problem_name
                                   , created_date
                                   , problem_description
                                   , category)
              VALUES( '$problem[problem_name]'
                     , '$problem[created_date]'
                     , '$problem[problem_description]'
                     , '$problem[category]')";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> insertProblem($problem)";
		}
	}
	public function insertKBN($kbn) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "INSERT INTO kbn ( kbn_name
                                   , description
                                   , tags
                                   , make_global
								   , company_id
								   , equipment_id
								   , software
								   , details
								   , date)
              VALUES( '$kbn[kbn_name]'
                     , '$kbn[description]'
                     , '$kbn[tags]'
					 , '$kbn[make_global]'
					 , '$kbn[company_id]'
					 , '$kbn[equipment_id]'
					 , '$kbn[software]'
					 , '$kbn[details]'
                     , '$kbn[date]')";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $contacts;
		} else {
			die("SQL TOOL ERROR ->  insertKBN($kbn)<br />". mysql_error() . "<br />$query");
 

		}
	}
	public function updateKBN($kbn) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "UPDATE kbn 
				  SET kbn_name = '$kbn[kbn_name]'
                    , description = '$kbn[description]'
                    , tags = '$kbn[tags]'
					, make_global = '$kbn[make_global]'
					, company_id = '$kbn[company_id]'
					, equipment_id = '$kbn[equipment_id]'
					, software = '$kbn[software]'
					, details = '$kbn[details]'
					, date = '$kbn[date]'
				  WHERE id = '$kbn[kbn_id]'";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'Success! ';
			return $submit;
		} else {
			die("SQL TOOL ERROR ->  insertKBN($kbn)<br />". mysql_error() . "<br />$query");
		}
	}
	public function insertContactSignature($signature) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "INSERT INTO contact_signature ( sig_hash
                                   , created_date
                                   , ip
                                   , contact_id
								   , contact_name
								   , incident_id
								   , signature)
              VALUES( '$signature[sig_hash]'
                     , '$signature[created_date]'
                     , '$signature[ip]'
                     , '$signature[contact_id]'
					 , '$signature[contact_name]'
					 , '$signature[incident_id]'
					 , '$signature[signature]')";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $contacts;
		} else {
			die(mysql_error());
			//return "SQL TOOL ERROR -> insertContactSignature($signature)";
		}
	}
	public function insertEmployeeSignature($signature) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "INSERT INTO employee_signature ( sig_hash
                                   , created_date
                                   , ip
                                   , employee_id
								   , incident_id
								   , signature)
              VALUES( '$signature[sig_hash]'
                     , '$signature[created_date]'
                     , '$signature[ip]'
                     , '$signature[employee_id]'
					 , '$signature[incident_id]'
					 , '$signature[signature]')";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $contacts;
		} else {
			die("SQL TOOL ERROR -> insertEmployeeSignature($signature)<br />". mysql_error() . "<br />$query");
			//return "SQL TOOL ERROR -> insertContactSignature($signature)";
		}
	}
	public function updateProblem($problem) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "UPDATE problem 
				  SET problem_name = '$problem[problem_name]'
                    , problem_description = '$problem[problem_description]'
                    , category = '$problem[category]'
				  WHERE id = $problem[problem_id]";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $submit;
		} else {
			return "SQL TOOL ERROR -> updateProblem($problem)";
		}
	}
	public function resetDB() {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "CALL reset_db()";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'Database has been reset';
			return $submit;
		} else {
			return "SQL TOOL ERROR -> resetDB()";
		}
	}
	public function insertIncident($problem_id, $incident) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "INSERT INTO incident ( problem_id
										, created_date
										, company_id
										, follow_up
										, status
										, contact_id
										, employee_id)
              VALUES( '$problem_id'
                     , '$incident[created_date]'
                     , '$incident[company_id]'
                     , '$incident[follow_up]'
                     , '$incident[status]'
					 , '$incident[contactOption_id]'
					 , '$incident[employee_id]')";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> insertIncident($problem_id, $incident)";
		}
	}
	public function updateIncident($incident) 	{
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
					  
		$query = "UPDATE incident 
				  SET follow_up = '$incident[follow_up]'
					, status = '$incident[status]'
					, source = '$incident[source]'
					, contact_id = '$incident[contactOption_id]'
					, employee_id = '$incident[employee_id]'
				 WHERE id = $incident[incident_id]";


		$result = mysql_query($query);
		if($result) 
		{
			$submit = 'true';
			return $submit;
		} 
		else 
		{
			return "SQL TOOL ERROR -> updateIncident($incident)";
		}
	}
	public function completeIncident($incident_id) 	{
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
		
		$date = date('Y-m-d');
		$query = "UPDATE incident 
				  SET completed_date = '$date'
					, status = 'Closed'
				  WHERE id = $incident_id";


		$result = mysql_query($query);
		if($result) 
		{
			$submit = 'true';
			return $submit;
		} 
		else 
		{
			return "SQL TOOL ERROR -> updateIncident($incident)";
		}
	}
	public function insertWorkPerformed($incident) 	{
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
					  
		$query = "INSERT INTO work_performed ( incident_id
									, date
									, employee_id)
				  VALUES( '$incident[incident_id]'
						 , '$incident[date]'
						 , '$incident[employee_id]')";
		
		$result = mysql_query($query);
		if($result) {
			
		} else {
			return "SQL TOOL ERROR -> insertWorkPerformed($problem_id, $incident)";
		}
	}
	public function insertTravel($_POST) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
		$travel = $_POST[travel];

		$query = "INSERT INTO travel ( work_performed_id
                                    , depart_time1
                                    , arrive_time1
                                    , depart_milage1
                                    , arrive_milage1
                                    , depart_time2
                                    , arrive_time2
                                    , depart_milage2
                                    , arrive_milage2)
              VALUES( '$_POST[work_performed_id]'
					,  '$travel[depart_time1]'
					, '$travel[arrive_time1]'
					, '$travel[depart_milage1]'
					, '$travel[arrive_milage1]'
					, '$travel[depart_time2]'
					, '$travel[arrive_time2]'
					, '$travel[depart_milage2]'
					, '$travel[arrive_milage2]')";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> insertTravel($_POST)";
		}
	}
	public function updateWorkPerformed($work_performed) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "UPDATE work_performed 
				  SET date = '$work_performed[date]'
				  WHERE id = $work_performed[work_performed_id]";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> updateWorkPerformed($problem_id, $incident)";
		}
	}
	public function updateTravel($travel, $work_performed_id, $insert) 	{
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
		
		if($insert == 1)
		{
			$query = "UPDATE travel 
					  SET 	  depart_time1	 =  '$travel[depart_time1]'
							, arrive_time1	 = '$travel[arrive_time1]'
							, depart_milage1	 = '$travel[depart_milage1]'
							, arrive_milage1	 = '$travel[arrive_milage1]'
							, depart_time2	 = '$travel[depart_time2]'
							, arrive_time2	 = '$travel[arrive_time2]'
							, depart_milage2	 = '$travel[depart_milage2]'
							, arrive_milage2	 = '$travel[arrive_milage2]'
					  WHERE work_performed_id = $work_performed_id";
			$message = "Updated";
		}
		else
		{
			$query = "INSERT INTO travel ( work_performed_id
										, depart_time1
										, arrive_time1
										, depart_milage1
										, arrive_milage1
										, depart_time2
										, arrive_time2
										, depart_milage2
										, arrive_milage2)
					  VALUES( '$_POST[work_performed_id]'
							,  '$travel[depart_time1]'
							, '$travel[arrive_time1]'
							, '$travel[depart_milage1]'
							, '$travel[arrive_milage1]'
							, '$travel[depart_time2]'
							, '$travel[arrive_time2]'
							, '$travel[depart_milage2]'
							, '$travel[arrive_milage2]')";
			$message = "Inserted";
		}
			
		$result = mysql_query($query);
		if($result) 
		{
			//return $message;
			return $query;
		} 
		else 
		{
			return "SQL TOOL ERROR -> updateTravel($travel, $work_performed_id, $insert)";
		}
	}
	public function travelExists($work_performed_id)	{
		
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
		
		$query = "SELECT COUNT(*)
				  FROM travel
				  WHERE work_performed_id = $work_performed_id";

		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			
			while($row = mysql_fetch_array($result))
			{
				if ($row[0] > 0)
				{
					return 1;
				} 
				else
				{
					return 0;
				}	
			}
		} else {
			return "SQL TOOL ERROR -> travelExists($work_performed_id)";
		}
		
	}
	public function insertEwp($ewp) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "INSERT INTO equipment_work_performed ( equipment_id
														, work_performed_id
														, work_performed
														, start_time
														, end_time)
              VALUES( '$ewp[insert_equipment_id]'
                     , '$ewp[work_performed_id]'
                     , '$ewp[insert_work_performed]'
                     , '$ewp[insert_start_time]'
                     , '$ewp[insert_end_time]')";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> insertEwp($ewp)";
		}
	}
	public function updateEwp($ewp) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "UPDATE equipment_work_performed 
				  SET start_time = '$ewp[start_time]'
					, end_time = '$ewp[end_time]'
					, work_performed = '$ewp[work_performed]'
				  WHERE equipment_id = $ewp[equipment_id]
					AND work_performed_id = $ewp[work_performed_id]";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> updateEwp($ewp)";
		}
	}
	public function insertContact($contact) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "INSERT INTO contact
	                      (company_id
	                      , fname
	                      , lname
	                      , mobile_phone
						  , home_phone
						  , office_phone
	                      , email_address_uid
						  )
	          VALUES 
	                    ('$contact[company_id]'
	                    , '$contact[fname]'
	                    , '$contact[lname]'
	                    , '$contact[mobile_phone]'
						, '$contact[home_phone]'
						, '$contact[office_phone]'
	                    , '$contact[email_address_uid]')";
        
		$result = mysql_query($query);
		if($result) {
			return 'success';
		} else {
			return "SQL TOOL ERROR -> insertContact($contact)";
		}
	}
	public function updateContact($contact) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "UPDATE contact 
				  SET fname =  '$contact[fname]'
	                , lname = '$contact[lname]'
	                , mobile_phone = '$contact[mobile_phone]'
					, home_phone = '$contact[home_phone]'
					, office_phone = '$contact[office_phone]'
	                , email_address_uid = '$contact[email_address_uid]'
				  WHERE contact.id = $contact[contact_id]";
        
		$result = mysql_query($query);
		if($result) {
			return 'success';
		} else {
			return "SQL TOOL ERROR -> updateContact($contact)";
		}
	}
	public function insertCompany($company) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
				  
		$query = "INSERT INTO company
						  (company_name
						  , company_phone
						  , website
						  , notes
						  , service_type
						  )
			  VALUES 
						('$company[company_name]'
						, '$company[company_phone]'
						, '$company[website]'
						, '$company[notes]'
						, '$company[service_type]')";

		$result = mysql_query($query);
		
		if($result) 
		{
			return 'success';
		} else 
		{
			// die(mysql_error());
			return $query;
			// return "SQL TOOL ERROR -> insertCompany($company)";
		}
	}
	public function insertCompanyAddress($company_address, $company_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
				  
		$query = "INSERT INTO company_address
						  (company_id
						  , address1
						  , address2
						  , city
						  , state
						  , zip
						  , notes
						  , billing)
			  VALUES 
						('$company_id'
						, '$company_address[insertAddress1]'
						, '$company_address[insertAddress2]'
						, '$company_address[insertCity]'
						, '$company_address[insertState]'
						, '$company_address[insertZip]'
						, '$company_address[insertNotes]'
						, '$company_address[billing]')";

		$result = mysql_query($query);
		
		if($result) 
		{
			return 'success';
		} else 
		{
			die(mysql_error());
			//return $query;
			// return "SQL TOOL ERROR -> insertCompany($company)";
		}
	}
	public function updateCompanyAddress($company_address) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
				  
		$query = "UPDATE company_address
				  SET address1 = '$company_address[address1]'
					  , address2 = '$company_address[address2]'
					  , city = '$company_address[city]'
					  , state = '$company_address[state]'
					  , zip = '$company_address[zip]'
					  , notes = '$company_address[notes]'
					  , billing = '$company_address[billing]'
				  WHERE id = $company_address[address_id]";

		$result = mysql_query($query);
		
		if($result) 
		{
			return "Updated Company Addresses $$company_address[address_id]";
			//return $query;
		} else 
		{
			die(mysql_error());
			//return $query;
			// return "SQL TOOL ERROR -> insertCompany($company)";
		}
	}
	public function updateCompany($company) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
				  
		$query = "UPDATE company 
				  SET company_name =  '$company[company_name]'
					, company_phone = '$company[company_phone]'
					, website = '$company[website]'
					, notes = '$company[notes]'
					, service_type = '$company[service_type]'
				  WHERE id = $company[company_id]";

		$result = mysql_query($query);
		if($result) {
			//return 'success';
			return $query;
		} else {
			die(mysql_error());
		}
	}
	public function getProblemList($company_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 

		if($company_id == 0)
			$company_id = "";
		else
			$company_id = "company_id = $company_id AND";

		$query = "SELECT problem.id AS id
					, problem_name
					, problem.created_date
					, problem_description
					, category
					, problem.employee_id
					, 'Open' AS status
			  FROM problem
				JOIN incident ON problem.id = incident.problem_id
			  WHERE $company_id 
			   problem.id IN (SELECT problem.id
							  FROM problem JOIN incident
							  ON problem.id = incident.problem_id
							  WHERE completed_date = '0000-00-00 00:00:00' 
								OR completed_date IS NULL)
			UNION
				SELECT problem.id AS id
								, problem_name
								, problem.created_date
								, problem_description
								, category
								, problem.employee_id
								, 'Closed' AS status
				FROM problem
				  JOIN incident ON problem.id = incident.problem_id
				WHERE $company_id 
				  problem.id NOT IN (SELECT problem.id
								FROM problem JOIN incident
								ON problem.id = incident.problem_id
								WHERE completed_date = '0000-00-00 00:00:00' 
								  OR completed_date IS NULL)
			ORDER BY created_date DESC LIMIT 100";
			
		// $query = "SELECT problem.id AS id
				// , problem_name
				// , problem.created_date
				// , problem_description
				// , category
				// , problem.employee_id
				// , 'Open' AS status
		  // FROM problem
			// JOIN incident ON problem.id = incident.problem_id
		  // WHERE $company_id 
		   // problem.id IN (SELECT problem.id
						  // FROM problem JOIN incident
						  // ON problem.id = incident.problem_id
						  // WHERE completed_date = '0000-00-00 00:00:00' 
							// OR completed_date IS NULL)
		// UNION
			// SELECT problem.id AS id
							// , problem_name
							// , problem.created_date
							// , problem_description
							// , category
							// , problem.employee_id
							// , 'Closed' AS status
			// FROM problem
			  // JOIN incident ON problem.id = incident.problem_id
			// WHERE $company_id 
			  // problem.id NOT IN (SELECT problem.id
							// FROM problem JOIN incident
							// ON problem.id = incident.problem_id
							// WHERE completed_date = '0000-00-00 00:00:00' 
							  // OR completed_date IS NULL)
		// ORDER BY created_date DESC LIMIT 100";
		  
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> getProblemList()";
		}
	}
	public function getCompanyList() {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
    
		$query = "SELECT *
              FROM company
              ORDER BY company_name";
          
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> getCompanyList()";
		}
	}
	public function getContactList($company_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
    
		$query = "SELECT *
              FROM contact
              WHERE company_id = $company_id
              ORDER BY fname, lname";
          
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> getContactList($company_id)";
		}
	}
	public function getEquipmentList($company_id, $work_performed_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
    
		$query = "SELECT *
				  FROM equipment
				  WHERE company_id = $company_id
				  AND equipment.id NOT IN 
					(SELECT equipment_id FROM equipment_work_performed WHERE work_performed_id = $work_performed_id)
				  ORDER BY device_name";
          
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> getEquipmentList($company_id, $work_performed_id)";
		}
	}
	public function getCompanyEquipmentList($company_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
    
		$query = "SELECT *
				  FROM equipment
				  WHERE company_id = $company_id
				  ORDER BY device_name";
          
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$equipment[] = $row;
			}
			return $equipment;
		} else {
			return "SQL TOOL ERROR -> getCompanyEquipmentList($company_id)";
		}
	}
	public function getLatestProblem_id() {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
    $query = 'SELECT MAX(id) AS problem_id FROM problem';
		
    $result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			// while($roww = mysql_fetch_array($result)){
			while($row = mysql_fetch_array($result))
			{
				return $row[problem_id];
			}
		} else {
			return "SQL TOOL ERROR -> getLatestProblem_id()";
		}
	}
	public function getLatestIncidentId_fromProblem($problem_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);

		$query = "SELECT MAX(id) AS incident_id FROM incident WHERE problem_id = $problem_id";

		$result = mysql_query($query);
		if($result) 
		{
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result))
			{
				return $row[incident_id];
			}
		} 
		else 
		{
			return "SQL TOOL ERROR -> getLatestIncidentId_fromProblem($problem_id)";
		}
	}
	public function getLatestIncidentId() {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
    $query = "SELECT MAX(id) AS incident_id FROM incident";
		
    $result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				return $row[incident_id];
			}
		} else {
			return "SQL TOOL ERROR -> getLatestProblem_id()";
		}
	}
	public function getLatestContact_id() {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
    $query = 'SELECT MAX(id) AS contact_id FROM contact';
		
    $result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
				return $roww[contact_id];
			}
		} else {
			return "SQL TOOL ERROR -> getLatestContact_id()";
		}
	}
	public function getLatestKBN() {
		  mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  	mysql_select_db($GLOBALS['dbname']);
      
		  $query = "Select id as 'kbn_id', kbn_name, description, date FROM kbn ORDER BY id DESC LIMIT 1";
		  $result = mysql_query($query);
		  if($result) {
			  // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			  while($roww = mysql_fetch_array($result)){
				  return $roww;
			  }
		  } else {
			  return "SQL TOOL ERROR -> getLatestKBN()";
		  }
	  }
	public function getContactDetails($contact_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
		$query = "SELECT * 
				  FROM contact 
					JOIN company ON contact.company_id = company.id 
				  WHERE contact.id=$contact_id";

		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				return $row;
			}
		} else {
			return "SQL TOOL ERROR -> getContactDetails($contact_id)";
		}
	}
	public function getLatestWorkPerformedId() {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);

		$query = 'SELECT MAX(id) AS work_performed_id FROM work_performed';

		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
				return $roww[work_performed_id];
			}
		} else {
			return "SQL TOOL ERROR -> getLatestWorkPerformedId()";
		}
	}
	public function getLatestIncidentWorkPerformedId($incident_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);

		$query = "SELECT MAX(id) AS work_performed_id FROM work_performed WHERE incident_id = $incident_id";

		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
				return $roww[work_performed_id];
			}
		} else {
			return "SQL TOOL ERROR -> getLatestWorkPerformedId()";
		}
	}
	public function getOtherEquipmentId($companyId) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);

		$query = "SELECT id AS equipment_id 
				  FROM equipment
				  WHERE device_name = 'Other' AND  company_id = $companyId";

		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
				return $roww[equipment_id];
			}
		} else {
			return "SQL TOOL ERROR -> getOtherEquipmentId($companyId)";
		}
	}
	public function getProblem_id($incident_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
    $query = "SELECT problem_id AS problem_id 
              FROM incident
              WHERE id = $incident_id";
		
    $result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
				return $roww;
			}
		} else {
			return "SQL TOOL ERROR -> getLatestProblem_id()";
		}
	}
	public function getLatestIncident_id() 	{
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);

		$query = 'SELECT MAX(id) AS incident_id FROM incident';

		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
				return $roww[incident_id];
			}
		} else {
			return "SQL TOOL ERROR -> getLatestIncident_id()";
		}
	}
	public function getLatestEquipment_id() {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
    $query = 'SELECT MAX(id) AS equipment_id FROM equipment';
		
    $result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
				return $roww[equipment_id];
			}
		} else {
			return "SQL TOOL ERROR -> getLatestEquipment_id()";
		}
	}
	public function getProblemStatus($problem_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
    $query =    "SELECT TOP 1 'Open' AS status
                FROM incident
                WHERE EXISTS (SELECT * 
                              FROM incident 
                              WHERE problem_id = $problem_id
                              AND completed_date = '0000-00-00 00:00:00'
                              OR completed_date IS NULL)
              UNION
                SELECT TOP 1 'Closed' AS status
                FROM incident
                WHERE EXISTS (SELECT * 
                              FROM incident 
                              WHERE problem_id = $problem_id
                              AND  completed_date <> '0000-00-00 00:00:00'
                              OR completed_date IS NOT NULL)";
		
    $result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
				return $roww;
			}
		} else {
			return "SQL TOOL ERROR -> getLatestProblem_id()";
		}
	}
	public function getWorkPerformedTotalTime($work_performed_id, $employee_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
    $query = "SELECT  FLOOR((SUM(HOUR(TIMEDIFF(end_time, start_time))) * 60 + SUM(MINUTE(TIMEDIFF(end_time, start_time)))) / 60) AS hour
					, MOD(SUM(HOUR(TIMEDIFF(end_time, start_time))) * 60 + SUM(MINUTE(TIMEDIFF(end_time, start_time))), 60) AS minute
			  FROM work_performed AS wp
			  JOIN equipment_work_performed AS e_wp ON wp.id = e_wp.work_performed_id
			  WHERE wp.id = $work_performed_id
				AND wp.employee_id = '$employee_id'
				AND e_wp.start_time <> '00:00:00' AND e_wp.start_time IS NOT NULL
				AND e_wp.end_time <> '00:00:00' AND e_wp.end_time IS NOT NULL";
		
    $result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
				$total = "$roww[hour] Hours $roww[minute] Minute(s)";
				return $total;
			}
		} else {
			return "SQL TOOL ERROR -> getWorkPerformedTotalTime($work_performed_id)";
		}
	}
  	public function getEquipmentInfo($equipment_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
		$query = 'SELECT * FROM equipment WHERE id="'.$equipment_id.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				//$contacts[] = $row;
        return $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> getEquipmentInfo($equipment_id)";
		}
	}
  	public function updateEquipment($equipment) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "UPDATE equipment
				  SET device_name = '$equipment[device_name]'
					, model = '$equipment[model]'
					, serial = '$equipment[serial]'
					, os = '$equipment[os]'
					, notes = '$equipment[notes]'
					, operating_status = '$equipment[operating_status]'
					, installed_date = '$equipment[installed_date]'
					, system_information = '$equipment[system_information]'
				  WHERE id = $equipment[equipment_id]";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $submit;
		} else {
			return "SQL TOOL ERROR -> updateEquipment($equipment)";
		}
	}
	public function insertEquipment($equipment) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "INSERT INTO equipment 
								( company_id
								  , device_name
								  , model
								  , serial
								  , os
								  , notes
								  , installed_date
								  , system_information)
				  VALUES ( '$equipment[company_id]'
						  ,	'$equipment[device_name]'
						  , '$equipment[model]'
						  , '$equipment[serial]'
						  , '$equipment[os]'
						  , '$equipment[notes]'
						  , '$equipment[installed_date]'
						  , '$equipment[system_information]')";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $submit;
		} else {
			return "SQL TOOL ERROR -> insertEquipment($equipment)";
		}
	}
//Transfer Settings
  	public function getCompany_old() {
        mysql_connect($GLOBALS['hostname_old'],$GLOBALS['username_old'], $GLOBALS['password_old']) OR DIE ('Unable to connect to database! Please try again later.');
	  	  mysql_select_db($GLOBALS['dbname_old']);
      
		    $query = 'SELECT * 
                  FROM companies 
                  ORDER BY name';
			  
        $result = mysql_query($query);
		    if($result) {
			    // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			    while($row = mysql_fetch_array($result)){
				    $company[] = $row;
			    }
			    return $company;
		    } else {
			    return "SQL TOOL ERROR -> getCompany_old()";
		    }
    }
	public function getContact_old() {
		mysql_connect($GLOBALS['hostname_old'],$GLOBALS['username_old'], $GLOBALS['password_old']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname_old']);
      
		    $query = 'SELECT * 
                  FROM contacts';
			  
        $result = mysql_query($query);
		    if($result) {
			    // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			    while($row = mysql_fetch_array($result)){
				    $company[] = $row;
			    }
			    return $company;
		    } else {
			    return "SQL TOOL ERROR -> getContact_old()";
		    }
    }
	public function getEquipment_old() {
        mysql_connect($GLOBALS['hostname_old'],$GLOBALS['username_old'], $GLOBALS['password_old']) OR DIE ('Unable to connect to database! Please try again later.');
	  	  mysql_select_db($GLOBALS['dbname_old']);
      
		    $query = 'SELECT * 
                  FROM equipment';
			  
        $result = mysql_query($query);
		    if($result) {
			    // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			    while($row = mysql_fetch_array($result)){
				    $company[] = $row;
			    }
			    return $company;
		    } else {
			    return "SQL TOOL ERROR -> getEquipment_old()";
		    }
    }
	public function getTicket_old() 	{
		mysql_connect($GLOBALS['hostname_old'],$GLOBALS['username_old'], $GLOBALS['password_old']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname_old']);

		$query = 'SELECT * 
			  FROM tickets
			  ORDER BY ticket_id';
		  
		$result = mysql_query($query);
		if($result) 
		{
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result))
			{
				$company[] = $row;
			}
			return $company;
		} 
		else 
		{
			return "SQL TOOL ERROR -> getTicket_old()";
		}
    }
  	public function getCompanyNames() {
		if ($this->companies == null) {
			$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
			$username='513061_intuitiv3';
			$password='Motiv8me';
			$dbname = '513061_intuitive_test_db';
			
			mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
			mysql_select_db($dbname);
			$query = 'SELECT name FROM companies WHERE name IS NOT NULL ORDER BY name';
			$result = mysql_query($query);
			if($result) {
				// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
				while($row = mysql_fetch_row($result)){
					$this->companies[] = $row[0];
				}
				return $this->companies;
			} else {
				return "SQL TOOL ERROR -> getCompanyNames()";
			}
		} else {
			return $this->companies;
		}
	}
  	public function getCompanyIds() {
		 if ($this->companies == null) {
			$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
			$username='513061_intuitiv3';
			$password='Motiv8me';
			$dbname = '513061_intuitive_test_db';
			
			mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
			mysql_select_db($dbname);
			$query = 'SELECT companies_id FROM companies WHERE name IS NOT NULL ORDER BY name';
			$result = mysql_query($query);
			if($result) {
				// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
				while($row = mysql_fetch_row($result)){
					$this->companies[] = $row[0];
				}
				return $this->companies;
			} else {
				return "SQL TOOL ERROR -> getCompanyIds()";
			}
		} else {
			return $this->companies;
		}
	}
	public function getCompanyListByFilterValue($filterName) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT '.$filterName.' FROM companies WHERE '.$filterName.' IS NOT NULL ORDER BY name';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_row($result)){
				$items[] = $row[0];
			}
			return $items ;
		} else {
			return "SQL TOOL ERROR -> 
      anyListByFilterValue($filterName)";
		}
	}
	public function getCompanyDetails_ById($term) {
		
		
		//mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		//mysql_select_db($dbname);
		mysql_select_db($GLOBALS['dbname']);
		//$query = 'SELECT companies_id, name, street_address, office_phone, city, state, zip FROM companies c INNER JOIN contacts cc ON (cc.company = c.name) WHERE c.name LIKE "'. $term .'%" OR  c.office_phone LIKE "'. $term .'%" OR cc.phone LIKE "'. $term .'%" OR cc.mobile_phone LIKE "'. $term .'%" OR  c.street_address LIKE "'. $term .'%" OR cc.first LIKE "'. $term .'%" OR cc.last LIKE "'. $term .'%"';
		$query = 'SELECT * FROM company WHERE companyId = "'.$term.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
				return $roww;
			}
		} else {
			return "SQL TOOL ERROR -> getCompanyDetails_ById($term)";
		}
	}
  	public function getMaxId() 	{
		// mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		// mysql_select_db($GLOBALS['dbname']);
		
		mysql_connect($GLOBALS['hostname_old'],$GLOBALS['username_old'], $GLOBALS['password_old']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname_old']);

		$query = 'SELECT MAX(ticket_id) AS problem
						, MAX(ticket_id) AS incident
						, MAX(companies_id) AS company
						, MAX(contacts_id) AS contact
						, MAX(failed_equipment_id) AS equipment
				  FROM tickets, companies, contacts, equipment';

		$result = mysql_query($query);
		if($result) 
		{
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result))
			{
				return $roww;
			}
		} 
		else 
		{
			return "SQL TOOL ERROR -> function getMaxId()";
		}
	}
	public function getLatestId() 	{
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
		// mysql_connect($GLOBALS['hostname_old'],$GLOBALS['username_old'], $GLOBALS['password_old']) OR DIE ('Unable to connect to database! Please try again later.');
		// mysql_select_db($GLOBALS['dbname_old']);

		$query = 'SELECT MAX(problem.id) AS problem_id
						, MAX(company.id) AS company_id
						, MAX(contact.id) AS contact_id
						, MAX(equipment.id) AS equipment_id
						, MAX(incident.id) AS incident_id
				  FROM problem, incident, company, contact, equipment';

		$result = mysql_query($query);
		if($result) 
		{
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result))
			{
				return $roww;
			}
		} 
		else 
		{
			//return "SQL TOOL ERROR -> function getMaxId()";
			die(mysql_error());
		}
	}
	public function getIncidentCompany($incident_id) 	{
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
		$query = "SELECT company.id AS company_id
					, company.company_name AS company_name
				  FROM company JOIN incident ON incident.company_id = company.id
					JOIN problem ON problem.id = incident.problem_id
				  WHERE incident.id = $incident_id
				  ORDER BY incident.created_date DESC LIMIT 1";

		$result = mysql_query($query);
		if($result) 
		{
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result))
			{
				return $roww;
			}
		} 
		else 
		{
			return "SQL TOOL ERROR -> function getIncidentCompany($incident_id)";
		}
	}
	public function getIncidentEmployees($incident_id) 	{
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
		$query =   "SELECT DISTINCT e.id AS employee_id
						, fname
						, lname
						, user_type
					FROM work_performed wp 
						JOIN employee e ON wp.employee_id = e.id
					WHERE incident_id = $incident_id";

		$result = mysql_query($query);
		if($result) 
		{
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$tickets[] = $row;
			}
			return $tickets;
		} 
		else 
		{
			//			return "SQL TOOL ERROR -> function getIncidentEmployees($incident_id)";
			die("SQL TOOL ERROR -> getIncidentEmployees($incident_id)<br />". mysql_error() . "<br />$query");
		}
	}
	public function getCompanyDetailsId($name) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		//$query = 'SELECT companies_id, name, street_address, office_phone, city, state, zip FROM companies c INNER JOIN contacts cc ON (cc.company = c.name) WHERE c.name LIKE "'. $term .'%" OR  c.office_phone LIKE "'. $term .'%" OR cc.phone LIKE "'. $term .'%" OR cc.mobile_phone LIKE "'. $term .'%" OR  c.street_address LIKE "'. $term .'%" OR cc.first LIKE "'. $term .'%" OR cc.last LIKE "'. $term .'%"';
		$query = 'SELECT * FROM companies';// WHERE name ="'.$name.'"';
    $result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
				return $roww;
			}
		} else {
			return "SQL TOOL ERROR -> getCompanyDetails($name)";
		}
	}
//Returns a list of employees and their information
	public function getEmployees() {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
		$query = "SELECT * FROM employee WHERE disabled=0 ORDER BY fname";
		
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$tickets[] = $row;
			}
			return $tickets;
		} else {
			return "SQL TOOL ERROR -> getEmployees()";
		}
	}
	public function getEmployeeDetails($employee_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
		$query = "SELECT * FROM employee WHERE id='$employee_id'";

		$result = mysql_query($query);
		if($result) 
		{
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result))
			{
				return $roww;
			}
		} 
		else 
		{
			return "SQL TOOL ERROR -> function getIncidentCompany($incident_id)";
		}
	}
	public function getEmployeeHours($tech) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT SUM(hours) AS total_hours FROM tickets WHERE tech="'.$tech.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				return $row['total_hours'];
			}
		} else {
			return "SQL TOOL ERROR -> getEmployeeHours($tech)";
		}
	}
	public function getEmployeeStatusCount($tech, $status) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT COUNT(ticket_id) AS total FROM tickets WHERE tech="'.$tech.'" AND status="'.$status.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				return $row['total'];
			}
		} else {
			return "SQL TOOL ERROR -> getEmployeeClosed($tech)";
		}
	}
	public function getTicketCount($status = NULL, $limit = 1000) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
    
    mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
    
    if ($status) { $status = ' WHERE status="'. ucwords($status).'" '; } else { $status = ''; }
				
		$query = 'SELECT COUNT(ticket_id) AS total FROM tickets ' . $status;
    
		//$query = 'SELECT COUNT(ticket_id) AS total FROM tickets WHERE ';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				return $row['total'];
			}
		} else {
			return "SQL TOOL ERROR -> getTicketCount($tech, $status)";
		}
	}
  	public function getCompanyContactsById($company_id) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT * FROM contacts WHERE company_id="'.$companyid.'" ORDER BY first';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_row($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> getCompanyContactsById($companyName)";
		}
	}
	public function getContactInfo($contacts) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT * FROM contacts WHERE contacts_id="'.$contacts.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_row($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> getContactInfo($contacts_id)";
		}
	}
  	public function getContactInfoById($term) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		//$query = 'SELECT companies_id, name, street_address, office_phone, city, state, zip FROM companies c INNER JOIN contacts cc ON (cc.company = c.name) WHERE c.name LIKE "'. $term .'%" OR  c.office_phone LIKE "'. $term .'%" OR cc.phone LIKE "'. $term .'%" OR cc.mobile_phone LIKE "'. $term .'%" OR  c.street_address LIKE "'. $term .'%" OR cc.first LIKE "'. $term .'%" OR cc.last LIKE "'. $term .'%"';
    $query = 'SELECT * FROM contacts WHERE contacts_id = "'.$term.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
				return $roww;
			}
		} else {
			return "SQL TOOL ERROR -> getContactInfoById($type, $term)";
		}
	}
	public function getEquipmentTickets($equipment_id) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT * FROM tickets WHERE equipment_id="'.$equipment_id.'" ORDER BY update_date DESC, date DESC';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$contacts[] = $row;
        //return $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> getEquipmentTickets($equipment_id)";
		}
	}
	public function getTickets($columnToSort = 'date', $status = NULL, $limit = 1000) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		
		if ($columnToSort == 'date'or $columnToSort == '') { $columnToSort = 'date DESC, company, ticket_id DESC'; }
		if ($columnToSort) { $columnToSort = 'ORDER BY ' . $columnToSort; }
		if ($columnToSort != 'ORDER BY date DESC') { $columnToSort = $columnToSort . ', date DESC'; }

		if ($status) { $status = ' WHERE status="'. ucwords($status).'" '; } else { $status = ''; }
		
		$limit = ' LIMIT '.$limit;
		
		$query = 'SELECT * FROM tickets ' . $status . $columnToSort . $limit;
		//echo $query;
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$tickets[] = $row;
			}
			return $tickets;
		} else {
			return "SQL TOOL ERROR -> getOpenTickets($columnToSort)";
		}
	}
	public function getCompanyTickets($company) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT * FROM tickets WHERE company="'.$company.'" ORDER BY date DESC LIMIT 50';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$tickets[] = $row;
			}
			return $tickets;
		} else {
			return "SQL TOOL ERROR -> getCompanyTickets($company)";
		}
	}
	public function getCaseTickets($case) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT * FROM tickets t WHERE t.case="'.$case.'" ORDER BY date DESC';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$tickets[] = $row;
			}
			return $tickets;
		} else {
			return "SQL TOOL ERROR -> getCaseTickets($case)";
		}
	}
	public function getTechTickets($tech) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT * FROM tickets t WHERE t.tech="'.$tech.'" ORDER BY date DESC';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$tickets[] = $row;
			}
			return $tickets;
		} else {
			return "SQL TOOL ERROR -> getTechTickets($tech)";
		}
	}
	public function getTicket($ticket_id) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		//$query = 'SELECT * FROM tickets t INNER JOIN companies c ON (t.company = c.name) INNER JOIN equipment e ON (e.company = c.name)  WHERE ticket_id='.$ticket_id;
    $query = 'SELECT * FROM tickets WHERE ticket_id='.$ticket_id;
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$tickets[] = $row;
			}
			return $tickets;
		} else {
			return "SQL TOOL ERROR -> getTicket($ticket_id)";
		}
	}
	public function getTicket2($ticket_id) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		//$query = 'SELECT * FROM tickets t INNER JOIN companies c ON (t.company = c.name) INNER JOIN equipment e ON (e.company = c.name)  WHERE ticket_id='.$ticket_id;
    $query = 'SELECT * FROM tickets WHERE ticket_id='.$ticket_id;
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$tickets[] = $row;
			}
			return $tickets;
		} else {
			return "SQL TOOL ERROR -> getTicket2($ticket_id)";
		}
	}
	public function getKBNotes($filterName = '', $filter = '') {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		
		$where = '';
		if ($filterName != '') {
			$where = 'WHERE '.$filterName.'='.$filter;
		}
		$query = 'SELECT ticket_id,
                     ticket_name, 
                     knowledge_base AS KBN 
                     FROM tickets '.$where.' AND knowledge_base IS NOT NULL
                     ORDER BY ticket_name';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				//$notes[] = array('ticket_name' => $row['ticket_name'], 'KBN' => $row['KBN']);
        //$notes[] = array('ticket_name' => $row['ticket_name'], 'KBN' => nl2br_limit($row['KBN'], 2));
        $notes[] = $row;
			}
			return $notes;
		} else {
			return "SQL TOOL ERROR -> >getKBNotes($filterName, $filter)";
		}
	}
	public function getKBNotesByCompanyID($company_id) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		
		$where = '';
		if ($filterName != '') {
			$where = 'WHERE '.$filterName.'='.$filter;
		}
		$query = 'SELECT ticket_name, knowledge_base AS KBN FROM tickets '.$where;
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$notes[] = array('ticket_name' => $row['ticket_name'], 'KBN' => $row['KBN']);
        //$notes[] = array('ticket_name' => $row['ticket_name'], 'KBN' => nl2br_limit($row['KBN'], 2));
        
			}
			return $notes;
		} else {
			return "SQL TOOL ERROR -> >getKBNotesByCompanyID($company_id)";
		}
	}
	public function getKBCompanies() {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='Motiv8me';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		
		$where = '';
		if ($filterName != '') {
			$where = 'WHERE '.$filterName.'='.$filter;
		}
		$query = "SELECT DISTINCT tickets.company_id, companies.name as CompanyName		
              FROM tickets, companies
              WHERE tickets.knowledge_base IS NOT NULL 
	                AND company_id IS NOT NULL 
	                AND company_id = companies_id
                  AND tickets.knowledge_base LIKE '% %'
              ORDER BY companies.name";
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				//$notes[] = array('ticket_name' => $row['ticket_name'], 'KBN' => $row['KBN']);
        //$notes[] = array('ticket_name' => $row['ticket_name'], 'KBN' => nl2br_limit($row['KBN'], 2));
        $notes[] = $row;
			}
			return $notes;
		} else {
			return "SQL TOOL ERROR -> >getKBCompanies($filterName, $filter)";
		}
	}
	public function nl2br_limit($string, $num){
    
    $dirty = preg_replace('/\r/', '', $string);
    $clean = preg_replace('/\n{4,}/', str_repeat('<br/>', $num), preg_replace('/\r/', '', $dirty));
    
    return nl2br($clean);
    }
	public function my_nl2br($string){
        $string = str_replace("\n", "<br />", $string);
        if(preg_match_all('/\<pre\>(.*?)\<\/pre\>/', $string, $match)){
            foreach($match as $a){
                foreach($a as $b){
                $string = str_replace('<pre>'.$b.'</pre>', "<pre>".str_replace("<br />", "", $b)."</pre>", $string);
                }
            }
        }
    return $string;
    }
	public function noApos($string){
        $newstring = str_replace("'", "", "$string");
        
    return $newstring;
    }
	public function changeUserPassword($newPass, $employee_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
		$newPassword = crypt(md5($newPass), '11');
		$query = "UPDATE employee SET site_password='$newPassword' WHERE id='$employee_id'";
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			return $result;
		} else {
			return "SQL TOOL ERROR -> changeUserPassword($newPass, $employee_id)";
		}
	}
	function convertDate2String($inputDate) {
		return substr(date('M d, Y', strtotime($inputDate)), 0, strrpos(date('F d, Y h:i:s A', strtotime($inputDate)), " ") );
	}
	function convertTime2String($inputTime) {
		return substr(date('F d, Y h:i:s A', strtotime($inputTime)), 0, strrpos(date('F d, Y h:i:s A', strtotime($inputTime)), " "));
	}
	
}

?>