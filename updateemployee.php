<?php
    header('Content-Type: text/html; charset=utf-8');
    require_once ('connect.php');
    
    #enable Arabic characters support
    mysqli_set_charset($dbconn,'utf8');
    
    //print_r($_POST);

    $strsql = "UPDATE tbl_employees SET emp_JobTitleID=" . $_POST["emp_jobtitle"] . ", emp_departmentID=" . $_POST["department"] . " WHERE emp_id=" . $_POST["employee_id"] . ";";
 
    phpAlert($strsql,0);
    
    if ($dbconn->connect_errno){
            echo 'Could not connect to mysql';
            echo "Errno:". $dbconn->connect_errno . "\n";
            echo "Error:". $dbconn->connect_error . "\n";
        } else {        
            if (!$result = $dbconn->query($strsql)){
                echo 'Sorry, there was an error updating the employees data!';
                exit;
            } 
            $mymsg = "Data updated for " . $_POST["employee_name"];
            phpAlert ($mymsg,1);
    }
    #echo "Result: " . $strsql; 
    
    $dbconn->close;

    function phpAlert($msg,$gohome) {
        if ($gohome==1){ 
            echo '<script type="text/javascript">alert("' . $msg . '");window.location=\'index.php\';</script>';
        } else {'<script type="text/javascript">alert("' . $msg . '");</script>'; }
    }
