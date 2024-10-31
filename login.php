<?php
session_start();
include 'backend/connection.php';

// Inisialisasi variabel error untuk pesan kesalahan
$error = "";

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['name'];
    $password = $_POST['password'];

    // Cek apakah username dan password tidak kosong
    if (!empty($username) && !empty($password)) {
        // Query untuk mengambil user berdasarkan username
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Cek apakah username ditemukan di database
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Set sesi pengguna dan arahkan ke dashboard
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: admin/dashboard.php");
                exit();
            } else {
                $error = "Username atau password salah.";
            }
        } else {
            $error = "Username atau password salah.";
        }

        $stmt->close();
    } else {
        $error = "Username dan password harus diisi.";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="src/output.css" rel="stylesheet">
</head>

<body class="bg-black">
    <div class="mx-auto h-screen flex justify-center items-center px-4">
        <div class="bg-white shadow-md border border-red-100 rounded-lg max-w-sm px-5 py-5">
            <h1 class="text-3xl font-bold mb-4 text-center">BengkelKopi</h1>

            <?php if (!empty($error)) : ?>
                <p class="text-red-600 mb-4"><?= htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                    <input type="text" id="name" name="name" placeholder="Enter your username"
                        class="shadow appearance-none border rounded w-full py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password"
                        class="shadow appearance-none border rounded w-full py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                </div>
                <button type="submit"
                    class="bg-blue-700 text-white px-4 py-2 mt-2 rounded-lg hover:bg-blue-600 w-full">Login</button>
            </form>
        </div>
    </div>
</body>

</html>