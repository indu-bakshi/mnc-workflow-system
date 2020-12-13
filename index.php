<?php
session_start();
unset($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login- Workflow System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Sign In</h1>
  </div>
</div>

		<form action="login-php.php" method="post" style="margin-right:20px;">

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label"style="margin-left: 30px">Email</label>
    <div class="col-sm-4">
      <input type="email" name='email' class="form-control" id="inputEmail3" aria-describedby="emailHelp">
      <small id="emailHelp" class="form-text text-muted">Enter the email company has provided you.</small>

    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label"style="margin-left: 30px">Password</label>
    <div class="col-sm-4">
      <input type="password" name='password' class="form-control" id="inputPassword3" aria-describeby="pwHelp">
      <small id="pwHelp" class="form-text text-muted">Enter the password company has provided you.</small>
    </div>
  </div>
  
  <div class="form-group row">
    <div class="col-sm-10" >
      <button type="submit" class="btn btn-primary"style="margin-left:50%" name="save">Sign In</button>
    </div>
  </div>
  <?php
                    if(isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        unset($_SESSION['msg']);
                        ?>

                        <div style="padding-left: 30px; color: red">
                    <?php echo "<span>$error</span>";?>
                    </div>
                   <?php }
                ?>  
                 <?php
                    if(isset($_SESSION["msg"])){
                        $msg = $_SESSION["msg"];?>

                        <div style="padding-left: 30px; color: red">
                    <?php echo "<span>$msg</span>";?>
                    </div>
                   <?php }
                ?>  
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
<?php
    unset($_SESSION["error"]);
?>