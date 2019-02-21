<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
</head>

<body>


	<span id="countdown"></span>


	<script>

		var seconds = 0,
			minutes = 0,
			hours = 0,
			t;

		function add() {
			seconds++;
			if ( seconds >= 60 ) {
				seconds = 0;
				minutes++;
				if ( minutes >= 60 ) {
					minutes = 0;
					hours++;
				}
			}

			document.getElementById( 'timer1' ).value = ( hours ? ( hours > 9 ? hours : "0" + hours ) : "00" ) + ":" + ( minutes ? ( minutes > 9 ? minutes : "0" + minutes ) : "00" ) + ":" + ( seconds > 9 ? seconds : "0" + seconds );
			document.getElementById("timer1").readOnly = true;


			timer();
		}

		function timer() {
			t = setTimeout( add, 1000 );
		}
		timer();
	</script>

	<?php
	session_start();
	include_once 'dbConnection.php';

	if ( @$_GET[ 'q' ] == 'quiz' ) {
		$lesson_id = @$_GET[ 'id' ];
		$seq_no = @$_GET[ 'n' ];
		$total = @$_GET[ 't' ];
		$score = @$_GET[ 'score' ];



		//display the question
		$query = mysqli_query( $con, "SELECT * FROM question WHERE lesson_id='$lesson_id' AND seq_no='$seq_no' " );
		echo '<div class="panel" style="margin:5%">';
		while ( $row = mysqli_fetch_array( $query ) ) {
			$question = $row[ 'question_desc' ];
			$qs_id = $row[ 'question_id' ];

			echo '<b>Question &nbsp;' . $seq_no . '&nbsp;:<br />' . $question . '</b><br /><br />';
		}

		//display options for the question
		$query = mysqli_query( $con, "SELECT * FROM options WHERE question_id='$qs_id' " );
		echo '<form id="myForm" action="update.php?q=quiz&id=' . $lesson_id . '&n=' . $seq_no . '&t=' . $total . '&qs_id=' . $qs_id . '&score=' . $score . '" method="POST"  class="form-horizontal">
<input type="text" id="timer1" name="timer1"><br /><br />';

		while ( $row = mysqli_fetch_array( $query ) ) {
			$option = $row[ 'option_text' ];
			$optionid = $row[ 'option_id' ];
			echo '<input type="radio" name="answer" value="' . $optionid . '" required>' . $option . '<br /><br />';
		}
		echo '<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
		
	}


	//result display
	if ( @$_GET[ 'q' ] == 'result' && @$_GET[ 'lesson_id' ] ) {
		$lesson_id = @$_GET[ 'lesson_id' ];
		$score = @$_GET[ 'score' ];
		$username = $_SESSION[ "email" ];
		$date = date( "Y-m-d H:i:s" );
		$query = mysqli_query( $con, "INSERT INTO user_history VALUES ('$username', '$lesson_id', '$score', '$date') " )or die( 'Error' );
		echo 'Score : ' . $score . '';


	}
	?>

</body>

</html>