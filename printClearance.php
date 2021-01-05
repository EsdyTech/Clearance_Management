<?php
// namespace Dompdf;
require_once 'dompdf/autoload.inc.php';
ob_start();
include('includes/config.php');
session_start();

// require_once('includes/configpdo.php');
error_reporting(0);

if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }

?>

<html>
<style>
body {
  padding: 4px;
  text-align: center;
}

table {
  width: 100%;
  margin: 10px auto;
  table-layout: auto;
}

.fixed {
  table-layout: fixed;
}

table,
td,
th {
  border-collapse: collapse;
}

th,
td {
  padding: 1px;
  border: solid 1px;
  text-align: center;
}


</style>
    <h2><b>OGUN STATE INSTITUTE OF TECHNOLOGY, IGBESA OGUN STATE</b></h2>
    <h4><b>COMPUTER SCIENCE DEPARTMENT</b></h4>
<?php 
$query = mysqli_query($con,"select * from students where matricno='$_SESSION[alogin]'")or die(mysqli_error());
while($rows = mysqli_fetch_array($query)){
                  {  ?>
                  <div align="left">
<p><b>Student Name :</b> <?php echo strtoupper($rows['surname'].' '.$rows['firstname'].' '.$rows['othername']);?></p>
<p><b>Level:</b> <?php echo $rows['level'];?>
<p><b>Session:</b> <?php echo $rows['session'];?>
<p><b>Matricno:</b> <?php echo $rows['matricno'];?>
<p><b>Sex:</b> <?php echo $rows['sex'];?>
</div>
<!-- <div align="right" style="margin-top:-2000px;"><img src="./<?php echo $rows['pic'];?>" alt="<?php echo $rows['surname'];?>" style="width:100px;height:100px;" class="img-circle profile-img"></div> -->
<?php 
}
?>    

    <h4><b>CLEARANCE REQUIREMENTS FOR <?php echo  $rows['session'].'  SESSION  '. $rows['level'].' LEVEL';?></b></h4>
 <table class="table table-inverse" border="1">
                      
                                                <table class="table table-hover table-bordered">
                                                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                        <th>#</th>
                                                        <th>Requirement</th>
                                                            <th>Session</th>
                                                            <th>Level</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php	
$query = mysqli_query($con,"select * from requirements where reqSession='$rows[session]' and reqLevel = '$rows[level]' and status='Activated'")or die(mysqli_error());
while($row = mysqli_fetch_array($query)){
  $matricno = $row['matricno'];$sn=$sn+1;?>
<tr>
                        <td><?php echo $sn; ?>
                        <td><?php echo $row['reqName']?>
                        <td><?php echo $row['reqSession']; ?></td>
                        <td><?php echo $row['reqLevel']; ?></td>

</tr>
<?php $cnt=$cnt+1;}}?>
                            </tbody>
                            </table>

                            </div>
</html>

<?php
$query = mysqli_query($con,"select * from students where matricno='$_SESSION[alogin]'")or die(mysqli_error());
$rr = mysqli_fetch_array($query);

// reference the Dompdf namespace
use Dompdf\Dompdf;
$html = ob_get_clean();
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($rr['surname'].' '.$rr['firstname']." Requirements");

?>