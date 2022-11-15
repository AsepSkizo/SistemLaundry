<?php
session_start();
include "filelog.php";
if (isset($_SESSION['loginadmin'])) {
    $nama = $_SESSION['nama'];
    $role = $_SESSION['role'];
    $log = $nama . " (" . $role . ") Telah Melakukan Logout";
    logger($log, "../../");
    session_destroy();
}
if (isset($_SESSION['loginkasir'])) {
    $nama = $_SESSION['nama'];
    $role = $_SESSION['role'];
    $log = $nama . " (" . $role . ") Telah Melakukan Logout";
    logger($log, "../../");
    session_destroy();
}
header('location: login.php');
