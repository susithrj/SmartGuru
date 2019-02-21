<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Re</title>
</head>

<body>
</body>

</html>

<?php
session_start();
include_once 'dbConnection.php';

if ( @$_GET[ 'q' ] == 'quiz' ) {
	$lesson_id = @$_GET[ 'id' ];
	$sn = @$_GET[ 'n' ];
	$total = @$_GET[ 't' ];
	$answer = $_POST[ 'answer' ];
	$time = $_POST[ 'timer1' ];
	$qs_id = @$_GET[ 'qs_id' ];
	$username = $_SESSION[ "email" ];
	$is_correct = 0;
	

	$query = mysqli_query( $con, "SELECT * FROM answer WHERE question_id='$qs_id' " );
	while ( $row = mysqli_fetch_array( $query ) ) {
		$answer_id = $row[ 'answer_id' ];
	}

	//if the given anser is correct
	if ( $answer == $answer_id ) {
		$is_correct = 1;
				
		$query = mysqli_query( $con, "SELECT * FROM lesson WHERE lesson_id='$lesson_id' " );
		while ( $row = mysqli_fetch_array( $query ) ) {
			//$sahi=$row['sahi'];
		}
		if ( $sn == 1 ) {
			//$query=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW())")or die('Error');
		}
		//$query=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');

		//while($row=mysqli_fetch_array($q) )
		{
			//$s=$row['score'];
			//$r=$row['sahi'];
		}
		//$r++;
		//$s=$s+$sahi;
		//$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');

	} else {
		
	}
	$query = mysqli_query( $con, "INSERT INTO user_answers VALUES ('$username','$qs_id', '$is_correct', '$time') " );

	//if the given answer is incorrect
	/*	
	else
	{
	$q=mysqli_query($con,"SELECT * FROM lesson WHERE eid='$lesson_id' " )or die('Error129');

	while($row=mysqli_fetch_array($q) )
	{
	$wrong=$row['wrong'];
	}
	if($sn == 1)
	{
	$q=mysqli_query($con,"INSERT INTO history VALUES('$email','$lesson_id' ,'0','0','0','0',NOW() )")or die('Error137');
	}
	$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$lesson_id' AND email='$email' " )or die('Error139');
	while($row=mysqli_fetch_array($q) )
	{
	$s=$row['score'];
	$w=$row['wrong'];
	}
	$w++;
	$s=$s-$wrong;
	$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$lesson_id'")or die('Error147');
	}
		*/

	

	if ( $sn != $total ) {
		$sn++;
		header( "location:quiz.php?q=quiz&id=$lesson_id&n=$sn&t=$total" )or die( 'Error152' );
	}

	//header("location:account.php?q=result&eid=$eid");

}

?>