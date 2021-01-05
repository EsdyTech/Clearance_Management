<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }

if (isset($_GET['reqId'])){

    $_SESSION['reqId'] = $_GET['reqId'];
    $query = mysqli_query($con,"select * from requirements where reqid='$_SESSION[reqId]'")or die(mysqli_error());
    $row = mysqli_fetch_array($query);
    
    
    $query = mysqli_query($con,"select * from students where matricno='$_SESSION[alogin]'")or die(mysqli_error());
    $rows = mysqli_fetch_array($query);
    

    if (isset($_POST['submit'])){

        $reqid=$_SESSION['reqId'];
        $file=$_POST['file'];
        $matricno=$_POST['matricno'];
        $session=$_POST['session'];
        $level=$_POST['level'];   $date = date('Y-m-d');


        $fileName = "files/".$_FILES['files']['name'];
        $filetmpName = $_FILES['files']['tmp_name'];
        $fileSize = $_FILES['files']['size'];
        $fileType = $_FILES['files']['type'];

        $queryy = mysqli_query($con,"select * from deadline where session='$rows[session]' and level='$rows[level]' and status ='Activated'")or die(mysqli_error()); 
        $rowss = mysqli_fetch_array($queryy);
        $count = mysqli_num_rows($queryy);

        $deadlinedate = $rowss['deadlinedate'];

        if ($date > $deadlinedate){

        echo "   <script type='text/javascript'>
        alert('You Cant Upload Requirements Deadline Has Exceeded!, Contact Administrator');
        window.location= 'upload-req.php';
        </script>";

        }
        else {

            $queryys = mysqli_query($con,"select * from requploads where matricno = '$_SESSION[alogin]' and session='$rows[session]' and level='$rows[level]' and reqId ='$_SESSION[reqId]'")or die(mysqli_error()); 
            $counts = mysqli_num_rows($queryys);


            if ( $counts > 0){

            //     echo "   <script type='text/javascript'>
            //     alert('Youve Uploaded your clearance for this Requirement, Session and Level');
            //     window.location= 'upload-req.php';
            // </script>";
            // echo $error="Youve Uploaded your clearance for this Requirement, Session and Level!";
                 echo "   <script type='text/javascript'>
                  alert('Youve Uploaded your clearance for this Requirement, Session and Level');
                window.location= 'upload-req.php';
            </script>";
            }

            else{



        // $N = count($reqid);
        // //echo $N;
        // foreach($_FILES['files']['name'] as $key => $name)
        // {               // move_uploaded_file ($filetmpName,'files/'.$fileName);
        
       
           
            $newfilename = $_FILES['files']['name'];
            move_uploaded_file ($_FILES['files']['tmp_name'],'files/'.$newfilename);
            $location = $newfilename;

            mysqli_query($con,"insert into requploads (reqId,matricno,session,level,filename,uploadStatus,dateReg) 
            values('$reqid','$matricno','$session','$level','$location','Unapproved','$date')")or die(mysqli_error());
                
        // }
        // echo $msg="Successfully Uploaded!";
        echo "   <script type='text/javascript'>
        alert('Successfully Uploaded!');
      window.location= 'upload-req.php';
  </script>";

        } 
    }

    }


    }
        ?>
      
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Requirements</title>
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
  <?php include('includes/studentTopbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                   <?php include('includes/studentLeftbar.php');?>  
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">File/Document Upload</h2><br>
                                    <h2 class="title"><?php echo strtoupper($row['reqName']);?></h2>

                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">File Upload</li>
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
                                                    <h5>Upload Files/Document</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                            <?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>An Error Occurred!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
        <form class="form-horizontal" method="post" enctype='multipart/form-data'>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Requirement</label>
<div class="col-sm-10">
<input type="text" name="requirement" readonly value="<?php echo $row['reqName']?>" class="form-control" id="fullanme" required="required" >
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Description</label>
<div class="col-sm-10">
<input type="text" name="requirement" readonly value="<?php echo $row['description']?>" class="form-control" id="fullanme" required="required" >
</div>
</div>


<div class="form-group">
<label for="default" class="col-sm-2 control-label">File/Document</label>
<div class="col-sm-10">
<input type="file" name="files" class="form-control" id="email" required="required" autocomplete="off">
</div>
</div>

<input type="hidden" name="matricno" value="<?php echo $rows['matricno'];?>" class="form-control" id="" >
<input type="hidden" name="session" value="<?php echo $rows['session'];?>" class="form-control" id="" >
<input type="hidden" name="level" value="<?php echo $rows['level'];?>" class="form-control" id="" >
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-primary">Upload File/Document</button>
    </div>
</div>
</form>
<br><br><br><br><br><br><br><br><br><br><br><br>

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
