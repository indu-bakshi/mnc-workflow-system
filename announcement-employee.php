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
                     Announcements 
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
    <a class="nav-link " href="employee.php">Tasks</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="employee-project.php">Project Status</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#">Announcements</a>
  </li>
</ul>
</div>
<hr>  
<?php endif ?> 
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
       
	$reset = date_default_timezone_get();
	date_default_timezone_set('Asia/Kolkata');
	$curr_date = strtotime($curr_date);
	date_default_timezone_set($reset);
	$curr_date = date( "d F, Y, h:i a", $curr_date);
        ?>
      <p class="pb-3 mb-0 small lh-sm border-bottom" style="padding-left:20px">
        <strong class="d-block text-gray-dark" >Rahul Mishra- Manager<br/><?php echo $curr_date?></strong>
       <?php echo $row['announcement'];?>
      </p>
    </div>
    <?php } ?>
  
  </div>
</main>
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
