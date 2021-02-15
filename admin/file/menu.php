<!-- MENU -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="./">
            <img src="../dist/img/logo.png" alt="" width="50">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./">Admin <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Produk
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="?url=produk">Daftar Produk</a>
                        <a class="dropdown-item" href="?url=tambahproduk">Tambah Produk</a>
                        <a class="dropdown-item" href="?url=stok">Stok</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pesanan
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="?url=pesanan">Daftar Pesanan</a>
                        <a class="dropdown-item" href="?url=pesananongoing">Ongoing</a>
                        <a class="dropdown-item" href="?url=pesananselesai">Pesanan Selesai</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?url=client">List Client</a>
                </li>
            </ul>
            <div class="avatar">
                <img src="../dist/img/avatar.png" alt="" class="avatar_img" width="23">
                <a href="./logout.php" class="text-dark"> Logout</a>
            </div>
        </div>
    </div>
</nav>