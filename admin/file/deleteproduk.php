<?php
    if (!isset($_GET['data'])) {
        alertWithRedirect('gagal mencoba server','?url=produk');
    } else {
        $data = $_GET['data'];
        $cek = $koneksi->query("SELECT id_produk FROM tbproduk WHERE id_produk = '$data'");
        if ($cek->num_rows > 0) {
            $deleteproduk = $koneksi->query("DELETE FROM tbproduk WHERE id_produk = '$data'");
            if ($deleteproduk) {
                $deletedetail = $koneksi->query("DELETE FROM tbprodukdetail WHERE id_produk = '$data'");
                if ($deletedetail) {
                    // JIKA SUKSES
                    alertWithRedirect('Berhasil menghapus produk','?url=produk');
                } else {
                    alertWithRedirect('ada sedikit kesalahan, coba lagi!','?url=tambahproduk');
                }
            } else {
                alertWithRedirect('ada sedikit kesalahan, coba lagi!','?url=tambahproduk');
            }
        }
    }