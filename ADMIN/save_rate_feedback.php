<?php include('dbConn.php'); ?>

<?php 
session_start();
if (isset($_POST['saverate'])) {

$RatedUserID = $_POST['RatedUserID'];
$RatedByUserID	= $_SESSION['uID'];
$RatingValue = $_POST['RatingValue'];
$feedback	= $_POST['feedback'];
$Timestamp	= date("Y/m/d h:i:s A");

	
$sql="INSERT INTO `rating`(`RatedUserID`, `RatedByUserID`, `RatingValue`, `Comments`, `Timestamp`) VALUES ('$RatedUserID','$RatedByUserID','$RatingValue','$feedback','$Timestamp') ";

$result=mysqli_query($db,$sql);

}
if($result){
?>
<script>
alert('Successfully Rating Submited');
	window.location="rate_feedback.php";
</script>
<?php }else{ ?>
<script>
alert('Sorry Try Again');
	window.location="rate_feedback.php";
</script>
<?php } ?>