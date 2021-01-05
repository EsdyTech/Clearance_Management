<?php
error_reporting(0);
session_start();
include('includes/config.php');
if(isset($_POST['login'])){

$username=$_POST['username'];$password=$_POST['password'];

 $qry = "SELECT * FROM students WHERE password='$password' AND matricno='$username'"; 
$res = @mysqli_query($con,$qry);
if (mysqli_num_rows($res) > 0){
$rs = mysqli_fetch_array($res);
$_SESSION['alogin']  = $rs['matricno'];
$_SESSION['surname']  = $rs['surname'];
$_SESSION['firstname']  = $rs['firstname'];
echo '<script>window.location= "studentDashboard.php";</script>';
}
else {
echo '<script type="application/javascript">alert("ERROR!");</script>';
}
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Online Clearance Management System</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/icheck/skins/flat/blue.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="" >
        <div class="main-wrapper">

            <div class="login-bg-color bg-black-300" style="background-image:url('images/ogitech1.jpg');">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel login-box">
                            <div class="panel-heading">
                                <div class="panel-title text-center">
                                    <h4>Online Clearance Management System</h4>
                                    <h4>Student Login</h4>
                                </div>
                            </div>
                            <div class="panel-body p-20">

                           

                                <form action="" method="post">
                                	<div class="form-group">
                                		<label for="rollid">Enter your Matric No</label>
                                        <input type="text" class="form-control" id="rollid" placeholder="Matricno"  name="username">
                                	</div>
                                    <div class="form-group">
                                		<label for="rollid">Password</label>
                                        <input type="password" class="form-control" id="rollid" placeholder="Password"  name="password">
                                	</div>
                                    <div class="form-group mt-20">
                                        <div class="">
                                      
                                        <button type="submit" name="login" class="btn btn-success btn-labeled pull-right">Sign in<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
</div>
                                        </div>
                                    </div>

                                       <div class="col-sm-6">
                                                               <a href="index.php">Back to Home</a>
                                                            </div>
                                </form>

                                <hr>

                            </div>
                        </div>
                        <!-- /.panel -->
                        <p class="text-muted text-center"><small>Copyright © <a href="http://facebook.com/createnetworksng">Create Network NG</a> 2017</small></p>
                    </div>
                    <!-- /.col-md-6 col-md-offset-3 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /. -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/icheck/icheck.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function(){
                $('input.flat-blue-style').iCheck({
                    checkboxClass: 'icheckbox_flat-blue'
                });
            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
