<?php
      /*
      $hostname='mysql50-60.wc2.dfw1.stabletransit.com';
      $username='513061_intuitiv3';
      $password='9teen6T9';
      $dbname = '513061_intuitive_test_db';

      */
$hostname='mysql50-33.wc2.dfw1.stabletransit.com';
$username='513061_solutions';
$password='9teen6T9';
$dbname = '513061_solutions';

$hostname_old='mysql50-60.wc2.dfw1.stabletransit.com';
$username_old='513061_intuitiv3';
$password_old='9teen6T9';
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
  foreach ($incidentDetails as $key => $value)
              echo $key.': '.$value.'<br />';
  */
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
                    LEFT JOIN company_address ON company.id = company_address.company_id
                  ORDER BY company_name';
			  
        $result = mysql_query($query);
		    if($result) {
			    // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			    while($row = mysql_fetch_array($result)){
				    $company[] = $row;
			    }
			    return $company;
		    } else {
			    return "SQL TOOL ERROR -> getCompanyList()";
		    }
    }
    public function getCompanyDetails($company_id) {
      mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  	mysql_select_db($GLOBALS['dbname']);
      
		  $query = 'SELECT * 
                FROM company 
                WHERE id = '.$company_id;
			  
      $result = mysql_query($query);
		  if($result) {
			  // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			  while($roww = mysql_fetch_array($result)){
				  return $roww;
			  }
		  } else {
			  return "SQL TOOL ERROR -> getCompanyDetails($company_id)";
		  }
    }
    public function getCompanyAddress($company_id) {
	    
      mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  	mysql_select_db($GLOBALS['dbname']);
      
	    $query = 'SELECT * 
                FROM company_address
                  JOIN company ON company_address.company_id = company.id
                WHERE company.id = '.$company_id;
	    $result = mysql_query($query);
		    if($result) {
			    // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			    while($row = mysql_fetch_array($result)){
				    $company[] = $row;
			    }
			    return $company;
		    } else {
		    return "SQL TOOL ERROR -> getCompanyAddress($company_id)";
		  }
	  }
	 public function getCompanyContacts($company_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']);
    
		$query = 'SELECT * FROM contact WHERE company_id='.$company_id.' ORDER BY fname';
	  $result = mysql_query($query);
		    if($result) {
			    // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			    while($row = mysql_fetch_array($result)){
				    $company[] = $row;
			    }
		  return $company;
		} else {
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
  
  public function getProblemIncident($problem_id, $incident_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
    if($incident_id != 0)
      $incident_id = "AND incident.id = $incident_id";
    else
      $incident_id = "";
    
		$query = "SELECT incident.id AS incident_id
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
                JOIN problem AS p ON p.id = incident.problem_id
                JOIN company ON company_id = company.id
                LEFT JOIN contact ON incident.contact_id = contact.id
              WHERE p.id=$problem_id
                    $incident_id 
              ORDER BY completed_date DESC, incident.created_date DESC";
          
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> getProblemIncident($problem_id)";
		}
	}
  
  public function getProblemDetails($problem_id) {
      mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  	mysql_select_db($GLOBALS['dbname']);
      
		  $query = 'SELECT * 
                FROM problem
                  JOIN employee ON problem.employee_id = employee.id
                WHERE problem.id = '.$problem_id;
			  
      $result = mysql_query($query);
		  if($result) {
			  // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			  while($roww = mysql_fetch_array($result)){
				  return $roww;
			  }
		  } else {
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
  public function getIncidentWorkPerformed($incident_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
    
		$query = 'SELECT * 
              FROM work_performed
              WHERE incident_id = '.$incident_id;
          
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> getIncidentWorkPerformed($incident_id)";
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
  
  public function equipment_work_performed($work_performed_id) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
    
		$query = 'SELECT * 
              FROM equipment_work_performed
                JOIN equipment ON equipment_work_performed.equipment_id = equipment.id
              WHERE work_performed_id = '.$work_performed_id;
          
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
  
  public function submitProblem($problem) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "INSERT INTO problem ( problem_name
                                   , created_date
                                   , problem_description
                                   , category
                                   , employee_id)
              VALUES( '$problem[problem_name]'
                     , '$problem[created_date]'
                     , '$problem[problem_description]'
                     , '$problem[category]'
                     , '$problem[employee_id]')";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> submitProblem($problem)";
		}
	}
  public function insertIncident($problem_id, $incident) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "INSERT INTO incident ( problem_id
                                    , created_date
                                    , completed_date
                                    , company_id
                                    , follow_up
                                    , status)
              VALUES( '$problem_id'
                     , '$incident[created_date]'
                     , '$incident[completed_date]'
                     , '$incident[company_id]'
                     , '$incident[follow_up]'
                     , '$incident[status]')";
        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> insertIncident($problem_id, $incident)";
		}
	}
  public function updateIncident($incident) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	  mysql_select_db($GLOBALS['dbname']); 
                  
		$query = "UPDATE incident 
              SET follow_up = '$incident[follow_up]'
                , status = '$incident[status]'
                , source = '$incident[source]'
                , contact_id = '$incident[contact_id]'
                , completed_date = '$incident[completed_date]'
             WHERE id = $incident[incident_id]";

        
		$result = mysql_query($query);
		if($result) {
			$submit = 'true';
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> updateIncident($incident)";
		}
	}
  public function insertWorkPerformed($incident) {
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
			$submit = 'true';
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> insertIncident($problem_id, $incident)";
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
            ORDER BY created_date DESC";
          
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
  public function getLatestProblem_id() {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
    $query = 'SELECT MAX(id) AS problem_id FROM problem';
		
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
  
  public function getLatestIncident_id() {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		
    $query = 'SELECT MAX(id) AS incident_id FROM incident';
		
    $result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
				return $roww;
			}
		} else {
			return "SQL TOOL ERROR -> getLatestIncident_id()";
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
		
    $query = "SELECT CAST((end_time - start_time) AS time) AS total_time
              FROM work_performed AS wp
                  JOIN equipment_work_performed AS e_wp ON wp.id = e_wp.work_performed_id
              WHERE wp.id = $work_performed_id
                    AND wp.employee_id = '$employee_id'";
		
    $result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($roww = mysql_fetch_array($result)){
				return $roww[total_time];
			}
		} else {
			return "SQL TOOL ERROR -> getWorkPerformedTotalTime($work_performed_id)";
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
    
    public function getTicket_old() {
        mysql_connect($GLOBALS['hostname_old'],$GLOBALS['username_old'], $GLOBALS['password_old']) OR DIE ('Unable to connect to database! Please try again later.');
	  	  mysql_select_db($GLOBALS['dbname_old']);
      
		    $query = 'SELECT * 
                  FROM tickets
                  ORDER BY ticket_id';
			  
        $result = mysql_query($query);
		    if($result) {
			    // See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			    while($row = mysql_fetch_array($result)){
				    $company[] = $row;
			    }
			    return $company;
		    } else {
			    return "SQL TOOL ERROR -> getTicket_old()";
		    }
    }
  
	public function getCompanyNames() {
		if ($this->companies == null) {
			$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
			$username='513061_intuitiv3';
			$password='9teen6T9';
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
			$password='9teen6T9';
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
		$password='9teen6T9';
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
  
  public function getNewTicketId($term) {
		mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname']);
		$query = 'SELECT MAX(ticket_id) AS newTicket FROM tickets';
		
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
	public function getCompanyDetailsId($name) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='9teen6T9';
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
  
	public function getEmployeeDetails($tech) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='9teen6T9';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT * FROM employees WHERE tech_id="'.$tech.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				return $row;
			}
		} else {
			return "SQL TOOL ERROR -> getEmployeeDetails($tech)";
		}
	}
	
	public function getEmployeeHours($tech) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='9teen6T9';
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
		$password='9teen6T9';
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
		$password='9teen6T9';
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
		$password='9teen6T9';
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
		$password='9teen6T9';
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
		$password='9teen6T9';
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
	
	
	public function getEquipmentInfo($equipment_id) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='9teen6T9';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT * FROM equipment WHERE failed_equipment_id="'.$equipment_id.'"';
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
  public function getEquipmentTickets($equipment_id) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='9teen6T9';
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
		$password='9teen6T9';
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
		$password='9teen6T9';
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
		$password='9teen6T9';
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
		$password='9teen6T9';
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
		$password='9teen6T9';
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
		$password='9teen6T9';
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
		$password='9teen6T9';
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
		$password='9teen6T9';
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
		$password='9teen6T9';
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
	
	
	public function changeUserPassword($newPass, $techid) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='9teen6T9';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'UPDATE employees SET `site_password`="'.crypt(md5($newPass), '11').'" WHERE `tech_id`="'.$techid.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			return $result;
		} else {
			return "SQL TOOL ERROR -> changeUserPassword($newPass, $techid)";
		}
	}
	 
	function convertDate2String($inputDate) {
		return substr(date('F d, Y h:i:s A', strtotime($inputDate)), 0, strrpos(date('F d, Y h:i:s A', strtotime($inputDate)), " ") - 9);
	}
}

?>