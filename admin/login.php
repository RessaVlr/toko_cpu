<?php include_once '../koneksi.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Komputer</title>
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dist/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./dist/css/login.css">
</head>

<body>

    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div class="fadeIn first">
                <img src="../dist/img/logo.png" id="icon" alt="User Icon" />
            </div>
            <form method="post">
                <input type="text" id="login" class="fadeIn second" name="username" placeholder="username" required>
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="********"
                    required>
                <button type="submit" class="fadeIn fourth">Login</button>
            </form>
            <div id="formFooter">
                <a class="underlineHover" href="#">Forgot Password?</a>
            </div>

        </div>
    </div>

    <?php
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $cek = $koneksi->query("SELECT password FROM tbadmin WHERE username = '$username'");
            $row_cek = $cek->fetch_assoc();
            if ($cek->num_rows > 0) {
                if ($row_cek['password'] == $password) {
                    $date = date('Y-m-d H:i:s');
                    $update_date = $koneksi->query("UPDATE tbadmin SET last_login = '$date' WHERE username = '$username'");
                    if ($update_date) {
                        $_SESSION['tokocpu_user'] = $username;
                        header('Location: index.php');exit;
                    } else {
                        alertWithRedirect('Maaf, ada sedikit kesalahan. Coba lagi!', 'login.php');
                    }
                } else {
                    alertWithRedirect('Maaf, ada sedikit kesalahan. Coba lagi!', 'login.php');
                }
            } else {
                alertWithRedirect('Maaf, ada sedikit kesalahan. Coba lagi!','login.php');
            }
        }


    ?>

    <script src="../dist/js/jquery-3.5.1.min.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/main.js"></script>
</body>

</html>