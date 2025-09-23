<?php

$skorPemain = 650;

$batasPoinHadiah = 500;

echo "Total skor pemain adalah: " . $skorPemain . "<br>";

$mendapatkanHadiah = ($skorPemain > $batasPoinHadiah) ? "YA" : "TIDAK";

echo "Apakah pemain mendapatkan hadiah tambahan? " . $mendapatkanHadiah;

?>