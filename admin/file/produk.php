<?php

    $query = $koneksi->query("SELECT * FROM tbproduk ORDER BY id DESC");
    $row = $query->fetch_assoc();

?>
<section id="produk">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section">
                    <h2 class="title_section d-flex">
                        <span class="w-50 float-left">Daftar Produk</span>
                        <div class="w-50 text-right float-right"><a href="?url=tambahproduk"
                                class="btn btn-info btn-sm">Tambah
                                Produk</a></div>
                    </h2>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="1%">#</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Tanggal Rilis</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;do { ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $row['id_produk'] ?></td>
                                <td class="font-weight-bold text-primary"><?= $row['nama_produk'] ?></td>
                                <td><?= $row['tanggal'] ?></td>
                                <td>
                                    <a href="?url=detailproduk&amp;data=<?=$row['id_produk'] ?>"
                                        class="btn btn-info btn-sm">Lihat Detail</a>
                                    <a href="?url=stok" class="btn btn-warning btn-sm">Stok</a>
                                    <a href="?url=editproduk&amp;data=<?=$row['id_produk'] ?>"
                                        class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                    <a href="?url=deleteproduk&amp;data=<?=$row['id_produk'] ?>"
                                        onclick="return confirm('yakin ingin menghapus data?')"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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