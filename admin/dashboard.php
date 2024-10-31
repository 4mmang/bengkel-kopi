<?php
session_start();

// Periksa apakah pengguna sudah login, jika tidak, arahkan ke login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}
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
            <li>
                <a href="pesanan/index.php"
                    class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                    <i class="fas fa-coffee mr-2"></i> Pesanan
                </a>
            </li>
            <li>
                <a href="menu/index.php"
                    class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                    <i class="fas fa-coffee mr-2"></i> Menu
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
            </div>


            <div class="overflow-x-auto mt-4">
                <!-- Tambahan konten lainnya dapat diletakkan di sini -->
            </div>
        </div>

    </div>

    <script>
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
    </script>
</body>

</html>
