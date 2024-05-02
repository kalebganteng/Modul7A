<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'Pratikum7';

// Koneksi ke database
$koneksi = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
    
}else {
    echo "<p>Koneksi berhasil</p>";
}
?>

