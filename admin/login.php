<?php
session_start();
include '../includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login - Mr Vibe Coder</title>
    <link rel="icon" href="https://img.icons8.com/ios-filled/50/ffffff/lock-2.png" type="image/png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="bg-gray-950 text-white flex items-center justify-center min-h-screen">

    <div class="bg-gray-900 p-8 rounded-xl shadow-md w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6 text-center text-purple-400"><i class="fas fa-lock mr-2"></i>Admin Login</h2>

        <?php if ($error): ?>
            <div class="bg-red-600 text-white px-4 py-2 mb-4 rounded"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-4">
                <label class="block text-sm mb-1">Username</label>
                <input type="text" autocomplete="off" name="username" required class="w-full px-4 py-2 bg-gray-800 rounded focus:outline-none focus:ring focus:ring-purple-500">
            </div>
            <div class="mb-6">
                <label class="block text-sm mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 bg-gray-800 rounded focus:outline-none focus:ring focus:ring-purple-500">
            </div>
            <button type="submit" class="w-full bg-purple-500 hover:bg-purple-600 text-black font-semibold py-2 px-4 rounded transition">
                Login
            </button>
        </form>
        <div class="mt-6 text-center">
            <a href="../index.php" class="inline-flex items-center gap-2 text-sm text-white hover:text-purple-400 transition">
                <i class="fas fa-globe"></i> Go to Website
            </a>
        </div>

    </div>

</body>

</html>