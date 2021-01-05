<?php
session_start();
error_reporting(0);
include('includes/config.php');

$_SESSION['rollid']=$_GET['rollid'];
$_SESSION['classid']=$_GET['classid'];
$_SESSION['sessionid']=$_GET['session'];
$_SESSION['term']=$_GET['term'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Result Management System</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body>
        <div class="main-wrapper">
            <div class="content-wrapper">
                <div class="content-container">

         
                    <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-12">
                                    <h2 class="title" align="center">Result Management System</h2>
                                </div>
                            </div>
                            <!-- /.row -->
                          
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                                <div class="row">
                              
                             

                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
<?php
// code Student Data
$rollid=$_SESSION['rollid'];
$classid=$_SESSION['classid'];
$sessionid=$_SESSION['sessionid'];
$term=$_SESSION['term'];


$qery = "SELECT   tblstudents.StudentName,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section,tblresult.Session,tblresult.Term from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId join tblresult on tblresult.StudentId=tblstudents.StudentId where tblstudents.RollId=:rollid and tblstudents.ClassId=:classid LIMIT 1";
$stmt = $dbh->prepare($qery);
$stmt->bindParam(':rollid',$rollid,PDO::PARAM_STR);
$stmt->bindParam(':classid',$classid,PDO::PARAM_STR);
$stmt->execute();
$resultss=$stmt->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($stmt->rowCount() > 0)
{
foreach($resultss as $row)
{   ?>
<p><b>Student Name :</b> <?php echo htmlentities($row->StudentName);?></p>
<p><b>Student Roll Id :</b> <?php echo htmlentities($row->RollId);?>
<p><b>Student Class:</b> <?php echo htmlentities($row->ClassName);?>(<?php echo htmlentities($row->Section);?>)
<p><b>Term:</b> <?php echo htmlentities($row->Term);?>
<p><b>Session:</b> <?php echo htmlentities($row->Session);?>

<?php }

    ?>
                                            </div>
                                            <div class="panel-body p-20">







                                                <table class="table table-hover table-bordered">
                                                <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Subject</th>    
                                                            <th>CA</th>
                                                            <th>EXAM</th>
                                                        </tr>
                                               </thead>
  


                                                	
                                                	<tbody>
<?php                                              
// Code for result
// $query = "SELECT   tblstudents.StudentName,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section,tblresult.id,tblresult.Session,tblresult.Term from tblstudents join tblsubjects on tblsubjects.id=tblresult.SubjectId join tblresult on tblresult.StudentId=tblstudents.StudentId where tblstudents.RollId=:rollid and tblstudents.ClassId=:classid and tblresult.Session=:sessionid and tblresult.Term=:term";
 $query ="select t.StudentName,t.RollId,t.ClassId,t.marks,t.CA,t.Session,t.Term,SubjectId,tblsubjects.SubjectName from (select sts.StudentName,sts.RollId,sts.ClassId,tr.marks,tr.CA,tr.Session,tr.Term,SubjectId from tblstudents as sts join  tblresult as tr on tr.StudentId=sts.StudentId) as t join tblsubjects on tblsubjects.id=t.SubjectId where (t.RollId=:rollid and t.ClassId=:classid )";
$query= $dbh -> prepare($query);
$query->bindParam(':rollid',$rollid,PDO::PARAM_STR);
$query->bindParam(':classid',$classid,PDO::PARAM_STR);
// $query->bindParam(':sessionid',$sessionid,PDO::PARAM_STR);
// $query->bindParam(':term',$term,PDO::PARAM_STR);

$query-> execute();  
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($countrow=$query->rowCount()>0)
{ 

foreach($results as $result){

    ?>

                                                		<tr>
                                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                			<td><?php echo htmlentities($result->SubjectName);?></td>
                                                			<td><?php echo htmlentities($totalca=$result->CA);?></td>
                                                            <td><?php echo htmlentities($totalmarks=$result->marks);?></td>
                                                		</tr>
<?php 
$totlcount+=$totalmarks; $totlcount1+=$totalca;
$cnt++;}
?>
<tr>
                                                <th scope="row" colspan="2">Total Marks</th>
<td><b><?php echo htmlentities($totlcount1); ?></b> out of <b><?php echo htmlentities($outof=($cnt-1)*100); ?></b></td>
<td><b><?php echo htmlentities($totlcount); ?></b> out of <b><?php echo htmlentities($outof=($cnt-1)*100); ?></b></td>

                                                        </tr>
<tr>
                                                <th scope="row" colspan="2">Percentage</th>           
                                                            <td><b><?php echo  htmlentities($totlcount1*(100)/$outof); ?> %</b></td>
                                                            <td><b><?php echo  htmlentities($totlcount*(100)/$outof); ?> %</b></td>

                                                             </tr>
<tr>
                                                <th scope="row" colspan="3">Download Result</th>           
                                                            <td><b><a href="download-result.php">Download </a> </b></td>
                                                             </tr>

 <?php } else { ?>     
<div class="alert alert-warning left-icon-alert" role="alert">
                                            <strong>Notice!</strong> Your result has not been Computed Yet! Contact the Administrator
 <?php }
?>
                                        </div>
 <?php 
 } else
 {?>

<div class="alert alert-danger left-icon-alert" role="alert">
<strong>An Error Occured!</strong>
<?php
echo htmlentities("Invalid Roll Id");
 }
?>
                                        </div>



                                                	</tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                    <div class="form-group">
                                                           
                                                            <div class="col-sm-6">
                                                               <a href="Students-result.php">Back to Student List</a>
                                                            </div>
                                                        </div>

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

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {

            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

    </body>
</html>
