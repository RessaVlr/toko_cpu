<?php

    if (!isset($_GET['data'])) {
        alertWithRedirect('gagal mencoba server','?url=produk');
    }

    $data = $_GET['data'];
    $query = $koneksi->query("SELECT * FROM tbproduk INNER JOIN tbprodukdetail ON tbproduk.id_produk = tbprodukdetail.id_produk WHERE tbproduk.id_produk = '$data' ORDER BY tbproduk.id DESC");
    $row = $query->fetch_assoc();

?>
<style>
th {
    text-transform: uppercase;
}
</style>
<section id="produk">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section">
                    <h2 class="title_section d-flex">
                        <span class="w-50 float-left">Produk > <?= $row['nama_produk'] ?></span>
                        <div class="w-50 text-right float-right"><a href="?url=produk"
                                class="btn btn-info btn-sm">Kembali</a></div>
                    </h2>
                    <table class="table">
                        <tr>
                            <th class="bg-dark text-light" width="15%">Kode</th>
                            <td>
                                <?= $row['id_produk'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-dark text-light" width="15%">Nama Produk</th>
                            <td>
                                <?= $row['nama_produk'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-dark text-light" width="15%">Tanggal Rilis</th>
                            <td>
                                <?= $row['tanggal'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-dark text-light" width="15%">Harga</th>
                            <td>
                                <?= rupiah($row['harga'])." (<span class='text-danger text-capitalize'>".terbilang($row['harga'])."</span>)" ?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class="bg-warning text-center text-dark" width="15%">SPESIFIKASI</th>
                        </tr>
                        <tr>
                            <th class="bg-info text-light" width="15%">Kode Detail</th>
                            <td>
                                <?= $row['id_produkdetail'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-info text-light" width="15%">Brand</th>
                            <td>
                                <?= $row['brand'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-info text-light" width="15%">Processor</th>
                            <td>
                                <?= $row['processor'] ?>
                                <a target="_blank"
                                    href="https://www.google.com/search?q=<?= urlencode($row['processor']) ?>"><i
                                        class="fa fa-search"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-info text-light" width="15%">GPU / VGA</th>
                            <td>
                                <?= $row['vga'] ?>
                                <a target="_blank"
                                    href="https://www.google.com/search?q=<?= urlencode($row['vga']) ?>"><i
                                        class="fa fa-search"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-info text-light" width="15%">Memory / RAM</th>
                            <td>
                                <?= $row['ram'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-info text-light" width="15%">Power Supply</th>
                            <td>
                                <?= $row['powersupply'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-info text-light" width="15%">Hardisk / SSD</th>
                            <td>
                                <?= $row['hardiskssd'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-info text-light" width="15%">Garansi</th>
                            <td>
                                <?= $row['garansi'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <img src="../dist/img/produk/<?= $row['gambar'] ?>" class="img-fluid">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>