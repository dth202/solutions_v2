<?php
    /*
	// Fetch the ID, and validate it
    ($groupID = @$_GET['gid']) or $groupID = null;
    
    if(!is_numeric($groupID) || $groupID <= 0) {
        // Validation failed. Exit without returning a valid result.
        die("No results");
    }
    
    // Connect to mysql
    $dbLink = new mysqli('mysql50-60.wc2.dfw1.stabletransit.com', '513061_intuitiv3', '9teen6T9', '513061_intuitive_test_db');
    if(mysqli_connect_errno()) {
        echo 'MySQL connection failed:', mysqli_connect_error();
    }
     
    // Fetch items
    //$result = @mysql_query("SELECT * FROM 513061_intuitive_test_db.contacts ORDER BY company, first");
    $sql = "SELECT * FROM 513061_intuitive_test_db.contacts ORDER BY company, first"; //WHERE company_id = $groupID
    $result = @mysql_query($sql) or die("Query failed: ". $dbLink->error);
     
    // Create a CSV-style output
    while($row = mysql_fetch_assoc($result)) {
        $contacts_id = $row['contacts_id'];
        $first = $row['first'];
				$last = $row['last'];
				$company = $row['company'];
				print "<option value=\"$contacts_id\">$company - $first $last</option>";
        //echo $row['contacts_id'], ",", $row['last'], "\n";
    }
     
    $result->close();
    $dbLink->close();
	*/
?>