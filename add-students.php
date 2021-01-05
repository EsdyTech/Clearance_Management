<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }

if (isset($_POST['submit'])){
        $matricno = $_POST['matricno'];
        $surname = $_POST['surname'];
        $firstname = $_POST['firstname'];
        $othername = $_POST['othername'];
        $sex = $_POST['sex'];
        $level = $_POST['level'];
        $session = $_POST['session'];
        $password = 'password';
        $dateReg = date("Y-m-d");

        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $image_name = addslashes($_FILES['image']['name']);
        $image_size = getimagesize($_FILES['image']['tmp_name']);

        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $_FILES["image"]["name"]);
        $passportName = "uploads/" . $_FILES["image"]["name"];

        $query = mysqli_query($con,"select * from students where matricno = '$matricno'")or die(mysqli_error());
        $count = mysqli_num_rows($query);
        
        if ($count > 0)
        { 
       echo $error;
             }
        
        else{
        
        mysqli_query($con,"insert into students (surname,firstname,othername,matricno,password,sex,pic,level,session,status,dateReg,isCleared,dateCleared) 
        values('$surname','$firstname','$othername','$matricno','$password','$sex','$passportName','$level','$session','Activated','$dateReg','','')")or die(mysqli_error());
        
         echo $msg;
        }
    }
        ?>
      
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMS Admin| Student Admission< </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                   <?php include('includes/leftbar.php');?>  
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Student Registration</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">Student Registration</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Fill the Student info</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Student Registration was Successful</strong><?php echo $msg; ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Student with the matric No Exists!</strong> <?php echo $error; ?>
                                        </div>
                                        <?php } ?>
        <form class="form-horizontal" method="post" enctype='multipart/form-data'>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Surname</label>
<div class="col-sm-10">
<input type="text" name="surname" class="form-control" id="fullanme" required="required" >
</div>
</div>


<div class="form-group">
<label for="default" class="col-sm-2 control-label">FirstName</label>
<div class="col-sm-10">
<input type="text" name="firstname" class="form-control" id="fullanme" required="required" autocomplete="off">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">OtherName</label>
<div class="col-sm-10">
<input type="text" name="othername" class="form-control" id="fullanme" required="required" autocomplete="off">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Sex</label>
<div class="col-sm-10">
<select name="sex" class="form-control" required>										
<option>Male</option>
<option>Female</option>
</select>	
</div>
</div>


<div class="form-group">
<label for="default" class="col-sm-2 control-label">Level</label>
<div class="col-sm-10">
<select name="level" class="form-control" required>										
<option>ND1</option>
<option>ND2</option>
<option>HND1</option>
<option>HND2</option>
</select>	
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Matric No</label>
<div class="col-sm-10">
<input type="text" name="matricno" class="form-control" id="rollid" maxlength="20" required="required" >
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Session</label>
<div class="col-sm-10">
<select name="session" class="form-control" required>										
<option>2018/2019</option>
<option>2019/2020</option>
<option>2020/2021</option>
<option>2021/2022</option>
</select>	
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Picture</label>
<div class="col-sm-10">
<input type="file" name="image" class="form-control" id="email" required="required" autocomplete="off">
</div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-primary">Register Student</button>
    </div>
</div>
</form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>
</html>
