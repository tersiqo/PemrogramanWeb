<?php

$nilaiSiswa = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];

sort($nilaiSiswa);

$nilaiYangDiabaikan = array_slice($nilaiSiswa, 2, -2);

$totalNilai = array_sum($nilaiYangDiabaikan);

echo "<h2>Perhitungan Nilai Ujian</h2>";
echo "Daftar nilai awal: " . implode(", ", $nilaiSiswa) . "<br>";
echo "Daftar nilai setelah diurutkan dan diabaikan: " . implode(", ", $nilaiYangDiabaikan) . "<br>";
echo "Total nilai yang akan dihitung rata-ratanya: " . $totalNilai . "<br>";

?>