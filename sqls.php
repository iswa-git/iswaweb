<?php

 $sqlemployees = 
                "SELECT `tbl_employees`.`emp_id`, `tbl_employees`.`emp_jobTitleID`, `tbl_employees`.`emp_departmentID`, `tbl_employees`.`emp_name`, `tbl_departments`.`dep_name`, `tbl_jobs`.`job_title`, `tbl_employees`.`emp_salary` FROM (`tbl_employees` INNER JOIN `tbl_departments` ON `tbl_employees`.`emp_departmentID`=`tbl_departments`.`dep_id` INNER join `tbl_jobs` ON `tbl_employees`.`emp_jobTitleID`=`tbl_jobs`.`job_id`)";

$sqlempname = 'SELECT * FROM `tbl_employees`';
$sqljobs = 'SELECT * FROM `tbl_jobs`';
$sqldepartments = 'SELECT * FROM `tbl_departments`';
$sqlmartialstatus = 'SELECT * FROM `tbl_martialStatus`';
$sqlInsurance = 'SELECT * FROM `tbl_insurance`';
