<?php
// PROCESSING LAYER
// Berisi fungsi untuk mengolah data produk.

// Menghitung total nilai stok = harga x stok
function hitungTotalNilaiStok($harga, $stok)
{
    return $harga * $stok;
}

// Stok kurang dari 3 => "Stok Rendah", selain itu => "Stok Aman"
function cekStatusStok($stok)
{
    if ($stok < 3) {
        return "Stok Rendah";
    } else {
        return "Stok Aman";
    }
}

// Mengubah angka ke format rupiah, contoh: 7500000 => Rp 7.500.000
function formatRupiah($angka)
{
    return "Rp " . number_format($angka, 0, ",", ".");
}
