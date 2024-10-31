<?php
include 'backend/connection.php';

// Username dan password yang diinputkan pengguna
$username = "admin"; // Ganti dengan username sesuai kebutuhan
$plain_password = "admin";

// Hash password menggunakan algoritma BCRYPT
$hashed_password = password_hash($plain_password, PASSWORD_BCRYPT);

// Simpan username dan hashed password ke dalam database
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $hashed_password);
$stmt->execute();

if ($stmt->affected_rows > 0) {
echo "Pengguna berhasil ditambahkan.";
} else {
echo "Gagal menambahkan pengguna.";
}

$stmt->close();
$conn->close();