<?php include('dbConn.php'); ?>

<?php 
session_start();
if (isset($_POST['saveevent'])) {

$EVENT_T 		= $_POST['EVENT_T'];
$EVENT_L 		= $_POST['EVENT_L'];
$EVENT_DATE 	= $_POST['EVENT_DATE'];
$EVENT_S_TIME 	= $_POST['EVENT_S_TIME'];
$EVENT_E_TIME	= $_POST['EVENT_E_TIME'];
$EVENT_ORG_ID	= $_SESSION['uID'];
$EVENT_DES		= $_POST['EVENT_DES'];

	
$sql="INSERT INTO `event`(`TITLE`, `DESCRIPTION`, `LOCATION`, `DATE`, `START_TIME`, `END_TIME`, `ORG_ID`) VALUES ('$EVENT_T','$EVENT_DES','$EVENT_L','$EVENT_DATE','$EVENT_S_TIME','$EVENT_E_TIME','$EVENT_ORG_ID') ";

$result=mysqli_query($db,$sql);

}
if($result){
?>
<script>
alert('Successfully Event Created');
	window.location="event.php";
</script>
<?php }else{ ?>
<script>
alert('Sorry Try Again');
	window.location="manage_event.php";
</script>
<?php } ?>