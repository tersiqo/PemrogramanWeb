<?php

$totalKursi = 45;
$kursiDitempati = 28;

$kursiKosong = $totalKursi - $kursiDitempati;

$persentaseKosong = ($kursiKosong / $totalKursi) * 100;

echo "<h2>Analisis Kursi Restoran</h2>";
echo "Jumlah total kursi: " . $totalKursi . " kursi<br>";
echo "Jumlah kursi yang ditempati: " . $kursiDitempati . " kursi<br>";
echo "Jumlah kursi yang masih kosong: " . $kursiKosong . " kursi<br>";
echo "<h3>Persentase kursi yang masih kosong adalah: " . number_format($persentaseKosong, 2) . "%</h3>";

?>