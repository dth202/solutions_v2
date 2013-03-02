<?php
    $problem = $sqlTool->getProblemDetails($problem_id);
    
    echo '<table class="shadow">
          <caption>Problem Details<caption>
          <tr>
            <td><h3><a href="problem.php?problem_id='.$problem_id.'">'.$problem[problem_name].'</a></h3></td>
          </tr>
          <tr>
            <td>'. $sqlTool->convertDate2String($problem[created_date]).'</td>
          </tr>
          <tr>
            <td><em><a href=employee.php?employee_id='.$problem[employee_id].'>'.$problem[fname].' '.$problem[lname].'</a></em></td>
          </tr>
          <tr>
            <td>'.$problem[category].'</td>
          </tr>';
      echo '<tr>
              <td><h4>Problem Description</h4></td>
            </tr>
            <tr>
              <td><blockquote>'.$sqlTool->nl2br_limit($problem[problem_description]).'</blockquote></td>
            </tr>';
      echo '</table>'; 
    
 
?>