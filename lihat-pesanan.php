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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <style>
        #myTable_filter {
            margin-bottom: 12px;
        }
    </style>
</head>

<body class="bg-black">

    <div class="container mx-auto p-4 mt-4">
        <h1 class="mb-3 text-white">Daftar Pesanan Hari ini.</h1>
        <a href="index.php" class="inline-block rounded bg-red-600 px-4 mb-5 py-2 text-xs font-medium text-white hover:bg-indigo-700">Halaman Utama</a>

        <div class="bg-white rounded-lg shadow-lg w-full mx-auto p-4">
            <div class="overflow-x-auto">
                <table id="myTable" class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Meja</th>
                            <th class="px-4 py-2">Jenis Pesanan</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border px-4 py-2">1</td>
                            <td class="border px-4 py-2">Arman</td>
                            <td class="border px-4 py-2">Proses</td>
                            <td class="border px-4 py-2">Dalam</td>
                            <td class="border px-4 py-2">Take Away</td>
                            <td class="border px-4 py-2">
                                <a href="#" class="inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">Detail</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- footer-->
    <footer class="py-2 text-center font-bold text-white">&copy; 2024 BengkelKopi</footer>
    <!-- end of footer-->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/script.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>