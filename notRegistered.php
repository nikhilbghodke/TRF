<?php
$elex_start_time = '2019-02-15 10:00:00';
$elex_end_time = '2019-02-15 22:00:07';
$pro_start_time = '2019-02-16 20:00:00';
$pro_end_time = '2019-02-16 22:00:00';
$mech_start_time = '2019-02-18 20:00:00';
$mech_end_time = '2019-02-18 22:00:00';
$schedule= "<h1>Elex paper will start on ".$elex_start_time."<br>   programming paper will start on ".$pro_start_time."<br>  Mechanical Paper will start on ".$mech_start_time." </h1>";
	//echo $schedule;

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
  <p class="lead"><strong>Your are not Registered for Todays Test</strong> wait till  further instructions or contact Admin.</p>
  <hr>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Domain</th>
        <th>Start Time</th>
        <th>End Time</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Electronics</td>
        <td><?php echo $elex_start_time;?></td>
        <td><?php echo $elex_start_time;?></td>
      </tr>
      <tr>
        <td>Programming</td>
        <td><?php echo $pro_start_time;?></td>
        <td><?php echo $pro_end_time;?></td>
      </tr>
      <tr>
        <td>Mechanical</td>
        <td><?php echo $mech_start_time;?></td>
        <td><?php echo $mech_start_time;?></td>
      </tr>
    </tbody>
  </table>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="login.php" role="button">Continue to homepage</a>
  </p>
</div>

</html>