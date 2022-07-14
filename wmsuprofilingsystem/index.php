<?php
    session_start();
    if (isset($_SESSION['id'])){
        header("Location: dashboard.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP WebDev and GIT</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
		<link rel="stylesheet" href="lib/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="icon" type="image/png" href="images/DSWD-logo.png" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script type="text/javascript" src="js/index-functionality.js"></script>
	</head>
	<body>
		<div class="table">
			<div class="center-table">
				<div id="login-box">
					<div class="header-box-with-bottom-line">
						<div class="row">
							<div class="col">
								<div class="header-box-title">PHP CRUD Application</div>
								<div id="login-text-content">PHP Application using OOP approach, MYSQL for the database, and Bootstrap 5 for the User Interface
								</div>
							</div>
						</div>
					</div>
					<form class="form-login" action="login.php" method="post">
		                <div class="login-error">
		                    <?php if (isset($_GET['error'])) { ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<strong><?php echo $_GET['error']; ?></strong>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
		                    <?php } ?>
		                </div>
						<div class="form-floating mb-3">
							<input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username">
							<label for="floatingInput">Username</label>
						</div>
						<div class="form-floating mb-3">
							<input type="password" name="password" class="form-control" id="floatingInput" placeholder="Password">
							<label for="floatingInput">Password</label>
						</div>
						<br />
						<div class="d-grid gap-2 mt-4">
							<input type="submit" name="submit" value="Proceed">
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>


