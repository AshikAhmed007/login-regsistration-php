<?php include 'helper/function.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Confirm Email</title>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" style="margin-top: 200px">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-4">
				<?php 
					if (isset($_SESSION['account_create'])):
						echo "<div class='alert alert-success'>".$_SESSION['account_create']."</div>";
					endif;
					unset($_SESSION['account_create']);
				 ?>
				 <?php 
					if (isset($_SESSION['please_confirm'])):
						echo "<div class='alert alert-success'>".$_SESSION['please_confirm']."</div>";
					endif;
					unset($_SESSION['please_confirm']);
				 ?>
				<h4>Please Confirm your Email</h4><hr>
				<form action="" method="post">
					<div class="input-group">
						<input type="text" name="confirm_code" class="form-control" placeholder="Enter Confirmation Code...">
						<div class="input-group-btn">
							<input type="submit" name="confirm" value="confirm" class="btn btn-success">
						</div>
					</div>
				</form>
					<?php confirm_email(); ?>
			</div>

		</div>
	</div>
</body>
</html>