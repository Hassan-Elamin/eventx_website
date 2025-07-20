<?php

if (isset($_POST['logout-submit'])) {
    if (isset($_COOKIE['org_email'])) {
        setcookie('org_email', '', time() - 3600);
    }
    setcookie('uid', '', time() - 3600, '/');
    header("Location:../../../index.php");
    exit();
}