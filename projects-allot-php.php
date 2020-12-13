<?php
include('config.php');

if (isset($_POST['save'])) 
{
    $client_id=$_POST['selectpicker-1'];
    $emp_id=$_POST['selectpicker-2'];
    $task_name=$_POST['emp_task'];
    $task_status = $_POST['selectpicker-3'];
    $deadline = $_POST['emp_due'];

$sql1 = "INSERT INTO task_details(client_id, emp_id, task_name, task_status, deadline)VALUES('$client_id','$emp_id','$task_name', '$task_status','$deadline')";

mysqli_query($conn,$sql1);		
 
}
		
header('Location:' . $_SERVER['HTTP_REFERER']);
?>