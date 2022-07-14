<?php
	include '../classes/databasemanager.class.php';
	include '../classes/academicrank.class.php';
	include '../classes/department.class.php';
	include '../classes/faculty.class.php';
	include '../classes/college.class.php';

	$faculty_count = Faculty::count_data();
	$rank_count = AcademicRank::count_data();
	$dept_count = Department::count_data();
	$coll_count = College::count_data();
	$display_faculties = Faculty::display_data();
	$display_colleges = College::display_data();
	$display_departments = Department::display_data();
?> 
<!DOCTYPE html>
<html>
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
				<div id="menubutton"><img onclick="myFunction()" src="images/hamburger.png" /></div>
			</div>
			<div class="description">PHP Application using OOP approach, MYSQL for the database, and Bootstrap 5 for the User Interface</div>
		</div>
		<div id="sidebar-container" class="sidebar">
			<a class="active" href="index.php">Dashboard</a>
			<a href="../logout.php">Logout</a>
		</div>
		<div class="content">
			<div class="container">
				<br>
				<div class="row">
					<div class="col">
						<div class="card">
					        <div class="card-body">
					        	<div class="row">
					        		<div class="col">
					        			<div class="page-title">Dashboard</div>
					        		</div>
					        		
						        </div>
					        </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 mt-3">
						<div class="card">
							<div class="card-header">NO. FACULTY</div>
							<div class="card-body text-center">
								<div class="count"><?php echo $faculty_count[0]['count_data'] ?></div>
							</div>
						</div>
					</div>
					<div class="col-md-3 mt-3">
						<div class="card">
							<div class="card-header">NO. RANK</div>
							<div class="card-body text-center">
								<div class="count"><?php echo $rank_count[0]['count_data'] ?></div>
							</div>
						</div>
					</div>
					<div class="col-md-3 mt-3">
						<div class="card">
							<div class="card-header">NO. COLLEGE</div>
							<div class="card-body text-center">
								<div class="count"><?php echo $coll_count[0]['count_data'] ?></div>
							</div>
						</div>
					</div>
					<div class="col-md-3 mt-3">
						<div class="card">
							<div class="card-header">NO. DEPARTMENT</div>
							<div class="card-body text-center">
								<div class="count"><?php echo $dept_count[0]['count_data'] ?></div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-7 mt-3">
						<div class="card">
							<div class="card-header">DIRECTORY</div>
							<div class="card-body ">
								<div class="row">
									<div class="col-md-4">
										<select name="rank" class="form-select form-select-lg" aria-label=".form-select-lg example" onchange="$display_departments = Department::find_by_id($college['id']);">
											<option selected>College</option>
											<?php
												foreach($display_colleges as $college) {
													echo '<option value="'.$college['id'].'">'.$college['description'].'</option>';
												}
											?>

											<option value="<?php echo $sql_res1["id"]; ?>" <?php if($sql_res1["id"]==$_REQUEST["cat_id"]) { echo "Selected"; } ?>><?php echo $sql_res1["category_name"]; ?></option>
										</select>
									</div>
									<div class="col-md-4">
										<select name="rank" class="form-select form-select-lg" aria-label=".form-select-lg example">
											<option selected>Department</option>
											<?php
												foreach($display_departments as $department) {
													echo '<option value="'.$department['id'].'">'.$department['description'].'</option>';
												}
											?>
										</select>
									</div>
									<div class="col-md-4">
										<div class="d-grid gap-2 d-md-flex justify-content-md-end">
											<input type="submit" name="Search" value="Search">
							            </div>
									</div>
								</div>
								<div class="row m-1 mt-3">
									<table class="table table-hover table-bordered">
										<thead>
											<tr bgcolor="#395a72" height="30px">
												<th>Full name</th>
												<th>Email address</th>
												<th>Mobile number</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($display_faculties as $faculty) { ?>
												<tr>
													<td height="50px"><?php echo $faculty['first_name'] . $faculty['last_name']; ?></td>
													<td height="50px"><?php echo $faculty['email_address']; ?></td>
													<td height="50px"><?php echo $faculty['mobile_number']; ?></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-5 mt-3">
						<div class="card">
							<div class="card-header">COLLEGES</div>
							<div class="card-body">
								<div class="row m-1 mt-3">
									<table class="table table-hover table-bordered table-responsive">
										<thead>
											<tr bgcolor="#395a72" height="30px">
												<th>Code</th>
												<th>Description</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($display_colleges as $college) { ?>
												<tr>
													<td height="50px"><?php echo $college['code'] ?></td>
													<td height="50px"><?php echo $college['description']; ?>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
