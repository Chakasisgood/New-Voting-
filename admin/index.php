<?php
session_start();
if (isset($_SESSION['admin'])) {
	header('location:home.php');
}
?>
<?php include 'includes/header.php'; ?>
<link rel="icon" href="..images/download.png" />

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<b>SUPREME STUDENT GOVERMENT ADMIN COMMISSION</b>
		</div>

		<div class="login-box-body">
			<p class="login-box-msg"> </p>

			<form action="login.php" method="POST">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="username" placeholder="Admin" required>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
					<span class="glyphicon glyphicon-eye-open" id="togglePassword"></span>
				</div>
				<br>
				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary btn-block btn-flat" name="login">Login</button>
					</div>
				</div>
			</form>
		</div>
		<?php
		if (isset($_SESSION['error'])) {
			// Pass the error message to JavaScript
			echo "<script>
			  window.addEventListener('DOMContentLoaded', function() {
				  Swal.fire({
					  icon: 'error',
					  title: 'Error',
					  text: '" . addslashes($_SESSION['error']) . "',
					  confirmButtonText: 'OK'
				  });
			  });
		  </script>";
			// Clear the error message from the session
			unset($_SESSION['error']);
		}
		?>
	</div>

	<?php include 'includes/scripts.php' ?>
</body>

</html>