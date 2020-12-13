<?php
include("config.php");
session_start(); 
unset($_SESSION['msg']);

if (!isset($_SESSION['email'])) { 
  $_SESSION['msg'] = "You have to log in first";
  header('location: index.php'); 
} 
 
if (isset($_GET['logout'])) { 
  session_destroy(); 
  unset($_SESSION['email']);
  header("location: index.php"); 
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Progress- Workflow System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<style>       
    hr{
        height: 1px;
        background-color: #ccc;
        border: none;
        margin-top: 5px;
        margin-bottom: 1rem;
        
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        margin-left:50px
    }
</style>
    
<!-- Getting all details about manager -->
<?php 
$result_emp = mysqli_query($conn,"SELECT * from emp_details where occupation = 'Manager' ");
?>
<!-- Welcome message -->
<div>
<?php while ($row= mysqli_fetch_array($result_emp)){?>
<div class="jumbotron">
    <div class="display-4">  
    Work Progress
    
    </div>
</div>
<a class="btn btn-danger" href="employee.php?logout='1'" role="button" style="float:right; margin-right:30px">Log Out!</a>
</div>
    <?php } ?>
    <!-- Nav Bar -->
    <div class="nav-bar" style="margin-left:50px">
    <ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link " href="manager.php">Clients</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="projects.php">Projects</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#">Work Progress</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="announcement-manager.php">Announcement</a>
  </li>
</ul>

</div>
<hr>
<!-- Getting data for client table -->
<?php 
$result_client = mysqli_query($conn,"SELECT * from client_details INNER JOIN project on client_details.client_id= project.client_id ");
$emp_projects=  mysqli_query($conn,"SELECT * FROM status_table INNER JOIN task_details ON status_table.task_id=task_details.task_id INNER JOIN project on project.client_id=task_details.client_id INNER JOIN emp_details ON emp_details.emp_id=status_table.emp_id ");
?>

<?php

if (isset($_POST['save'])) 
{
    $emp_id=$_POST['selectpicker-new'];
    $emp_projects=  mysqli_query($conn,"SELECT * FROM status_table INNER JOIN task_details ON status_table.task_id=task_details.task_id INNER JOIN project on project.client_id=task_details.client_id INNER JOIN emp_details ON emp_details.emp_id=status_table.emp_id WHERE emp_details.emp_id = '".$emp_id."'");
 
}

?>
<!-- Clients table -->
<table class="table">
<thead class="thead-dark">
   <tr>
    <th scope="col">Employee</th>
      <th scope="col">Project Name</th>
      <th scope="col">Task Alloted</th>
      <th scope="col">Work History</th>
      <th scope="col">Work Date</th>
      
      <!-- <th scope="col"></th> -->
   </tr>
	</thead>
	<tbody>
<?php while ($row= mysqli_fetch_array($emp_projects)){?>
    <tr>
    <td><?php echo $row['f_name'];?> <?php echo $row['l_name'];?>- <?php echo $row['occupation'];?></td>
    <td><?php echo $row['project_name'];?></td>
    <td><?php echo $row['task_name'];?></td>
    <td><?php echo $row['progress'];?></td>
    <td><?php echo $row['work_hour'];?></td>
   
    
</tr>
    <?php } ?>
    <tbody>
</table>
<?php  if (isset($_SESSION['email'])) : 
      $result_view = mysqli_query($conn,"SELECT * FROM emp_details");
    ?>
      <?php endif ?> 
<form class="px-4 py-3" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
<div class="form-group btn ">
      <select name="selectpicker-new" >
            <?php
            $i=0;
            while($row = mysqli_fetch_array($result_view)) {
            ?>
            <option value="<?=$row['emp_id'];?>"><?= $row['f_name'];?> <?= $row['l_name'];?>- <?= $row['occupation'];?></option>
            <?php
            $i++;
            }
            ?>
        </select>
       
    </div>
    <button type="submit" class="btn btn-primary" name="save" style="margin-top:-10px">View</button>
  </form>


<!-- Footer -->
<footer class="page-footer font-small blue" style="margin-top:100px; color:white; background:#007BFF">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="https://indu-bakshi.github.io/" style="color:white"> Bakshi Web World</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
</body>
</html>