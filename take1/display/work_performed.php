<?php
  echo "<table class='shadow'>
        <caption>Work Performed<a href='/solutions/work_performed.php?edit=insert&incident_id=$incident_id'><img class='add' src='/images/add.jpg' /></a></caption>";
        
        
  foreach($work_performed as $key => $details) {   
      echo "<tr><td>
            <table>
              <caption style='text-align: left;'>";
                $total_time = $sqlTool->getWorkPerformedTotalTime($details[id], $_SESSION[user_name]);
                
                $date = $sqlTool->convertDate2String($details[date]);
                if ($_SESSION[user_name] == $details[employee_id])
                  echo "<a title='Edit Date' href='work_performed.php?work_performed_id=$details[id]&edit=update'>$date</a>";
                else
                  echo "$details[date]";
                echo "<br/>$details[employee_id]<br />
                Total Time: $total_time<hr/>
              </caption>
              
              <th>Equipment<a href='work_performed.php?edit=insert&work_performed_id=$details[id]'><img class='add' src='/images/add.jpg' /></a></th>
              <th>Start Time</th>
              <th>End Time</th>";
      
            $equipment = $sqlTool->equipment_work_performed($details[id]);      
            foreach($equipment as $key => $equipment_details) {   
            $work_performed_br = $sqlTool->nl2br_limit($equipment_details[work_performed]);
                echo "<tr>
                        <td style='width: 33%;'><a href='equipment.php?equipment_id=$equipment_details[equipment_id]'>$equipment_details[device_name] - $equipment_details[model]</a></td>
                        <td>$equipment_details[start_time]</td>
                        <td>$equipment_details[end_time]</td>
                      </tr><tr>
                        <td>
                        <td colspan='2'>$work_performed_br</td>
                      </tr>";

                }
      echo "</table></td></tr>";
	  }
    
   echo "</table>";
     
?>