<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "sistem_layanan_tamu";

$db = mysqli_connect($host, $user, $password, $database);

// cek koneksi
if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>