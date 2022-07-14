<?php
	include 'databaseconfiguration.class.php';
	
	class DatabaseManager {

		static protected $table_name = "";

		//** Generic functions
		static public function find_by_id($id) {
			$database = new Connection();
			$db = $database->open();
			try{
				//make use of prepared statement to prevent sql injection
				$stmt = $db->prepare("SELECT * FROM " . static::$table_name . " WHERE id = :id");

	            //bind params
	            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	            if($stmt->execute()) {
					// Fetch the records
					$record = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return($record);
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch (PDOException $e) {
				echo "There is some problem in connection: " . $e->getMessage();
			}
			//close connection
			$database->close();
			header('Location: faculty.php');
		}

		//** Dashboard
		static public function count_data() {
			$database = new Connection();
			$db = $database->open();
			try {
				$stmt = $db->prepare("SELECT COUNT(*) AS count_data FROM  " . static::$table_name . ";");
				
				if($stmt->execute()) {
					// Fetch the records
					$record = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return($record);
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch(PDOException $e){
				echo "There is some problem in connection: " . $e->getMessage();
			}
			//close connection
			$database->close();
			header('location: index.php');
		}

		static public function display_data() {
			$database = new Connection();
			$db = $database->open();
			try {
				$stmt = $db->prepare("SELECT * FROM  " . static::$table_name . ";");
				
				if($stmt->execute()) {
					// Fetch the records
					$record = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return($record);
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch(PDOException $e){
				echo "There is some problem in connection: " . $e->getMessage();
			}
			//close connection
			$database->close();
			header('location: index.php');
		}

		static public function find_by_college($id) {
			$database = new Connection();
			$db = $database->open();
			try{
				//make use of prepared statement to prevent sql injection
				$stmt = $db->prepare("SELECT * FROM " . static::$table_name . " WHERE colID_fk = :id");

	            //bind params
	            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	            if($stmt->execute()) {
					// Fetch the records
					$record = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return($record);
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch (PDOException $e) {
				echo "There is some problem in connection: " . $e->getMessage();
			}

			//close connection
			$database->close();
			header('Location: faculty.php');
		}

		static public function search_by_filter($collegeID, $departmentID) {
			$database = new Connection();
			$db = $database->open();
			try{
				//make use of prepared statement to prevent sql injection
				$stmt = $db->prepare("SELECT * FROM " . static::$table_name . " WHERE collegeID = :collegeID AND departmentID = :departmentID");

	            //bind params
	            $stmt->bindParam(':collegeID', $collegeID, PDO::PARAM_INT);
	            $stmt->bindParam(':departmentID', $departmentID, PDO::PARAM_INT);
	            if($stmt->execute()) {
					// Fetch the records
					$record = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return($record);
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch (PDOException $e) {
				echo "There is some problem in connection: " . $e->getMessage();
			}

			//close connection
			$database->close();
			header('Location: faculty.php');
		}

		//** Faculty
		static public function display_joined_data() {
			$database = new Connection();
			$db = $database->open();

			$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
			$records_per_page = 5;
			try {
				$stmt = $db->prepare("SELECT dir.id, dir.emp_no, dir.first_name, dir.last_name, dir.email_address, dir.mobile_number, acad.Description AS Rank, dept.Description AS Department, coll.code as College, dir.undergrad_course, dir.masters_degree, dir.doctorate_degree FROM tblFaculty AS dir  INNER JOIN tblAcademicRank AS acad ON dir.academic_rankID = acad.id INNER JOIN tblCollege AS coll ON dir.collegeID = coll.id  INNER JOIN tblDepartment AS dept ON dir.departmentID = dept.id ORDER BY dir.id LIMIT :current_page, :record_per_page;");

				$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
				$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);

				if($stmt->execute()) {
					// Fetch the records
					$record = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return($record);
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch(PDOException $e){
				echo "There is some problem in connection: " . $e->getMessage();
			}
			//close connection
			$database->close();
			//header('location: index.php');
		}

		static public function search_faculty($keyword) {
			$database = new Connection();
			$db = $database->open();
			try {
				$stmt = $db->prepare("SELECT dir.id, dir.emp_no, dir.first_name, dir.last_name, dir.email_address, dir.mobile_number, acad.Description AS Rank, dept.Description AS Department, coll.code as College, dir.undergrad_course, dir.masters_degree, dir.doctorate_degree FROM tblFaculty AS dir INNER JOIN tblAcademicRank AS acad ON dir.academic_rankID = acad.id INNER JOIN tblCollege AS coll ON dir.collegeID = coll.id INNER JOIN tblDepartment AS dept ON dir.departmentID = dept.id WHERE (dir.first_name LIKE '%".$keyword."%') OR (dir.last_name LIKE '%".$keyword."%') ORDER BY dir.id ASC;");

				if($stmt->execute()) {
					// Fetch the records
					$record = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return($record);
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch(PDOException $e){
				echo "There is some problem in connection: " . $e->getMessage();
			}
			//close connection
			$database->close();
			//header('location: index.php');
		}

		static public function add_faculty_data($post) {
			$database = new Connection();
			$db = $database->open();
			try{
				//make use of prepared statement to prevent sql injection
				$stmt = $db->prepare("INSERT INTO tblFaculty (emp_no, first_name, last_name, email_address, mobile_number, undergrad_course, masters_degree, doctorate_degree, academic_rankID, departmentID, collegeID) VALUES (:emp_no, :first_name, :last_name, :email_address, :mobile_number, :undergrad_course, :masters_degree, :doctorate_degree, :rank, :department, :college)");

				//bind
				$stmt->bindParam(':emp_no', $post['emp_no']);
				$stmt->bindParam(':first_name', $post['first_name']);
	            $stmt->bindParam(':last_name', $post['last_name']);
				$stmt->bindParam(':email_address', $post['email_address']);
				$stmt->bindParam(':mobile_number', $post['mobile_number']);
				$stmt->bindParam(':undergrad_course', $post['undergrad_course']);
	            $stmt->bindParam(':masters_degree', $post['masters_degree']);
				$stmt->bindParam(':doctorate_degree', $post['doctorate_degree']);
				$stmt->bindParam(':rank', $post['rank']);
				$stmt->bindParam(':department', $post['department']);
				$stmt->bindParam(':college', $post['college']);

				if($stmt->execute()) {
					echo "Successful Transaction";
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch(PDOException $e){
				echo "There is some problem in connection: " . $e->getMessage();
			}
			//close connection
			$database->close();
			header('Location: faculty.php');
		}

		static public function edit_faculty_data($post) {
			$database = new Connection();
			$db = $database->open();
			try{
				//make use of prepared statement to prevent sql injection
				$stmt = $db->prepare("UPDATE tblFaculty SET emp_no = :emp_no, first_name = :first_name, last_name = :last_name, email_address = :email_address, mobile_number = :mobile_number, undergrad_course = :undergrad_course, masters_degree = :masters_degree, doctorate_degree = :doctorate_degree, academic_rankID = :rank, departmentID = :department, collegeID = :college WHERE id = :id;");
				//bind
				$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
				$stmt->bindParam(':emp_no', $post['emp_no']);
				$stmt->bindParam(':first_name', $post['first_name']);
	            $stmt->bindParam(':last_name', $post['last_name']);
				$stmt->bindParam(':email_address', $post['email_address']);
				$stmt->bindParam(':mobile_number', $post['mobile_number']);
				$stmt->bindParam(':undergrad_course', $post['undergrad_course']);
	            $stmt->bindParam(':masters_degree', $post['masters_degree']);
				$stmt->bindParam(':doctorate_degree', $post['doctorate_degree']);
				$stmt->bindParam(':rank', $post['rank']);
				$stmt->bindParam(':department', $post['department']);
				$stmt->bindParam(':college', $post['college']);

				if($stmt->execute()) {
					echo "Successful Transaction";
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch(PDOException $e){
				echo "There is some problem in connection: " . $e->getMessage();
			}
			//close connection
			$database->close();
			header('Location: faculty.php');
		}

		//** Department
		static public function add_department_data($post) {
			$database = new Connection();
			$db = $database->open();
			try{
				//make use of prepared statement to prevent sql injection
				$stmt = $db->prepare("INSERT INTO tblDepartment (description, colID_fk) VALUES (:description, :college)");

				//bind
				$stmt->bindParam(':description', $post['description']);
				$stmt->bindParam(':college', $post['college']);

				if($stmt->execute()) {
					echo "Successful Transaction";
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch(PDOException $e){
				echo "There is some problem in connection: " . $e->getMessage();
			}
			//close connection
			$database->close();
			header('Location: department.php');
		}

		static public function edit_department_data($post) {
			$database = new Connection();
			$db = $database->open();
			try{
				//make use of prepared statement to prevent sql injection
				$stmt = $db->prepare("UPDATE tblDepartment SET description = :description, colID_fk = :college WHERE id = :id;");
				//bind
				$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
				$stmt->bindParam(':description', $post['description']);
				$stmt->bindParam(':college', $post['college']);

				if($stmt->execute()) {
					echo "Successful Transaction";
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch(PDOException $e){
				echo "There is some problem in connection: " . $e->getMessage();
			}
			//close connection
			$database->close();
			header('Location: department.php');
		}

		//** College
		static public function add_college_data($post) {
			$database = new Connection();
			$db = $database->open();
			try{
				//make use of prepared statement to prevent sql injection
				$stmt = $db->prepare("INSERT INTO tblCollege (code, description) VALUES (:code, :description)");

				//bind
				$stmt->bindParam(':code', $post['code']);
				$stmt->bindParam(':description', $post['description']);

				if($stmt->execute()) {
					echo "Successful Transaction";
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch(PDOException $e){
				echo "There is some problem in connection: " . $e->getMessage();
			}
			//close connection
			$database->close();
			header('Location: college.php');
		}

		static public function edit_college_data($post) {
			$database = new Connection();
			$db = $database->open();
			try{
				//make use of prepared statement to prevent sql injection
				$stmt = $db->prepare("UPDATE tblCollege SET code = :code, description = :description WHERE id = :id;");
				//bind
				$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
				$stmt->bindParam(':code', $post['code']);
				$stmt->bindParam(':description', $post['description']);

				if($stmt->execute()) {
					echo "Successful Transaction";
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch(PDOException $e){
				echo "There is some problem in connection: " . $e->getMessage();
			}
			//close connection
			$database->close();
			header('Location: college.php');
		}

		//** Academic Rank
		static public function add_academicrank_data($post) {
			$database = new Connection();
			$db = $database->open();
			try{
				//make use of prepared statement to prevent sql injection
				$stmt = $db->prepare("INSERT INTO tblAcademicRank (description) VALUES (:description)");

				//bind
				$stmt->bindParam(':description', $post['description']);

				if($stmt->execute()) {
					echo "Successful Transaction";
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch(PDOException $e){
				echo "There is some problem in connection: " . $e->getMessage();
			}
			//close connection
			$database->close();
			header('Location: rank.php');
		}

		static public function edit_academicrank_data($post) {
			$database = new Connection();
			$db = $database->open();
			try{
				//make use of prepared statement to prevent sql injection
				$stmt = $db->prepare("UPDATE tblAcademicRank SET description = :description WHERE id = :id;");
				//bind
				$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
				$stmt->bindParam(':description', $post['description']);

				if($stmt->execute()) {
					echo "Successful Transaction";
				}
				else {
					echo "Something went wrong.";
				}
			}
			catch(PDOException $e){
				echo "There is some problem in connection: " . $e->getMessage();
			}
			//close connection
			$database->close();
			header('Location: rank.php');
		}
	}

?>
