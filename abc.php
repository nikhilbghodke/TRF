
text/x-generic TestPage.php ( PHP script text )
<?php
/*
session_start();
    if(!isset($_SESSION["password"]))   //session variables are reset after every half hour
    {
        header('Location: publicity_login');    
    }
    else
    {

    }
*/ 
    /*date_default_timezone_set("Asia/Kolkata");	//set time zone
    $deadlineday=date_create("2018-04-01");
    $deadlinetime=00;
	if(date("Y-m-d")==date_format($deadlineday,"Y-m-d")&&(idate("H")>=$deadlinetime))
	{
		echo '<script>';
	    echo 'alert("Sorry!! Cannot submit the form, deadline has passed")';
	    echo "</script>";
	}
	else if(date("Y-m-d")>date_format($deadlineday,"Y-m-d"))
    {
    	echo '<script>';
	    echo 'alert("Sorry!! Cannot submit the form, deadline has passed")';
	    echo "</script>";
	}
	else
	{*/
		session_start();
		if($_SERVER['REQUEST_METHOD']==('POST')&&isset($_POST['submit']))
		{
		    $name=$_POST['fname'];
		    $gr=$_POST['gr'];
		    $shift=$_POST['shift'];
		    $domain=$_POST['domain'];
		    $_SESSION['gr']=$gr;
		   	include 'db_con.php';

		   	$sql = "SELECT testgiven FROM interviewee2018 WHERE grno='$gr'";
		   	$result = $con->query($sql);
		   	if ($result->num_rows > 0) {
		   		while($row = $result->fetch_assoc()) 
		   		{
			   		if ($row["testgiven"]&&($gr!=14)) 
			   		{	
			   					$_SESSION['alert']=1;
				            	header("Location:OnlineTest");
			   		}
		   		}	
			} 
			else {
				$_SESSION['alert']=2;
            	header("Location:OnlineTest");
			}

		   	$qUery="UPDATE interviewee2018 SET testgiven=1, shift='$shift' WHERE grno='$gr'";
		   	if ($con->query($qUery) === TRUE) {
		   	echo '<script>';
			    echo 'alert("Test Started!")';
			    echo "</script>";
			    
			} else {
			  
			}
		   	
		   	$con->close();	
		}
		
		unset($_SERVER['REQUEST_METHOD']);  
	//}
?>

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<style type="text/css">
		form
	    {
	        box-shadow:0px 0px 20px darkgreen!important;
	        border:1px 1px 1px 1px darkgreen!important;
            font-family: 'Acme';
	    }
	    label
	    {
            /*font-family: 'Acme'!important;*/
	        color:darkgreen;
	    }
	    #submit
	    {
	        background-color:darkgreen;
	        color: white;
	    }
/*div.stars 
{
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}*/
</style>


<html>
<head>

    <title>TRF Online Test</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1" />
    <link rel="icon" href="img/trf.jpg" />
    <script language="javascript" src="js/main.js"></script>
    <link rel="stylesheet" type="text/css" href="css/register_main.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />

    <!--google fonts/icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href='https://fonts.googleapis.com/css?family=Antic' rel='stylesheet'>    <!-- Antic font -->
    <link href='https://fonts.googleapis.com/css?family=Alegreya Sans' rel='stylesheet'> <!-- Alegreya Sans font -->

</head>


