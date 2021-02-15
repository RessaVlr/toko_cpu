<?php include_once './koneksi.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.:: Toko CPU Adil ::.</title>
    <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./dist/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./admin/dist/css/login.css">
</head>

<body>

    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div class="fadeIn first">
                <img src="./dist/img/logo.png" id="icon" alt="User Icon" />
            </div>
            <form method="post">
                <input type="text" id="login" class="fadeIn second" name="username" placeholder="username" required>
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="********"
                    required>
                <button type="submit" class="fadeIn fourth">Login</button>
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="#">Forgot Password?</a>
            </div>

        </div>
    </div>

    <?php
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // cek jika ada di database
            $cek = $koneksi->query("SELECT id_client,password,nama FROM tbclient WHERE username = '$username'");
            $row_cek = $cek->fetch_assoc();
            if ($cek->num_rows > 0) {
                // cek password
                if ($row_cek['password'] == $password) {
                    // CEK INVOICES
                    $id_client = $row_cek['id_client'];
                    $cek_invoices = $koneksi->query("SELECT * FROM tbinvoices WHERE id_client = '$id_client'");
                    $row_cekinvoices = $cek_invoices->fetch_assoc();
                    $invoices = array();

                    if ($cek_invoices->num_rows > 0) {
                        do {
                            $id_invoice = $row_cekinvoices['id_invoice'];
                            array_push($invoices, $row_cekinvoices['id_invoice']);
                        }while($row_cekinvoices = $cek_invoices->fetch_assoc());
                    }

                    $_SESSION['tokocpu_client'] = $username;
                    $_SESSION['tokocpu_client_id'] = $id_client;
                    $_SESSION['tokocpu_client_name'] = $row_cek['nama'];
                    $_SESSION['tokocpu_client_invoices'] = $invoices;
                        header('Location: index.php');exit;
                } else {
                    alertWithRedirect('Maaf, ada sedikit kesalahan. Coba lagi!', 'login.php');
                }
            } else {
                alertWithRedirect('Maaf, ada sedikit kesalahan. Coba lagi!','login.php');
            }
        }


    ?>

    <script src="./dist/js/jquery-3.5.1.min.js"></script>
    <script src="./dist/js/bootstrap.min.js"></script>
    <script src="./admin/dist/js/admin.js"></script>
</body>

</html>