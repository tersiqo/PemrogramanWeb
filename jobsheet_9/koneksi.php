<?php

$host = "localhost"; 
$user = "root"; 
$password = ""; 
$database = "prakwebdb";

$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_error) {
    die("Koneksi gagal: " . $connect->connect_error);
}

?>
