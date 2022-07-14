<?php
	include '../classes/databasemanager.class.php';
	include '../classes/college.class.php';
	include '../classes/department.class.php';

	if(isset($_GET['id']) && !empty($_GET['id'])) {
		$editId = $_GET['id'];
		$college = College::find_by_id($editId);
	}

	$display_departments = Department::find_by_college($college[0]['id']);

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
			<a href="../dashboard.php">Dashboard</a>
			<a href="../faculty/faculty.php">Faculty</a>
			<a href="../department/department.php">Department</a>
			<a class="active" href="college.php">College</a>
			<a href="../rank/rank.php">Academic Rank</a>
			<a href="../logout.php">Logout</a>
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
										<a class="clickable-page-title" href="college.php">College</a>
										<div class="page-title"> &nbsp;- View College</div>
									</div>
									<div class="col">
										<div class="d-grid gap-2 d-md-flex justify-content-md-end">
											<button class="btn btn-secondary" onclick="window.location.href='college.php';" type="button">Back</button>	
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
						<div class="row">
							<div class="col">
								<div class="form-floating mb-3">
									<input type="text" name="code" class="form-control" id="floatingInput" value="<?php echo $college[0]['code']; ?>" disabled>
									<label for="floatingInput">Code</label>
								</div>
								<div class="form-floating mb-3">
									<input type="text" name="description" class="form-control" id="floatingInput" value="<?php echo $college[0]['description']; ?>" disabled>
									<label for="floatingInput">Description</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="card">
					<div class="card-body">
						<div class="row m-1 mt-3">
							<table class="table table-hover table-bordered align-middle">
								<thead>
									<tr bgcolor="#395a72" height="30px" class="align-middle">
										<th>ID</th>
										<th>Description</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($display_departments as $department) { ?>
										<tr>
											<td height="50px"><?php echo $department['id']; ?></td>
											<td height="50px"><?php echo $department['description']; ?></td>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- End Page Content -->
			</div>
		</div>
	</body>
</html>
