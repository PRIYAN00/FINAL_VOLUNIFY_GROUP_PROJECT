<?php include('dbConn.php'); ?>

<?php 
session_start();
if (isset($_POST['vooppreg'])) {

$VO_TITLE   =   $_POST['VO_TITLE'];
$VO_DES     =   $_POST['VO_DES'];
$VO_LOCATION    =   $_POST['VO_LOCATION'];
$VO_TYPE    =   $_POST['VO_TYPE'];
$VO_TIME    =   $_POST['VO_TIME'];
$VO_STATUS  =   $_POST['VO_STATUS'];
$VO_DATEPOSTED = date("Y/m/d h:i:s A");
$ORG_ID = $_SESSION['uID'];

	
$sql="INSERT INTO `vol_opp`(`ORG_ID`,`TITLE`, `DESCRIPTION`, `TYPE`, `LOCATION`, `TIME_COMMITMENT`, `DATE_POSTED`, `STATUS`) VALUES ('$ORG_ID','$VO_TITLE','$VO_DES','$VO_TYPE','$VO_LOCATION','$VO_TIME','$VO_DATEPOSTED','$VO_STATUS');";

$result=mysqli_query($db,$sql);

}
if($result){
?>
<script>
alert('Successfully Volunteer Opportunity Created');
	window.location="volunteer_opp_reg.php";
</script>
<?php }else{ ?>
<script>
alert('Sorry Try Again');
	window.location="volunteer_opp_reg.php";
</script>
<?php } ?>