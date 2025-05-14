<?php
$servername = "localhost"; // Nama server, biasanya "localhost"
$username = "root"; // Nama pengguna MySQL Anda
$password = "A9PV;8k~U&*n"; // Kata sandi MySQL Anda
$database = "u206385220_bk"; // Nama database yang ingin Anda hubungkan

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
