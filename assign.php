<?php 
		//this is just hardcoding of schedule of test 
		date_default_timezone_set('Asia/Kolkata');
		 session_start();
		 include("connection.php");
if(!isset($_SESSION['grNo']))
{
	
	//echo "<script>alert('you are  not logged in')</script>";
	//sleep(3);
	header("location: login.php");
	
}
print_r($_SESSION['grNo']);
$date = date('Y-m-d H:i:s');
//print_r($date);
$testNo=2;
$elex_start_time = '2019-02-15 10:00:00';
$elex_end_time = '2019-02-15 22:00:07';
$pro_start_time = '2019-02-11 20:00:00';
$pro_end_time = '2019-02-16 22:00:00';
$mech_start_time = '2019-02-18 20:00:00';
$mech_end_time = '2019-02-18 22:00:00';
if(((strtotime($elex_start_time))<strtotime($date))and ((strtotime($elex_end_time))>strtotime($date)) )
{
	$str="Elex paper no ".$testNo." will be displayed";
	$_SESSION['domain']="elex";
	$_SESSION['testNo']=$testNo;
	echo $str;
}if(((strtotime($pro_start_time))<strtotime($date))and ((strtotime($pro_end_time))>strtotime($date)) )
{
	$str="Programming paper no ".$testNo." will be displayed";
	$_SESSION['domain']="pro";
	$_SESSION['testNo']=$testNo;
	echo $str;
}
if(((strtotime($mech_start_time))<strtotime($date))and ((strtotime($mech_end_time))>strtotime($date)) )
{
	$str="Mech paper no ".$testNo." will be displayed";
	$_SESSION['domain']="mech";
	$_SESSION['testNo']=$testNo;
	echo $str;
}
if(!isset($_SESSION['domain']))
{
	header("location:schedule.php");
	session_destroy();
}
?>