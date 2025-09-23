<?php
$a = 10;
$b = 5;

echo "Variabel a: {$a} <br>";
echo "Variabel b: {$b} <br>";
echo "<br>";

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;

echo "Hasil Penjumlahan: " . $hasilTambah . "<br>";
echo "Hasil Pengurangan: " . $hasilKurang . "<br>";
echo "Hasil Perkalian: " . $hasilKali . "<br>";
echo "Hasil Pembagian: " . $hasilBagi . "<br>";
echo "Sisa Bagi (Modulus): " . $sisaBagi . "<br>";
echo "Hasil Pangkat: " . $pangkat . "<br>";

$hasilSama = $a ==  $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;

echo "<br>";
echo "Hasil perbandingan: <br>";
echo "Apakah a sama dengan b? " . ($hasilSama ? 'Ya' : 'Tidak') . "<br>";
echo "Apakah a tidak sama dengan b? " . ($hasilTidakSama ? 'Ya' : 'Tidak') . "<br>";
echo "Apakah a lebih kecil dari b? " . ($hasilLebihKecil ? 'Ya' : 'Tidak') . "<br>";
echo "Apakah a lebih besar dari b? " . ($hasilLebihBesar ? 'Ya' : 'Tidak') . "<br>";
echo "Apakah a lebih kecil atau sama dengan b? " . ($hasilLebihKecilSama ? 'Ya' : 'Tidak') . "<br>";
echo "Apakah a lebih besar atau sama dengan b? " . ($hasilLebihBesarSama ? 'Ya' : 'Tidak') . "<br>";

?>

