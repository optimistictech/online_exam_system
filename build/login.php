<?php
$my_username = $_POST['username'];
$my_password = $_POST['password'];

include '../db_config/connection.php';

$sql = "SELECT * FROM user_info where user_id='$my_username' or email='$my_username' and password='$my_password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
		$user_role = $row['role'];
		$fullname = $row['full_name'];
		$dept_id = $row['department_id'];
		if ($user_role == "Admin") {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $my_username;
            $_SESSION['fullname'] = $fullname;
			header("location:../admin/");
		}else{
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $my_username;
            $_SESSION['fullname'] = $fullname;
			$_SESSION['department_id'] = $dept_id;
			header("location:../student/");
		}
        
    }
} else {
   header("location:../?login_err=Account not found in database");
}
$conn->close();
?>