<?php

		
if(isset($_POST['newstd'])) {
$stdname = $_POST['name'];
$stdem = $_POST['email'];
$stdadd = $_POST['address'];
$gender = $_POST['gender'];
$stdno = $_POST['stdno'];
$department_id = $_POST['department_name'];
 include '../db_config/connection.php';
$rs=("Select * from department WHERE department_id='$department_id'");
$result = $conn->query($rs);

	  while($row = $result->fetch_assoc())
{

 $department_name =$row["department_name"];


}



}else{
	header("location:./");
}
include '../db_config/connection.php';

$matricch=("Select * from user_info WHERE user_id='$stdno'");
$result = $conn->query($matricch);
if ($result->num_rows > 0) {
	header("location:new_student.php?msgi=Matric Number $stdno is not available&name=$stdname");
}
else{
$sql = "SELECT * FROM user_info where email = '$stdem'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
		$student = $row['full_name'];
       header("location:new_student.php?msg=Email $stdem is not available&student=$student");
    }
} else {
  $regdate = date('jS \ F Y h:i:s A');

$insert = "INSERT INTO `exam_system`.`user_info` (`department_id`, `user_id`, `user_index`, `full_name`, `gender`, `email`, `address`, `role`, `avatar`, `password`, `regdate`, `department_name`) VALUES ('$department_id', '$stdno', '', '$stdname', '$gender', '$stdem', '$stdadd', 'Student', NULL, '123456', '$regdate', '$department_name')";


if ($conn->query($insert) === TRUE) {
    header("location:new_student.php?message=$stdname have been registered with Matric no. $stdno");
} else {
	$error = $conn->error;
     header("location:new_student.php?err=$error");
}


}
}
$conn->close();

?>


