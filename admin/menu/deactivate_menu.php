<?php
include '../../backend/connection.php'; // Menghubungkan file koneksi ke database

if (isset($_GET['id'])) {
    $menu_id = $_GET['id'];

    // Query untuk mengupdate status menu menjadi "off"
    $sql = "UPDATE menus SET status = 'off' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $menu_id);

    if ($stmt->execute()) {
        // Menyimpan pesan keberhasilan dalam session dan mengarahkan kembali ke halaman utama
        session_start();
        $_SESSION['message'] = 'Menu berhasil dinonaktifkan.';
        header("Location: index.php"); // Sesuaikan dengan halaman utama Anda
        exit();
    } else {
        echo "Gagal menonaktifkan menu: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID menu tidak valid.";
}

$conn->close(); // Menutup koneksi
