<?php
    require_once '../koneksi.php';

    if (isset($_SESSION['tokocpu_user'])) {
        unset($_SESSION['tokocpu_user']);
        header('Location: login.php');exit;
    }