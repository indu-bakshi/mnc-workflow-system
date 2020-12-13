<?php
 include("config.php");
 session_start();
 
 $error = "Email or password is incorrect";
 if (isset($_POST['save'])) 
 {
	$email= $_POST['email'];
	$pass= $_POST['password'];
	
	$q= "select * from emp_details where email= '$email' && password ='$pass' ";
	
	$result = mysqli_query($conn,$q);
	
	$num = mysqli_num_rows($result);	
 }

 
if($num==1){
	if($email=='manager@gmail.com'){
		$_SESSION['email']=$email;
		header("Location:manager.php");
	}
	   else {
		$_SESSION['email']=$email;
		header('location:employee.php');
	
	   }
	
}
else{
	$_SESSION["error"] = $error;	
	header('location:index.php');	
}
?>