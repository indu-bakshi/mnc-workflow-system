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
    <title>Clients- Workflow System</title>
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
    Welcome! <?php echo $row['f_name']; ?>
    <?php echo $row['l_name']; ?>
    </div>
</div>
<a class="btn btn-danger" href="employee.php?logout='1'" role="button" style="float:right; margin-right:30px">Log Out!</a>
</div>
    <?php } ?>
    <!-- Nav Bar -->
    <div class="nav-bar" style="margin-left:50px">
    <ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link active" href="#">Clients</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="projects.php">Projects</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="manager-progress.php">Work Progress</a>
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
?>
<!-- Clients table -->
<table class="table">
<thead class="thead-dark">
   <tr>
    <th scope="col">Client ID</th>
      <th scope="col">Name</th>
      <th scope="col">Website</th>
      <th scope="col">Phone no</th>
      <th scope="col">Project name</th>
      <th scope="col">Start date</th>
      <th scope="col">Due date</th>
      <!-- <th scope="col"></th> -->
   </tr>
	</thead>
	<tbody>
<?php while ($row= mysqli_fetch_array($result_client)){?>
    <tr>
    <td><?php echo $row['client_id'];?></td>
    <td><?php echo $row['name'];?></td>
    <?php $url=$row['website']; ?>
    <td><?php echo "<a href=$url>$url</a>" ?></td>
    <td><?php echo $row['phone'];?></td>
    <td><?php echo $row['project_name'];?></td>
    <td><?php echo $row['start_date'];?></td>
    <td><?php echo $row['due_date'];?></td>
</tr>
    <?php } ?>
    <tbody>
</table>

<!-- Inserting Data -->
<div class="dropdown-inser" style='float:left; margin-left:50px'>
<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Add
  </button>
<div class="dropdown-menu">

  <form class="px-4 py-3" action="manager-client-insert.php" method="post">
  <div class="form-group">
      <label for="client_id">Client ID</label>
      <input type="number" class="form-control" id="client_id" name="client_id" placeholder="Client id">
    </div>
    <div class="form-group">
      <label for="client_name">Name</label>
      <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Company name">
    </div>
     <div class="form-group">
      <label for="client_website">Website</label>
      <input type="text" class="form-control" id="client_website" name="client_website" placeholder="Company website">
    </div>
    <div class="form-group">
      <label for="client_phone">Phone no</label>
      <input type="text" class="form-control" id="client_phone" name="client_phone" placeholder="Company phone">
    </div>
    <div class="form-group">
      <label for="client_project">Project name</label>
      <input type="text" class="form-control" id="client_project" name="client_project" placeholder="Company project name">
    </div>
    <div class="form-group">
      <label for="client_start">Start date</label>
      <input type="text" class="form-control" id="client_start" name="client_start" placeholder="Project start date">
    </div>
    <div class="form-group">
      <label for="client_due">Due date</label>
      <input type="text" class="form-control" id="client_due" name="client_due" placeholder="Project due date">
    </div>
    <div class="form-group">
      <label for="client_id">Cost</label>
      <input type="text" class="form-control" id="client_cost" name="client_cost" placeholder="Project Cost">
    </div>
    <button type="submit" class="btn btn-primary" name="save">Insert</button>
  </form>
</div>
</div>

<!-- Modify Buttton -->
<div class="dropdown-modify" style='float:left; margin-left:30px'>
<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Modify
  </button>
  <form class="px-4 py-3" action="manager-client-modify.php" method="post" >
<div class="dropdown-menu" style="padding:30px">
  <div class="form-group" >
      <label for="client_id">Client ID to Modify</label>
      <input type="number" class="form-control" id="client_id" name="client_id" placeholder="Client id">
    </div>
    <div class="form-group">
      <label for="client_name">Name</label>
      <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Company name">
    </div>
     <div class="form-group">
      <label for="client_website">Website</label>
      <input type="text" class="form-control" id="client_website" name="client_website" placeholder="Company website">
    </div>
    <div class="form-group">
      <label for="client_phone">Phone no</label>
      <input type="text" class="form-control" id="client_phone" name="client_phone" placeholder="Company phone">
    </div>
    <div class="form-group">
      <label for="client_project">Project name</label>
      <input type="text" class="form-control" id="client_project" name="client_project" placeholder="Company project name">
    </div>
    <div class="form-group">
      <label for="client_start">Start date</label>
      <input type="text" class="form-control" id="client_start" name="client_start" placeholder="Project start date">
    </div>
    <div class="form-group">
      <label for="client_due">Due date</label>
      <input type="text" class="form-control" id="client_due" name="client_due" placeholder="Project due date">
    </div>
    <div class="form-group">
      <label for="client_id">Cost</label>
      <input type="text" class="form-control" id="client_cost" name="client_cost" placeholder="Project Cost">
    </div>
    <button type="submit" class="btn btn-primary" name="save">Update</button>
  </form>
</div>
</div>

<!-- Deleting data -->

<div class="dropdown-modify" style='float:left; margin-left:30px'>
<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Delete
  </button>
  <form class="px-4 py-3" action="manager-client-delete.php" method="post" >
<div class="dropdown-menu" style="padding:30px">
  <div class="form-group" >
      <label for="client_id">Client ID to Delete</label>
      <input type="number" class="form-control" id="client_id" name="client_id" placeholder="Client id">
    </div>
    <button type="submit" class="btn btn-primary" name="save">Delete</button>
  </form>
</div>
</div>

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