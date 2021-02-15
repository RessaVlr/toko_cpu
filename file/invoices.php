<div id="invoices" class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="font-weight-bold">My Invoices</h2>
                <hr>
                <form action="" method="post" id="formCheckout">
                    <table class="table">
                        <?php

                        // CHECKOUT
                        if (isset($_POST['alamat'])) {
                            $alamat = $_POST['alamat'];
                            foreach($_POST['id_invoice'] as $id_invs){
                                $cek_invstok = $koneksi->query("SELECT id_produk,quantity FROM tbinvoices WHERE id_invoice = '$id_invs'");
                                $row_cekinvstok = $cek_invstok->fetch_assoc();
                                $id_prodstok = $row_cekinvstok['id_produk'];

                                // UPDATE STOK
                                $cekoldstok = $koneksi->query("SELECT stok FROM tbstok WHERE id_produk = '$id_prodstok'");
                                $row_cekoldstok = $cekoldstok->fetch_assoc();
                                $stok_update = $row_cekoldstok['stok'] - $row_cekinvstok['quantity'];
                                $update_stok = $koneksi->query("UPDATE tbstok SET stok = '$stok_update' WHERE id_produk = '$id_prodstok'");

                                if ($update_stok) {
                                    $update = $koneksi->query("UPDATE tbinvoices SET status = 2, alamat = '$alamat' WHERE id_invoice = '$id_invs'");
                                }
                            }
                            if ($update) {
                                alertWithRedirect("berhasil checkout dan sedang dalam pengiriman, terimakasih!", "?url=invoices");
                            } else {
                                alertWithRedirect("ada kesalahan server");
                            }
                        }



                        // HAPUS ITEM
                        if (isset($_GET['d']) && isset($_GET['data'])) {
                            $data = $_GET['data'];
                            if ($_GET['d'] == 'hapus') {
                                // HAPUS
                                $remove = $koneksi->query("DELETE FROM tbinvoices WHERE id_invoice = '$data'");
                                if ($remove) {
                                    if (($key = array_search($data, $_SESSION['tokocpu_client_invoices'])) !== false) {
                                        unset($_SESSION['tokocpu_client_invoices'][$key]);
                                        header('Location: ?url=invoices');exit;
                                    }
                                }
                            } else if ($_GET['d'] == 'selesai'){
                                // SELESAI
                                $done = $koneksi->query("UPDATE tbinvoices SET status = 0 WHERE id_invoice = '$data'");
                                if ($done) {
                                    alertWithRedirect("Terimakasih telah berbelanja :D", "?url=invoices");
                                } else {
                                    alertWithRedirect("ada kesalahan server");
                                }
                            }
                        }

                            $invoices = $_SESSION['tokocpu_client_invoices'];
                            $id_client = $_SESSION['tokocpu_client_id'];
                            if (!empty($invoices)) {
                                foreach ($invoices as $id_inv){
                                    $cek_inv = $koneksi->query("SELECT * FROM tbinvoices INNER JOIN tbproduk ON tbinvoices.id_produk = tbproduk.id_produk WHERE tbinvoices.id_client = '$id_client' AND tbinvoices.id_invoice = '$id_inv'");
                                    $row_cekinv = $cek_inv->fetch_assoc();

                                    $id_produk = $row_cekinv['id_produk'];
                                    $cek_gambar = $koneksi->query("SELECT gambar FROM tbprodukdetail WHERE id_produk = '$id_produk'");
                                    $row_cekgambar = $cek_gambar->fetch_assoc();
                                    
                                    $harga = $row_cekinv['quantity'] * $row_cekinv['harga'];

                                    if ($row_cekinv['quantity'] > 1) {
                                        $desk = "(".$row_cekinv['quantity']."x".str_replace('Rp ','',rupiah($row_cekinv['harga'])).")";
                                    } else {
                                        $desk = "";
                                    }

                                    // Gambar
                                    if (file_exists('./dist/img/produk/'.$row_cekgambar['gambar'])) {
                                        $gambar = './dist/img/produk/'.$row_cekgambar['gambar'];
                                    } else {
                                        $gambar = './dist/img/produk/contoh_produk.png';
                                    }


                        ?>
                        <!-- ITEM -->
                        <tr>
                            <?php if($row_cekinv['status'] == 1){ ?><input type="hidden" name="id_invoice[]"
                                value="<?= $row_cekinv['id_invoice'] ?>"><?php } ?>
                            <td class="img" width="20%"><img src="<?= $gambar ?>" alt="" class="img-fluid"></td>
                            <th>
                                <div class="mb-5">
                                    <p class="namaproduk"><?= $row_cekinv['nama_produk'] ?></p>
                                    <p class="jumlah"><?= $row_cekinv['quantity'] ?> pcs</p>
                                    <p class="harga">
                                        <?= rupiah($harga)?> <span class="small text-muted"><?= $desk ?></span></p>
                                    <?php if ($row_cekinv['status'] == 1) { ?>
                                    <a href="?url=invoices&amp;d=hapus&amp;data=<?= $row_cekinv['id_invoice'] ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('yakin ingin menghapus item?')">Hapus</a>
                                    <?php } else {
                                    if ($row_cekinv['status'] == 2) {
                                        $alert['text'] = "Sedang dalam perjalanan";
                                        $alert['icon'] = "shipping-fast";
                                        $alert['color'] = "primary";
                                        $alert['enabled'] = true;
                                    } else if ($row_cekinv['status'] == 0) {
                                        $alert['text'] = "Pesanan sampai";
                                        $alert['icon'] = "check-double";
                                        $alert['color'] = "success";
                                        $alert['enabled'] = false;
                                    } else {
                                        $alert['text'] = "Pesanan dibatalkan";
                                        $alert['icon'] = "times-circle";
                                        $alert['color'] = "danger";
                                        $alert['enabled'] = false;
                                    }
                                ?>
                                    <div class="alert alert-<?= $alert['color'] ?> d-inline-block" role="alert">
                                        <i class="fa fa-<?= $alert['icon'] ?>"></i> <?= $alert['text'] ?>
                                    </div><br>
                                    <?php if ($alert['enabled']) { ?>
                                    <a href="?url=invoices&amp;d=selesai&amp;data=<?= $row_cekinv['id_invoice'] ?>"
                                        class="btn btn-success d-inline-block"
                                        onclick="return confirm('apakah barangnya sudah sampai?')"><i
                                            class="fa fa-check-square"></i>
                                        Selesaikan</a>
                                    <?php } ?>
                                    <?php } ?>
                                </div>
                            </th>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="2">
                                <div class="form-group">
                                    <textarea name="alamat" id="alamat" cols="30" class="form-control"
                                        placeholder="Alamat" required></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="button" id="checkout" name="checkout" class="btn btn-lg btn-success w-100"
                                    onclick="return confirm('pastikan datanya sudah benar?')">CHECKOUT</button>
                            </td>
                        </tr>
                        <?php } else { ?>

                        <tr>
                            <td colspan="2" class="text-center bg-warning">Belum ada INVOICES</td>
                        </tr>

                        <?php } ?>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>