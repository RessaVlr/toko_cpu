<?php

    $query = $koneksi->query("SELECT * FROM tbinvoices WHERE status = 2");
    $row = $query->fetch_assoc();

    // BATALKAN
    if (isset($_GET['d']) && isset($_GET['data'])) {
        if ($_GET['d'] == 'batalkan') {
            $data = $_GET['data'];
            $cek_invcs = $koneksi->query("SELECT id_produk FROM tbinvoices WHERE id_invoice = '$data'");
            $row_cekinvcs = $cek_invcs->fetch_assoc();
            if ($cek_invcs->num_rows > 0) {
                // UPDATE STOK
                $id_produkinv = $row_cekinvcs['id_produk'];
                $cekstok = $koneksi->query("SELECT stok FROM tbstok WHERE id_produk = '$id_produkinv'");
                $row_cekstok = $cekstok->fetch_assoc();
                $stok_update = $row_cekstok['stok']+1;
                $update_stok = $koneksi->query("UPDATE tbstok SET stok = '$stok_update' WHERE id_produk = '$id_produkinv'");
                if ($update_stok) {
                    $update = $koneksi->query("UPDATE tbinvoices SET status = 3 WHERE id_invoice = '$data'");
                    if ($update) {
                        alertWithRedirect("berhasil membatalkan pesanan","?url=pesananongoing");
                    } else {
                        alertWithRedirect("ada kesalahan server","?url=pesananongoing");
                    }
                } else {
                    alertWithRedirect("ada kesalahan server","?url=pesananongoing");
                }
                
            }
        }
    }

?>
<section id="produk">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section">
                    <h2 class="title_section d-flex">
                        <span class="w-50 float-left"><a href="?url=pesanan" class="text-muted">Daftar Pesanan</a> >
                            Ongoing</span>
                    </h2>
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="1%">#</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Kode Produk</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Pembeli</th>
                                <th scope="col">Alamat</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;
                            if ($query->num_rows > 0) {
                                do {
                                    // CEK CLIENT
                                    $id_client = $row['id_client'];
                                    $cek_client = $koneksi->query("SELECT nama FROM tbclient WHERE id_client = '$id_client'");
                                    $row_cekclient = $cek_client->fetch_assoc();
                                    
                                    // CEK PRODUK
                                    $id_produk = $row['id_produk'];
                                    $cek_produk = $koneksi->query("SELECT nama_produk,harga FROM tbproduk WHERE id_produk = '$id_produk'");
                                    $row_cekproduk = $cek_produk->fetch_assoc();

                                    // TOTAL
                                    $total = $row['quantity'] * $row_cekproduk['harga'];
                            ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $row['id_invoice'] ?></td>
                                <td><a
                                        href="?url=detailproduk&amp;data=<?= $row['id_produk'] ?>"><?= $row['id_produk'] ?></a>
                                </td>
                                <td><?= $row_cekproduk['nama_produk'] ?></td>
                                <td><?= $row['quantity'] ?></td>
                                <td><?= rupiah($total) ?></td>
                                <td><?= "<span class='text-muted'>(".$id_client.")</span> ".$row_cekclient['nama'] ?>
                                </td>
                                <td><?= $row['alamat'] ?></td>
                                <td>
                                    <a href="?url=pesananongoing&amp;d=batalkan&amp;data=<?=$row['id_invoice'] ?>"
                                        onclick="return confirm('yakin ingin menghapus data?')"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('yakin ingin membatalkannya?')"><i
                                            class="fa fa-times"></i> Batalkan</a>
                                </td>
                            </tr>
                            <?php }while($row = $query->fetch_assoc());} else { ?>
                            <tr>
                                <td colspan="8" class="bg-dark text-center text-light font-weight-bold"><i
                                        class="fa fa-frown"></i> Belum ada
                                    pesanan</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>