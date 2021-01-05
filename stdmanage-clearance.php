
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{

        $query = mysqli_query($con,"select * from students where matricno='$_SESSION[alogin]'")or die(mysqli_error());
        $rows = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Print Clearance</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
          <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
   <?php include('includes/studentTopbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">
<?php include('includes/studentLeftbar.php');?>  

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                <h3 class="title"><b>Welcome </b><?php echo strtoupper($rows['surname'].' '.$rows['firstname'].' '.$rows['othername']);?></h3>
                                    <h3 class="title"><b>Level</b> : <?php echo $rows['level'];?>&nbsp;&nbsp;<b>Session</b> : <?php echo $rows['session'];?></h3>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Requirements</li>
            							<li class="active">Print Clearance Form</li>
            						</ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                             

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>View Requirements Submitted/Uploaded<h5>
                                                </div>
                                            </div>
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                            <div class="panel-body p-20">

                                                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                        <th>#</th>
                                                        <th>Requirement</th>
                                                            <th>Matric No</th>
                                                            <th>Session</th>
                                                            <th>Level</th>
                                                            <th>Status</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php	
$query = mysqli_query($con,"select * from requploads where matricno='$_SESSION[alogin]' and session='$rows[session]' and level = '$rows[level]'")or die(mysqli_error());
while($row = mysqli_fetch_array($query)){
    $querys = mysqli_query($con,"select * from requirements where reqid='$row[reqId]'")or die(mysqli_error());
while($rowss = mysqli_fetch_array($querys)){
  $matricno = $row['matricno'];$sn=$sn+1;?>
<tr>
                        <td><?php echo $sn; ?>
                        <td><?php echo $rowss['reqName']?>
                        <td><?php echo $row['matricno']; ?></td>
                        <td><?php echo $row['session']; ?></td>
                        <td><?php echo $row['level']; ?></td>
                        <td><?php echo $row['uploadStatus']; ?></td>


</tr>
<?php $cnt=$cnt+1;}}}?>
                            </tbody>
                            </table>
<?php
    $quesr= mysqli_query($con,"select * from students where matricno='$rows[matricno]' and session ='$rows[session]' and level = '$rows[level]' and isCleared = 'Cleared'")or die(mysqli_error());$countCleared = mysqli_num_rows($quesr);

?>
     <?php if($countCleared > 0){ ?>

    <div class="form-group">
    <div class="col-sm-12">
<a href="printClearance2.php" class="btn btn-primary">Print Clearance</a>
    </div>
</div>
     <?php } else {?>
        <div class="alert alert-danger left-icon-alert" role="alert">
        <b>You cannot Print your Clearance Form, because you are yet to be cleared!</b>
                                        </div>
        <div class="form-group">
    <div class="col-sm-12">
<a href="printClearance2.php" disabled class="btn btn-primary">Print Clearance</a>
    </div>
</div>


     <?php }?>


     <br><br><br><br><br><br><br><br><br><br><br><br>



                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->

                                                               
                                                </div>
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                    

                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });
        </script>
    </body>
</html>


