<?php
include 'backend/connection.php';

// Cek apakah id pesanan ada di URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data detail pesanan berdasarkan id
    $sql = "SELECT id, nama, status, meja, take_away, waktu_pemesanan
            FROM pesanan
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah ada hasil dari query
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Pesanan tidak ditemukan.";
        exit;
    }
    $stmt->close();

    // Query untuk mengambil data item pesanan
    $sqlItems = "SELECT o.id_menu, o.jumlah, m.nama AS nama_menu, m.harga
                 FROM orders o
                 JOIN menus m ON o.id_menu = m.id
                 WHERE o.id_pesanan = ?";
    $stmtItems = $conn->prepare($sqlItems);
    $stmtItems->bind_param("i", $id);
    $stmtItems->execute();
    $resultItems = $stmtItems->get_result();
} else {
    echo "ID pesanan tidak valid.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link href="src/output.css" rel="stylesheet">
</head>

<body class="bg-black text-white">
    <div class="container mx-auto p-4 mt-4">
        <h1 class="mb-3">Detail Pesanan</h1>
        <a href="lihat-pesanan.php" class="inline-block rounded bg-red-600 px-4 py-2 mb-5 text-xs font-medium text-white hover:bg-indigo-700">Kembali ke Daftar Pesanan</a>

        <!-- Bagian informasi pesanan -->
        <div class="bg-white text-black rounded-lg shadow-lg w-full mx-auto p-4 mt-5">
            <h2 class="mb-4 text-xl font-semibold">Informasi Pesanan</h2>
            <table class="table-auto w-full">
                <tbody>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Nama</td>
                        <td class="px-4 py-2"><?= ucwords(htmlspecialchars($row['nama'])); ?></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Status</td>
                        <td class="px-4 py-2"><?= ucwords(htmlspecialchars($row['status'])); ?></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Meja</td>
                        <td class="px-4 py-2"><?= ucwords(htmlspecialchars($row['meja'])); ?></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Take Away</td>
                        <td class="px-4 py-2"><?= $row['take_away'] == 'ya' ? 'Ya' : 'Tidak'; ?></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Waktu Pemesanan</td>
                        <td class="px-4 py-2"><?= ucwords(htmlspecialchars($row['waktu_pemesanan'])); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Bagian daftar item pesanan -->
        <div class="bg-white text-black rounded-lg shadow-lg w-full mx-auto p-4 mt-5">
            <h2 class="mb-4 text-xl font-semibold">Daftar Item Pesanan</h2>
            <div class="overflow-x-auto"> <!-- Tambahkan div ini untuk responsivitas -->
                <table class="table-auto w-full min-w-max">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left">No</th>
                            <th class="px-4 py-2 text-left">Nama Menu</th>
                            <th class="px-4 py-2 text-left">Jumlah</th>
                            <th class="px-4 py-2 text-left">Harga</th>
                            <th class="px-4 py-2 text-left">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $totalPesanan = 0;

                        if ($resultItems->num_rows > 0) {
                            while ($item = $resultItems->fetch_assoc()) {
                                $namaMenu = ucwords(htmlspecialchars($item['nama_menu']));
                                $jumlah = (int) $item['jumlah'];
                                $harga = (float) $item['harga'];
                                $totalHargaItem = $jumlah * $harga;

                                echo "<tr>";
                                echo "<td class='border px-4 py-2'>" . $no++ . "</td>";
                                echo "<td class='border px-4 py-2'>{$namaMenu}</td>";
                                echo "<td class='border px-4 py-2'>{$jumlah}</td>";
                                echo "<td class='border px-4 py-2'>" . number_format($harga, 2) . "</td>";
                                echo "<td class='border px-4 py-2'>" . number_format($totalHargaItem, 2) . "</td>";
                                echo "</tr>";

                                $totalPesanan += $totalHargaItem;
                            }
                        } else {
                            echo "<tr><td colspan='5' class='border px-4 py-2 text-center'>Tidak ada item pesanan</td></tr>";
                        }
                        ?>
                        <tr class="bg-gray-200 font-semibold">
                            <td colspan="4" class="px-4 py-2 text-left">Total Keseluruhan</td>
                            <td class="px-4 py-2"><?= number_format($totalPesanan, 2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <footer class="py-2 text-center font-bold text-white">&copy; 2024 BengkelKopi</footer>
</body>

</html>

<?php
$stmtItems->close();
$conn->close();
?>