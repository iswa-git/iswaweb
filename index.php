<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
	<title>
   	ISWA test
   </title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
       
    <!-- bootbox
    <script src="bootbox.min.js"></script>
     -->
    
    <!-- jQuery -->
    <script src="jquery-3.2.1.min.js"></script>
    
    <!-- DataTable -->
    <script type="text/javascript" charset="utf-8" src="DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
    
    <!-- Buttons -->	    
    <script type="text/javascript" charset="utf-8" src="DataTables/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="DataTables/Buttons-1.4.2/js/buttons.print.min.js"></script>
    <link rel="stylesheet" type="text/css" href="DataTables/Buttons-1.4.2/css/buttons.dataTables.min.css" />

    <!-- jQueryUI -->
    <script type="text/javascript" charset="utf-8" src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery-ui-1.12.1/jquery-ui.min.css" /> 
    
    <!-- PDF export 
    <script type="text/javascript" charset="utf-8" src="DataTables/pdfmake-0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="DataTables/pdfmake-0.1.32/vfs_fonts.js"></script>
    -->
    
     <link rel="stylesheet" type="text/css" href="styles.css" >
     
    <script type="text/javascript">
        function updatecombo(t) {
            var y = document.getElementsByName(t.name);
            y.value = t.value;
        }
    </script>
    <script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

    <script>
    /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    } 
    </script>
    
    <script>
		$(document).ready(function() {
            var empTable= $('#employees_table').dataTable( {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'اكسل'
                    },  
                    {
                        extend:'csv',
                        text: 'تحويل إلى CSV',
                        charset: 'UTF-16LE',
                        bom:true
                    },
                    {
                        extend: 'print',
                        text: 'طباعة',
                        title: 'لائحة بالموظفين',
                        exportOptions: { stripHtml: false },
                              customize: function (win) {
                                  $(win.document.body)
                                    .css('font-size', '16pt' )
                                    .prepend('<img src="http://iswa.ibrik.net/images/logofade.png" style="position:absolute; top:10; left:10		;" />');
                                    $(win.document.body).find('table' )
                                        .addClass('compact' )
                                        .css('font-size', 'inherit' );
                                }
                    },
                    {
                        extend: 'copy',
                        text: 'نقل'
                    }
                ],
                "iDisplayLength":-1 ,
                "bPaginate": false,
                "language": {
                    "sProcessing":   "جارٍ التحميل...",
                    "sLengthMenu":   "أظهر _MENU_ سجلات",
                    "sZeroRecords":  "لم يعثر على أية سجلات",
                    "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ سجل",
                    "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ سجل)",
                    "sInfoThousands":	",",
                    "sInfoPostFix":  "",
                    "sSearch":       "ابحث:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "الأول",
                        "sPrevious": "السابق",
                        "sNext":     "التالي",
                        "sLast":     "الأخير"
                    } //end oPginate
                } //end language
            }) // end var empTable = employees_table.dataTable
            
            $('.dataTable').on('dblclick', 'tbody tr', function(){
                $("#empmoreinfo").dialog({autoOpen: false});
                //console.log('Log: ', this.textContent);
                var aData = empTable.fnGetData(this);
                var empname = aData[1];
                var empid = aData[0];
                //console.log ("aData1: ", aData[1]);
                $.ajax({    
                    url: 'empdetails.php',
                    type: 'POST',
                    data: {emp_id: aData[0]},
                    success: function (result){
                        var empmoreinfotext = result;
                        $("#empmoreinfo").html(empmoreinfotext);
                        $("#empmoreinfo").dialog("open" );
                        $("#empmoreinfo").dialog ({
                            modal: true,
                            resizable: true,
                            closeOnEscape: true,
                            title: "  معلومات إضافية عن  " + empname,
                            draggable: false,
                            minWidth: 200,
                            maxWidth:500,
                            position: "center",
                            dialogClass: 'ui-dialog-content'
                        })//.prev(".dialogempmoreinfo").css("background", "red") //end dialog
                    } // end success
                }) // end ajax
            }) //end on dblclick
            
            empTable.fnSetColumnVis(0,false);
	});
    </script>
</head>

