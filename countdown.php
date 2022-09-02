<!Doctype html>
<html>
<head>
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
	
	top:50;
	left:50;
	transform:translatex(-) translatey(-50);
	text-align:center;
	background:#152744;
	border:1px solid #999;
	padding:10px;
	box-shadow:0 0 5px 3px #ccc;
	
}
</style>

</head>
<body>
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
$h = 1;
$m =1;



?>

<!-- Countdown html end -->


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
  if (t.total <= 0) {
		alert("Time Up!");
	 
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


</body>
</html>