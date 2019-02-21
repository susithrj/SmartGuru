<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>


<span id="countdown"></span>
	
	
<script>
/*var seconds = 40;
    function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
		document.getElementById("myForm").submit();
        document.getElementById('countdown').innerHTML = "Time Over ";
    } else {    
        seconds--;
    }
    }
var countdownTimer = setInterval('secondPassed()', 1000);
	
	*/
	var seconds = 0, minutes = 0, hours = 0,
    t;
	
	function add() {
    seconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            hours++;
        }
    }
    
    //h1.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
		
		document.getElementById('timer1').value = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
		//document.getElementById("timer1").readOnly = true;
		

    timer();
}
function timer() {
    t = setTimeout(add, 1000);
}
timer();
	
	
</script>

<?php
include_once 'dbConnection.php';
	 
if(@$_GET['q']== 'quiz'){
$lesson_id=@$_GET['id'];
$seq_no=@$_GET['n'];
$total=@$_GET['t'];
	
	
	//display the question
$query=mysqli_query($con,"SELECT * FROM question WHERE lesson_id='$lesson_id' AND seq_no='$seq_no' " );
echo '<div class="panel" style="margin:5%">';
while($row=mysqli_fetch_array($query) )
{
$question=$row['question_desc'];
$qs_id=$row['question_id'];
echo '<b>Question &nbsp;'.$seq_no.'&nbsp;:<br />'.$question.'</b><br /><br />';
}
	
	//display options for the question
$query=mysqli_query($con,"SELECT * FROM options WHERE question_id='$qs_id' " );
echo '<form id="myForm" action="update.php?q=quiz&id='.$lesson_id.'&n='.$seq_no.'&t='.$total.'&qs_id='.$qs_id.'" method="POST"  class="form-horizontal">
<input type="text" id="timer1" name="timer1"><br /><br />';

while($row=mysqli_fetch_array($query) )
{
$option=$row['option_text'];
$optionid=$row['option_id'];
echo'<input type="radio" name="answer" value="'.$optionid.'" required>'.$option.'<br /><br />';
}
echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}








//result display
if(@$_GET['q']== 'result' && @$_GET['eid']) 
{
$eid=@$_GET['eid'];
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error157');
echo  '<div class="panel">
<center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>'.$qa.'</td></tr>
      <tr style="color:#99cc32"><td>right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr> 
	  <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
	  <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
}
$q=mysqli_query($con,"SELECT * FROM rank WHERE  email='$email' " )or die('Error157');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
echo '<tr style="color:#990000"><td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
}
echo '</table></div>';

}
?>
	
	</body>
</html>