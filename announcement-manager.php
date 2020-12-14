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
    <title>Announcement- Workflow System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body class="bg-light">
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
    

<!-- Welcome message -->
<div>

<div class="jumbotron">
    <div class="display-4">  
    Announcements
    
    </div>
</div>
<a class="btn btn-danger" href="employee.php?logout='1'" role="button" style="float:right; margin-right:30px">Log Out!</a>
</div>
    
    <!-- Nav Bar -->
    <div class="nav-bar" style="margin-left:50px">
    <ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link" href="manager.php">Clients</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="projects.php">Projects</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="manager-progress.php">Work Progress</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#">Announcement</a>
  </li>
</ul>

</div>
<hr>
<!-- Getting all details about announcement -->
<?php 
$result_ann = mysqli_query($conn,"SELECT * from announcement ORDER BY date DESC;");
?>


<main class="container">
  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Recent announcements</h6>
    <?php while ($row= mysqli_fetch_array($result_ann)){?>
    <div class="d-flex text-muted pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
        <?php $curr_date=$row["date"];
	date_default_timezone_set("India/Mumbai");
        $curr_date = date( "d F, Y, h:i a", strtotime($curr_date));
        ?>
      <p class="pb-3 mb-0 small lh-sm border-bottom" style="padding-left:20px">
        <strong class="d-block text-gray-dark" >Rahul Mishra- Manager<br/><?php echo $curr_date?></strong>
       <?php echo $row['announcement'];?>
      </p>
    </div>
    <?php } ?>
  
  </div>
</main>
<!-- Inserting Data -->
<div class="dropdown-inser" style='float:left; margin-left:50px'>
<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Add
  </button>
<div class="dropdown-menu">

  <form class="px-4 py-3" action="announcement-php.php" method="post">
    <div class="form-group">
      <label for="announce_notice">Announcement</label>
      <input type="text" class="form-control" id="announce_notice" name="announce_notice" placeholder="What's new?">
    </div>
    <button type="submit" class="btn btn-primary" name="save">Insert</button>
  </form>
</div>
</div>

<?php

 $result_form_1 = mysqli_query($conn,"SELECT * from announcement ");

?>

<!-- delete -->
<div class="btn-group" style="float:left; margin-left:30px">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" >
                    Delete <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" style="min-width:15rem">
                    <li >
                    <form class="px-4 py-3" action="announcement-php.php" method="post" style="padding:150px;" >
  <div class="form-group">
      <label for="project_name">Announcement</label><br>
      <select name="selectpicker-1">
            <?php
            $i=0;
            while($row = mysqli_fetch_array($result_form_1)) {
            ?>
            <option value="<?=$row['ann_id'];?>"><?= $row['announcement'];?></option>
            <?php
            $i++;
            }
            ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary" name="delete">Delete</button>
   
                            
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
    <!-- <script src="../assets/dist/js/bootstrap.bundle.min.js"></script> -->
  
    

    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <script>
   $('.dropdown-menu').on('click', function(event) {
	event.stopPropagation();
});

$('.selectpicker-1').selectpicker({
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
