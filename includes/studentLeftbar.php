<div class="left-sidebar bg-black-300 box-shadow ">
                        <div class="sidebar-content">
                            <div class="user-info closed">

                               <?php
                             
                                        $query = mysqli_query($con,"select * from students where matricno='$_SESSION[alogin]'")or die(mysqli_error());
                                        $rows = mysqli_fetch_array($query);

                                        ?>
                                <img src="./<?php echo $rows['pic'];?>" alt="<?php echo $rows['surname'];?>" style="width:50px;height:50px;" class="img-circle profile-img">
                                <h6 class="title"><?php echo $rows['firstname'];?></h6>
                                <small class="info"><?php echo $rows['matricno'];?></small>



                            </div>
                            <!-- /.user-info -->

                            <div class="sidebar-nav">
                                <ul class="side-nav color-gray">
                                    <li class="nav-header">
                                        <span class="">Main Menu</span>
                                    </li>
                                    <li>
                                        <a href="studentDashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>
                                     
                                    </li>

                                    <li class="nav-header">
                                        <span class="">Student Menu</span>
                                    </li>
  <li class="has-children">
                                        

                                        <li class="has-children">

                                        <a href="#"><i class="fa fa-users"></i> <span>Profile</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="studentProfile.php"><i class="fa fa-bars"></i> <span>View Profile</span></a></li>
                                           
                                        </ul>
                                    </li>
                                    <li class="has-children">

<a href="#"><i class="fa fa-file-text"></i> <span>Requirements and Clearance</span> <i class="fa fa-angle-right arrow"></i></a>
<ul class="child-nav">
    <li><a href="upload-req.php"><i class="fa fa-bars"></i> <span>Upload Requirements</span></a></li>
    <li><a href="studentManage-upload.php"><i class="fa fa fa-server"></i> <span>Manage Uploads</span></a></li>
    <li><a href="stdmanage-req.php"><i class="fa fa-bars"></i> <span>Print Requirements</span></a></li>
    <li><a href="stdmanage-clearance.php"><i class="fa fa-bars"></i> <span>Print Clearance</span></a></li>

</ul>
</li>
<li class="has-children">

<a href="#"><i class="fa fa-bell"></i> <span>Deadline</span> <i class="fa fa-angle-right arrow"></i></a>
<ul class="child-nav">
    <li><a href="view-deadline.php"><i class="fa fa-bars"></i> <span>View Deadline</span></a></li>
   
</ul>
</li>
<li class="has-children">
                                        <!-- <a href="#"><i class="fa fa-info-circle"></i> <span>Result</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="add-result.php"><i class="fa fa-bars"></i> <span>Add Result</span></a></li>
                                            <li><a href="manage-results.php"><i class="fa fa fa-server"></i> <span>Manage Result</span></a></li>
                                            <li><a href="students-result.php"><i class="fa fa fa-server"></i> <span>View Result</span></a></li>
                                           
                                        </ul> -->
                                        <li><a href="studentChangePass.php"><i class="fa fa fa-server"></i> <span>Change Password</span></a></li>
                                           
                                    </li>
                            </div>
                            <!-- /.sidebar-nav -->
                        </div>
                        <!-- /.sidebar-content -->
                    </div>