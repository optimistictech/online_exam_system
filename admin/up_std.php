<?php
$stdid = $_GET['ref'];

include 'check_login.php';

$fname = $_POST['name'];
$address = $_POST['address'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$matric = $_POST['matric'];
$department_id = $_POST['department_name'];
 include '../db_config/connection.php';
$rs=("Select * from department WHERE department_id='$department_id'");
$result = $conn->query($rs);

	  while($row = $result->fetch_assoc())
{

 $department_name =$row["department_name"];


}
$sql1 = "SELECT * FROM user_info where user_id='$matric' and email != '$email' ";
	$result = $conn->query($sql1);
if ($result->num_rows > 0) {

 while($row = $result->fetch_assoc()) {
		$fullname111 = $row['full_name'];
		echo "<script language='javascript'> alert('Matric Number Has Been Use By $fullname111 ');</script>";
 }
}
else{
$sql = "SELECT * FROM user_info where email='$email' and user_id != '$stdid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
		$fullname22 = $row['full_name'];
       header("location:update_std.php?ref=$stdid&msg=Email $email is used by $fullname22");
    }
} else  {
    include '../db_config/connection.php';
$sql3 = "UPDATE user_info SET department_id='$department_id',full_name='$fname', gender='$gender', email='$email', address='$address',department_name='$department_name' WHERE user_id='$stdid'";

if ($conn->query($sql3) === TRUE) {
	echo "<script language='javascript'> alert('Update Successfully');</script>";
   
   header("Refresh: 1; update_std.php?ref=$stdid");
} else {
$error = $conn->error;
     header("location:update_std.php?ref=$stdid&error=$error");
}


}
}
$conn->close();




?>