<?php
include('config.php');

if (isset($_POST['save'])) 
{
  $client_name = $_POST['client_name'];
  $client_website = $_POST['client_website'];
  $client_phone = $_POST['client_phone'];
  $client_id=$_POST['client_id'];
  $client_cost=$_POST['client_cost'];
  $client_start=$_POST['client_start'];
  $client_due=$_POST['client_due'];
  $client_project=$_POST['client_project'];

$sql1 = "UPDATE client_details SET name = '$client_name', website= '$client_website', phone='$client_phone' where client_id= '$client_id'";  
$sql2 = "UPDATE project SET cost = '$client_cost', start_date= '$client_start', due_date='$client_due', project_name = '$client_project' where client_id= '$client_id'"; 


mysqli_query($conn,$sql1);	
mysqli_query($conn,$sql2);	
 
}
		
header('Location:' . $_SERVER['HTTP_REFERER']);
?>