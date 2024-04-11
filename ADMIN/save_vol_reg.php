<?php include('dbConn.php'); ?>

<?php 
session_start();
if (isset($_POST['volreg'])) {

$VOL_ID     = $_SESSION['uID'];
$OPP_ID     = $_POST['OPP_ID'];
$REG_DATE   = $_POST['REG_DATE'];
$AVAIABILITY    =   $_POST['AVAIABILITY'];
$REG_NO     = $_POST['REG_NO'];
$REG_QUALI  = $_POST['REG_QUALI'];

	
$sql="INSERT INTO `vol_reg`(`VOL_ID`, `OPP_ID`, `REG_DATE`, `AVAIABILITY`, `CONTACT_INFO`, `QUALICFICATION`) VALUES ('$VOL_ID', '$OPP_ID', '$REG_DATE', '$AVAIABILITY', '$REG_NO', '$REG_QUALI');";

$result=mysqli_query($db,$sql);

}
if($result){
?>
<script>
alert('Successfully Volunteer Registration Created');
	window.location="volunteer_reg.php";
</script>
<?php }else{ ?>
<script>
alert('Sorry Try Again');
	window.location="volunteer_reg.php";
</script>
<?php } ?>