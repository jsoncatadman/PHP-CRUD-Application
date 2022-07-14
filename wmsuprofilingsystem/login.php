<?php
    session_start();
    include('./classes/databaseconfiguration.class.php');
    
    $database = new Connection();
	$db = $database->open();
	try{

		//make use of prepared statement to prevent sql injection
		$result = $db->prepare("SELECT id, concat(first_name, ' ', last_name) name, user_type, username, password FROM tblUserAccount WHERE username = :username and password = :password LIMIT 1");

        //bind params
        $result->bindParam(':username', $_POST['username']);
        $result->bindParam(':password', $_POST['password']);
		$result->execute();
        $row_count = $result->fetchColumn();

        if ($row_count > 0) {
            $result->execute();
            $row = $result->fetch();
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_type'] = $row['user_type'];

            if($_SESSION['user_type'] == 'Super Admin') {
                header("Location: /jacdev/app/wmsuprofilingsystem/admin");
                exit();
            }
            elseif ($_SESSION['user_type'] == 'Admin') {
                header("Location: dashboard.php");
                exit();
            }
            else {
                header("Location: dashboard.php");
                exit();
            }  
        } 
        else {
            header("Location: index.php?error=Invalid Username or password");
		    exit();
        }
	}
	catch(PDOException $e){
		$_SESSION['message'] = $e->getMessage();
	}

	//close connection
	$database->close();

?>