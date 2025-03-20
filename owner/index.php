<?php

session_start();

// Periksa apakah pengguna sudah login, jika tidak, arahkan ke login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'owner') {
    header('Location: ../login.php');
    exit();
}

include '../backend/connection.php';

// Pastikan koneksi berhasil
if (!$conn) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

date_default_timezone_set('Asia/Makassar');
// Array nama hari dalam bahasa Indonesia
$nama_hari = [
    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu',
];

// Inisialisasi array untuk menyimpan daftar hari
$hari_list = [];

// Loop dari 6 hari yang lalu hingga hari ini
for ($i = 6; $i >= 0; $i--) {
    // Hitung tanggal untuk hari ke-$i yang lalu
    $tanggal = strtotime("-$i days");
    // echo "$tanggal <br>";
    $hari_inggris = date('l', $tanggal); // Ambil nama hari dalam bahasa Inggris
    $hari_indonesia = $nama_hari[$hari_inggris]; // Konversi ke bahasa Indonesia

    // Simpan hari ke dalam array
    $hari_list[$hari_indonesia] = []; // Inisialisasi array kosong untuk setiap hari

    // Debug: Tampilkan hari yang dihasilkan
    // echo "$hari_inggris ($hari_indonesia) <br>";
}

// Query SQL untuk mengambil best seller per hari (7 hari terakhir)
$query = "
    SELECT DAYNAME(p.waktu_pemesanan) AS hari,
           m.nama AS nama_menu,
           SUM(o.jumlah) AS total_terjual
    FROM pesanan p
    JOIN orders o ON p.id = o.id_pesanan
    JOIN menus m ON o.id_menu = m.id
    WHERE p.waktu_pemesanan >= CURDATE() - INTERVAL 6 DAY
    GROUP BY hari, m.nama
    ORDER BY hari ASC, total_terjual DESC;
";

// Eksekusi query
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $hari_inggris = $row['hari']; // Nama hari dalam bahasa Inggris dari MySQL
        if (isset($nama_hari[$hari_inggris])) {
            $hari_indonesia = $nama_hari[$hari_inggris]; // Ubah ke bahasa Indonesia
            $produk = $row['nama_menu'];
            $terjual = $row['total_terjual'];

            // Tambahkan ke array jika hari ada dalam daftar
            $hari_list[$hari_indonesia][$produk] = $terjual;
        }
    }
}

// Konversi array $hari_list ke JSON
$hari_list_json = json_encode($hari_list, JSON_PRETTY_PRINT);

