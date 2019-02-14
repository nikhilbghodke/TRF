<?php 
session_start();
include "connection.php";


	//$testNo=$_SESSION['testNo'];
	echo "acha hai";
	$sql = "SELECT * FROM ";
	$sql.=$_SESSION['domain'];
	$sql.=" WHERE testNo = ";
	$sql.=$_SESSION['testNo'];
	$answer = mysqli_query($con,$sql);
	$marks=0;
	while($check=mysqli_fetch_assoc($answer))
	{
			$string="q_".$check['id'];
			if($_POST[$string]==$check['answer'])
				$marks++;
			
	}
	$store_sql="UPDATE apply2019 SET ";
	$store_sql.=$_SESSION['domain']."_Score =";
	$store_sql.=$marks." WHERE gr=".$_SESSION['grNo'];
	$answer = mysqli_query($con,$store_sql);
	
	echo "<script>alert('Your  score is ".$marks.""."');</script>";
	
	


?>