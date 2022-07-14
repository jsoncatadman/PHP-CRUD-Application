<?php
	include 'initialize.php';

	if(isset($_POST['did'])) {
		$departments = Department::find_by_college($_POST['did']);
		echo json_encode($departments);
	}
?>