// Tutup koneksi
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sidebar with Toggle and Separated Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }

        .hidden-sidebar {
            transform: translateX(-100%);
        }

        #example_filter {
            margin-bottom: 12px;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body class="flex h-screen">
    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed inset-y-0 left-0 w-64 bg-black border-r z-50 border-gray-200 p-4 sidebar-transition hidden-sidebar md:static md:transform-none">
        <!-- <span class="grid h-10 w-32 place-content-center rounded-lg bg-gray-100 text-xs text-gray-600">
            Logo
        </span> -->
        <div class="flex justify-center">
            <span class="grid h-10 place-content-center rounded-lg bg-black text-xl text-white px-3">
                BengkelKopi
            </span>
        </div>

        <ul id="sidebar-menu" class="mt-6 space-y-1">
            <li>
                <a href="#" class="block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
            </li>
        </ul>
    </div>

    <!-- Konten Utama -->
    <div class="flex flex-col flex-1 overflow-hidden">
        <!-- Navbar di atas konten utama -->
        <nav class="bg-white p-4 sticky top-0 z-10">
            <div class="flex justify-between items-center">
                <div class="text-lg font-semibold md:hidden">
                    <a href="../index.php" class="">BengkelKopi</a>
                </div>
                <!-- Tombol toggle sidebar -->
                <button id="menu-btn" class="p-2 rounded-lg text-black md:hidden">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
                <!-- Menu navigasi untuk desktop -->
                <ul class="hidden md:flex space-x-4 ml-auto">
                    <a href="../logout.php">Keluar</a>
                </ul>
            </div>
        </nav>

        <div class="flex-1 p-6 bg-gray-100 overflow-y-auto">
            <h1 class="text-3xl font-bold">Dashboard</h1>
            <!-- <p>This is the main content area. The sidebar is separate and the navbar stays on top of the content area only.</p> -->

            <?php
            // Koneksi ke database
            include '../backend/connection.php';
            
            // Query untuk mendapatkan total pendapatan
            $sql = "
                                                                                        SELECT SUM(menus.harga * orders.jumlah) AS total_pendapatan
                                                                                        FROM pesanan
                                                                                        JOIN orders ON pesanan.id = orders.id_pesanan
                                                                                        JOIN menus ON orders.id_menu = menus.id
                                                                                        WHERE pesanan.status = 'selesai'
                                                                                    ";
            $result = $conn->query($sql);
            
            $total_pendapatan = 0;
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $total_pendapatan = $row['total_pendapatan'] ?? 0;
            }
            
            $conn->close();
            ?>

            <div class="container">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-white shadow-lg rounded-lg p-6 mt-6">
                        <h2 class="text-xl font-semibold text-gray-700">Total Pendapatan</h2>
                        <p class="text-4xl font-bold text-green-500 mt-4">Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></p>
                        <!-- <p class="text-sm text-gray-500">Pendapatan dari pesanan selesai</p> -->
                    </div>
                </div>
                <div class="flex mt-5">
                    <div class="w-full">
                        <div class="bg-white shadow-lg rounded-2xl p-4">
                            <div class="p-4">
                                <canvas id="barChart" class="w-full h-[300px]"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="overflow-x-auto mt-4">
                <!-- Tambahan konten lainnya dapat diletakkan di sini -->
            </div>
        </div>

    </div>

    <!-- <script>
        // Script untuk toggle sidebar dan menambahkan menu
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        const sidebarMenu = document.getElementById('sidebar-menu');

        // Menu baru
        const newMenuItem = document.createElement('li');
        newMenuItem.innerHTML =
            `<a href="../logout.php" class="block rounded-lg px-4 py-2 text-sm md:hidden lg:hidden xl:hidden font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"><i class="fas fa-sign-out-alt mr-2"></i> Keluar</a>`;

        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('hidden-sidebar');

            if (sidebar.classList.contains('hidden-sidebar')) {
                sidebarMenu.removeChild(newMenuItem);
            } else {
                sidebarMenu.appendChild(newMenuItem);
            }
        });

        const btnDownload = document.getElementById('download')
        const popUp = document.getElementById('pop-up')
        btnDownload.addEventListener('click', function() {
            popUp.classList.toggle('hidden')
        })
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // var line = document.getElementById('myLineChart').getContext('2d');
        // // let grafikIncomeThisYear = @json($grafikIncomeThisYear);

        // var myBarChart = new Chart(line, {
        //     type: 'bar', // Ubah dari 'line' menjadi 'bar'
        //     data: {
        //         labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'], // Gunakan label dinamis
        //         datasets: [{
        //             data: [2, 10, 20, 25, 10, 45, 56],
        //             backgroundColor: 'rgba(255, 99, 132, 0.5)', // Warna batang dengan transparansi
        //             borderColor: 'rgba(255, 99, 132, 1)',
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //         plugins: {
        //             title: {
        //                 display: true,
        //                 text: 'Grafik total pendapatan tahun ini'
        //             },
        //             legend: {
        //                 display: false
        //             }
        //         },
        //         // scales: {
        //         //     y: {
        //         //         beginAtZero: true // Memastikan sumbu Y mulai dari nol
        //         //     }
        //         // }
        //     }
        // });

        // var myBarChart = new Chart(document.getElementById('barChart'), {
        //     type: 'bar',
        //     data: {
        //         labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'], // Label hari
        //         datasets: [{
        //                 label: 'Toko A',
        //                 data: [2, 10, 20, 25, 10, 45, 56],
        //                 backgroundColor: 'rgba(255, 99, 132, 0.5)',
        //                 borderColor: 'rgba(255, 99, 132, 1)',
        //                 borderWidth: 1
        //             },
        //             {
        //                 label: 'Toko B',
        //                 data: [5, 15, 10, 30, 20, 50, 60],
        //                 backgroundColor: 'rgba(54, 162, 235, 0.5)',
        //                 borderColor: 'rgba(54, 162, 235, 1)',
        //                 borderWidth: 1
        //             },
        //             {
        //                 label: 'Toko C',
        //                 data: [8, 20, 25, 15, 30, 35, 40],
        //                 backgroundColor: 'rgba(75, 192, 192, 0.5)',
        //                 borderColor: 'rgba(75, 192, 192, 1)',
        //                 borderWidth: 1
        //             },
        //             {
        //                 label: 'Toko D',
        //                 data: [3, 12, 18, 22, 14, 28, 32],
        //                 backgroundColor: 'rgba(255, 206, 86, 0.5)',
        //                 borderColor: 'rgba(255, 206, 86, 1)',
        //                 borderWidth: 1
        //             }
        //         ]
        //     },
        //     options: {
        //         plugins: {
        //             title: {
        //                 display: true,
        //                 text: 'Grafik Perbandingan Pendapatan per Hari'
        //             },
        //             legend: {
        //                 display: true
        //             }
        //         },
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });

        // Data produk terlaris setiap hari
        // const bestSellersData = {
        //     Senin: {
        //         'Produk A': 20,
        //         'Produk B': 15,
        //         'Produk C': 10,
        //         'Produk D': 5
        //     },
        //     Selasa: {
        //         'Produk B': 18,
        //         'Produk C': 12,
        //         'Produk E': 8,
        //         'Produk F': 6
        //     },
        //     Rabu: {
        //         'Produk A': 22,
        //         'Produk D': 14,
        //         'Produk E': 9,
        //         'Produk G': 7
        //     },
        //     Kamis: {
        //         'Produk B': 19,
        //         'Produk C': 13,
        //         'Produk F': 10,
        //         'Produk H': 5
        //     },
        //     Jumat: {
        //         'Produk A': 25,
        //         'Produk E': 15,
        //         'Produk G': 12,
        //         'Produk I': 8
        //     },
        //     Sabtu: {
        //         'Produk C': 20,
        //         'Produk D': 18,
        //         'Produk F': 14,
        //         'Produk J': 10
        //     },
        //     Minggu: {
        //         'Produk A': 30,
        //         'Produk B': 25,
        //         'Produk E': 20,
        //         'Produk K': 40
        //     }
        // };

        const bestSellersData = <?php echo $hari_list_json; ?>;


        console.log(bestSellersData);


        // Fungsi untuk mengambil 4 produk terlaris setiap hari
        function getTop4Products(bestSellersData) {
            const top4ProductsPerDay = {};

            for (const day in bestSellersData) {
                const products = Object.entries(bestSellersData[day])
                    .sort((a, b) => b[1] - a[1]) // Urutkan dari penjualan tertinggi ke terendah
                    .slice(0, 4) // Ambil 4 produk teratas
                    .reduce((acc, [product, value]) => {
                        acc[product] = value; // Simpan produk dan nilainya
                        return acc;
                    }, {});

                top4ProductsPerDay[day] = products;
            }

            return top4ProductsPerDay;
        }

        // Fungsi untuk menyiapkan data grafik
        function prepareChartData(bestSellersData, top4ProductsPerDay) {
            const labels = Object.keys(bestSellersData); // Hari: Senin, Selasa, Rabu, dst.
            const datasets = [];

            // Buat dataset untuk setiap produk yang pernah menjadi top 4
            const allTop4Products = [...new Set(Object.values(top4ProductsPerDay).flatMap(Object
                .keys))]; // Gabungkan semua produk teratas

            allTop4Products.forEach(product => {
                const data = labels.map(day => {
                    // Jika produk termasuk top 4 di hari tersebut, ambil nilainya, jika tidak, isi dengan null
                    return top4ProductsPerDay[day][product] || null;
                });

                datasets.push({
                    label: product,
                    data: data,
                    backgroundColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`, // Warna acak
                    borderColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`,
                    borderWidth: 1
                });
            });

            return {
                labels,
                datasets
            };
        }

        // Ambil 4 produk terlaris setiap hari
        const top4ProductsPerDay = getTop4Products(bestSellersData);

        // Siapkan data untuk Chart.js
        const chartData = prepareChartData(bestSellersData, top4ProductsPerDay);

        // Buat grafik
        var myBarChart = new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: chartData.labels, // Label hari
                datasets: chartData.datasets // Dataset untuk setiap produk
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Produk Best Seller per Hari'
                    },
                    legend: {
                        display: true // Tampilkan legend
                    }
                },
                // barPercentage: 1.0, // Ubah nilai ini lebih dari 1.0
                // categoryPercentage: 1.0, // Ubah nilai ini lebih dari 1.0
                scales: {
                    x: {
                        stacked: false, // Batang tidak berdempetan
                        barThickness: 60, // Atur ketebalan batang (opsi 1)
                    },
                    y: {
                        beginAtZero: true
                    }
                },
            }
        });
    </script>
</body>

</html>
