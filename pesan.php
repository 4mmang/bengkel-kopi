<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Warkop</title>
    <link href="src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
</head>

<body class="bg-black">

    <!-- Form Pemesanan -->
    <div class="container mx-auto p-4 mt-4">
        <div class="bg-white rounded-lg shadow-lg w-full md:w-1/2 mx-auto">
            <!-- Form Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h2 class="text-lg font-semibold">Buat Pesanan</h2>
            </div>
            <!-- Form Body -->
            <div class="p-4">
                <!-- Input Nama -->
                <label for="nama" class="block font-semibold">Nama:</label>
                <input type="text" id="nama" class="w-full p-2 border rounded mt-2" placeholder="Masukkan nama Anda">

                <!-- Pilihan Meja (Luar/Dalam) -->
                <label for="tableOption" class="block font-semibold mt-4">Pilih Meja:</label>
                <select id="meja" class="w-full p-2 border rounded mt-2">
                    <option value="dalam">Dalam</option>
                    <option value="luar">Luar</option>
                </select>

                <!-- Pilihan Take Away atau Minum di Tempat -->
                <label class="block font-semibold mt-4">Jenis Pesanan:</label>
                <div class="flex gap-4 mt-2">
                    <label class="flex items-center">
                        <input type="radio" name="jenisPesanan" value="ya" class="mr-2">
                        Take Away
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="jenisPesanan" value="tidak" class="mr-2">
                        Minum di Tempat
                    </label>
                </div>

                <!-- Pilihan Menu -->
                <p class="mt-4">Pilihan menu hari ini:</p>
                <select id="coffeeSelect" class="w-full p-2 border rounded mt-2">
                    <?php
                    include 'backend/connection.php'; // Menghubungkan file koneksi

                    // Query untuk mengambil menu dengan status 'on'
                    $sql = "SELECT id, nama FROM menus WHERE status = 'on'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Loop untuk setiap menu yang ada
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nama']) . '</option>';
                        }
                    } else {
                        echo '<option value="">Tidak ada menu tersedia</option>'; // Menampilkan pesan jika tidak ada menu
                    }

                    $conn->close(); // Menutup koneksi
                    ?>
                </select>

                <!-- Input Jumlah -->
                <label for="quantity" class="mt-4">Jumlah:</label>
                <input type="number" id="quantity" class="w-full p-2 border rounded mt-2" min="1" value="1">

                <button id="addToOrder" class="mt-4 px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">Tambah</button>

                <!-- Daftar Pesanan -->
                <h3 class="mt-4 font-semibold">Daftar Pesanan:</h3>
                <ul id="orderList" class="mt-2"></ul>
            </div>
            <!-- Form Footer -->
            <div class="flex justify-end p-4 border-t">
                <button id="placeOrder" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Pesan</button>
                <a href="index.php" class="px-4 py-2 bg-blue-300 rounded ml-3">Kembali ke halaman utama</a>
            </div>
        </div>
    </div>
    <!-- End of Form Pemesanan -->



    <!-- footer-->
    <footer class="py-2 text-center font-bold text-white">&copy; 2024 BengkelKopi</footer>
    <!-- end of footer-->

    <script src="dist/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Inisialisasi Choices.js pada elemen select
            const coffeeSelect = new Choices('#coffeeSelect', {
                placeholder: true,
                searchEnabled: true,
            });
        });

        const addToOrder = document.getElementById('addToOrder');
        const coffeeSelect = document.getElementById('coffeeSelect');
        const quantityInput = document.getElementById('quantity');
        const orderList = document.getElementById('orderList');
        const placeOrder = document.getElementById('placeOrder');
        let orders = [];

        addToOrder.addEventListener('click', () => {
            const coffeeType = coffeeSelect.value;
            const coffeeText = coffeeSelect.options[coffeeSelect.selectedIndex]
                .text; // Mendapatkan teks opsi yang dipilih
            const quantity = quantityInput.value;

            if (quantity > 0) {
                orders.push({
                    id: coffeeType,
                    namaMenu: coffeeText, // Gunakan teks opsi sebagai 'type'
                    jumlah: quantity
                });
                updateOrderList();
                quantityInput.value = 1; // Reset input jumlah
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Jumlah harus lebih dari 0",
                });
                // alert("Jumlah harus lebih dari 0");
            }
        });

        // Memperbarui daftar pesanan di UI
        function updateOrderList() {
            orderList.innerHTML = ""; // Mengosongkan daftar
            orders.forEach(order => {
                const listItem = document.createElement('li');
                listItem.textContent = `${order.jumlah} x ${order.namaMenu}`;
                orderList.appendChild(listItem);
            });
        }


        // Menangani tindakan saat tombol "Pesan" diklik
        placeOrder.addEventListener('click', () => {
            if (orders.length > 0) {
                const nama = document.getElementById("nama").value.trim();
                const meja = document.getElementById("meja").value;
                // const jenisPesanan = document.getElementById("jenisPesanan").value;
                const jenisPesanan = document.querySelector('input[name="jenisPesanan"]:checked').value;

                // Validasi input
                if (nama === "" || meja === "" || jenisPesanan === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Harap isi Nama, Pilihan Meja, dan Jenis Pesanan sebelum memesan!',
                    });
                } else {
                    // Buat objek pesanan lengkap
                    const fullOrder = {
                        nama: nama,
                        meja: meja,
                        jenisPesanan: jenisPesanan,
                        items: [...orders]
                    };

                    // Kirim data ke PHP dengan AJAX menggunakan fetch
                    fetch('proses_pesanan.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(fullOrder)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                orders = []; // Kosongkan daftar setelah pesan
                                updateOrderList();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Pesanan Berhasil',
                                    text: 'Pesanan Anda telah diterima.',
                                    allowOutsideClick: false, // Cegah menutup pop-up dengan mengklik di luar
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Arahkan ke halaman lihat-pesanan.php jika tombol OK diklik
                                        window.location.href = 'lihat-pesanan.php';
                                    }
                                });

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Mengirim Pesanan',
                                    text: data.message,
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan saat mengirim pesanan.',
                            });
                        });
                }
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Silakan tambahkan pesanan terlebih dahulu!",
                });
            }
        });
    </script>

</body>

</html>