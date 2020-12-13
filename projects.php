<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects- Workflow System</title>
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
   Projects 
    
    </div>
</div>
    <?php } ?>
    <a class="btn btn-danger" href="employee.php?logout='1'" role="button" style="float:right; margin-right:30px">Log Out!</a>
</div>
    <!-- Nav Bar -->
    <div class="nav-bar" style="margin-left:50px">
    <ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link " href="manager.php">Clients</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#">Projects</a>
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
<!-- Getting data for forms -->
<?php 
$result_project = mysqli_query($conn,"SELECT * from client_details INNER JOIN project on client_details.client_id= project.client_id INNER JOIN task_details on client_details.client_id= task_details.client_id INNER JOIN emp_details on task_details.emp_id=emp_details.emp_id" );
?>
<!-- Clients table -->
<table class="table">
<thead class="thead-dark">
   <tr>
   <th scope="col">Client ID</th>
    <th scope="col">Client Name</th>
      <th scope="col">Status</th>
      <th scope="col">Project Name</th>
      <th scope="col">Project Cost</th>
      <th scope="col">Employee</th>
      <th scope="col">Task alloted</th>
      <th scope="col">Deadline</th>
      <!-- <th scope="col"></th> -->
   </tr>
	</thead>
	<tbody>
<?php while ($row= mysqli_fetch_array($result_project)){?>
    <tr>
    <td><?php echo $row['client_id'];?></td>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['task_status'];?></td>
    <td><?php echo $row['project_name'];?></td>
    <td><?php echo $row['cost'];?></td>
    <td><?php echo $row['f_name'];?> <?php echo $row['l_name'];?>- <?php echo $row['occupation'];?></td>
    <td><?php echo $row['task_name'];?></td>
    <td><?php echo $row['deadline'];?></td>
</tr>
    <?php } ?>
    <tbody>
</table>

<!-- Getting data for forms -->
<?php 
$result_client = mysqli_query($conn,"SELECT * from client_details INNER JOIN project on client_details.client_id= project.client_id ");
$result_employee= mysqli_query($conn,"SELECT * from emp_details");
?>

<!-- Inserting Data -->
<div class="btn-group" style="float:left; margin-left:50px">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" >
                    Insert <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" style="min-width:15rem">
                    <li >
                    <form class="px-4 py-3" action="projects-allot-php.php" method="post" style="padding:150px;" >
  <div class="form-group">
      <label for="client_id">Client Name</label><br>
      <!-- <input type="number" class="form-control" id="client_id" name="client_id" placeholder="Client id"> -->
      <select name="selectpicker-1">
            <?php
            $i=0;
            while($row = mysqli_fetch_array($result_client)) {
            ?>
            <option value="<?=$row['client_id'];?>"><?= $row['name'];?></option>
            <?php
            $i++;
            }
            ?>
        </select>
    </div>
    <div class="form-group">
      <label for="emp_name">Employee</label>
      <select name="selectpicker-2">
            <?php
            $i=0;
            while($row = mysqli_fetch_array($result_employee)) {
            ?>
            <option value="<?=$row['emp_id'];?>"><?= $row['f_name'];?> <?= $row['l_name'];?>- <?= $row['occupation'];?> </option>
            <?php
            $i++;
            }
            ?>
        </select>
    </div>
    <div class="form-group">
      <label for="emp_task">Task</label>
      <input type="text" class="form-control" id="emp_task" name="emp_task" placeholder="Task to be alloted">
    </div>

    <div class="form-group">
      <label for="task_status">Status</label>
      <select name= selectpicker-3>
      <option value="Active">Active</option>
      <option value ="Inactive">Inactive</option>
      </select>
    </div>

    <div class="form-group">
      <label for="emp_due">Deadline</label>
      <input type="text" class="form-control" id="emp_due" name="emp_due" placeholder="Deadline for the task">
    </div>
    <button type="submit" class="btn btn-primary" name="save">Insert</button>
   
                            
                        </form>
                    </li>
                </ul>
            </div>
<!-- Getting data for modify -->
<?php 
$result_modify = mysqli_query($conn,"SELECT * from task_details t inner join client_details c on t.client_id=c.client_id");
$result_modify2= mysqli_query($conn,"SELECT * from task_details");
?>
<!-- Modify Buttton -->
<div class="btn-group" style="float:left; margin-left:30px">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" >
                    Modify <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" style="min-width:15rem">
                    <li >
                    <form class="px-4 py-3" action="manager-projects-modify-php.php" method="post" style="padding:150px;" >
  <div class="form-group">
      <label for="client_id">Client Name</label><br>
      <select name="selectpicker-1">
            <?php
            $i=0;
            while($row = mysqli_fetch_array($result_modify)) {
            ?>
            <option value="<?=$row['client_id'];?>"><?= $row['name'];?></option>
            <?php
            $i++;
            }
            ?>
        </select>
    </div>
    <div class="form-group">
      <label for="task_name">Task alloted</label>
      <select name="selectpicker-2">
            <?php
            $i=0;
            while($row = mysqli_fetch_array($result_modify2)) {
            ?>
            <option value="<?=$row['task_id'];?>"><?= $row['task_name'];?></option>
            <?php
            $i++;
            }
            ?>
        </select>
    </div>
    <div class="form-group">
      <label for="task_status">Status</label>
      <select name= selectpicker-3>
      <option value="Active">Active</option>
      <option value ="Inactive">Inactive</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary" name="save">Update</button>
   
                            
                        </form>
                    </li>
                </ul>
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