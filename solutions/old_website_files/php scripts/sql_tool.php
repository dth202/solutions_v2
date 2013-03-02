<?php

class SqlTool {
	
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
			return "SQL TOOL ERROR -> getCompanyListByFilterValue($filterName)";
		}
	}
	
	public function getCompanyDetails($type, $term) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='9teen6T9';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT name, street_address, office_phone, city, state, zip, main_contact FROM companies c INNER JOIN contacts cc ON (cc.company = c.name) WHERE c.name LIKE "'. $term .'%" OR  c.office_phone LIKE "'. $term .'%" OR cc.phone LIKE "'. $term .'%" OR cc.mobile_phone LIKE "'. $term .'%" OR  c.street_address LIKE "'. $term .'%" OR c.main_contact LIKE "'. $term .'%" OR cc.first LIKE "'. $term .'%" OR cc.last LIKE "'. $term .'%"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				return $row;
			}
		} else {
			return "SQL TOOL ERROR -> getCompanyDetails($type, $term)";
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
	
	public function getCompanyContacts($companyName) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='9teen6T9';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT * FROM contacts WHERE company="'.$companyName.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_row($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> getCompanyContacts($companyName)";
		}
	}
	
	public function getCompanyEquipment($companyName) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='9teen6T9';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT * FROM equipment WHERE company="'.$companyName.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			while($row = mysql_fetch_array($result)){
				$contacts[] = $row;
			}
			return $contacts;
		} else {
			return "SQL TOOL ERROR -> getCompanyEquipment($companyName)";
		}
	}
	
	public function getTickets($columnToSort = 'date', $status = NULL, $limit = 1000) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='9teen6T9';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		
		if ($columnToSort == 'date'or $columnToSort == '') { $columnToSort = 'date DESC'; }
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
		$query = 'SELECT * FROM tickets t INNER JOIN equipment e ON (t.equipment = e.model) INNER JOIN companies c ON (t.company = c.name) WHERE ticket_id='.$ticket_id;
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
	
	public function getUserPassword($user) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='9teen6T9';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT site_password FROM employees WHERE tech_id="'.$user.'" OR email_address="'.$user.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			$passArray = mysql_fetch_row($result);
			return $passArray[0];
		} else {
			return "SQL TOOL ERROR -> getUserPassword($user)";
		}
	}
	
	public function getUserPassword($user) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='9teen6T9';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'SELECT site_password FROM employees WHERE tech_id="'.$user.'" OR email_address="'.$user.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			$passArray = mysql_fetch_row($result);
			return $passArray[0];
		} else {
			return "SQL TOOL ERROR -> getUserPassword($user)";
		}
	}
	
	public function changeUserPassword($newPass, $techid) {
		$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
		$username='513061_intuitiv3';
		$password='9teen6T9';
		$dbname = '513061_intuitive_test_db';
		
		mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		$query = 'UPDATE `employees` SET `site_password`="'.crypt(md5($newPass), '11').'" WHERE `tech_id`="'.$techid.'"';
		$result = mysql_query($query);
		if($result) {
			// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
			//return mysql_result($result);
			return 'era';
		} else {
			return "SQL TOOL ERROR -> changeUserPassword($newPass, $techid)";
		}
	}
	 
	function convertDate2String($inputDate,$dateFormat=1) {
	 /*
	  @format
	  1 - January 1, 1970 12:00:00 AM/PM  # full date and 12 hour format (default)
	  2 - January 1, 1970 23:00:00   # full date and 24 hour format
	  3 - Jan 1, 1970 12:00:00 AM/PM  #short date and 12 hour format
	  4 - Jan 1, 1970 24:00:00 # short date and 24 hour format
	  */
		switch ($dateFormat) {
		   case 1:
				return substr(date('F d, Y h:i:s A', strtotime($inputDate)), 0, strrpos(date('F d, Y h:i:s A', strtotime($inputDate)), " ") - 9);
		   break;
	 
		   case 2:
				return date('F d, Y G:i:s', strtotime($inputDate));
		   break;
	 
		   case 3:
				return date('M d, Y h:i:s A', strtotime($inputDate));
		   break;
	 
		   case 4:
				return date('M d, Y G:i:s', strtotime($inputDate));
		   break;
		}
	}
}

?>