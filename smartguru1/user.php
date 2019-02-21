<?php
include_once 'dbConnection.php';
$ref=@$_GET['q'];
$email = $_POST['username'];
$password = $_POST['password'];

$email = stripslashes($email);
$email = addslashes($email);
$password = stripslashes($password); 
$password = addslashes($password);
$result = mysqli_query($con,"SELECT email FROM user WHERE username = '$email' and password = '$password'") or die('Error');
$count=mysqli_num_rows($result);
if($count==1){
session_start();
if(isset($_SESSION['email'])){
session_unset();}
$_SESSION["email"] = $email;
header("location:dashboard.php?q=0");
}

else header("location:$ref?w=Warning : Access denied");
?>