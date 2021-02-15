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
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="./dist/img/logo.png" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form method="post">
                <input type="text" id="nama" class="fadeIn second" name="nama" placeholder="Nama Lengkap" required>
                <input type="text" id="login" class="fadeIn second" name="username" placeholder="username" required>
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="********"
                    required>
                <button type="submit" class="fadeIn fourth">Register</button>
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="?url=login">Sudah punya akun?</a>
            </div>

        </div>
    </div>

    <?php
        if (isset($_POST['username'])) {
            $nama = $_POST['nama'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            // cek jika ada di database
            $cek = $koneksi->query("SELECT password FROM tbclient WHERE username = '$username'");
            $row_cek = $cek->fetch_assoc();
            if ($cek->num_rows > 0) {
                alertWithRedirect('Maaf username sudah ada','?url=register');
            } else {
                $cek_prod = $koneksi->query("SELECT id FROM tbclient ORDER BY id DESC");
                if ($cek_prod->num_rows <= 0) {
                    $id_client = date('y')."2501";
                } else {
                    $last_id = $cek_prod->num_rows;
                    if ($last_id < 10) {
                        $last_id++;
                        $id_client = date('y')."250".$last_id;
                    } else {
                        $last_id++;
                        $id_client = date('y')."25".$last_id;
                    }
                }
                $insert = $koneksi->query("INSERT INTO tbclient (id_client,nama,username,password) VALUES ('$id_client','$nama','$username','$password')");
                if ($insert) {
                    $_SESSION['tokocpu_client'] = $username;
                    $_SESSION['tokocpu_client_name'] = $nama;
                    $_SESSION['tokocpu_client_id'] = $id_client;
                    $_SESSION['tokocpu_client_invoices'] = array();
                    
                    header('Location: index.php');exit;
                } else {
                    alertWithRedirect('maaf ada sedikit kesalahan, coba lagi!','?url=register');
                }
            }
        }


    ?>

    <script src="./dist/js/jquery-3.5.1.min.js"></script>
    <script src="./dist/js/bootstrap.min.js"></script>
    <script src="./admin/dist/js/admin.js"></script>
</body>

</html>