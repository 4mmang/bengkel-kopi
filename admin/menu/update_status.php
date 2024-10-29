<?php
session_start(); // Memulai sesi
include '../../backend/connection.php'; // Menghubungkan file koneksi

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['menu_id'])) {
    $menu_id = $_POST['menu_id'];

    $sql = "UPDATE menus SET status = 'on' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $menu_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Menu berhasil ditambahkan ke daftar menu hari ini.";
    } else {
        $_SESSION['message'] = "Gagal menambahkan menu";
    }

    $stmt->close();
} else {
    $_SESSION['message'] = "Data tidak valid.";
}

$conn->close();
header("Location: index.php");
exit();
