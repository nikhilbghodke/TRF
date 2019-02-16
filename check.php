<?php 
		 date_default_timezone_set('Asia/Kolkata');
		$sql = "SELECT * FROM apply2019 WHERE gr = ".$_SESSION['grNo'] ;
        $result = mysqli_query($con,$sql);
		if($result)
		{
			echo "Set hai";
		}
		while($row=mysqli_fetch_assoc($result))
		{
			$reg=$row['domain'];
			$reg=preg_split ("/\,/", $reg); 
			if(strcmp($_SESSION['domain'],'elex')==0)
			{
				if(!in_array("Elex",$reg))
				{
					echo "<script>alert('You have Not Registered For Todays Test');</script>";
					session_destroy();
					header("location:notRegistered.php");
				}
				if(!is_null($row['elex_Score']))
				{
					echo "<script>alert('You have  already Submitted Todays Test');</script>";
					session_destroy();
					header("location:testAlreadyGiven.php");
				}
			}
			if(strcmp($_SESSION['domain'],'pro')==0)
			{
				if(!in_array("Prog",$reg))
				{
					echo "<script>alert('You have Not Registered For Todays Test');</script>";
					session_destroy();
					header("location:notRegistered.php");
				}
				if(!is_null($row['pro_Score']))
				{
					echo "<script>alert('You have  already Submitted Todays Test');</script>";
					session_destroy();
					header("location:testAlreadyGiven.php");
				}
			}
			if(strcmp($_SESSION['domain'],'mech')==0)
			{
				if(!in_array("Mech",$reg))
				{
					echo "<script>alert('You have Not Registered For Todays Test');</script>";
					session_destroy();
					header("location:notRegistered.php");
				}
				if(!is_null($row['mech_Score']))
				{
					echo "<script>alert('You have  already Submitted Todays Test');</script>";
					session_destroy();
					header("location:testAlreadyGiven.php");
				}
			}
			
			
		}

 ?>