<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my warkop</title>
    <link href="src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

</head>

<body class="bg-black">
    <!-- Header Start -->
    <header class="bg-transparent absolute top-0 left-0 w-full flex items-center z-10">
        <div class="container">
            <div class="flex items-center justify-between relative">
                <div class="px-4">
                    <a href="#home" class="font-bold text-3xl text-white block py-6">BengkelKopi</a>
                </div>
                <div class="flex items-center px-4">
                    <button id="hamburger" name="hamburger" type="button" class="block absolute right-4 lg:hidden">
                        <span class="hamburger-line transition duration-300 ease-in-out origin-top-left"></span>
                        <span class="hamburger-line transition duration-300 ease-in-out "></span>
                        <span class="hamburger-line transition duration-300 ease-in-out origin-top-left"></span>
                    </button>

                    <a href="#pesan" class="lg:hidden text-base rounded-full bg-primary text-white py-2 px-4 mx-12">
                        Pesan
                    </a>

                    <nav id="nav-menu"
                        class="hidden absolute py-5 bg-dark shadow-lg rounded-lg max-w-[250px] w-full right-4 top-full lg:block lg:static lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none">
                        <ul class="block lg:flex">
                            <li class="group">
                                <a href="#beranda"
                                    class="text-base text-white py-2 mx-8 flex group-hover:text-primary">Beranda</a>
                            </li>
                            <li class="group">
                                <a href="#menu"
                                    class="text-base text-white py-2 mx-8 flex group-hover:text-primary">Menu</a>
                            </li>
                            <li class="group">
                                <a href="lihat-pesanan.php"
                                    class="text-base text-white py-2 mx-8 flex group-hover:text-primary">Lihat
                                    Pesanan</a>
                            </li>
                            <li class="group">
                                <a href="#tentang"
                                    class="text-base text-white py-2 mx-8 flex group-hover:text-primary">Tentang</a>
                            </li>
                            <li class="group">
                                <a href="pesan.php"
                                    class="text-base hidden lg:block rounded-full bg-primary px-8 text-white py-2 mx-8 flex group-hover:bg-blue-400">Pesan</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- banner section-->
    <section id="beranda">
        <div style="background-image: url('dist/image/banner.jpeg');" class="bg-[url('dist/image/bgbanner.jpeg')] w-full h-screen bg-cover bg-center">
            <div class="bg-black/60 w-full h-full flex flex-col  items-center">
                <div class="mt-12 md:mt-20">
                    <h1><img src="dist/image/logoobk.png" alt="" width="100px"></h1>
                </div>
                <div class="w-64 md:w-1/2 space-y-3 flex flex-col justify-center">
                    <h1 class="text-white text-center text-2xl md:text-5xl mt-24">Selamat Datang!</h1>
                    <p class="text-white text-center md:text-2xl">
                        Kiranya di sudut kami dapat menjadi ruang untuk bertemu dan berbagi cerita tentang hari ini
                    </p>
                    <a href="#menu"
                        class="bg-black/60 text-white text-sm p-2 ring-1 ring-white rounded-lg mx-auto hover:bg-gray-700">Lihat
                        Menu Hari Ini</a>
                </div>
                <div class="grid grid-cols-2 space-x-2 text-gray-400 mt-24 text-center">
                    <span class="border-gray-400 border-b b-1">BUKA</span>
                    <p class="border-gray-400 border-b b-1">JAM</p>
                    <span>Senin-Jum'at</span>
                    <p>(16.00-23.00)</p>
                    <span>Sabtu-Minggu</span>
                    <p>(11.00-23.00)</p>
                </div>
            </div>
        </div>

    </section>
    <!-- end  of banner section-->

    <!--menu hari ini section-->
    <section id="menu">
        <div style="background-image: url('dist/image/bgmenu.jpeg');" class="bg-[url('image/bgmenu.jpeg')] h-screen bg-cover bg-center">
            <div class="bg-black/70 h-full flex justify-center">
                <div>
                    <h1 class="text-white text-center text-3xl font-bold mt-6 ">Menu Hari Ini</h1>
                    <p class="text-white text-right font-sans ">( <?php echo date('d/m/Y'); ?> )</p>
                    <?php
                    include 'backend/connection.php'; // Menghubungkan file koneksi
                    
                    // Query untuk mengambil menu dengan status 'on'
                    $sql = "SELECT id, nama FROM menus WHERE status = 'on'";
                    $result = $conn->query($sql);
                    
                    $menus = [];
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $menus[] = $row; // Simpan menu ke dalam array
                        }
                    }
                    
                    // Hitung jumlah menu
                    $totalMenus = count($menus);
                    $half = ceil($totalMenus / 2); // Jika ganjil, bagi dua dan bulatkan ke atas
                    
                    // Tampilkan tabel
                    echo '<table class="table-auto border">';
                    echo '<thead class="text-2xl text-white bg-black">';
                    echo '<tr><th class="p-2 border-b text-left">Ready</th><th class="py-3 px-2 border-b text-left text-black">Ket</th></tr>';
                    echo '</thead>';
                    echo '<tbody class="text-xl text-white text-left">';
                    
                    // Loop untuk kolom kiri dan kanan
                    for ($i = 0; $i < $half; $i++) {
                        echo '<tr class="bg-transparent">';
                    
                        // Cetak menu di kolom kiri
                        if (isset($menus[$i])) {
                            echo '<td class="p-2 border-b border-x text-left">' . $menus[$i]['nama'] . '</td>';
                        } else {
                            echo '<td class="p-2 border-b border-x text-left"></td>'; // Jika tidak ada, kosongkan
                        }
                    
                        // Cetak menu di kolom kanan jika ada
                        if (isset($menus[$i + $half])) {
                            echo '<td class="p-2 border-b text-left">' . $menus[$i + $half]['nama'] . '</td>';
                        } else {
                            echo '<td class="p-2 border-b text-left"></td>'; // Jika tidak ada, kosongkan
                        }
                    
                        echo '</tr>';
                    }
                    
                    echo '</tbody>';
                    echo '</table>';
                    
                    $conn->close();
                    ?>
                </div>
            </div>

        </div>
    </section>
    <!--end of menu hari ini section-->

    <!-- menu section-->
    <section id="Menu">
        <div class="bg-black py-12 container mx-auto">
            <h3 class="text-3xl font-bold text-white text-center pb-2 border-b border-white mb-5 mt-20">Menu Minuman
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 ps-4 pe-4">
                <!--menu 1-->
                <div class="flex space-x-5 py-8 px-8 ring-2 ring-white rounded-xl">
                    <img src="dist/image/air.jpg" width="100px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Air Mineral</h4>
                        <p class="text-white text-xl">Rp 5.000</p>
                    </div>
                </div>
                <!--menu 2-->
                <div class="flex space-x-5 py-8 px-8 ring-2 ring-white rounded-xl">
                    <img src="dist/image/hitam.jpg" width="100px" />
                    <div>
                        <h4 class="text-xl text-white font-bold">Kopi Hitam</h4>
                        <h4 class="text-xl text-white font-bold mb-2">( Rp 5.000 )</h4>
                        <p class="text-gray-300 text-xl">Kopi Hitam yang diseduh tanpa tambahan gula</p>
                    </div>
                </div>
                <!--menu 3-->
                <div class="flex space-x-5 py-8 px-8 ring-2 ring-white rounded-xl">
                    <img src="dist/image/klasik.jpg" width="100px" />
                    <div>
                        <h4 class="text-xl text-white font-bold">Kopi Klasik</h4>
                        <h4 class="text-xl text-white font-bold mb-2">( Rp 5.000 )</h4>
                        <p class="text-gray-300 text-xl">Kopi bubuk yang telah diracik khusus</p>
                    </div>
                </div>
                <!--menu 4-->
                <div class="flex space-x-5 py-8 px-8 ring-2 ring-white rounded-xl">
                    <img src="dist/image/tubruk.webp" width="100px" />
                    <div>
                        <h4 class="text-xl text-white font-bold ">Kopi Tubruk Susu</h4>
                        <h4 class="text-xl text-white font-bold mb-2">( Rp 5.000 )</h4>
                        <p class="text-gray-300 text-xl">Kopi hitam yang dicampur dengan Susu Kental Manis</p>
                    </div>
                </div>
                <!--menu 5-->
                <div class="flex space-x-5 py-8 px-8 ring-2 ring-white rounded-xl">
                    <img src="dist/image/vietnamdrip.jpeg" width="100px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold">Vietnam Drip</h4>
                        <h4 class="text-xl text-white font-bold mb-2">( Rp 10.000 )</h4>
                        <p class="text-gray-300 text-xl">Kopi hitam yang dicampur dengan Susu Kental Manis, diseduh
                            menggunakan teknik menyeduh kopi dengan cara disaring</p>
                    </div>
                </div>
                <!--menu 6-->
                <div class="space-x-5 py-2 px-2 ring-2 ring-black rounded-xl">
                    <img src="dist/image/meja.jpeg" width="800px" />
                    <div>
                        <h1 class="text-xl text-center font-serif text-gray-400 mt-1 pb-2 border-b border-white ">
                            Nikmati kopi panas hari ini di sudut BK</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of menu section-->

    <!-- menu es kopi section-->
    <section>
        <div class="bg-black py-12 container mx-auto">
            <h3 class="text-3xl font-bold text-white text-center pb-2 border-b border-white mb-5 mt-6">Menu Es Kopi
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 ps-4 pe-4">
                <!--menu 1-->
                <div class="flex space-x-5 py-8 px-8 ring-2 bg ring-white rounded-xl">
                    <img src="dist/image/esspanishlatte.jpeg" width="130px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Ice Kopi Susu BK</h4>
                        <p class="text-white text-2xl">( Rp 13.000 )</p>
                    </div>
                </div>
                <!--menu 2-->
                <div class="flex space-x-5 py-8 px-8 ring-2 ring-white rounded-xl">
                    <img src="dist/image/eskopimatcha.jpeg" width="130px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Ice Espresso X Matcha</h4>
                        <p class="text-white text-2xl">( Rp 15.000 )</p>
                    </div>
                </div>
                <!--menu 3-->
                <div class="flex space-x-5 py-8 px-8 ring-2 ring-white rounded-xl">
                    <img src="dist/image/eskopiaren.jpeg" width="130px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Ice Espresso X Aren</h4>
                        <p class="text-white text-2xl">( Rp 15.000 )</p>
                    </div>
                </div>
                <!--menu 4-->
                <div class="flex space-x-5 py-8 px-8 ring-2 ring-white rounded-xl">
                    <img src="dist/image/eskopibanana.jpeg" width="130px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Ice Espresso X Banana</h4>
                        <p class="text-white text-2xl">( Rp 15.000 )</p>
                    </div>
                </div>
                <!--menu 5-->
                <div class="flex space-x-5 py-8 px-8 ring-2 ring-white rounded-xl">
                    <img src="dist/image/eskopimatcha.jpeg" width="130px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Ice Espresso X Avocado</h4>
                        <p class="text-white text-2xl">( Rp 15.000 )</p>
                    </div>
                </div>
                <!--menu 6-->
                <div class="flex space-x-5 py-8 px-8 ring-2 ring-white rounded-xl">
                    <img src="dist/image/esspanishlatte.jpeg" width="130px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Ice Espresso X Vanilla</h4>
                        <p class="text-white text-2xl">( Rp 15.000 )</p>
                    </div>
                </div>
                <!--menu 7-->
                <div class="flex space-x-5 py-8 px-8 ring-2 ring-white rounded-xl">
                    <img src="dist/image/eskopipandan.jpeg" width="130px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Ice Espresso X Pandan</h4>
                        <p class="text-white text-2xl">( Rp 15.000 )</p>
                    </div>
                </div>
                <!--menu 8-->
                <div class="flex space-x-5 py-8 px-8 ring-2 ring-white rounded-xl">
                    <img src="dist/image/esamericano.jpeg" width="130px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Ice Americano</h4>
                        <p class="text-white text-2xl">( Rp 15.000 )</p>
                    </div>
                </div>
                <!--menu 9-->
                <div class="flex space-x-5 py-8 px-8 ring-2 ring-white rounded-xl">
                    <img src="dist/image/esspanishlatte.jpeg" width="130px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Ice Spanish Latte BK</h4>
                        <p class="text-white text-2xl">( Rp 15.000 )</p>
                    </div>
                </div>
                <!--menu 10-->
                <div class="space-x-5 py-2 px-2 ring-2 ring-black rounded-xl">
                    <img src="dist/image/WhatsApp Image 2025-05-15 at 11.50.21.jpeg" width="800px" />
                    <div>
                        <h4 class="text-xl text-gray-400 text-left font-serif mt-1 pb-2 border-b border-white ">- Aku,
                            Kamu, dan sudut BK</h4>

                    </div>
                </div>
    </section>
    <!-- end of menu es kopi section-->

    <!--menu bukan kopi section -->
    <section>
        <div class="bg-black py-12 container mx-auto">
            <h3 class="text-3xl font-bold text-white text-center pb-2 border-b border-white mb-5 mt-6">Menu Non Kopi
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 ps-4 pe-4">
                <!--menu 1-->
                <div class="flex space-x-5 py-8 px-8 ring-2 bg ring-white rounded-xl">
                    <img src="dist/image/Original Avocado Latte.jpeg" width="130px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Original Avocado Latte</h4>
                        <p class="text-white text-2xl">13k</p>
                    </div>
                </div>
                <!--menu 2-->
                <div class="flex space-x-5 py-8 px-8 ring-2 bg ring-white rounded-xl">
                    <img src="dist/image/pandan.jpeg" width="130px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Original Pandan Latte</h4>
                        <p class="text-white text-2xl">( Rp 13.000 )</p>
                    </div>
                </div>
                <!--menu 1-->
                <div class="flex space-x-5 py-8 px-8 ring-2 bg ring-white rounded-xl">
                    <img src="dist/image/Ice x Banana Milk.jpeg" width="130px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Ice X Banana Milk</h4>
                        <p class="text-white text-2xl">13k</p>
                    </div>
                </div>
                <!--menu 1-->
                <div class="flex space-x-5 py-8 px-8 ring-2 bg ring-white rounded-xl">
                    <img src="dist/image/vanilla.jpeg" width="130px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Ice X Vanilla Milk</h4>
                        <p class="text-white text-2xl">13k</p>
                    </div>
                </div>
                <!--menu 1-->
                <div class="flex space-x-5 py-8 px-8 ring-2 bg ring-white rounded-xl">
                    <img src="dist/image/Ice x Matcha.jpeg" width="130px" />
                    <div>
                        <h4 class="text-2xl text-white font-bold mb-2">Ice X Matcha</h4>
                        <p class="text-white text-2xl">13k</p>
                    </div>
                </div>
                <!--menu 10-->
                <div class="space-x-5 py-2 px-2 ring-2 ring-black rounded-xl">
                    <img src="dist/image/WhatsApp Image 2025-05-15 at 11.50.21.jpeg" width="800px" />
                    <div>
                        <h4 class="text-xl text-gray-400 text-left font-serif mt-1 pb-1 border-b border-white ">- Aku,
                            Kamu, dan sudut BK</h4>

                    </div>
                </div>
    </section>
    <!-- end of menu bukan kopi section-->

    <!-- tentang BK-->
    <section id="tentang" class="bg-black w-10/12 md:container mx-auto py-20">
        <div class="space-x-10 px-4  grid grid-cols-1 md:grid-cols-2">
            <img src="dist/image/bgbanner.jpeg" width="500px" class="aspect-square">
            <div class="text-white">
                <h3 class="text-3xl font-bold mb-5 mt-6">Tentang BengkelKopi</h3>
                <p class="mb-4"> BengkelKopi adalah sebuah warkop yang berdiri sejak 17 Maret 2024, berlokasi di Desa
                    Lombong tepatnya didepan Masjid Nurul Taufik Deking. Warkop ini mengusung tema Industrial Modern dan
                    dipadukan dengan interior bengkel sehingga menciptakan atmosfer yang berbeda dan menarik. Sudut -
                    sudut yang estetika dalam warkop ini dirancang untuk menciptakan area berkumpul yang nyaman sambil
                    menikmati kopi bersama teman, kerabat, atau tambatan hatimu.</p>
                <p class="text-slate-300"> "Bengkel dalam arti luas itu adalah workshop atau kegiatan yang didalamnya
                    dilakukan sebuah perbaikan. Jadi konsep dari warkop ini sebenarnya adalah kita ingin menyediakan
                    ruang diskusi atau 'perbaikan' perasaan bagi orang -orang yang sedang mencari ketenangan"</p>
                <p class="pb-2 border-b border-gray-300 mb-4 mt-1 text-right text-slate-300"> - Owner BengkelKopi</p>
                <ul class="flex justify-center space-x-6">
                    <li><a href=''><i class="fa-brands fa-instagram"></i> bengkelkopi.17</a>
                    </li>
                    <li><a href=''><i class="fa-brands fa-facebook"></i> BK.17</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end of tentang BK-->

    <!-- footer-->
    <footer class="py-2 text-center font-bold text-white">&copy; 2024 BengkelKopi</footer>
    <!-- end of footer-->

    <script src="dist/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
