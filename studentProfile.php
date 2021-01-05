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
        $rows = mysqli_fetch_array($query); $count = mysqli_num_rows($query);


        if(isset($_POST['submit']))
        {
        $matricno = $_POST['matricno'];
        $surname = $_POST['surname'];
        $firstname = $_POST['firstname'];
        $othername = $_POST['othername'];
        $sex = $_POST['sex'];
        $level = $_POST['level'];
        $status = $_POST['status'];
        $session = $_POST['session'];
        
       
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $image_name = addslashes($_FILES['image']['name']);
        $image_size = getimagesize($_FILES['image']['tmp_name']);

        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $_FILES["image"]["name"]);
        $passportName = "uploads/" . $_FILES["image"]["name"];
        
        $queryq =mysqli_query($con,"update students set surname = '$surname',firstname = '$firstname',othername = '$othername', matricno = '$matricno', sex = '$sex', pic='$passportName',level='$level',status='$status' where matricno = '$_SESSION[alogin]' ")or die(mysqli_error());
        $counte = mysqli_num_rows($queryq);
        
        if($queryq){
        
        $msg="Your Profile succesfully Updated";   
        }
        
        else{
        $error="An Error Ocurred!";    
        }
        
        }
        
                

       ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin change password</title>
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
        <script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
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
        <?php include('includes/studentTopbar.php');?> 
            <div class="content-wrapper">
                <div class="content-container">
                <?php include('includes/studentLeftbar.php');?>  
 <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                            <div class="col-md-6">
                                    <h3 class="title"><b>Welcome </b><?php echo strtoupper($rows['surname'].' '.$rows['firstname'].' '.$rows['othername']);?></h3>
                                    <h3 class="title"><b>Level</b> : <?php echo $rows['level'];?>&nbsp;&nbsp;<b>Session</b> : <?php echo $rows['session'];?></h3>

                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="studentDashboard.php"><i class="fa fa-home"></i> Home</a></li>
            						
            							<li class="active">Student Update Profile</li>
            						</ul>
                                </div>
                               
                            </div>
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
                                                    <h5>Student Update Profile</h5>
                                                </div>
                                            </div>
           <?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>An Error Occurred!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
  
                                            <div class="panel-body">

                                            <form method="post" enctype='multipart/form-data'>                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Surname</label>
                                                		<div class="">
                                    <input type="text" name="surname" value="<?php echo $rows['surname'];?>" class="form-control" required="required" id="success">
                                                      
                                                		</div>
                                                	</div>
                                                       <div class="form-group has-success">
                                                        <label for="success" class="control-label">First Name</label>
                                                        <div class="">
                                                            <input type="text" name="firstname" value="<?php echo $rows['firstname'];?>" required="required" class="form-control" id="success">
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Othername</label>
                                                        <div class="">
                                                            <input type="text" name="othername" value="<?php echo $rows['othername'];?>" required="required" class="form-control" id="success">
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Matricno</label>
                                                        <div class="">
                                                            <input type="text" name="matricno" value="<?php echo $rows['matricno'];?>" required="required" class="form-control" id="success">
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="form-group has-success">
                                                    <label for="default" class="col-sm-2 control-label">Sex</label>
                                                    <div class="">
                                                    <select name="sex" class="form-control" required>	
                                                    <option><?php echo $rows['sex'];?></option>									
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                    </select>	
                                                    </div>
                                                    </div>
                                                     <div class="form-group has-success">
                                                        <label for="success" class="control-label">Picture</label>
                                                        <div class="">
                                                            <input type="file" name="image" class="form-control" required="required" id="success">
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="form-group has-success">
                                                    <label for="default" class="col-sm-2 control-label">Level</label>
                                                    <div class="">
                                                    <select name="level" class="form-control" required>
                                                    <option><?php echo $rows['level'];?></option>									
                                                    <option>ND1</option>
                                                    <option>ND2</option>
                                                    <option>HND1</option>
                                                    <option>HND2</option>
                                                    </select>	
                                                    </div>
                                                    </div>

                                                    <div class="form-group has-success">
                                                    <label for="default" class="col-sm-2 control-label">Session</label>
                                                    <div class="">
                                                    <select name="session" class="form-control" required>	
                                                    <option><?php echo $rows['session'];?></option>																		
                                                    <option>2018/2019</option>
                                                    <option>2019/2020</option>
                                                    <option>2020/2021</option>
                                                    <option>2021/2022</option>
                                                    </select>	
                                                    </div>
                                                    </div>
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Status</label>
                                                        <div class="">
                                                            <input type="text" readonly name="status" value="<?php echo $rows['status'];?>" class="form-control" id="success">
                                                        </div>
                                                    </div>
                                                <div class="form-group has-success">
                                                        <div class="">
                                                           <button type="submit" name="submit" class="btn btn-success btn-labeled">Update<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                                    </div>


                                                    
                                                </form>
                                          
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-8 col-md-offset-2 -->
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
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>



        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
<?php  } ?>
