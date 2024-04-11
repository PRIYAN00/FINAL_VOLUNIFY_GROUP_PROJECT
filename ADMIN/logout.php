<?php 
session_start();

unset($_SESSION['userName']);
session_destroy();

header("location:./");

?>