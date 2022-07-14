<?php
	include '../classes/databasemanager.class.php';
	include '../classes/academicrank.class.php';

	if(isset($_POST['submit'])) {
		AcademicRank::add_academicrank_data($_POST);
	}
?> 
<!DOCTYPE html>
<html>
	<!-- Page Header -->
	<head>
		<title>PHP WebDev Fundamentals</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="icon" type="image/png" href="../images/DSWD-logo.png" />
		<script type="text/javascript" src="../js/index-functionality.js"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	</head>
	<body>
		<div id="header">
			<div id="name">
				PHP CRUD Application
				<div id="menubutton"><img onclick="myFunction()" src="../images/hamburger.png" /></div>
			</div>
			<div class="description">PHP Application using OOP approach, MYSQL for the database, and Bootstrap 5 for the User Interface</div>
		</div>
		<!-- End Page Header -->
		<!-- Active Page Menu -->
		<div id="sidebar-container" class="sidebar">
			<a href="../index.php">Dashboard</a>
			<a href="../faculty/faculty/faculty.php">Faculty</a>
			<a href="../department/department.php">Department</a>
			<a href="../college/college.php">College</a>
			<a class="active" href="rank.php">Academic Rank</a>
			<a href="#">Logout</a>
		</div>
		<!-- End Active Page Menu -->
		<div class="content">
			<div class="container">
				<br>
				<!-- Page Content Title -->
				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col">
										<a class="clickable-page-title" href="rank.php">Acadmic Rank</a>
										<div class="page-title"> &nbsp;- Add Academic Rank</div>
									</div>
									<div class="col">
										<div class="d-grid gap-2 d-md-flex justify-content-md-end">
											<button class="btn btn-secondary" onclick="window.location.href='rank.php';" type="button">Back</button>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Page Content Title -->
				<!-- Page Content -->
				<br>
				<div class="card">
					<div class="card-body">
						<form action="add.php" method="POST">
							<div class="row">
								<div class="col">
									<div class="form-floating mb-3">
										<input type="text" name="description" class="form-control" id="floatingInput">
										<label for="floatingInput">Description</label>
									</div>
									<div class="d-grid gap-2 d-md-flex justify-content-md-end">
										<input type="submit" name="submit" value="Save Academkc Rank Data">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- End Page Content -->
			</div>
		</div>
	</body>
</html>
