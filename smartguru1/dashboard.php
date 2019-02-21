
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>SmartGuru || Dashboard </title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>

 

  

<script>
$(function () {
    $(document).on( 'scroll', function(){
        console.log('scroll top : ' + $(window).scrollTop());
        if($(window).scrollTop()>=$(".logo").height())
        {
             $(".navbar").addClass("navbar-fixed-top");
        }

        if($(window).scrollTop()<$(".logo").height())
        {
             $(".navbar").removeClass("navbar-fixed-top");
        }
    });
});</script>
</head>

<body  style="background:#eee;">
<div class="header">
<div class="row">

<?php
 include_once 'dbConnection.php';
session_start();
$email=$_SESSION['email'];
  if(!(isset($_SESSION['email']))){
header("location:index.php");

}
else
{
$name = $_SESSION['email'];

include_once 'dbConnection.php';
echo '<span  ><span class="log1">&nbsp;&nbsp;Hello,</span> <a href="" >'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php" ></span>&nbsp;Signout</a></span>';
}?>

</div></div>

<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php"><b>Dashboard</b></a>
    </div>
    
  
  </div>
</nav>

<div class="container">
<div class="row">
<div class="col-md-12">

<?php if(@$_GET['q']==0) {

$result = mysqli_query($con,"SELECT * FROM lesson") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Time limit</b></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$id = $row['lesson_id'];
	$title = $row['lesson_name'];
	$time = $row['time'];
    $total = $row['total_qs'];
	

	echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$time.'&nbsp;min</td>
	<td><b><a href="quiz.php?q=quiz&id='.$id.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32">&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';


}
$c=0;
echo '</table></div>';

}
?>


</div>
</div></div>
</body>
</html>
