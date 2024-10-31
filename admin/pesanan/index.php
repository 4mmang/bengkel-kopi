<?php
session_start();

// Periksa apakah pengguna sudah login, jika tidak, arahkan ke login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
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
                <a href="../dashboard.php" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="#"
                    class="block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                    <i class="fas fa-coffee mr-2"></i> Pesanan
                </a>
            </li>

            <li>
                <a href="../menu/index.php"
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
                    <a href="#" class="">BengkelKopi</a>
                </div>
                <!-- Tombol toggle sidebar -->
                <button id="menu-btn" class="p-2 rounded-lg text-black md:hidden">
                    <i class="fas fa-bars text-2xl"></i>
                </button>

                <!-- Menu navigasi untuk desktop -->
                <ul class="hidden md:flex space-x-4 ml-auto">
                    <a href="../../logout.php">Keluar</a>
                </ul>
            </div>
        </nav>

        <!-- Isi konten -->
        <div class="flex-1 p-6 bg-gray-100 overflow-y-auto">
            <h1 class="text-3xl font-bold">Daftar Pesanan Hari Ini.</h1>


            <div class="container">
            </div>

            <!-- Modal Script -->
            <script>
                const modal = document.getElementById('modal');
                const openModalBtn = document.getElementById('openModal');
                const closeModalBtn = document.getElementById('closeModal');

                openModalBtn.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                });

                closeModalBtn.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });

                // Optional: Close modal when clicking outside modal content
                window.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.classList.add('hidden');
                    }
                });
            </script>


            <!-- pop up start -->
            <div id="pop-up"
                class="rounded-2xl mt-3 hidden border border-blue-100 bg-white p-4 shadow-lg sm:p-6 lg:p-8"
                role="alert">
                <div class="flex items-center gap-4">
                    <span class="shrink-0 rounded-full bg-blue-400 p-2 text-white">
                        <svg class="size-4" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z"
                                fill-rule="evenodd" />
                        </svg>
                    </span>

                    <p class="font-medium sm:text-lg">New message!</p>
                </div>

                <p class="mt-4 text-gray-500">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam ea quo unde vel adipisci
                    blanditiis voluptates eum. Nam, cum minima?
                </p>

                <div class="mt-6 sm:flex sm:gap-4">
                    <a class="inline-block w-full rounded-lg bg-blue-500 px-5 py-3 text-center text-sm font-semibold text-white sm:w-auto"
                        href="#">
                        Take a Look
                    </a>

                    <a class="mt-2 inline-block w-full rounded-lg bg-gray-50 px-5 py-3 text-center text-sm font-semibold text-gray-500 sm:mt-0 sm:w-auto"
                        href="#">
                        Mark as Read
                    </a>
                </div>
            </div>
            <!-- pop up end -->

            <div class="overflow-x-auto mt-4">
                <table id="example" class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm mt-4">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">No</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Nama</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Meja</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>
                            <th class="whitespace-neowrap px-4 py-2 font-medium text-gray-900">Take Away</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <?php
                        include '../../backend/connection.php';
                        // Lakukan query untuk mengambil data pesanan
                        $sql = "SELECT id, nama, status, meja, take_away, waktu_pemesanan 
                                                            FROM pesanan 
                                                            WHERE DATE(waktu_pemesanan) = CURDATE()
                                                            ORDER BY 
                                                                CASE WHEN status = 'proses' THEN 1 ELSE 2 END,
                                                                waktu_pemesanan ASC";

                        $result = $conn->query($sql);
                        $no = 1; // Inisialisasi nomor urut

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Tampilkan setiap data dalam bentuk tabel
                                echo '<tr>';
                                echo "<td class='whitespace-nowrap px-4 py-2 font-medium text-gray-900'>" . $no++ . '</td>';
                                echo "<td class='whitespace-nowrap px-4 py-2 font-medium text-gray-900'>" . htmlspecialchars(ucwords($row['nama'])) . '</td>';
                                echo "<td class='whitespace-nowrap px-4 py-2 text-gray-700'>" . htmlspecialchars(ucwords($row['meja'])) . '</td>';
                                echo "<td class='whitespace-nowrap px-4 py-2 text-gray-700'>" . htmlspecialchars(ucwords($row['status'])) . '</td>';
                                echo "<td class='whitespace-nowrap px-4 py-2 text-gray-700'>" . ($row['take_away'] == 'ya' ? 'Ya' : 'Tidak') . '</td>';
                                echo "<td class='whitespace-nowrap px-4 py-2'>
                                                                    <a href='detail.php?id=" .
                                    htmlspecialchars($row['id']) .
                                    "' 
                                                                        class='inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700'>
                                                                        Detail
                                                                    </a>
                                                                  </td>";
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>

                </table>
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
            `<a href="../../logout.php" class="block rounded-lg px-4 py-2 text-sm md:hidden lg:hidden xl:hidden font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"><i class="fas fa-sign-out-alt mr-2"></i> Keluar</a>`;

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

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>