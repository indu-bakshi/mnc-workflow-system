<?php
include('config.php');

if (isset($_POST['save'])) 
{
  $client_id = $_POST['selectpicker-1'];
  $task_id = $_POST['selectpicker-2'];
  $task_status = $_POST['selectpicker-3'];

$sql1 = "UPDATE task_details SET task_status = '$task_status' where client_id= '$client_id' AND task_id='$task_id'";  



mysqli_query($conn,$sql1);	
mysqli_query($conn,$sql2);	
 
}
		
header('Location:' . $_SERVER['HTTP_REFERER']);
?>