<?php

    $query = $koneksi->query("SELECT * FROM tbclient ORDER BY id DESC");
    $row = $query->fetch_assoc();

?>
<section id="produk">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section">
                    <h2 class="title_section d-flex">
                        <span class="w-50 float-left">Daftar Client</span>
                    </h2>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="1%">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nama Client</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;
                            if ($query->num_rows > 0) {
                            do { ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $row['username'] ?></td>
                                <td class="font-weight-bold text-primary"><?= $row['nama'] ?></td>
                            </tr>
                            <?php }while($row = $query->fetch_assoc());} else { ?>
                            <tr>
                                <td colspan="3" class="bg-warning text-center font-weight-bold">Belum ada client</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>