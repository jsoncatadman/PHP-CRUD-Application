<?php
	include '../classes/databasemanager.class.php';
	include '../classes/academicrank.class.php';
	include '../classes/department.class.php';
	include '../classes/faculty.class.php';
	include '../classes/college.class.php';

	$display_colleges = College::display_data();
	$display_departments = Department::display_data();
	$display_ranks = AcademicRank::display_data();

	if(isset($_POST['submit'])) {
		Faculty::add_faculty_data($_POST);
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
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#colleges").change(function(){
					var did = $("#colleges").val();
					$.ajax({
						url: 'filter_by_college.php',
						method: 'post',
						data: 'did=' + did
					}).done(function(departments){
						console.log(departments);
						departments = JSON.parse(departments);
						$('#departments').empty();
						$('#departments').append('<option selected>Department</option>')
						departments.forEach(function(dept){
							$('#departments').append('<option value="' + dept.id + '">' + dept.description + '</option>')
						})
					})
				})
			})
		</script>
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
			<a class="active" href="faculty.php">Faculty</a>
			<a href="../department/department.php">Department</a>
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
										<a class="clickable-page-title" href="faculty.php">Faculty</a>
										<div class="page-title"> &nbsp;- Add Faculty</div>
									</div>
									<div class="col">
										<div class="d-grid gap-2 d-md-flex justify-content-md-end">
											<button class="btn btn-secondary" onclick="window.location.href='faculty.php';" type="button">Back</button>	
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
								<div class="col-md-6">
									<div class="form-floating mb-3">
										<input type="number" name="emp_no" class="form-control" id="floatingInput" placeholder="First name">
										<label for="floatingInput">Employee No.</label>
									</div>
									<div class="mb-4">
										<select name="rank" class="form-select form-select-lg" aria-label=".form-select-lg example">
											<option selected>Academic Rank</option>
												<?php
													foreach($display_ranks as $rank) {
														echo '<option value="'.$rank['id'].'">'.$rank['description'].'</option>';
													}
												?>
										</select>
									</div>
									<div class="form-floating mb-3">
										<input type="text" name="first_name" class="form-control" id="floatingInput">
										<label for="floatingInput">Firstname</label>
									</div>
									<div class="form-floating mb-3">
										<input type="text" name="last_name" class="form-control" id="floatingInput">
										<label for="floatingInput">Lastname</label>
									</div>
									<div class="form-floating mb-3">
										<input type="tel" name="mobile_number" class="form-control" id="floatingInput">
										<label for="floatingInput">Mobile Number</label>
									</div>
									<div class="form-floating mb-3">
										<input type="email" name="email_address" class="form-control" id="floatingInput">
										<label for="floatingInput">Email Address</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-4">
										<select name="college" id="colleges" class="form-select form-select-lg" aria-label=".form-select-lg example">
											<option selected>College</option>
												<?php
													foreach($display_colleges as $college) {
														echo '<option value="'.$college['id'].'">'.$college['description'].'</option>';
													}
												?>
										</select>
									</div>
									<div class="mb-4">
										<select name="department" id="departments" class="form-select form-select-lg" aria-label=".form-select-lg example">
											<option selected>Department</option>
										</select>
									</div>
									<div class="form-floating mb-3">
										<input type="text" name="undergrad_course" class="form-control" id="floatingInput">
										<label for="floatingInput">Undergraduate Course</label>
									</div>
									<div class="form-floating mb-3">
										<input type="text" name="masters_degree" class="form-control" id="floatingInput">
										<label for="floatingInput">Master's Degree</label>
									</div>
									<div class="form-floating mb-3">
										<input type="text" name="doctorate_degree" class="form-control" id="floatingInput">
										<label for="floatingInput">Doctorate Degree</label>
									</div>
									<div class="d-grid gap-2 mt-4">
										<input type="submit" name="submit" value="Save Faculty Data">
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
