<?php include('dbConn.php'); ?>

<?php
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and passwords from the form
    $email = $_POST["email"];
    $password = md5($_POST["pass"]);
    $confirmPassword = md5($_POST["pass1"]);

    // Check if email exists in the database
    $sql = "SELECT * FROM user WHERE EMAIL='$email'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        // Check if passwords match
        if ($password == $confirmPassword) {
            // Update the user's password in the database
            $sql = "UPDATE user SET PASSWORD='$password' WHERE EMAIL='$email'";
            if ($db->query($sql) === TRUE) {
                $msg = "Password reset successfully.";
            } else {
                $msg = "Error updating password: " . $db->error;
            }
        } else {
            $msg = "Passwords do not match. Please try again.";
        }
    } else {
        $msg = "Email not found. Please try again.";
    }
}

$db->close();
?>
<script>
alert('<?php echo $msg ?>');
	window.location="../login.html";
</script>
