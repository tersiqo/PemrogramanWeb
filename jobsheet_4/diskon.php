<?php

$hargaProduk = 120000;
$batasDiskon = 100000;
$persentaseDiskon = 20;

if ($hargaProduk > $batasDiskon) {
    $jumlahDiskon = $hargaProduk * ($persentaseDiskon / 100);
    
    $hargaAkhir = $hargaProduk - $jumlahDiskon;

    echo "<h3>Detail Pembelian</h3>";
    echo "Harga produk: Rp " . number_format($hargaProduk, 0, ',', '.') . "<br>";
    echo "Diskon: " . $persentaseDiskon . "%<br>";
    echo "Jumlah diskon yang didapatkan: Rp " . number_format($jumlahDiskon, 0, ',', '.') . "<br>";
    echo "Harga yang harus dibayar: Rp " . number_format($hargaAkhir, 0, ',', '.') . "<br>";

} else {
    echo "<h3>Detail Pembelian</h3>";
    echo "Harga produk: Rp " . number_format($hargaProduk, 0, ',', '.') . "<br>";
    echo "Maaf, Anda tidak mendapatkan diskon karena pembelian di bawah Rp " . number_format($batasDiskon, 0, ',', '.') . ".<br>";
    echo "Harga yang harus dibayar: Rp " . number_format($hargaProduk, 0, ',', '.') . "<br>";
}
?>