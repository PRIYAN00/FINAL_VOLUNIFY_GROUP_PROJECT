<?php include('dbConn.php'); ?>

<?php 
session_start();
if (isset($_POST['upload'])) {

$USERNAME = $_POST['username'];
$FULLNAME = $_POST['fullname'];
$PASSWORD = md5($_POST['password']);
$EMAIL = $_POST['email'];
$USERTYPE = $_POST['usertype'];
$LOCATION = $_POST['location'];
$INTEREST = $_POST['interest'];
$ABILITY = $_POST['ability'];
$TALENTS = $_POST['talents'];
$CREDENTIAL = $_POST['qualification'];
$REG_DATE = date("Y/m/d h:i:s A");
	
$sql="INSERT INTO `user`(`USERNAME`, `FULLNAME`, `PASSWORD`, `EMAIL`, `USERTYPE`, `LOCATION`, `INTEREST`, `ABILITY`, `TALENTS`, `CREDENTIAL`, `REG_DATE`) VALUES ('$USERNAME','$FULLNAME','$PASSWORD','$EMAIL','$USERTYPE','$LOCATION','$INTEREST','$ABILITY','$TALENTS','$CREDENTIAL','$REG_DATE');";

$result=mysqli_query($db,$sql);


$to = $_POST['email'];
$subject = "Welcome to Volunify!";
$message = "Dear User " . $_POST['username'];
$message .= "Welcome to  Volunfy! We're excited to have you as a member of our community.\n";
$message .= "Feel free to explore our website and discover all the features and resources available to you.\n";
$message .= "If you have any questions or need assistance, please don't hesitate to contact us.\n\n";
$message .= "Best regards,\n";
$message .= "Team Volunify";

$headers = "From: onboard@volunify.com\r\n";
$headers .= "Reply-To: onboard@volunify.com\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send welcome email
if (mail($to, $subject, $message, $headers)) {
    echo "Welcome email sent successfully.";
} else {
    echo "Failed to send welcome email.";
}

}
if($result){
?>
<script>
alert('Successfully Account Created');
	window.location="../login.html";
</script>
<?php }else{ ?>
<script>
alert('Sorry Try Again');
	window.location="../signup.html";
</script>
<?php } ?>