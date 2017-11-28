<?php
//    header('Content-Type: text/html; charset=utf-8');
//    
    require_once ('connect.php');
//    
    #enable Arabic characters support
    mysqli_set_charset($dbconn,'utf8');
    
//    //$mymsg = print_r($_POST);


    $strsql = "SELECT tbl_employees.emp_id, tbl_employees.emp_name, ";
    $strsql .= " tbl_martialStatus.ms_status AS 'empMaritalS',";
    $strsql .= " tbl_insurance.ins_InsurringCompany AS 'Ins',";
    $strsql .= " tbl_employees.emp_salary";
    $strsql .= " FROM tbl_employees ";
    $strsql .= " INNER JOIN tbl_martialStatus ON ";
    $strsql .= " tbl_martialStatus.ms_id = tbl_employees.emp_martialStatusID ";
    $strsql .= " INNER JOIN tbl_insurance ON";
    $strsql .= " tbl_employees.emp_InsuredID = tbl_insurance.ins_id ";
    $strsql .= " WHERE emp_id=" .  $_POST["emp_id"] . ";";

    if ($dbconn->connect_errno){
            echo 'Could not connect to mysql';
            echo "Errno:". $dbconn->connect_errno . "\n";
            echo "Error:". $dbconn->connect_error . "\n";
    } else {        
        if (!$result = $dbconn->query($strsql)){
            echo 'Sorry, there was an error while retrieving the employees data!\n';
            //echo "strsql: " . $strsql; 
            exit;
        }
        
        if($result->num_rows > 0){
                $emp_details = "";
                while ($rowemp = $result->fetch_assoc()){
                	$emp_details .= "<table><tr>";
                    $emp_details .= "<td width=40%> الرقم الوظيفي: </td><td><b>". $rowemp["emp_id"] . "</b></td></tr>\n";
                	$emp_details .= "<tr><td width=40%>المعاش الشهري:</td><td><b>" . number_format($rowemp["emp_salary"]) . "</b></td></tr>\n";
                	$emp_details .= "<tr><td width=40%>الوضع الإجتماعي: </td><td><b>" . $rowemp["empMaritalS"] . "</b></td></tr>\n";
                    $emp_details .= "<tr><td width=40%>التأمين: </td><td><b>" . $rowemp["Ins"]. "<b></td></tr></table>";
                    //$emp_details[1] = $rowemp["emp_name"];
                    //console.log ($emp_details[0]);
                }
            
            echo $emp_details;
    }
    $dbconn->close;
    }

    ?>