<?php
include('config.php');

if (isset($_POST['save'])) 
{
    $ann=$_POST['announce_notice'];
   

$sql1 = "INSERT INTO announcement(announcement)VALUES('$ann')";

mysqli_query($conn,$sql1);		
 
}

if (isset($_POST['delete']))
{
    $delete_id=$_POST['selectpicker-1'];
    echo "$delete_id";
    $sql2 = "DELETE from announcement where ann_id='$delete_id'";

   mysqli_query($conn,$sql2);
   
   
}
 		
header('Location:' . $_SERVER['HTTP_REFERER']);
?>