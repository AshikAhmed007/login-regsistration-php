<?php 
require_once 'helper/function.php';


if(isset($_POST['create_account'])){
$err='';
$first_name=trim($_POST['first_name']);
$last_name=trim($_POST['last_name']);
$email=trim($_POST['email']);
$password=trim($_POST['password']);
$cpassword=trim($_POST['confirm_password']);
$gender=trim($_POST['gender']);
if(empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($cpassword) || empty($gender)){
	$err="<div class='text-danger'>Please fill out the form!!!</div>";
}
else{
	 $pattern="/^[a-zA-Z ]+$/";
	 if(preg_match($pattern, $first_name)){
	 	if(preg_match($pattern, $last_name)){
	 		if(filter_var($email,FILTER_VALIDATE_EMAIL)){
	 			if(strlen($password)>4 && strlen($cpassword)>4){
	 				if($password==$cpassword){
	 					$check_email=$db->prepare("SELECT email from users where email=?");
	 					$check_email->execute([$email]);
	 					
	 					if($check_email->rowCount()==1){
	 						$err="<div class='text-danger'>Sorry email already exist!!!</div>";
	 					}
	 					else{
	 						$code=rand(100000,999999);
	 						$status=0;
	 						try{
	 						$insert_query=$db->prepare("INSERT into users(first_name,last_name,email,password,gender,code,status) Values(?,?,?,?,?,?,?)");
	 						$insert_query->execute([$first_name,$last_name,$email,password_hash($password, PASSWORD_DEFAULT),$gender,$code,$status]);
	 						sendCode($code,$email);
	 						}
	 						catch(PDOExecption $e){
	 							echo "sorry ".$e->getMessage();
	 						}
	 					}
	 				}
	 				else{
	 					$err="<div class='text-danger'>Password is not matched!!!</div>";
	 				}
	 			}
	 			else{
	 				$err="<div class='text-danger'>Password must be greater than 4 characters!!</div>";
	 			}
	 		}
	 		else{
	 			$err="<div class='text-danger'>Email invalid!!!</div>";
	 		}
	}
	 	else{
	 	$err="<div class='text-danger'>Last name must be character!!!</div>";
	 	}
	 }
	 else{
	 	$err="<div class='text-danger'>First name must be character!!!</div>";
	 }
}

}


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</head>
<body>
	
	<!-- <h1 style="color: green"><?php echo $msg; ?></h1> -->

<div class="container col-lg-3" style="margin-top: 100px;">

<div class="panel panel-default">
	<div class="panel-heading">
		<span><h2>Registration</h2></span>
	</div>

	<div class="panel-body">
<form   action="reg.php" method="post">
<div class="form-group">
	<?php if(isset($err)): echo $err; endif; ?>
</div>
	

	<div class="form-group">
      <label for="Phone">First Name :</label>
      <input type="text" class="form-control" placeholder="Enter First Name" name="first_name">
    </div>

<div class="form-group">
      <label for="Phone">Last Name :</label>
      <input type="text" class="form-control" placeholder="Enter Last Name" name="last_name">
    </div>
    <div class="form-group">
      <label for="email">Email :</label>
      <input type="email" class="form-control" placeholder="Enter email" name="email">
    </div>

   <div class="form-group">
      <label for="Password">Password :</label>
      <input type="Password" class="form-control" placeholder="Password" name="password">
    </div>

    <div class="form-group">
      <label for="Password">Confirm Password :</label>
      <input type="Password" class="form-control" placeholder="confirm Password" name="confirm_password">
    </div>

    <div class="form-group">
      <label for="Password">Gender :</label>
      <select name="gender" class="form-control">
      	<option value="">select gender</option>
      	<option value="male">Male</option>
      	<option value="female">Female</option>
      </select>
    </div>
	 <div class="form-group">
      
      <button type="submit" class="form-control btn btn-success btn-block"  name="create_account">Create Account</button>
      
    </div>



	
</form>
</div>
</div>
</div>
</body>
</html>