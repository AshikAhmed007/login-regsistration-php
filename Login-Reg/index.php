<?php 
 
 require_once 'helper/function.php';
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="main.css" />
  
</head>
<body style="background-image: url(img/bg.jpg);background-repeat: no-repeat;background-size: cover;">


<div class="container col-lg-3" style="position: relative;top: 150px;">
  <h2 style="color: white;">Login</h2> 
  <?php if(isset($_SESSION['confirm_success'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['confirm_success']; ?></div>
  <?php endif; ?>
  <?php unset($_SESSION['confirm_success']); ?>
  <form action="index" method="post">
     <div class="form-group">
     <?php user_login(); ?> 
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>
    <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me  <span><a href="reg" style="color: white;padding: 30px"> Join now!</a></span>
      </label>
    </div>
    <button name="login" type="submit" class="btn btn-primary">login</button>
  </form>
</div>
<script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.scrollex.min.js"></script>
      <script src="assets/js/skel.min.js"></script>
      <script src="assets/js/util.js"></script>
      <script src="assets/js/main.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

  
</body>
</html>

