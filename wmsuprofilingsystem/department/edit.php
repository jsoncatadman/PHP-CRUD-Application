<?php


	include '../classes/databasemanager.class.php';
	include '../classes/college.class.php';
	include '../classes/department.class.php';

	$display_colleges = College::display_data();


	if(isset($_GET['id']) && !empty($_GET['id'])) {
		$editId = $_GET['id'];
		$department = Department::find_by_id($editId);
	}

	if(isset($_POST['submit'])) {
		Department::edit_department_data($_POST);
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
			<a href="../dashboard.php">Dashboard</a>
			<a href="../faculty/faculty.php">Faculty</a>
			<a class="active" href="department.php">Department</a>
			<a href="../college/college.php">College</a>
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
										<a class="clickable-page-title" href="department.php">Department</a>
										<div class="page-title"> &nbsp;- Modify Department Data</div>
									</div>
									<div class="col">
										<div class="d-grid gap-2 d-md-flex justify-content-md-end">
											<button class="btn btn-secondary" onclick="window.location.href='department.php';" type="button">Back</button>	
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
						<form action="edit.php?id=<?php echo $department[0]['id']; ?>" method="POST">
							<div class="row">
								<div class="col-md-6">
									<div class="form-floating mb-3">
										<input type="text" name="description" class="form-control" id="floatingInput" value="<?php echo $department[0]['description']; ?>">
										<label for="floatingInput">Description</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-4">
										<select name="college" class="form-select form-select-lg" aria-label=".form-select-lg example">
											<option selected>College</option>
												<?php
													foreach($display_colleges as $college) {
														if($college['id'] == $department[0]['colID_fk']) {
															echo '<option selected="selected" value="'.$college['id'].'">'.$college['description'].'</option>';
														}
														else {
															echo '<option value="'.$college['id'].'">'.$college['description'].'</option>';
														}
													}
												?>
										</select>
									</div>
									<div class="d-grid gap-2 mt-4">
										<input type="submit" name="submit" value="Save Department Data">
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
