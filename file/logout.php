<?php
    require_once './koneksi.php';

    if (isset($_SESSION['tokocpu_client'])) {
        unset($_SESSION['tokocpu_client']);
        unset($_SESSION['tokocpu_client_name']);
        unset($_SESSION['tokocpu_client_invoices']);
        header('Location: index.php');exit;
    }