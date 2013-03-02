<?php

  require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
  
  
	$list_o_companies = $sqlTool->getCompany_old();
	$contactList = $sqlTool->getContact_old();
  $equipmentList = $sqlTool->getEquipment_old();
  $ticketList = $sqlTool->getTicket_old();
    
            foreach($list_o_companies  as $key => $company) {
            
				    //  echo '<tr>';
					  //    echo '<td><a style="font-size:110%;" href="company.php?company_id='.$company[companies_id].'">' . $company[name] . '</a></td>';
					  //    echo '<td>'.$company[city].'</td>';
					  //    echo '<td>'.$company[office_phone].'</td>';
				    //  echo '</tr>';
              
              $hostname='mysql50-33.wc2.dfw1.stabletransit.com';
              $username='513061_solutions';
              $password='9teen6T9';
              $dbname = '513061_solutions';
			
              $con = mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
              mysql_select_db($dbname, $con);
               
              $sql = "INSERT INTO transition_company 
                  ( companies_id
                    , name
                    , office_phone
                    , street_address
                    , city
                    , state
                    , zip
                    , website)
              VALUES 
                  (
                    '$company[companies_id]'
                    , '$company[name]'
                    , '$company[office_phone]'
                    , '$company[street_address]'
                    , '$company[city]'
                    , '$company[state]'
                    , '$company[zip]'
                    , '$company[website]')";

              if (!mysql_query($sql,$con))
                {
                die('Error: ' . mysql_error());
                }
      }
      echo 'Company inserted into transition_company';
    

      foreach($contactList as $key => $contact) {
          //echo $contact[contacts_id].' - '.$contact[first].' '.$contact[first];
          
          $hostname='mysql50-33.wc2.dfw1.stabletransit.com';
          $username='513061_solutions';
          $password='9teen6T9';
          $dbname = '513061_solutions';
			
          $con = mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
          mysql_select_db($dbname, $con);
               
          $sql = "INSERT INTO transition_contact 
                      ( contact_id
                        , company_id
                        , email_address_uid
                        , fname
                        , lname
                        , mobile_phone
                        , home_phone)
                  VALUES 
                      (   '$contact[contacts_id]'
                        , '$contact[company_id]'
                        , '$contact[email_address]'
                        , '$contact[first]'
                        , '$contact[last]'
                        , '$contact[mobile_phone]'
                        , '$contact[phone]')";

          if (!mysql_query($sql,$con))
            {
            die('Error: ' . mysql_error());
            }
  
          //echo "1 record added";
      }
      echo '<br />contacts inserted into transition_contact';
      
      
      foreach($equipmentList as $key => $equipment) {
          $notes = $sqlTool->noApos($equipment[notes]);
          //echo $model;
          //echo '<tr>
          //        <td>'.$equipment[failed_equipment_id].'</td>
          //              <td>'.$equipment[pc_name].'</td>
          //              <td>'.$equipment[company].'</td>
          //              <td>'.$equipment[company_id].'</td>
          //              <td>'.$equipment[model].'</td>
         //               <td>'.$equipment[serial].'</td>
          //              <td>'.$equipment[os].'</td>
          //              <td>'.$notes.'</td>
          //              <td>'.$equipment[system_information].'</td></tr>';
                        
          
          
          $hostname='mysql50-33.wc2.dfw1.stabletransit.com';
          $username='513061_solutions';
          $password='9teen6T9';
          $dbname = '513061_solutions';
			
          $con = mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
          mysql_select_db($dbname, $con);
               
          $sql = "INSERT INTO transition_equipment 
                      ( failed_equipment_id
                        , pc_name
                        , company
                        , company_id
                        , model
                        , serial
                        , os
                        , notes
                        , system_information
                        , install_date)
                  VALUES 
                      (   '$equipment[failed_equipment_id]'
                        , '$equipment[pc_name]'
                        , '$equipment[company]'
                        , '$equipment[company_id]'
                        , '$equipment[model]'
                        , '$equipment[serial]'
                        , '$equipment[os]'
                        , '$notes'
                        , '$equipment[system_information]'
                        , '$equipment[install_date]')";

          if (!mysql_query($sql,$con))
            {
            die('Error: ' . mysql_error());
            }
  
          //echo "1 equipment added";
      }
      
      echo '<br />equipment inserted into transition_equipment';
      
      
      
       foreach($ticketList as $key => $ticket) {
          
          $problem_description = $sqlTool->noApos($ticket[problem_description]);
          $work_preformed = $sqlTool->noApos($ticket[work_preformed]);
          $equipment = $sqlTool->noApos($ticket[equipment]);
          $user = $sqlTool->noApos($ticket[user]);
          $knowledge_base = $sqlTool->noApos($ticket[knowledge_base]);
          $needs = $sqlTool->noApos($ticket[needs]);
          $ticket_name = $sqlTool->noApos($ticket[ticket_name]);
          
          $hostname='mysql50-33.wc2.dfw1.stabletransit.com';
          $username='513061_solutions';
          $password='9teen6T9';
          $dbname = '513061_solutions';
			
          $con = mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
          mysql_select_db($dbname, $con);
               
          $sql = "INSERT INTO transition_tickets
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

          if (!mysql_query($sql,$con))
            {
            die('Error: ' . mysql_error());
            }
          
          //echo "1 ticket added";
      }
      
      echo '<br />tickets inserted into transition_tickets';
      
      
?>