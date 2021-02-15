<?php require_once '../koneksi.php' ?>

<?php
    if (!isset($_SESSION['tokocpu_user'])) {
        alertWithRedirect('Sesi anda telah habis!','login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Komputer</title>
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dist/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./dist/css/admin.css">
</head>

<body>

    <?php
        include_once 'file/menu.php';

        $url = 'home.php';
        if (isset($_GET['url'])) {
            if ($_GET['url'] == 'produk') {
                $url = 'produk.php';
            } else if ($_GET['url'] == 'tambahproduk') {
                $url = 'tambahproduk.php';
            } else if ($_GET['url'] == 'stok') {
                $url = 'stok.php';
            } else if ($_GET['url'] == 'detailproduk') {
                $url = 'detailproduk.php';
            } else if ($_GET['url'] == 'editproduk') {
                $url = 'editproduk.php';
            } else if ($_GET['url'] == 'deleteproduk') {
                $url = 'deleteproduk.php';
            } else if ($_GET['url'] == 'stok') {
                $url = 'stok.php';
            } else if ($_GET['url'] == 'pesananongoing') {
                $url = 'pesananongoing.php';
            } else if ($_GET['url'] == 'pesanan') {
                $url = 'pesanan.php';
            } else if ($_GET['url'] == 'pesananselesai') {
                $url = 'pesananselesai.php';
            } else if ($_GET['url'] == 'client') {
                $url = 'client.php';
            }
        }

        include_once 'file/'.$url;

        include_once 'file/footer.php';
    ?>


    <script src="../dist/js/jquery-3.5.1.min.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <script src="./dist/js/admin.js"></script>
</body>

</html>