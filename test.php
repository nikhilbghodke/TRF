<?php 
include "assign.php";

?>

<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>TRF Level 2 Test</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/layout.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/nav.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/quiz.css" rel="stylesheet" type="text/css" media="screen">

</head>
<body onload="MyFunction">
    <div id="container">
    	
       
        
	<div id="nav">        
       
      </div> <!-- nav END -->
        
                    
  <div id="content">
            <h1>Level 2 Test</h1>
        	<div id="content-left" >
                <h2>Ready for the Test?</h2>
               	<form id="form6" method="post" action="submit.php" name="test_form" id="test_form">
                <fieldset >
					<?php 
				if(isset($_SESSION['domain']) and isset($_SESSION['testNo']))
				{
				$sql = "SELECT * FROM ". $_SESSION['domain']." WHERE testNo = '$testNo' ";
				$result = mysqli_query($con,$sql);
				while($row=mysqli_fetch_assoc($result))
				{
					
				?>

                <div class="jumbotron text-xs-center">
                <?php 
					echo "<h3>" .$row['questionNo']."   "; 
					if(!is_null($row['question']))
					echo$row['question']."</h3>" ?><code></code>
                  <br>
				<?php 
				 if(!is_null($row['image']))
					echo "<img src='test_questions/".$_SESSION['domain']."/test".$_SESSION['testNo']."/".$row['image']."'  class='img-responsive' /><br><br>"
				?>
				 
                <input type="radio" name="q_<?php echo $row['id']; ?>" id="question0_0" value="A"><label><?php echo $row['optionA']; ?></label><br>
                <input type="radio" name="q_<?php echo $row['id']; ?>" id="question0_1" value="B"> <label><?php echo $row['optionB']; ?></label><br>
                <input type="radio" name="q_<?php echo $row['id']; ?>" id="question0_2" value="C"> <label><?php echo $row['optionC']; ?></label><br>
                <input type="radio" name="q_<?php echo $row['id']; ?>" id="question0_2" value="D"> <label><?php echo $row['optionD']; ?></label><br>
                </div>
				<?php 
					}
				}
				
				
				?>
                
                </fieldset>
                <input type="submit" value="Submit Quiz" name="submit" class="btn btn-success" id="submit">
                </form>
   	</div> <!-- content-left END -->

       	  <div id="content-right">
          </div> <!-- content-right END -->
          
          <div class="clear"></div>
          
      </div> <!-- content END -->
        
      <div class="clear"></div>
 
        
    </div> <!-- container END -->
	
</body>

<script>

setTimeout(function myFunction(){
alert("Time out your test is Submitted");
document.getElementById("submit").click();
},20000);
</script>




