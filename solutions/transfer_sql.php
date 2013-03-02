<?php

	require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	
	//Reset DB
	
	echo $sqlTool->resetDB();
	echo "<br />";
	//sleep(5);
	
	//Echo Status
	function ShowStatus()
	{
		// ob_flush();
		// flush();
		// ob_start();
		// echo str_pad(" ", 4096)."\n";
		//sleep(1);
		
	}
	ShowStatus();
	$companyList = $sqlTool->getCompany_old();
	$contactList = $sqlTool->getContact_old();
	$equipmentList = $sqlTool->getEquipment_old();
	$ticketList = $sqlTool->getTicket_old();
	$maxId = $sqlTool->getMaxId();
	
	//Create placeholder for each table (companies, contacts, equipment, tickets)
	foreach($maxId AS $table => $id)
	{
		//print_r($id);
		if(!IS_NUMERIC($table))
		{
			$con = mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
			mysql_select_db($dbname, $con);
			
			for($i = 1; $i <= $id; $i++)
			{
				$sql = "INSERT INTO $table VALUES()";
				//echo $sql;
				
				if (!mysql_query($sql,$con))
				{
					die('Error: ' . mysql_error());
				}
				else
				{
					//echo "id $i for $table | ";
				}
				
			}
			echo "Created and inserted $table<br />";
		}
	}
	ShowStatus();
	foreach($companyList as $key => $company) 
	{
		$con = mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname'], $con);

		//Update Company information
		mysql_select_db($GLOBALS['dbname'], $con);
		$sqlUpdate = "UPDATE company
					  SET company_name = '$company[name]'
						, company_phone = '$company[office_phone]'
						, website = '$company[website]'
					  WHERE id = '$company[companies_id]'";

		if (!mysql_query($sqlUpdate,$con))
		{
			die('Error: ' . mysql_error());
		}
		
		//Update Company Address
		mysql_select_db($GLOBALS['dbname'], $con);
		$sql = "INSERT INTO company_address 
			  ( company_id
				, address1
				, city
				, state
				, zip)
			VALUES 
			  ( '$company[companies_id]'
				, '$company[street_address]'
				, '$company[city]'
				, '$company[state]'
				, '$company[zip]')";

		if (!mysql_query($sql,$con))
		{
			die('Error: ' . mysql_error());
		}
		
		
    }
	ShowStatus();
	//Delete where they don't exist
	$con = mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
	mysql_select_db($GLOBALS['dbname'], $con);
	$sql = "DELETE FROM  company
			WHERE company_name IS NULL ";

	if (!mysql_query($sql,$con))
	{
		die('Error: ' . mysql_error());
	}
	ShowStatus();
	echo 'Company inserted into company and company_address';
	
	foreach($contactList as $key => $contact) 
	{
		$con = mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname'], $con);
		   
		// $sql = "INSERT INTO transition_contact 
				  // ( contact_id
					// , company_id
					// , email_address_uid
					// , fname
					// , lname
					// , mobile_phone
					// , home_phone)
			  // VALUES 
				  // (   '$contact[contacts_id]'
					// , '$contact[company_id]'
					// , '$contact[email_address]'
					// , '$contact[first]'
					// , '$contact[last]'
					// , '$contact[mobile_phone]'
					// , '$contact[phone]')";
		
		$sql = "UPDATE contact
				SET   company_id = '$contact[company_id]'
					, email_address_uid = '$contact[email_address]'
					, fname = '$contact[first]'
					, lname = '$contact[last]'
					, mobile_phone = '$contact[mobile_phone]'
					, home_phone = '$contact[phone]'
				WHERE id = '$contact[contacts_id]'";

		if (!mysql_query($sql,$con))
		{
			die('Error: ' . mysql_error());
		}

		//echo "1 record added";
	}
	
	mysql_select_db($GLOBALS['dbname'], $con);
	$sql = "DELETE FROM  contact
			WHERE fname IS NULL ";

	if (!mysql_query($sql,$con))
	{
		die('Error: ' . mysql_error());
	}
	
	echo '<br />contacts inserted into transition_contact';
      
    ShowStatus();
	foreach($equipmentList as $key => $equipment) 
	{
		$notes = $sqlTool->noApos($equipment[notes]);
		$system_information = $sqlTool->noApos($equipment[system_information]);
		
		$con = mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname'], $con);
		   
		// $sql = "INSERT INTO transition_equipment 
				  // ( failed_equipment_id
					// , pc_name
					// , company
					// , company_id
					// , model
					// , serial
					// , os
					// , notes
					// , system_information
					// , install_date)
			  // VALUES 
				  // (   '$equipment[failed_equipment_id]'
					// , '$equipment[pc_name]'
					// , '$equipment[company]'
					// , '$equipment[company_id]'
					// , '$equipment[model]'
					// , '$equipment[serial]'
					// , '$equipment[os]'
					// , '$notes'
					// , '$system_information'
					// , '$equipment[install_date]')";
		
		$sql = "UPDATE equipment
				SET device_name = '$equipment[pc_name]'
					, company_id = '$equipment[company_id]'
					, model = '$equipment[model]'
					, serial = '$equipment[serial]'
					, os = '$equipment[os]'
					, notes = '$notes'
					, system_information = '$system_information'
					, installed_date = '$equipment[install_date]'
				WHERE id = $equipment[failed_equipment_id]";

		if (!mysql_query($sql,$con))
		{
		die('Error: ' . mysql_error());
		}

		//echo "1 equipment added";
	}
	
    mysql_select_db($GLOBALS['dbname'], $con);
	$sql = "DELETE FROM  equipment
			WHERE device_name IS NULL ";

	if (!mysql_query($sql,$con))
	{
		die('Error: ' . mysql_error());
	}
	echo '<br />equipment inserted into transition_equipment';
    
	include('create_equipment_other.php');

	echo '<br />';
      
    // print_r($ticketList);
	
	ShowStatus();
	foreach($ticketList as $key => $ticket) 
	{
		$problem_description = $sqlTool->noApos($ticket[problem_description]);
		$work_preformed = $sqlTool->noApos($ticket[work_preformed]);
		$equipment = $sqlTool->noApos($ticket[equipment]);
		$user = $sqlTool->noApos($ticket[user]);
		$knowledge_base = $sqlTool->noApos($ticket[knowledge_base]);
		$needs = $sqlTool->noApos($ticket[needs]);
		$ticket_name = $sqlTool->noApos($ticket[ticket_name]);
		
		$completed_date = $ticket[date];
		$status = $ticket[status];//'Tech';
		if($ticket[status] != "Closed")
		{ 
			$completed_date = '0000-00-00';
			
		}
		$source = $ticket[tech];
		if($ticket[online_request] == 1)
				$source = 'Online Request';
		$equipment_id = $ticket[equipment_id];		
		//echo "<br />ticket_id: $ticket[ticket_id]<br />ticket equipment:$ticket[equipment_id]<br />";
		
		if(!$equipment_id || $equipment_id== 0 || $equipment_id=="")
		{
			$equipment_id = $sqlTool->getOtherEquipmentId($ticket[company_id]);
		}
		
		
		$con = mysql_connect($GLOBALS['hostname'],$GLOBALS['username'], $GLOBALS['password']) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($GLOBALS['dbname'], $con);
		/*   
		$sql_old = "INSERT INTO transition_tickets
				  ( ticket_id
					, ticket_name
					, case1
					, equipment_id
					, equipment
					, date
					, problem_description
					, work_preformed
					, needs
					, status
					, hours
					, company
					, company_id
					, user1
					, tech
					, knowledge_base
					, milage
					, drive_time
					, customer_signature
					, technician_signature
					, contactOption_id
					, contactOption
					, quantity
					, vendor
					, part_id
					, part_description
					, serial
					, price
					, update_tech
					, update_date
					, online_request)
			  VALUES 
				  (   '$ticket[ticket_id]'
					, '$ticket_name'
					, '$ticket[case]'
					, '$ticket[equipment_id]'
					, '$equipment'
					, '$ticket[date]'
					, '$problem_description'
					, '$work_preformed'
					, '$needs'
					, '$ticket[status]'
					, '$ticket[hours]'
					, '$ticket[company]'
					, '$ticket[company_id]'
					, '$user'
					, '$ticket[tech]'
					, '$knowledge_base'
					, '$ticket[milage]'
					, '$ticket[drive_time]'
					, '$ticket[customer_signature]'
					, '$ticket[technician_signature]'
					, '$ticket[contactOption_id]'
					, '$ticket[contactOption]'
					, '$ticket[quantity]'
					, '$ticket[vendor]'
					, '$ticket[part_id]'
					, '$ticket[part_description]'
					, '$ticket[serial]'
					, '$ticket[price]'
					, '$ticket[update_tech]'
					, '$ticket[update_date]'
					, '$ticket[online_request]')";
		*/
		
		$sql = "UPDATE problem
				SET problem_name = '$ticket_name'
					, created_date = '$ticket[date]'
					, problem_description = '$problem_description'
				WHERE id = $ticket[ticket_id]";
		
		if (!mysql_query($sql,$con))
		{
		die('Error: ' . mysql_error());
		}
		
		// $sql2 = "INSERT INTO incident (
					  // problem_id
					// , company_id
					// , contact_id
					// , follow_up
					// , created_date
					// , completed_date
					// , status
					// , source)
				// VALUES (
					  // $ticket[ticket_id]
					// , $ticket[company_id]
					// , '$ticket[contactOption_id]'
					// , '$needs'
					// , '$ticket[date]'
					// , '$completed_date'
					// , '$status'
					// , '$source')";
					
		$sql2 = "UPDATE incident 
				 SET problem_id = $ticket[ticket_id]
					, company_id = $ticket[company_id]
					, contact_id = '$ticket[contactOption_id]'
					, employee_id = '$ticket[tech]'
					, follow_up = '$needs'
					, created_date = '$ticket[date]'
					, completed_date = '$completed_date'
					, status = '$status'
					, source = '$source'
				 WHERE id = $ticket[ticket_id]";
		
		if (!mysql_query($sql2,$con))
		{
			die('Error: ' . mysql_error().'<br />'.$sql2);
		}
		//Get latest incident_id
		$incident_id = $sqlTool->getLatestIncidentId();
		
		$sql3 = "INSERT INTO work_performed (
					date
					, incident_id
					, employee_id)
				VALUES
					( '$ticket[date]'
					 , $ticket[ticket_id]
					 , '$ticket[tech]')";
		//if($ticket[ticket_id] == 418 || $ticket[ticket_id] == 417)
			
			
		if (!mysql_query($sql3,$con))
		{
			die('Error: ' . mysql_error());
		}
		
		
		
		$work_performed_id = $sqlTool->getLatestWorkPerformedId();
		
		//echo "Equipment: $equipment_id <br />";
		$sql4 = "INSERT INTO equipment_work_performed(
					  equipment_id 
					, work_performed_id
					,  work_performed
					,  start_time
					,  end_time)
				VALUES
					( $equipment_id
					, $work_performed_id
					, '$work_preformed'
					, ''
					, '')";
		
		if (!mysql_query($sql4,$con))
		{
			die('Error: ' . mysql_error());
		}
		
		if($knowledge_base)
		{
			$sql5 = "insert into kbn (
						kbn_name
						, details
						, equipment_id
						, company_id
						, date)
					values (
						  '$ticket_name'
						, '$knowledge_base'
						, '$equipment_id'
						, $ticket[company_id]
						, '$ticket[date]')";
			
			if (!mysql_query($sql5,$con))
			{
			die('error: ' . mysql_error());
			}
		}
		
		$sql6 = "INSERT INTO travel(
					   work_performed_id
					,  depart_time1
					,  arrive_time1
					,  depart_milage1
					,  arrive_milage1
					,  depart_time2
					,  arrive_time2
					,  depart_milage2
					,  arrive_milage2)
				VALUES
					( $work_performed_id
					, '00:00:00'
					, '00:00:00'
					, '0'
					, '0'
					, '00:00:00'
					, '00:00:00'
					, '0'
					, '0')";
		
		if (!mysql_query($sql6,$con))
		{
			die('Error: ' . mysql_error());
		}
	}
    
	echo 'tickets inserted into problem, incident, work_performed, kbn';
	ShowStatus();
      
      
?>