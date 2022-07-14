<?php
	include '../classes/databasemanager.class.php';
	include '../classes/academicrank.class.php';
	include '../classes/department.class.php';
	include '../classes/faculty.class.php';
	include '../classes/college.class.php';

	if(isset($_GET['Search'])) {
		$keyword = $_GET['keyword'];
		$display_faculties = Faculty::search_faculty($keyword);
	}
	else {
		$display_faculties = Faculty::display_joined_data();
	}

	// Get the page via GET request (URL param: page), if non exists default the page to 1
	$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
	$records_per_page = 5;
	$num_directories = Faculty::count_data();
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
					        			<div class="page-title">Faculty</div>
					        		</div>
					        		<div class="col">
					        			<div class="d-grid gap-2 d-md-flex justify-content-md-end">
											<button class="btn btn-primary" onclick="window.location.href='add.php';" type="button">Add Faculty</button>	
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
							<form class="d-flex" action="faculty.php" method="GET">
								<input class="form-control me-2" name="keyword" type="text" placeholder="Search name.. ." aria-label="Search">
								<input type="submit" name="Search" value="Search">
							</form>
						</div>
						<div class="row m-1 mt-3">
							<table class="table table-hover table-bordered align-middle">
								<thead>
									<tr bgcolor="#395a72" height="30px" class="align-middle">
										<th>Full name</th>
										<th>Email address</th>
										<th>Mobile number</th>
										<th>Rank</th>
										<th>College</th>
										<th>Department</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($display_faculties as $faculty) { ?>
										<tr>
											<td height="50px"><?php echo $faculty['first_name'] . " " . $faculty['last_name']; ?></td>
											<td height="50px"><?php echo $faculty['email_address']; ?></td>
											<td height="50px"><?php echo $faculty['mobile_number']; ?></td>
											<td height="50px"><?php echo $faculty['Rank']; ?></td>
											<td height="50px"><?php echo $faculty['College']; ?></td>
											<td height="50px"><?php echo $faculty['Department']; ?></td>
											<td><a class="action-button edit" href="edit.php?id=<?php echo $faculty['id']; ?>">Edit</a></td>

										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="pagination">
							<div class="row">
								<div class="col">
									<?php if ($page > 1): ?>
										<a href="faculty.php?page=<?=$page-1?>" class="btn btn-dark"> Back </a>
									<?php endif; ?>
								</div>
								<div class="col">
									<?php if ($page*$records_per_page < $num_directories): ?>
										<a href="faculty.php?page=<?=$page+1?>" class="btn btn-dark"> Next </a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Page Content -->
			</div>
		</div>
	</body>
</html>
