<?php
    $produk = $koneksi->query("SELECT * FROM tbproduk INNER JOIN tbprodukdetail ON tbproduk.id_produk = tbprodukdetail.id_produk INNER JOIN tbstok ON tbproduk.id_produk = tbstok.id_produk ORDER BY tbproduk.id DESC");
    $row_produk = $produk->fetch_assoc();


?>

<!-- BODY -->
<section class="m-3">
    <div class="container">
        <div class="banner"></div>
        <div class="pengertian">
            <h2>apa itu <b>Toko CPU</b>?</h2>
            <p class="blockquote text-muted">Sebagai langkah awal, konsep dari toko komputer yang saya impikan adalah
                sebuah toko sederhana dan menjual barang barang yang berkualitas dengan harga terjangkau. Karena tidak
                bisa dipungkiri, kebutuhan perangkat teknologi khususnya komputer dan smartphone saat ini sudah menjadi
                sebuah kebutuhan primer.</p>
        </div>
    </div>
</section>



<!-- JUALAN -->
<section id="produk" class="mt-5">
    <div class="container">
        <div class="row">
            <?php do { ?>
            <?php
                if ($row_produk['stok'] < 1) {
                    $stok['text'] = "STOK HABIS";
                    $stok['color'] = "danger";
                } else {
                    $stok['text'] = "TERSEDIA (".$row_produk['stok']."<span class='small'>pcs</span>)";
                    $stok['color'] = "success";
                }


                // ELIPSIS
                $in = $row_produk['processor']." &bull; ".$row_produk['vga'];
                $elipsis = strlen($in) > 60 ? substr($in,0,60)."..." : $in;

                // Gambar
                if (file_exists('./dist/img/produk/'.$row_produk['gambar'])) {
                    $gambar = './dist/img/produk/'.$row_produk['gambar'];
                } else {
                    $gambar = './dist/img/produk/contoh_produk.png';
                }

            ?>
            <!-- PRODUK LIST -->
            <a href="?url=detail&amp;data=<?= $row_produk['id_produk'] ?>" class="col-md-4 mb-5 produk_detail">
                <div class="img_produk" style="background-image: url(<?= $gambar ?>);"></div>
                <div class="isi_produk">
                    <h2 class="title_produk"><?= $row_produk['nama_produk'] ?></h2>
                    <p class="sub_produk mb-0"><?= $elipsis ?></p>
                    <span class="badge badge-<?= $stok['color'] ?>"><?= $stok['text'] ?></span>
                    <p class="harga_produk"><?= rupiah($row_produk['harga']) ?></p>
                </div>
            </a>
            <?php }while($row_produk = $produk->fetch_assoc()) ?>
        </div>
    </div>
</section>