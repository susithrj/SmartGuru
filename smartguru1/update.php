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

$score = 0;

if ( @$_GET[ 'q' ] == 'quiz' ) {
	$lesson_id = @$_GET[ 'id' ];
	$sn = @$_GET[ 'n' ];
	$total = @$_GET[ 't' ];
	$answer = $_POST[ 'answer' ];
	$time = $_POST[ 'timer1' ];
	$qs_id = @$_GET[ 'qs_id' ];
	$username = $_SESSION[ "email" ];
	$is_correct = 0;
	$score = @$_GET[ 'score' ];


	$query = mysqli_query( $con, "SELECT * FROM answer WHERE question_id='$qs_id' " );
	while ( $row = mysqli_fetch_array( $query ) ) {
		$answer_id = $row[ 'answer_id' ];
	}

	//if the given anser is correct
	if ( $answer == $answer_id ) {
		$is_correct = 1;

		$query = mysqli_query( $con, "SELECT * FROM question WHERE question_id='$qs_id' " );
		while ( $row = mysqli_fetch_array( $query ) ) {
			$score += $row[ 'points' ];
		}
		if ( $sn == 1 ) {

		}

	} else {

	}
	$query = mysqli_query( $con, "INSERT INTO user_answers VALUES ('$username','$qs_id', '$is_correct', '$time') " );


	if ( $sn != $total ) {
		$sn++;
		header( "location:quiz.php?q=quiz&id=$lesson_id&n=$sn&t=$total&score=$score" )or die( 'Error152' );
	}

	header( "location:quiz.php?q=result&lesson_id=$lesson_id&score=$score" );

}

?>