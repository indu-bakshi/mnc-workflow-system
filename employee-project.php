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
    <title>Profile- Workflow System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div>
    <div class="content"> 
   
        <?php  if (isset($_SESSION['email'])) : 
            $email_user = $_SESSION['email'];
            $emp_results=  mysqli_query($conn,"SELECT * from emp_details where email = '".$email_user."' ");
            ?> 
            
            <?php while ($row= mysqli_fetch_array($emp_results)){?>
            <div class="jumbotron">
                <div class="display-4">  
                     Project Status
                </div>
            </div>
        </div>
    <a class="btn btn-danger" href="employee.php?logout='1'" role="button" style="float:right; margin-right:30px">Log Out!</a>
</div>
    <?php } ?>

        <!-- Nav Bar -->
    <div class="nav-bar" style="margin-left:50px">
    <ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link" href="employee.php">Tasks</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#">Project Status</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="announcement-employee.php">Announcements</a>
  </li>
</ul>
</div>
<hr>  
<?php endif ?> 
<?php  if (isset($_SESSION['email'])) : 
            $email_user = $_SESSION['email'];
            $emp_projects=  mysqli_query($conn,"SELECT * FROM status_table INNER JOIN task_details ON status_table.task_id=task_details.task_id INNER JOIN project on project.client_id=task_details.client_id INNER JOIN emp_details ON emp_details.emp_id=status_table.emp_id where email='".$email_user."'");
            ?> 
 <!-- Employee table -->
<table class="table">
<thead class="thead-dark">
   <tr>
    <th scope="col">Project name</th>
      <th scope="col">Task alloted</th>
      <th scope="col">Progress</th>
      <th scope="col">Hour Description</th>
   </tr>
	</thead>
	<tbody>
    <?php while ($row= mysqli_fetch_array($emp_projects)){?>
    <tr>
    <td><?php echo $row['project_name'];?></td>
    <td><?php echo $row['task_name'];?></td>
    <td><?php echo $row['progress'];?></td>
    <td><?php echo $row['work_hour'];?></td>
</tr>
    <?php } ?>
    <tbody>
</table>      
        <?php endif ?> 
    </div> 
    <?php  if (isset($_SESSION['email'])) : 
      $email_user = $_SESSION['email'];
      $result_form_1 = mysqli_query($conn,"SELECT * FROM task_details INNER JOIN emp_details ON task_details.emp_id=emp_details.emp_id INNER JOIN project ON project.client_id= task_details.client_id WHERE emp_details.email = '".$email_user."'");
      $result_form_2 = mysqli_query($conn,"SELECT * FROM task_details INNER JOIN emp_details ON task_details.emp_id=emp_details.emp_id INNER JOIN project ON project.client_id= task_details.client_id WHERE emp_details.email = '".$email_user."'");
?>

<?php  if (isset($_SESSION['email'])) ?>
    <div class="btn-group" style="float:left; margin-left:50px">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" >
                    Insert <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" style="min-width:15rem">
                    <li >
                    <form class="px-4 py-3" action="employee-project-allot-php.php" method="post" style="padding:150px;" >
  <div class="form-group">
      <label for="project_name">Project Name</label><br>
      <select name="selectpicker-1">
            <?php
            $i=0;
            while($row = mysqli_fetch_array($result_form_1)) {
            ?>
            <option value="<?=$row['emp_id'];?>"><?= $row['project_name'];?></option>
            <?php
            $i++;
            }
            ?>
        </select>
    </div>
    <div class="form-group">
      <label for="emp_name">Task Alloted</label><br>
      <select name="selectpicker-2">
            <?php
            $i=0;
            while($row = mysqli_fetch_array($result_form_2)) {
            ?>
            <option value="<?=$row['task_id'];?>"><?= $row['task_name'];?></option>
            <?php
            $i++;
            }
            ?>
        </select>
    </div>
    <div class="form-group">
      <label for="emp_progress">Progress</label>
      <input type="text" class="form-control" id="emp_progress" name="emp_progress" placeholder="What you did today?">
    </div>

    <div class="form-group">
      <label for="emp_hour">Hour Description</label>
      <input type="text" class="form-control" id="emp_hour" name="emp_hour" placeholder="Date and Hour">
    </div>

    <button type="submit" class="btn btn-primary" name="save">ADD</button>
   
                            
                        </form>
                    </li>
                </ul>
            </div>

            <?php endif ?> 

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
    
    
    <script>
   $('.dropdown-menu').on('click', function(event) {
	event.stopPropagation();
});

$('.selectpicker-1','.selectpicker-2','.selectpicker-3').selectpicker({
	container: 'body'
});

$('body').on('click', function(event) {
	var target = $(event.target);
	if (target.parents('.bootstrap-select').length) {
		event.stopPropagation();
		$('.bootstrap-select.open').removeClass('open');
	}
});	

    </script>
    
</body>
</html>