<body onscroll="scrollFunction()">

    <!-- navigation bar and loading graphics -->
    <?php include 'loadgrphc.php';?>
    <?php include 'nav.php';?>
    <img src="img/test.jpg" class="img-responsive feature_image" width="100%"/>
    <div class="col-xs-0 col-md-1"></div>
    <div class="form-group col-xs-12 col-md-10">

    <form action='Submit' method="POST" id="quespaper" name="quespaper">
            <fieldset>
            <div class="col-md-12">
                <legend align="center" style="background-color: darkgreen;color: white">TRF Online Test</legend> 
                <center style="color: red;font-size: 22px;"><b>PLEASE DO NOT GO BACK OR CLOSE THIS PAGE</b></center>
                <div class="container-fluid">
				        <div class="col-sm-12 col-md-12">
				        <!-- <center style="color: black;"><b>Test ends in 30 mins</b></center> -->
				        </div>
				    	<center style="color: red;font-size: 22px;">Time left<br/><br/><span class='square'><span id="timer"></span></span></center>
				        <p id="demo" style="text-align: center;"></p>
				</div>
				<br/><br/>
				<?php
					include 'db_con.php';
					$domaincount=0;$totalcount=0;
					$elexeasy=0;$elexmed=0;$elexhard=0;$mecheasy=0;$mechmed=0;$mechhard=0;$progeasy=0;$progmed=0;$proghard=0;
					$aptieasy=0;$aptimed=0;$aptihard=0;
					$quesdone = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
					while($totalcount<25)
					{
						randomques:
						$srno=rand(1,194);
						for($i=0;$i<=24;$i++)
						{
							if($srno==$quesdone[$i])
							{
								goto randomques;
							}
						}

						$sql = "SELECT * FROM online_test WHERE srno='$srno'";
						$result = $con->query($sql);

						if ($result->num_rows > 0) {
					    // output data of each row
						    while($row = $result->fetch_assoc()) 
						    {
						    	$correctopt=array(-1,-1,-1,-1);
						    	//mech section
						    	if(($row['domain']==3)&&($mecheasy<2)&&($row['audience']==1)&&($row['diff']==1))
						    	{
						    		$quesdone[$totalcount]=$srno;
									$totalcount++;
									$mecheasy++;
									$correctopt[$row['correctopt']-1]=4;
						    		echo '<label>Q'.$totalcount.') '.utf8_decode($row['ques']).'</label><br>
						    		<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[0].'">'.utf8_decode($row['option1']).'</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[1].'">'.utf8_decode($row['option2']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[2].'">'.utf8_decode($row['option3']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[3].'">'.utf8_decode($row['option4']).'</label>
									</div><br>';
								}
								else if(($row['domain']==3)&&($mechmed<1)&&($row['audience']==1)&&($row['diff']==2))
						    	{
						    		$quesdone[$totalcount]=$srno;
									$totalcount++;
									$mechmed++;
									$correctopt[$row['correctopt']-1]=4;
						    		echo '<label>Q'.$totalcount.') '.utf8_decode($row['ques']).'</label><br>
						    		<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[0].'">'.utf8_decode($row['option1']).'</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[1].'">'.utf8_decode($row['option2']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[2].'">'.utf8_decode($row['option3']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[3].'">'.utf8_decode($row['option4']).'</label>
									</div><br>';
								}
								else if(($row['domain']==3)&&($mechhard<2)&&($row['audience']==1)&&($row['diff']==3))
						    	{
						    		$quesdone[$totalcount]=$srno;
									$totalcount++;
									$mechhard++;
									$correctopt[$row['correctopt']-1]=4;
						    		echo '<label>Q'.$totalcount.') '.utf8_decode($row['ques']).'</label><br>
						    		<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[0].'">'.utf8_decode($row['option1']).'</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[1].'">'.utf8_decode($row['option2']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[2].'">'.utf8_decode($row['option3']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[3].'">'.utf8_decode($row['option4']).'</label>
									</div><br>';
								}
								//prog section
								else if(($row['domain']==2)&&($progeasy<2)&&($row['audience']==1)&&($row['diff']==1))
						    	{
						    		$quesdone[$totalcount]=$srno;
									$totalcount++;
									$progeasy++;
									$correctopt[$row['correctopt']-1]=4;
						    		echo '<label>Q'.$totalcount.') '.utf8_decode($row['ques']).'</label><br>
						    		<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[0].'">'.utf8_decode($row['option1']).'</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[1].'">'.utf8_decode($row['option2']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[2].'">'.utf8_decode($row['option3']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[3].'">'.utf8_decode($row['option4']).'</label>
									</div><br>';
								}
								else if(($row['domain']==2)&&($progmed<1)&&($row['audience']==1)&&($row['diff']==2))
						    	{
						    		$quesdone[$totalcount]=$srno;
									$totalcount++;
									$progmed++;
									$correctopt[$row['correctopt']-1]=4;
						    		echo '<label>Q'.$totalcount.') '.utf8_decode($row['ques']).'</label><br>
						    		<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[0].'">'.utf8_decode($row['option1']).'</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[1].'">'.utf8_decode($row['option2']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[2].'">'.utf8_decode($row['option3']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[3].'">'.utf8_decode($row['option4']).'</label>
									</div><br>';
								}
								else if(($row['domain']==2)&&($proghard<2)&&($row['audience']==1)&&($row['diff']==3))
						    	{
						    		$quesdone[$totalcount]=$srno;
									$totalcount++;
									$proghard++;
									$correctopt[$row['correctopt']-1]=4;
						    		echo '<label>Q'.$totalcount.') '.utf8_decode($row['ques']).'</label><br>
						    		<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[0].'">'.utf8_decode($row['option1']).'</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[1].'">'.utf8_decode($row['option2']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[2].'">'.utf8_decode($row['option3']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[3].'">'.utf8_decode($row['option4']).'</label>
									</div><br>';
								}
								//elex section
								else if(($row['domain']==1)&&($elexeasy<2)&&($row['diff']==1))
						    	{
						    		$quesdone[$totalcount]=$srno;
									$totalcount++;
									$elexeasy++;
									$correctopt[$row['correctopt']-1]=4;
						    		echo '<label>Q'.$totalcount.') '.utf8_decode($row['ques']).'</label><br>
						    		<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[0].'">'.utf8_decode($row['option1']).'</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[1].'">'.utf8_decode($row['option2']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[2].'">'.utf8_decode($row['option3']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[3].'">'.utf8_decode($row['option4']).'</label>
									</div><br>';
								}
								else if(($row['domain']==1)&&($elexmed<1)&&($row['diff']==2))
						    	{
						    		$quesdone[$totalcount]=$srno;
									$totalcount++;
									$elexmed++;
									$correctopt[$row['correctopt']-1]=4;
						    		echo '<label>Q'.$totalcount.') '.utf8_decode($row['ques']).'</label><br>
						    		<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[0].'">'.utf8_decode($row['option1']).'</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[1].'">'.utf8_decode($row['option2']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[2].'">'.utf8_decode($row['option3']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[3].'">'.utf8_decode($row['option4']).'</label>
									</div><br>';
								}
								else if(($row['domain']==1)&&($elexhard<2)&&($row['diff']==3))
						    	{
						    		$quesdone[$totalcount]=$srno;
									$totalcount++;
									$elexhard++;
									$correctopt[$row['correctopt']-1]=4;
						    		echo '<label>Q'.$totalcount.') '.utf8_decode($row['ques']).'</label><br>
						    		<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[0].'">'.utf8_decode($row['option1']).'</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[1].'">'.utf8_decode($row['option2']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[2].'">'.utf8_decode($row['option3']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[3].'">'.utf8_decode($row['option4']).'</label>
									</div><br>';
								}
								//apti section
								else if(($row['domain']==4)&&($aptieasy<2)&&($row['audience']==1)&&($row['diff']==1))
						    	{
						    		$quesdone[$totalcount]=$srno;
									$totalcount++;
									$aptieasy++;
									$correctopt[$row['correctopt']-1]=4;
						    		echo '<label>Q'.$totalcount.') '.utf8_decode($row['ques']).'</label><br>
						    		<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[0].'">'.utf8_decode($row['option1']).'</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[1].'">'.utf8_decode($row['option2']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[2].'">'.utf8_decode($row['option3']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[3].'">'.utf8_decode($row['option4']).'</label>
									</div><br>';
								}
								else if(($row['domain']==4)&&($aptimed<1)&&($row['audience']==1)&&($row['diff']==2))
						    	{
						    		$quesdone[$totalcount]=$srno;
									$totalcount++;
									$aptimed++;
									$correctopt[$row['correctopt']-1]=4;
						    		echo '<label>Q'.$totalcount.') '.utf8_decode($row['ques']).'</label><br>
						    		<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[0].'">'.utf8_decode($row['option1']).'</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[1].'">'.utf8_decode($row['option2']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[2].'">'.utf8_decode($row['option3']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[3].'">'.utf8_decode($row['option4']).'</label>
									</div><br>';
								}
								else if(($row['domain']==4)&&($aptihard<2)&&($row['audience']==1)&&($row['diff']==3))
						    	{
						    		$quesdone[$totalcount]=$srno;
									$totalcount++;
									$aptihard++;
									$correctopt[$row['correctopt']-1]=4;
						    		echo '<label>Q'.$totalcount.') '.utf8_decode($row['ques']).'</label><br>
						    		<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[0].'">'.utf8_decode($row['option1']).'</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[1].'">'.utf8_decode($row['option2']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[2].'">'.utf8_decode($row['option3']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[3].'">'.utf8_decode($row['option4']).'</label>
									</div><br>';
								}
								else if(($row['domain']==$_POST['domain'])&&($domaincount<5)&&($row['audience']==$_POST['year']))
							    {
							    		$quesdone[$totalcount]=$srno;
										$totalcount++;
										$domaincount++;
										$correctopt[$row['correctopt']-1]=4;
							    		echo '<label>Q'.$totalcount.') '.utf8_decode($row['ques']).'</label><br>
							    		<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[0].'">'.utf8_decode($row['option1']).'</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[1].'">'.utf8_decode($row['option2']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[2].'">'.utf8_decode($row['option3']).'</label>
									</div>
									<div class="radio ">
									  <label><input type="radio" name="q'.$totalcount.'" value="'.$correctopt[3].'">'.utf8_decode($row['option4']).'</label>
									</div><br>';
								}
								else
								{
									break;
								}
							}

						} 
						else {
						    
						}
					}

					$con->close();
					$_SESSION['ques']=$quesdone;
					$elexcount=0;$progcount=0;$mechcount=0;$apticount=0;$totalcount=0;$domaincount=0;
					$quesdone = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
				?>
                <input type="submit" class="btn btn-success btn-md" value="Submit" name="submit" />
                <input type="reset" class="btn btn-warning btn-md" value="Reset" onmouseup="(function(){document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;})();" />
            </div>
      </fieldset>
    </form>
         <br/><br/><br/>
    </div>
   
    <!-- topButton --><?php /*include 'topButton.php'*/ ?>
</body>
</html>

<script>
                        document.getElementById('timer').innerHTML =
                          45 + ":" + 04;
                        startTimer();

                        function startTimer() 
                        {
                            var presentTime = document.getElementById('timer').innerHTML;
                            var timeArray = presentTime.split(/[:]+/);
                            var m = timeArray[0];
                            var s = checkSecond((timeArray[1] - 1));
                            if(s==59)
                                {m=m-1}
                            if(m<0)
                            {
                                alert('Time Passed out!');  
                                document.getElementById("quespaper").submit();
                            }
                          document.getElementById('timer').innerHTML =
                            m + ":" + s;
                          setTimeout(startTimer, 1000);
                        }

                        function checkSecond(sec) {
                          if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
                          if (sec < 0) {sec = "59"};
                          return sec;
                        }
</script>