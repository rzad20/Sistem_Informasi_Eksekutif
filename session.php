<?php
session_start();
$check = $_SESSION['login_username'];
if(!isset($check)) {
    header("Location:login.php");
}
?>