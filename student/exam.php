<?php
error_reporting(0);
include 'verfy_std.php';
   session_start();
            $my_username = $_SESSION['username'];
			$dept_id = $_SESSION['department_id'];
			include '../db_config/connection.php';
			
			$sql = "SELECT * FROM user_info where user_id='$my_username' or email='$my_username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
       $stdno = $row['user_id'];
	   $stdname = $row['full_name'];
	   $dept_id = $row['department_id'];
    }
} else {
}
$conn->close();
			
$result_id = 'RST:'.rand(10000000,99999999).'';
$today_date = date('jS \ F Y h:i:s A');


include '../db_config/connection.php';
$sql = "SELECT * FROM results_info where student_no='$stdno'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       header("location:begin_assessment.php");
    }
} else {
  include '../db_config/connection.php';

$sql = "INSERT INTO results_info (result_id, student_no, student_name, date)
VALUES ('$result_id', '$stdno', '$stdname', '$today_date')";

if ($conn->query($sql) === TRUE) {
session_start();
$_SESSION['examstarted'] = true;
    
} else {

}

$conn->close();
}




?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>OES | Examination</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
</head>
<style>
#myhead{
 margin:0 auto;
background-color:#4B77BE;
height:230px;
}

#myhead2{
  height:100%; margin:0 auto;
background-color:white;

}
</style>
<!-- Countdown css begin -->
<style type="text/css">

h1{
  color: white;
  font-weight: 100;
  font-size: 40px;
  margin: 0 0 4px 0;
}

#clockdiv{
	font-family: sans-serif;
	color: white;
	display: inline-block;
	font-weight: 100;
	text-align: center;

}

#clockdiv > div{
	padding: 10px;
	border-radius: 3px;
	background: #1b1c42;
	display: inline-block;
}

#clockdiv div > span{
	padding: 15px;
	border-radius: 3px;
	background: #3f6096;
	display: inline-block;
	
}

.smalltext{
	padding-top: 5px;
	
}
.rap{
	
	
	
	transform:translatex(-) translatey(-50);
	text-align:center;
	background:#152744;
	border:1px solid #999;
	padding:10px;
	box-shadow:0 0 5px 3px #ccc;
	position:fixed;
	top:0;
	right:0;
}

</style>
<!-- Countdown css end -->
<body class="hold-transition fixed skin-blue sidebar-mini">

<div class="wrapper">


<div  id="myhead" >

<?php
include '../db_config/connection.php';
$sql = "SELECT * FROM school_info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       $name = $row['name'];
	   $email = $row['email'];
	   $address = $row['address'];
	   $phone = $row['phone'];
	   $slogan = $row['slogan'];
    }
} else {
  
}
$conn->close();
?>


<center>
<h3 style="color:white; font-weight: bold;">
<?php 
$str = $name;
$str = strtoupper($name);
echo"$str"; ?>
</h3>
<p style="color:white; line-height: 35%; font-size: 14px;"><?php echo"$email"; ?></p>
<p style="color:white; line-height: 35%;font-size: 14px;"><?php echo"$address"; ?></p>
<p style="color:white; line-height: 35%; font-size: 14px;"><?php echo"$phone"; ?></p>
<i><p style="color:white; line-height: 35%; font-size: 14px;"><?php echo"$slogan"; ?></p></i>


<?php
include '../db_config/connection.php';
$sql = "SELECT * FROM school_info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
echo '<img style="width:120px;" src="data:image/jpeg;base64,'.base64_encode($row['logo'] ).'" class="img-circle" alt="'.$name.'" title="'.$name.'"  class="img-responsive"   />';
    }
} else {
  
}
$conn->close();
?>
</center>

</div>

<!-- Countdown html begin -->
<div class='rap'>

<div id="clockdiv" >
 <h1>Remaining Time</h1>
  <div>
    <span class="hours"></span>
    <div class="smalltext">Hours</div>
  </div>
  <div>
    <span class="minutes"></span>
    <div class="smalltext">Minutes</div>
  </div>
  <div>
    <span class="seconds"></span>
    <div class="smalltext">Seconds</div>
  </div>
</div>
</div>


<?php
include '../db_config/connection.php';
$sql = "SELECT * FROM exam_time";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$h =1;
$m =1 ;

}


?>

<!-- Countdown html end -->



<div id="myhead2" style="padding-left:20px; padding-right:20px;">
<form action="submit_exam.php"  name ='form1' method="GET">
<table style="font-size:15px;">
<?php
include '../db_config/connection.php';

$sql = "SELECT * FROM exam WHERE department_id='$dept_id'  ORDER BY RAND()  ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
		$quesno = 1;
		while($quesno <= 20) {
	while($row = $result->fetch_assoc()) {
		
		
    echo "<tr><td> Question " .$quesno.":  ".$row["question"]." </td>";
	print '<tr><td>A: <input type="radio" name="q'.$quesno.'" value="'.$row["option1"].'" > '.$row["option1"].'<br> </td></tr>';
	print '<tr><td>B: <input type="radio" name="q'.$quesno.'" value="'.$row["option2"].'" > '.$row["option2"].'<br></td></tr>';
	print '<tr><td>C: <input type="radio" name="q'.$quesno.'" value="'.$row["option3"].'" > '.$row["option3"].'<br></td></tr>';
	print '<tr><td>D: <input type="radio" name="q'.$quesno.'" value="'.$row["option4"].'" > '.$row["option4"].'<br></td></tr>';
	print '<tr><td colspan="10"><hr></td></tr>';
	print '<tr><td><input type="hidden" name="'.$quesno.'" value="'.$row["question_id"].'"</td></tr>';
    $quesno++;}
}
		 
} else {
    
}
$conn->close();


?>
</table>
<button type="submit" onclick="return confirm('Are you sure you want to submit your assessment ?')"  class="btn btn-primary">Submit Assessment</button><br><br>
</form>
</div>

<!-- Countdown Javascript begin -->

<script  type= "text/javascript ">
function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);

  return {
    'total': t,
   
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
 
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    var t = getTimeRemaining(endtime);

  
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
	if (t.minutes == 1 && t.seconds == 40) {
		alert("Less Than 2 Minute Remaining Pls Make Sure You Submit Your Examination Before The Time Run Out. Any Examination That is not submited is invalid ");
	}
   
  if (t.total <= 0) {
		alert("Time Up!");
		document.form1.submit();
	 
	 clearInterval(timeinterval);
    }
	 }
	 
	

  
   
   
	 var timeinterval = setInterval(updateClock, 1000);
  updateClock();
  
 
  
}

var deadline = new Date(Date.parse(new Date()) +  <?php echo"$h "?> * <?php echo"$m" ?> * 60 * 1000);
initializeClock('clockdiv', deadline);

</script>
<!-- Countdown Javascript end -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>

<footer >
    
	 <?php include('footer.php');?>
 
    
  </footer>
  </div>
</body>
</html>
