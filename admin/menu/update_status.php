<?php
session_start();
include '../../backend/connection.php';
include '../../backend/phpqrcode/qrlib.php'; // Pastikan sudah ada file ini

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['menu_id'])) {
    $menu_id = $_POST['menu_id'];

    $sql = "UPDATE menus SET status = 'on' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $menu_id);

    if ($stmt->execute()) {
        // ✅ Buat URL tujuan
        $url = "https://bengkelkopi.shop/pesan.php?menu_id=" . $menu_id;

        // ✅ Tentukan lokasi penyimpanan file QR Code di folder menu/
        $qr_dir = __DIR__ . '/../../menu/';
        $qr_filename = "qr_menu_" . $menu_id . ".png";
        $qr_file = $qr_dir . $qr_filename;

        // ✅ Generate QR code
        QRcode::png($url, $qr_file, QR_ECLEVEL_L, 4);

        // ✅ Simpan path relatif ke database
        $qr_path_to_save = "menu/" . $qr_filename; // Path relatif dari root

        $update_qr = $conn->prepare("UPDATE menus SET qr_code = ? WHERE id = ?");
        $update_qr->bind_param("si", $qr_path_to_save, $menu_id);
        $update_qr->execute();
        $update_qr->close();

        $_SESSION['message'] = "Menu berhasil diaktifkan & QR code berhasil dibuat.";
    } else {
        $_SESSION['message'] = "Gagal mengaktifkan menu.";
    }

    $stmt->close();
} else {
    $_SESSION['message'] = "Data tidak valid.";
}

$conn->close();
header("Location: index.php");
exit();
