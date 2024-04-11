<?php
date_default_timezone_set('Asia/Colombo');

session_start();

include('dbConn.php');

if(isset($_POST['un']) && isset($_POST['pw']) ){	
	
$userName=$_POST['un'];
$pass=md5($_POST['pw']);
	
$sql="SELECT user.EMAIL, user.PASSWORD , user.USERID, role.R_NAME, user.USERNAME FROM user, role WHERE user.EMAIL = '$userName' AND user.PASSWORD='$pass' AND user.USERTYPE = role.R_ID;";

$result=mysqli_query($db,$sql);

$no=mysqli_num_rows($result);


if($result && $no>0){	
	
	
	while($row = mysqli_fetch_array($result)){
		
		$_SESSION['userName']= $row['USERNAME'];
		
		$_SESSION['role'] =$row['R_NAME'];

		$_SESSION['uID'] = $row['USERID'];
		
	}

?>		
<script>
	window.location="./";
</script>
<?php 
}else{	
?>		
<script>
alert("invalid login");
		window.location="../login.html";
</script>
<?php }	} ?>