<?php
const DB_HOST = 'localhost';
const DB_PORT = '5433'; 
const DB_NAME = 'rentalmobil'; 
const DB_USER = 'postgres';
const DB_PASS = '123456';

function get_pg_connection() {
    static $conn = null;
    if ($conn === null) {
        $conn = pg_connect(
            "host=" . DB_HOST .
            " port=" . DB_PORT .
            " dbname=" . DB_NAME .
            " user=" . DB_USER .
            " password=" . DB_PASS
        );
        if (!$conn) {
            $err = pg_last_error() ?: 'Unknown error from pg_connect';
            throw new RuntimeException("Koneksi PostgreSQL gagal. Periksa host/port/db/user/pass & ekstensi pgsql.");
            throw new RuntimeException("Koneksi PostgreSQL gagal: " . $err);
        }
    }
    return $conn;
}

// Buat koneksi global
// Jika koneksi gagal di sini, script akan berhenti.
try {
    $conn = get_pg_connection();
} catch (Throwable $e) {
    die('Koneksi gagal: ' . htmlspecialchars($e->getMessage()));
}

/**
 * --- Helper query dengan parameter (qparams) ---
 */
function qparams(string $sql, array $params)
{
    $conn = get_pg_connection();
    $res = pg_query_params($conn, $sql, $params);
    if ($res === false) {
        throw new Exception(pg_last_error($conn) . "\nSQL: " . $sql);
    }
    return $res;
}

/**
 * --- Helper query UNIFIED (q) ---
 * Diperbaiki: Menerima parameter opsional. Jika ada parameter, ia memanggil qparams().
 */
function q(string $sql, array $params = []) 
{
    $conn = get_pg_connection();
    
    if (empty($params)) {
        // Query tanpa parameter
        $res = pg_query($conn, $sql);
    } else {
        // Query dengan parameter
        return qparams($sql, $params); 
    }
    
    if ($res === false) {
        throw new Exception(pg_last_error($conn) . "\nSQL: " . $sql);
    }
    return $res;
}
?>