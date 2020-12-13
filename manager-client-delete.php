<?php
include('config.php');

if (isset($_POST['save'])) 
{
  $client_id=$_POST['client_id'];

$sql1 = "DELETE from client_details where client_id='$client_id'";  
$sql2 = "DELETE from project where client_id='$client_id'"; 


mysqli_query($conn,$sql1);	
mysqli_query($conn,$sql2);	
 
}
		
header('Location:' . $_SERVER['HTTP_REFERER']);
?>