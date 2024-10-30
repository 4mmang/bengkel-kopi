<?php
include '../../backend/connection.php';

// Periksa apakah ID pesanan telah diterima
if (isset($_GET['id'])) {
    // Ambil ID dari URL
    $id = (int)$_GET['id'];

    // Query untuk mengupdate status menjadi 'selesai'
    $sql = "UPDATE pesanan SET status = 'selesai' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Jika berhasil, redirect kembali ke halaman detail
        header("Location: detail.php?id=$id");
        exit();
    } else {
        echo "Gagal mengupdate status: " . $conn->error;
    }
} else {
    echo "ID pesanan tidak ditemukan.";
}
