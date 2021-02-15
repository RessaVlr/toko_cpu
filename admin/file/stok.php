<?php

    $query = $koneksi->query("SELECT * FROM tbproduk ORDER BY id DESC");
    $row = $query->fetch_assoc();

    if (isset($_POST['stok'])) {
        $kode_produk = $_POST['kode_produk'];
        $stok = $_POST['stok'];
        $tanggal = date('Y-m-d H:i:s');

        $cek = $koneksi->query("SELECT id FROM tbstok WHERE id_produk = '$kode_produk'");
        if ($cek->num_rows > 0) {
            $query = $koneksi->query("UPDATE tbstok SET stok = '$stok', tanggal = '$tanggal' WHERE id_produk = '$kode_produk'");
        } else {
            $query = $koneksi->query("INSERT INTO tbstok (id_produk,stok,tanggal) VALUES ('$kode_produk','$stok','$tanggal')");
        }

        if ($query) {
            alertWithRedirect('Berhasil merubah stok produk','?url=stok');
        } else {
            alertWithRedirect('ada sedikit kesalahan, coba lagi!','?url=stok');
        }

    }

?>
<section id="produk">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section">
                    <h2 class="title_section d-flex">
                        <span class="w-50 float-left"><a href="?url=produk" class="text-muted">Daftar Produk</a> >
                            Stok</span>
                    </h2>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="1%">#</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Tanggal Stok Terakhir</th>
                                <th scope="col">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;do {
                                $id_produk = $row['id_produk'];
                                $stok = $koneksi->query("SELECT * FROM tbstok WHERE id_produk = '$id_produk'");
                                $row_stok = $stok->fetch_assoc();
                                
                            ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $row['id_produk'] ?></td>
                                <td class="font-weight-bold text-primary"><?= $row['nama_produk'] ?></td>
                                <td><?= !empty($row_stok['tanggal']) ? $row_stok['tanggal'] : '' ?></td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="kode_produk" value="<?= $row['id_produk'] ?>">
                                        <div class="form-group">
                                            <div class="input-group inline-group">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-outline-secondary btn-minus">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input class="form-control quantity" min="0" name="stok"
                                                    value="<?= !empty($row_stok['stok']) ? $row_stok['stok'] : '0' ?>"
                                                    type="number">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary btn-plus">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-outline-secondary">
                                                        Update Stok
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <?php }while($row = $query->fetch_assoc()); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>