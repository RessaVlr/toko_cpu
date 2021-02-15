<!-- MENU -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="./">
            <img src="./dist/img/logo.png" alt="" width="50">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./">Beranda <span class="sr-only">(current)</span></a>
                </li>
                <?php if (isset($_SESSION['tokocpu_client'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">Halo
                        <b><?= $_SESSION['tokocpu_client_name']." ".$_SESSION['tokocpu_client_id']; ?></b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?url=invoices">Invoice Saya</a>
                </li>
                <?php } ?>
            </ul>
            <div class="avatar">
                <img src="./dist/img/avatar.png" alt="" class="avatar_img" width="23">
                <?php if (isset($_SESSION['tokocpu_client'])) { ?>
                <a href="?url=logout" class="text-light"> Logout</a>
                <?php } else { ?>
                <a href="?url=login" class="text-light"> Login</a>
                <a href="?url=register" class="text-light"> Register</a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>