<body  dir="rtl">
        <div class="topnav" id="myTopnav">
        <a href="#home" class="active">Home</a>
        <a href="#news">News</a>
        <a href="#contact">Contact</a>
        <a href="#about">About</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
    </div> 
    <h1 style='text-align:center'>أهلا بكم</h1>
    <p>السلام عليكم <br /> لائحة بالأسماء </p>
    <div id="empmoreinfo" title="Employee more info"></div>

    <?php
        #header('Content-Type: text/html; charset=utf-8');
        
        require_once('connect.php');
        require_once('sqls.php');
        
        # show errors in browser
        ini_set('display_errors', 'On');
        error_reporting(E_ALL | E_STRICT);
    
        #enable Arabic characters support
        mysqli_set_charset($dbconn,'utf8');
        
        if ($dbconn->connect_errno){
            echo 'Could not connect to mysql';
            echo "Errno:". $dbconn->connect_errno . "\n";
            echo "Error:". $dbconn->connect_error . "\n";
        } else {
            if (!$result = $dbconn->query($sqlemployees)){
                echo 'Sorry, there was an error retrieving the employees data!';
            }
            if (!$resultempnames=$dbconn->query($sqlempname)){
                echo 'Sorry, there was an error retrieving the employees table!';
            } 
            if (!$resultjobs=$dbconn->query($sqljobs)){
                echo 'Sorry, there was an error retrieving the jobs table!';
            }
            if (!$resultdepartments=$dbconn->query($sqldepartments)){
                echo 'Sorry, there was an error retrieving the jobs table!';
            }
               
            #reset counter
            $counter =0;
            #get jobs in an array 
            while ($rowjob = $resultjobs -> fetch_assoc()){
            $jobid[$counter] = $rowjob["job_id"];
            $jobtitle[$counter]= $rowjob["job_title"];
            $counter ++;
            }
            
            #reset counter
            $counter = 0;
            #get departments in an array
            while ($rowdepartment = $resultdepartments -> fetch_assoc()){
                $depid[$counter]=$rowdepartment["dep_id"];
                $depname[$counter]=$rowdepartment["dep_name"];
                $counter ++;
            }
            
            if ($result->num_rows > 0) {
                echo "\n\t<form>";
                echo "\n\t\t<table id=\"employees_table\" class=\"display\" data-order='[[ 1, \"asc\" ]]'><thead><tr><th>ID</th><th>الموظف</th><th>الوظيفة</th><th>القسم</th></tr></thead><tbody>";
                $i =0;
                while ($rowempname = $resultempnames->fetch_assoc()){
                    //echo "\n<!-- ################################################################# -->";
                    echo "\n\t\t<tr>";
                    
                    # Employee
						  
                    echo "\n\n<!--Employee-->";
                     echo "\n\n\t<td>" . $rowempname["emp_id"] . "</td>";                   
                    echo "\n\t\t<td>" . $rowempname["emp_name"];
                    //echo "\n\t\t\t<input type=\"hidden\" name=\"employee_name\" value=\"" . $rowempname["emp_name"] . "\" >";
                    //echo "\n\t\t\t<input type=\"hidden\" name=\"employee_id\" value=\"" . $rowempname["emp_id"] . "\" >";
                    echo "\n\t\t</td>";
                    #################################################################


                    # Job Title
                    #reset counter
                    $counter = 0;
                    echo "\n\n<!-- Job Title -->";
                    echo "\n\t\t<td>\n" ;
                    while ($counter < count ($jobid)) {
                        if ($rowempname["emp_jobTitleID"] == $jobid [$counter]){
                            echo $jobtitle[$counter];
                        }
                        $counter ++;
                     }
                     echo "\n\t\t</td>";
                    #################################################################

                    # Department
                    #reset counter
                    $counter = 0;
                    echo "\n\n<!-- Department-->";
                    echo "\n\t\t<td>\n" ;
                    while ($counter < count ($depid)) {
                        if ($rowempname["emp_departmentID"] == $depid [$counter]){ 
                            echo $depname[$counter];                        }
                        $counter ++;
                   }
                   echo "\n\t\t</td>";
                   #################################################################
                  
						

                    # Update Button
//                  echo "\n\n<!--Update Button -->";
//                  echo "\n\t\t<td>";
//                  echo "\n\t\t\t<input class=\"cen\" type=\"submit\" value=\"تحديث\" onclick=\"foo();\" />";
//                  echo "\n\t\t</td>";
                    #echo "\n\n";
                    $i++;
                    ################################################################# */   
                    echo "\n\t</tr>";
                    #echo "\n\t\t</form>";
            }
            # echo "<!-- End container -->";
            # echo "</div>";
            # echo "\n<hr>\n\n";
        } else {
            echo "0 results";
            }
      }
//      # New Employee
//        echo "\n<!-- New Employee-->";
//        echo "\n\t<div class=\"flex-container\">";
//        #echo "\n\t\t<div class=\"flex-item\">"; 
//        echo "\n\t\t<form class=\"newemployee\" name=\"New employee\" action=\"newemployee.php\" method=\"post\">";
//        echo "\n\t\t\t<table>\n\t\t\t\t<tr>"; 
//        # action=\"newemplyee.php\"
//        echo "\n\t\t\t\t\t<td>";
//           
//        echo "\n\t\t\t\t\t\t\t<input class=\"newemployee\" type=\"text\" name=\"new_employee\" placeholder=\"موظف جديد\" />";
//        echo "\n\t\t\t\t\t\t</div>";
//        echo "\n\t\t\t\t\t</td>\n\t\t\t\t\t</tr><tr>";
//        
//        # Department of the New Employee
//        # reset counter
//        $counter = 0;	
//        echo "\n\t<!-- Department of the New Employee-->";
//        echo "\n\t\t\t\t\t<td>";
//        echo "\n\t\t\t\t\t\t<select name=\"department\" onChange=\"updatecombo(this);\">\n";
//        echo "\t\t\t\t\t\t\t<option style=\"display:none\" disabled value selected=\"selected\">إختر قسم</option>\n";    
//        while ($counter < count ($depid)) {
//            echo "\t\t\t\t\t\t\t<option value=\"" .$depid[$counter]. "\"" ;
//            echo ">" . $depname[$counter] . "</option>\n";
//            $counter ++;
//        }
//        echo "\n\t\t\t\t\t\t</select>";
//        echo "\n\t\t\t\t\t</td>";
//        echo "\n\t\t\t\t\t<tr><tr>";
        #echo "\n\t\t\t\t\t\t<input class=\"newsubmit\" type=\"submit\" value=\"سجّل\">";
        echo "\n\t\t\t\t\t</td></tr>";
        #echo "\n\t\t\t</table>";
        #echo "\n\t\t</form>";
//        echo "\n\t\t</div>";
//        echo "\n\t</div>";
        
        #################################################################
        $dbconn->close();   
        ?>
	</tbody>
    </table>
</form>
</body>

</html>