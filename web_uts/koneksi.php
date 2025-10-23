<?php
$host = "localhost";
$port = "5433";
$dbname = "rentalmobil";
$user = "postgres";
$password = "12345678"; // ganti sesuai password PostgreSQL kamu

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if(!$conn){
    die("Koneksi ke database gagal: " . pg_last_error());
}
?>
