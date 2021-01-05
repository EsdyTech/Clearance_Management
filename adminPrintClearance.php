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

    if (isset($_POST['submit'])){
       
      $level = $_POST['level'];
      $session = $_POST['session'];
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

    <p><h2><b>CLEARANCE REQUIREMENTS </b></h2></p>
    <h4><b>OGUN STATE INSTITUTE OF TECHNOLOGY, IGBESA OGUN STATE</b></h4>
    <h4><b>COMPUTER SCIENCE DEPARTMENT</b></h4>
 <table class="table table-inverse" border="1">
                      
                                                <table class="table table-hover table-bordered">
                                                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                        <th>S/N</th>
                                                        <th>Requirement</th>
                                                            <th>Session</th>
                                                            <th>Level</th>
                                                            <th>Date Added</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php	
$query = mysqli_query($con,"select * from requirements where reqLevel = '$level' and reqSession = '$session'")or die(mysqli_error());
while($row = mysqli_fetch_array($query)){
$matricno = $row['matricno'];$snn=$snn+1;?>
<tr>
<td><?php echo $snn; ?>
<td><?php echo $row['reqName']; ?>
<td><?php echo $row['reqSession']; ?></td>
<td><?php echo $row['reqLevel']; ?></td>
<td><?php echo $row['dateReg']; ?></td>

</tr>
<?php $sn=$sn+1;}?>
                            </tbody>
                            </table>

                            </div>
</html>

<?php
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
$dompdf->stream($_POST['level'].' '.$_POST['session']." Requiremts Form");


?>