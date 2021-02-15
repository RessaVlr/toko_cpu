<?php
    if (!isset($_GET['data'])) {
        alertWithRedirect("ada kesalahan server");
    }

    $data = $_GET['data'];
    $cek = $koneksi->query("SELECT * FROM tbproduk INNER JOIN tbprodukdetail ON tbproduk.id_produk = tbprodukdetail.id_produk INNER JOIN tbstok ON tbproduk.id_produk = tbstok.id_produk WHERE tbproduk.id_produk = '$data'");
    $row_cek = $cek->fetch_assoc();

    // Gambar
    if (file_exists('./dist/img/produk/'.$row_cek['gambar'])) {
        $gambar = './dist/img/produk/'.$row_cek['gambar'];
    } else {
        $gambar = './dist/img/produk/contoh_produk.png';
    }

    // terjual
    $qinv = $koneksi->query("SELECT count(id) as totalterjual FROM tbinvoices WHERE id_produk = '$data' AND status = 0");
    $row_qinve = $qinv->fetch_assoc();

    if ($row_cek['stok'] > 0) {
        $button['text'] = 'Beli Sekarang';
        $button['color'] = 'success';
        $button['enabled'] = '';
    } else {
        $button['text'] = 'Stok Habis';
        $button['color'] = 'danger';
        $button['enabled'] = 'disabled';
    }


    // BELI
    if (isset($_POST['submit'])) {
        // ID INVOICES
        $cek_prod = $koneksi->query("SELECT id FROM tbinvoices ORDER BY id DESC");
        if ($cek_prod->num_rows <= 0) {
            $id_invoice = date('Ymd')."01";
        } else {
            $last_id = $cek_prod->num_rows;
            if ($last_id < 10) {
                $last_id++;
                $id_invoice = date('Ymd')."0".$last_id;
            } else {
                $last_id++;
                $id_invoice = date('Ymd').$last_id;
            }
        }
        $quantity = $_POST['quantity'];
        $id_client = $_SESSION['tokocpu_client_id'];
        $tanggal = date('Y-m-d H:i:s');

        // cek stok
        $cekstok = $koneksi->query("SELECT stok FROM tbstok WHERE id_produk = '$data'");
        $row_cekstok = $cekstok->fetch_assoc();

        if ($row_cekstok['stok'] >= $quantity) {
                $insert = $koneksi->query("INSERT INTO tbinvoices (id_client,id_invoice,id_produk,quantity,status,tanggal) VALUES ('$id_client','$id_invoice','$data','$quantity',1,'$tanggal')");
            if ($insert) {
        
                array_push($_SESSION['tokocpu_client_invoices'], $id_invoice);
                header('Location: ?url=invoices');exit;
            } else {
                // var_dump($insert);die();
                alertWithRedirect("ada kesalahan server");
            }
        } else {
            alertWithRedirect("Mohon maaf stok tidak cukup","?url=detail&data=".$data);
        }

        

        
    }
?>
<section id="produk_detail" class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="img_detail" style="background-image: url(<?= $gambar ?>)"></div>
            </div>
            <div class="col-md-8">
                <h1 class="title_produk"><?= $row_cek['nama_produk'] ?></h1>
                <span class="terjual text-muted">Terjual <?= $row_qinve['totalterjual'] ?> produk • 35,6rb x
                    dilihat</span>
                <p class="mt-3">SPESIFIKASI:</p>
                <table>
                    <tr>
                        <th>Brand</th>
                        <td width="1%">:</td>
                        <td><?= $row_cek['brand'] ?></td>
                    </tr>
                    <tr>
                        <th>Processor</th>
                        <td width="1%">:</td>
                        <td><?= $row_cek['processor'] ?></td>
                    </tr>
                    <tr>
                        <th>VGA Card</th>
                        <td width="1%">:</td>
                        <td><?= $row_cek['vga'] ?></td>
                    </tr>
                    <tr>
                        <th>Memory</th>
                        <td width="1%">:</td>
                        <td><?= $row_cek['ram'] ?></td>
                    </tr>
                    <tr>
                        <th>Power Supply</th>
                        <td width="1%">:</td>
                        <td><?= $row_cek['powersupply'] ?></td>
                    </tr>
                    <tr>
                        <th>HDD/SSD</th>
                        <td width="1%">:</td>
                        <td><?= $row_cek['hardiskssd'] ?></td>
                    </tr>
                </table>

                <p class="harga_detail mb-0"><?= rupiah($row_cek['harga']) ?></p>
                <p class="text-danger mb-5"><?= terbilang($row_cek['harga']) ?> rupiah</p>

                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Jumlah Dibeli:</label>
                        <div class="input-group inline-group">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-outline-secondary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input class="form-control quantity" min="1" name="quantity" value="1" type="number">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php if (isset($_SESSION['tokocpu_client'])) { ?>
                        <button type="submit" <?= $button['enabled'] ?> name="submit"
                            class="btn btn-<?= $button['color'] ?>"><i class="fa fa-shopping-cart"></i>
                            &nbsp;<?= $button['text'] ?></button>
                        <?php } else { ?>
                        <a href="?url=login" class="btn btn-success"><i class="fa fa-shopping-cart"></i> &nbsp;Beli
                            Sekarang</a>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>