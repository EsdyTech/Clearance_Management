
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
        

        // if (isset($_POST['submit'])){

        //     $reqid=$_POST['reqid'];
        //     $file=$_POST['file'];
        //     $matricno=$_POST['matricno'];
        //     $session=$_POST['session'];
        //     $level=$_POST['level'];   $date = date('Y-m-d');


        //     $fileName = "files/".$_FILES['files']['name'];
        //     $filetmpName = $_FILES['files']['tmp_name'];
        //     $fileSize = $_FILES['files']['size'];
        //     $fileType = $_FILES['files']['type'];

        //     $queryy = mysqli_query($con,"select * from deadline where session='$rows[session]' and level='$rows[level]' and deadlinedate < '$date' and status ='Activated'")or die(mysqli_error()); 
        //     $count = mysqli_num_rows($queryy);

            
        //     if ( $count > 0){

        //         echo "   <script type='text/javascript'>
        //         alert('You Cant Upload Requirements Deadline Has Exceeded!, Contact Administrator');
        //         window.location= 'upload-req.php';
        //     </script>";
        //     }
        //     else {

        //         $queryys = mysqli_query($con,"select * from requploads where matricno = '$_SESSION[alogin]' and session='$rows[session]' and level='$rows[level]'")or die(mysqli_error()); 
        //         $counts = mysqli_num_rows($queryys);

 
        //         if ( $counts > 0){

        //             echo "   <script type='text/javascript'>
        //             alert('Youve Uploaded your clearance for this Session and Level');
        //             window.location= 'upload-req.php';
        //         </script>";
        //         }

        //         else{



        //     $N = count($reqid);
        //     //echo $N;
        //     foreach($_FILES['files']['name'] as $key => $name)
        //     {               // move_uploaded_file ($filetmpName,'files/'.$fileName);
            
           
               
        //         $newfilename = $name;
        //         move_uploaded_file ($_FILES['files']['tmp_name'][$key],'files/'.$newfilename);
        //         $location = $newfilename;

        //         mysqli_query($con,"insert into requploads (reqId,matricno,session,level,filename,uploadStatus,dateReg) 
        // values('$reqid[$key]','$matricno','$session','$level','$location','Unapproved','$date')")or die(mysqli_error());
                	
        //     }
        //     } 
        // }
    }
        
        ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Students Requirements</title>
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
            							<li class="active">Upload Requirements</li>
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
                                                    <h5><b>Requirements Information List</b></h5>
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
                                                            <th>Requirement</th>
                                                            <th>Description</th>
                                                            <th>Session</th>
                                                            <th>Level</th>
                                                            <th>View Requirement</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Requirement</th>
                                                            <th>Description</th>
                                                            <th>Session</th>
                                                            <th>Level</th>
                                                            <th>View Requirement</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
<?php	
$query = mysqli_query($con,"select * from requirements where reqSession='$rows[session]' and reqLevel = '$rows[level]' ")or die(mysqli_error());
													while($row = mysqli_fetch_array($query)){
													$matricno = $row['matricno'];$sn=$sn+1;?>
<tr>
                                                <td><?php echo $sn; ?>
												<td><?php echo $row['reqName']?>
                                                <td><?php echo $row['description']?>
                                                <td><?php echo $row['reqSession']; ?></td>
                                                <td><?php echo $row['reqLevel']; ?></td>
                                                <td><a href="view-req.php?reqId=<?php echo $row['reqid'];?>" title="View Requirement" class="btn btn-primary">Click to View Details</a> 

<!-- <td><input type="file"  name="files[]" class="form-control" id="checkbox" ></td>
<input type="hidden" name="reqid[]" value="<?php echo $row['reqid'];?>" class="form-control" id="" >
<input type="hidden" name="matricno" value="<?php echo $rows['matricno'];?>" class="form-control" id="" >
<input type="hidden" name="session" value="<?php echo $rows['session'];?>" class="form-control" id="" >
<input type="hidden" name="level" value="<?php echo $rows['level'];?>" class="form-control" id="" > -->
</tr>
<?php $cnt=$cnt+1;}?>
                                                       
                                                    
                                                    </tbody>
                                                </table>
                                                <!-- <div class="form-group">
    <div class="col-sm-offset-2 col-sm-8" align="center">
        <button type="submit"  name="submit" class="btn btn-primary">Upload Files</button>
    </div>
  
</div> -->
</form>



                                                <div class="panel-title">
                                                    <h5><b>Uploaded Requirements List</b></h5>
                                                </div>

                                            <div class="panel-body p-20">
                                            <form class="form-horizontal" method="post" enctype='multipart/form-data'>

                                                <table id="example1" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                        <th>#</th>
                                                            <th>Student Name</th>
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
                                                          <th>Student Name</th>
                                                            <th>Matric No</th>
                                                            <th>Requirement</th>
                                                            <th>Session</th>
                                                            <th>Level</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php	
$query = mysqli_query($con,"select * from requploads where matricno='$rows[matricno]' and session='$rows[session]' and level = '$rows[level]' ")or die(mysqli_error());
                            while($rowd = mysqli_fetch_array($query)){
                                $reqId = $rowd['reqId'];$snn=$snn+1;
                                
$queryss = mysqli_query($con,"select * from requirements where reqid='$reqId'")or die(mysqli_error());
while($rowss = mysqli_fetch_array($queryss)){
                                                                            
                                
                                ?>
<tr>
                            <td><?php echo $snn; ?></td>
                            <td><?php echo $rows['firstname'].' '.$rows['othername'];?></td>
                            <td><?php echo $rows['matricno'];?></td>
                            <td><?php echo $rowss['reqName']?></td>
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
                $('#example1').DataTable();


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


