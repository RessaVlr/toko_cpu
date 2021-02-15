<?php

    $cek_prod = $koneksi->query("SELECT id FROM tbproduk ORDER BY id DESC");
    if ($cek_prod->num_rows <= 0) {
        $kode_produk = date('y')."01";
    } else {
        $last_id = $cek_prod->num_rows;
        if ($last_id < 10) {
            $last_id++;
            $kode_produk = date('y')."0".$last_id;
        } else {
            $last_id++;
            $kode_produk = date('y').$last_id;
        }
    }

    // FORM SUBMIT
    if (isset($_POST['submit'])) {
        $id_detail = date('y').$kode_produk;
        $nama_produk = $_POST['nama_produk'];
        $brand = $_POST['brand'];
        $harga = $_POST['harga'];
        $processor = $_POST['processor'];
        $vga = $_POST['vga'];
        $ram = $_POST['ram'];
        $powersupply = $_POST['powersupply'];
        $hardiskssd = $_POST['hardiskssd'];
        $garansi = $_POST['garansi'];
        $tanggal = date('Y-m-d H:i:s');

        // INPUT GAMBAR
        if (file_exists($_FILES['gambar']['tmp_name']) || is_uploaded_file($_FILES['gambar']['tmp_name'])) {
            $temp = explode(".", $_FILES["gambar"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            move_uploaded_file($_FILES["gambar"]["tmp_name"], "../dist/img/produk/" . $newfilename);
            $gambar = $newfilename;
        } else {
            $gambar = "contoh_produk.png";
        }

        $input = $koneksi->query("INSERT INTO tbproduk (id_produk,nama_produk,harga,tanggal) VALUES ('$kode_produk','$nama_produk','$harga','$tanggal')");
        if ($input) {
            $input_detail = $koneksi->query("INSERT INTO tbprodukdetail (id_produkdetail,id_produk,brand,processor,vga,ram,powersupply,hardiskssd,garansi,gambar) VALUES ('$id_detail','$kode_produk','$brand','$processor','$vga','$ram','$powersupply','$hardiskssd','$garansi','$gambar')");

            if ($input_detail) {
                // JIKA SUKSES
                alertWithRedirect('Berhasil menambah produk','?url=produk');
            } else {
                alertWithRedirect('ada sedikit kesalahan, coba lagi!','?url=tambahproduk');
            }
        } else {
            alertWithRedirect('ada sedikit kesalahan, coba lagi!','?url=tambahproduk');
        }

    }


?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section">
                    <h2 class="title_section">Tambah Produk</h2>
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <!-- ITEM -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Kode Produk</span>
                                    </div>
                                    <input type="text" class="form-control" value="<?= $kode_produk ?>"
                                        name="kode_produk" readonly>
                                </div>

                                <!-- ITEM -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Nama Produk</span>
                                    </div>
                                    <input type="text" class="form-control" value="" name="nama_produk"
                                        placeholder="KS 11GH1F">
                                </div>

                                <!-- ITEM -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Brand</span>
                                    </div>
                                    <input type="text" class="form-control" name="brand" value="">
                                </div>

                                <!-- ITEM -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Harga Produk</span>
                                    </div>
                                    <input type="number" class="form-control" min="1" name="harga" value="">
                                </div>

                                <!-- ITEM -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Processor</span>
                                    </div>
                                    <input type="text" class="form-control" name="processor" value="">
                                </div>

                                <!-- ITEM -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">VGA Card</span>
                                    </div>
                                    <input type="text" class="form-control" name="vga" value="">
                                </div>

                                <!-- ITEM -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Memory / RAM</span>
                                    </div>
                                    <input type="text" class="form-control" name="ram" value="">
                                </div>

                                <!-- ITEM -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Power Supply</span>
                                    </div>
                                    <input type="text" class="form-control" name="powersupply" value="">
                                </div>

                                <!-- ITEM -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Hardisk / SSD</span>
                                    </div>
                                    <input type="text" class="form-control" name="hardiskssd" value="">
                                </div>

                                <!-- ITEM -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Garansi</span>
                                    </div>
                                    <input type="text" class="form-control" name="garansi" value=""
                                        placeholder="5 Tahun">
                                </div>

                                <!-- GAMBAR -->
                                <div class="custom-file">
                                    <label class="custom-file-label" for="gambar">Pilih Gambar</label>
                                    <input type="file" accept="image/x-png,image/gif,image/jpeg"
                                        class="custom-file-input" name="gambar" id="gambar" required>
                                </div>

                                <div class="form-group mt-3">
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                    <a href="?url=produk" class="btn btn-info">Kembali</a>
                                </div>
                            </div>
                            <!-- GAMBAR -->
                            <div class="col-6">
                                <img src="" class="img-fluid" id="previewImg">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>