<?php require_once 'helper/function.php' ?>
<?php if(!isset($_SESSION['user_id'])): ?>
	<?php header('Location:index.php'); ?>
<?php endif; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
		<ul class="navbar-nav">
			<?php if(isset($_SESSION['user_id'])): ?>
			<li class="nav-item">
				<a class="nav-link" href="#">Hello <?php echo $_SESSION['user_name']; ?> !</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="logout.php">logout</a>
			</li>
		<?php endif; ?>
		</ul>
	</nav>
<div class="container col-2">

	<div class="alert alert-success text-center"><?php echo $_SESSION['user_name']; ?></div>

</div>
</body>
</html>