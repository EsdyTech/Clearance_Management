
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{

$_SESSION['matricno'] = $_GET['matricno'];
$_SESSION['session'] = $_GET['session'];
$_SESSION['level'] = $_GET['level'];

if (isset($_POST['clearstudent'])){

    $matricno=$_POST['matricno'];
    $session=$_POST['session'];
    $level=$_POST['level'];   $date = date('Y-m-d');

 $res = mysqli_query($con,"update students set isCleared='Cleared', dateCleared='$date' where matricno='$_SESSION[matricno]' and level='$_SESSION[level]' and session='$_SESSION[session]'") or die(mysqli_error());
 echo $msg="Student Cleared Successfully!";

    } 


if (isset($_POST['submit'])){

    
    $reqid=$_POST['reqid'];
    $matricno=$_POST['matricno'];
    $session=$_POST['session'];
    $level=$_POST['level'];   $date = date('Y-m-d');

    $N = count($reqid);
    //echo $N;
 for($i=0; $i < $N; $i++)
{        

    if(isset($reqid[$i])){
    $query = mysqli_query($con,"select * from requploads where reqId='$reqid[$i]'")or die(mysqli_error());
    $rows = mysqli_fetch_array($query); 

    if($query)
    {

 $resultt = mysqli_query($con,"update requploads set uploadStatus='Approved' where reqId='$reqid[$i]'") or die(mysqli_error());
        mysqli_query($con,"insert into clearancelist (reqId,matricno,level,session,clearStatus,dateReg) 
values('$reqid[$i]','$matricno','$level','$session','Approved','$date')")or die(mysqli_error());

echo $msg="Approved Successfully!";

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
        <title>Admin Manage Students</title>
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
   <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">
<?php include('includes/leftbar.php');?>  
<?php	
$query = mysqli_query($con,"select * from students where matricno='$_SESSION[matricno]'")or die(mysqli_error());
$row = mysqli_fetch_array($query);?>
                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Clearance for <?php echo strtoupper($row['surname'].' '.$row['firstname']);?></h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Students</li>
            							<li class="active">Manage Students</li>
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
                                                    <h5>View/Download Students Uploaded Requirements</h5>
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
                                            <form class="form-horizontal" method="post" enctype='multipart/form-data'>

                                                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Student FullName</th>
                                                            <th>Matric No</th>
                                                            <th>Requirement</th>
                                                            <th>Session</th>
                                                            <th>Level</th>
                                                            <th>Action</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                          <th>#</th>
                                                          <th>Student FullName</th>
                                                            <th>Matric No</th>
                                                            <th>Requirement</th>
                                                            <th>Session</th>
                                                            <th>Level</th>
                                                            <th>Action</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
<?php	
    $que= mysqli_query($con,"select * from requirements where reqSession ='$_SESSION[session]' and reqLevel = '$_SESSION[level]' and status = 'Activated'")or die(mysqli_error());$countReq = mysqli_num_rows($que);
    $ques= mysqli_query($con,"select * from requploads where matricno='$_SESSION[matricno]' and session ='$_SESSION[session]' and level = '$_SESSION[level]' and uploadStatus = 'Approved'")or die(mysqli_error());$countApp = mysqli_num_rows($ques);
    $quesr= mysqli_query($con,"select * from students where matricno='$_SESSION[matricno]' and session ='$_SESSION[session]' and level = '$_SESSION[level]' and isCleared = 'Cleared'")or die(mysqli_error());$countCleared = mysqli_num_rows($quesr);

$query = mysqli_query($con,"select * from requploads where matricno='$_SESSION[matricno]' and session='$_SESSION[session]' and level = '$_SESSION[level]' and uploadStatus='Unapproved' ")or die(mysqli_error()); $count = mysqli_num_rows($query);
												while($rowd = mysqli_fetch_array($query)){
                                                    $reqId = $rowd['reqId'];$sn=$sn+1;
                                                    
    $queryss = mysqli_query($con,"select * from requirements where reqid='$reqId'")or die(mysqli_error());
    while($rowss = mysqli_fetch_array($queryss)){
                                                                                               
                                                  
                                                    ?>
<tr>
                                                <td><?php echo $sn; ?>
                                                <td><?php echo $row['firstname'].' '.$row['othername'];?>
                                                <td><?php echo $row['matricno'];?>
												<td><?php echo $rowss['reqName']?>
                                                <td><?php echo $rowss['reqSession']; ?></td>
                                                <td><?php echo $rowss['reqLevel']; ?></td>
    <td><a class="btn btn-primary" href="download.php?file=<?php echo urlencode($rowd['filename']);?>">Download File/Document</a> 
<td><input type="checkbox" style="Width:60px;" name="reqid[]" value=" <?php echo $rowd['reqId'];?>" class="form-control" id="checkbox"></td>
<input type="hidden" name="matricno" value=" <?php echo $rowd['matricno'];?>" class="form-control" id="" >
<input type="hidden" name="session" value=" <?php echo $rowd['session'];?>" class="form-control" id="" >
<input type="hidden" name="level" value=" <?php echo $rowd['level'];?>" class="form-control" id="" >

</tr>
<?php $cnt=$cnt+1;}}} ?>
                                                       
                                                    
                                                    </tbody>
                                                </table>
                                              <?php  if ($count > 0){ ?>
                                                <div class="form-group">
    <div class="col-sm-offset-2 col-sm-8" align="center">
        <button type="submit"  name="submit" class="btn btn-primary">Approve Selected </button>
                                              </div><?php }?><br><br>
                                              <?php  if ($countCleared > 0){ ?>
                                                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8" align="center">
                    <div class="alert alert-success left-icon-alert" role="alert">
                    <b>All Clearance requirement uploaded by this Student has been approved, and student has been Cleared Successfully!<b>
                    </div>
                                              </div><?php }  ?>
                                              <?php  if ($countReq == $countApp && $countCleared == 0){ ?> <!-- if requirements uploaded by students is equal to the requirements setup by the admin display the clear studnet button-->
                                                <div class="col-sm-offset-2 col-sm-8" align="center">
                                                <div class="alert alert-success left-icon-alert" role="alert">
                                                <b>All Clearance requirement uploaded by this Student has been approved, Kindly click on the button below to Clear the student!<b>
                                                </div>
        <button type="submit"  name="clearstudent" class="btn btn-primary">Clear Student </button>
                                              </div><?php } ?>
                                            
                                              <?php if ($countReq != $countApp){?>
                                                <div class="col-sm-offset-2 col-sm-8" align="center">
                                                <div class="alert alert-danger left-icon-alert" role="alert">
                                                <b>All Clearance requirement expected to be uploaded by this Student has not been uploaded or approved!<b>
                                                </div>
                                                <button type="submit" disabled  name="cleardisabled" class="btn btn-primary">Clear Student </button>
                                              </div>
                                              <?php  }?>
</div>
</form>

                                               
<div class="panel-title">
<h5><b>Requirements List Approved/Unapproved</b></h5>
</div>

                        <div class="panel-body p-20">
                            <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student FullName</th>
                                        <th>Matric No</th>
                                        <th>Requirement</th>
                                        <th>Session</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Student FullName</th>
                                        <th>Matric No</th>
                                        <th>Requirement</th>
                                        <th>Session</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
<?php	
$query = mysqli_query($con,"select * from requploads where matricno='$_SESSION[matricno]' and session='$_SESSION[session]' and level = '$_SESSION[level]' ")or die(mysqli_error());
                            while($rowd = mysqli_fetch_array($query)){
                                $reqId = $rowd['reqId'];$sn=$sn+1;
                                
$queryss = mysqli_query($con,"select * from requirements where reqid='$reqId'")or die(mysqli_error());
while($rowss = mysqli_fetch_array($queryss)){
                                                                            
                                
                                ?>
<tr>
                            <td><?php echo $sn; ?>
                            <td><?php echo $row['firstname'].' '.$row['othername'];?>
                            <td><?php echo $row['matricno'];?>
                            <td><?php echo $rowss['reqName']?>
                            <td><?php echo $rowss['reqSession']; ?></td>
                            <td><?php echo $rowss['reqLevel']; ?></td>
                            <td><?php echo $rowd['uploadStatus']; ?></td>

</tr>
<?php $cnt=$cnt+1;}}?>
                                    
                                
                                </tbody>
                            </table>
                            <div class="form-group">

</div>
            


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


