<?php
    header('Content-Type: text/html; charset=utf-8');
    require_once ('connect.php');
    
    #enable Arabic characters support
    mysqli_set_charset($dbconn,'utf8');
    
    //print_r($_POST);

    $strsql = "INSERT INTO tbl_employees (emp_name, emp_jobTitleID, emp_departmentID, emp_martialStatusID, emp_InsuredID,emp_notes) VALUES (\"" . $_POST["new_employee"] . "\",1," . $_POST["department"] . ",1,1,\"\")";
 
    phpAlert($strsql,0);
    
    if ($dbconn->connect_errno){
            echo 'Could not connect to mysql';
            echo "Errno:". $dbconn->connect_errno . "\n";
            echo "Error:". $dbconn->connect_error . "\n";
        } else {        
            if (!$result = $dbconn->query($strsql)){
                echo "Sorry, there was an error inserting new employee's data!";
                exit;
            } 
            $mymsg = "New employee " . $_POST["new_employee"] . " inserted! ";
            phpAlert ($mymsg,1);
    }
    #echo "Result: " . $strsql; 
    
    $dbconn->close;

    function phpAlert($msg,$gohome) {
        if ($gohome==1){ 
            echo '<script type="text/javascript">alert("' . $msg . '");window.location=\'index.php\';</script>';
        } else {'<script type="text/javascript">alert("' . $msg . '");</script>'; }
    }
