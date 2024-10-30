<?php
include 'backend/connection.php';
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    // Ambil data customer dari JSON
    $nama = $conn->real_escape_string($data['nama']);
    $meja = $conn->real_escape_string($data['meja']);
    $jenisPesanan = $conn->real_escape_string($data['jenisPesanan']);

    // Query untuk memasukkan data ke tabel pesanan dengan waktu pemesanan
    $sql = "INSERT INTO pesanan (nama, meja, take_away, waktu_pemesanan) VALUES ('$nama', '$meja', '$jenisPesanan', NOW())";

    if ($conn->query($sql) === true) {
        // Ambil id_pesanan dari pesanan yang baru dibuat
        $id_pesanan = $conn->insert_id;

        // Proses setiap item dalam pesanan
        $items = $data['items']; // Asumsi items adalah array dari objek {id_menu, jumlah}
        $insert_success = true;

        foreach ($items as $item) {
            $id_menu = $conn->real_escape_string($item['id']);
            $jumlah = $conn->real_escape_string($item['jumlah']);

            // Query untuk memasukkan data item ke tabel orders
            $sql_item = "INSERT INTO orders (id_pesanan, id_menu, jumlah) VALUES ('$id_pesanan', '$id_menu', '$jumlah')";

            if (!$conn->query($sql_item)) {
                $insert_success = false;
                error_log("Error: " . $conn->error);
                break;
            }
        }

        if ($insert_success) {
            echo json_encode(['success' => true, 'message' => 'Pesanan dan item berhasil disimpan']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan beberapa item pesanan']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan pesanan: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Data pesanan tidak valid.']);
}

// Tutup koneksi
$conn->close();
