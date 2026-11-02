<?php
session_start();
//start//git
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit;
}

header('Location: login.php');
exit;