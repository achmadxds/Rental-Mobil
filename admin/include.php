<?php
    session_start();
    require 'auth.php';
    if (!isset($_SESSION['login'])) header('LOCATION:index.php');
?>