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

$sql1 = "INSERT INTO client_details VALUES('$client_id','$client_name','$client_website', '$client_phone')";
$sql2 = "INSERT INTO project(client_id, cost, start_date, due_date, project_name) VALUES('$client_id','$client_cost','$client_start', '$client_due','$client_project')";

mysqli_query($conn,$sql1);	
mysqli_query($conn,$sql2);	
 
}
		
header('Location:' . $_SERVER['HTTP_REFERER']);
?>