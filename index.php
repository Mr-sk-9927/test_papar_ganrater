<?php
session_start();
ob_start();
require 'includes/config.php';
if(isset($_SESSION['admin']['username'])) {	
  header('location: dashboard.php');
}
$username=isset($_POST['username']) ? $_POST['username'] : null;$password=md5(isset($_POST['password']) ? $_POST['password'] : null);
$query="SELECT * FROM login WHERE username=:username and password=:password";$sql=$dbcon->prepare($query);
$sql->execute(array(':username' => $username, ':password' => $password));$row=$sql->rowCount();
$data=$sql->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['login'])){
  if($row==0){
    echo "<script type='text/javascript'>alert('Invalid username or password.');window.location='index.php';</script>";
             }
  else{
    if($data['role']==0){$_SESSION['admin']['username']=$username;
                         header("location: dashboard.php");
                        }
    else if($data['role']==1){$_SESSION['admin']['username']=$username;
                              header("location: dashboard.php");
                             } 
    else {
      echo "<script type='text/javascript'>alert('valid username or password.');window.location='index.php'; </script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title> Login | Paper Generator</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="httpS://www.phitsolution.com/favicon.ico" />
    
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  <body>
    <div class="limiter">
      <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100">
          <form class="login100-form validate-form" method="post">
            <span class="login100-form-title p-b-34 p-t-27">Log in</span>
            <div class="wrap-input100 validate-input" data-validate="Enter username">
              <input class="input100" type="text" name="username" id="username" placeholder="Username">
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>
            
            <div class="wrap-input100 validate-input" data-validate="Enter password">
              <input class="input100" type="password" name="password" placeholder="password" id="password">
              <span class="focus-input100" data-placeholder="&#xf191;"></span>
            </div>
            <div class="container-login100-form-btn">
              <button class="login100-form-btn" name="login">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div id="dropDownSelect1"></div>
    <!--<script src="js/jquery.js"></script>
    <script src="js/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>-->
  </body>
</html>