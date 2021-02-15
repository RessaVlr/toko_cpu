<?php require_once 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.:: Toko Komputer ::.</title>
    <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./dist/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./dist/css/main.css">
</head>

<body>
    <div id="loader" class="d-none">
        <img src="./dist/img/logo.png" alt="" class="logo justify-content-center">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <div id="app">
        <?php
        include_once 'file/menu.php';
        $url = 'home.php';
        if (isset($_GET['url'])) {
          if ($_GET['url'] == 'detail') {
            $url = 'detail.php';
          } else if ($_GET['url'] == 'login') {
            $url = 'login.php';
          } else if ($_GET['url'] == 'register') {
            $url = 'register.php';
          } else if ($_GET['url'] == 'logout') {
            $url = 'logout.php';
          } else if ($_GET['url'] == 'invoices') {
            $url = 'invoices.php';
          }
        }

        // include kan
        include_once "file/".$url;
        include_once 'file/footer.php';
        
        
      ?>
    </div>

    <script src="./dist/js/jquery-3.5.1.min.js"></script>
    <script src="./dist/js/bootstrap.min.js"></script>
    <script src="./dist/js/main.js"></script>
</body>

</html>