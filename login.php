<?php
   include("connection.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
	   // Simply:
		$date = date('Y-m-d H:i:s');
		print_r($date);
      
      $grNo = mysqli_real_escape_string($con,$_POST['grNo']);
      $sql = "SELECT * FROM apply2019 WHERE gr = '$grNo' ";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_assoc($result);
      $count = mysqli_num_rows($result);		
      if($count == 1) {
         $_SESSION['grNo'] = $grNo;
         header("location: test.php");
		 echo "<script>alert('you are logged in')</script>";
      }else {
         echo "<script>alert('You have not registered for test')</script>";
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TRF Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="login/css/style.css">
</head>
<body>

    <div class="main" style="padding:10px 0;">
        <!-- Sing in  Form -->
     <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="login/images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="up.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login in</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="number" name="grNo" id="your_name" placeholder="Your Gr No"/>
                            </div>
                           <!-- <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>-->
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Start Test"/>
                            </div>
                        </form>
                        <!--<div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>-->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="login/vendor/jquery/jquery.min.js"></script>
    <script src="login/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>