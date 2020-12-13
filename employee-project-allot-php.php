<?php
include('config.php');

if (isset($_POST['save'])) 
{
    $emp_id=$_POST['selectpicker-1'];
    $task_id=$_POST['selectpicker-2'];
    $task_progress=$_POST['emp_progress'];
    $task_hour = $_POST['emp_hour'];

$sql1 = "INSERT INTO status_table(task_id, emp_id, progress, work_hour)VALUES('$task_id','$emp_id','$task_progress', '$task_hour')";

mysqli_query($conn,$sql1);		
 
}
		
header('Location:' . $_SERVER['HTTP_REFERER']);
?>