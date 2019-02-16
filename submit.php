<?php 
session_start();
include "connection.php";


	//$testNo=$_SESSION['testNo'];
	$sql = "SELECT * FROM ";
	$sql.=$_SESSION['domain'];
	$sql.=" WHERE testNo = ";
	$sql.=$_SESSION['testNo'];
	$answer = mysqli_query($con,$sql);
	$marks=0;
	while($check=mysqli_fetch_assoc($answer))
	{
			$string="q_".$check['id'];
			if(isset($_POST[$string]))
			{
			if($_POST[$string]==$check['answer'])
				$marks++;
			}
			
	}
	$store_sql="UPDATE apply2019 SET ";
	$store_sql.=$_SESSION['domain']."_Score =";
	$store_sql.=$marks." WHERE gr=".$_SESSION['grNo'];
	$answer = mysqli_query($con,$store_sql);
	session_destroy();
	//echo "<script>alert('Your  score is ".$marks.""."');</script>";

?>
<!doctype html>
<html>
<head>
<title>Submitted</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<div class="jumbotron text-xs-center">
<center>
  <h1 class="display-3">Thank You!</h1><center>
  <p class="lead"><strong>Your Response have been submited</strong> wait till  further instructions .</p>
  <hr>
  
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="login.php" role="button">Continue to homepage</a>
  </p>
</div>

</html>