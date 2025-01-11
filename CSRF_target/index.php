<?php
session_start();

// Récupérer les messages de session, puis les supprimer pour qu'ils ne soient affichés qu'une seule fois
$message = $_SESSION['message'] ?? null;
$message_type = $_SESSION['message_type'] ?? null;
unset($_SESSION['message'], $_SESSION['message_type']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account / Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h1 class="text-2xl font-bold mb-6 text-center">Create Account / Login</h1>

        <!-- Affichage des messages -->
        <?php if ($message): ?>
            <div class="p-4 mb-4 text-sm <?= $message_type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?> rounded-lg">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- Create Account Form -->
        <h2 class="text-lg font-semibold mb-2">Create an Account</h2>
        <form action="process_create_user.php" method="POST" class="mb-6">
            <div class="mb-4">
                <label for="create-username" class="block text-gray-700 font-medium">Username</label>
                <input type="text" name="username" id="create-username" required class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="create-password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" id="create-password" required class="w-full p-2 border border-gray-300 rounded">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                Create Account
            </button>
        </form>

        <!-- Login Form -->
        <h2 class="text-lg font-semibold mb-2">Login</h2>
        <form action="process_login.php" method="POST">
            <div class="mb-4">
                <label for="login-username" class="block text-gray-700 font-medium">Username</label>
                <input type="text" name="username" id="login-username" required class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="login-password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" id="login-password" required class="w-full p-2 border border-gray-300 rounded">
            </div>
            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">
                Login
            </button>
        </form>
    </div>
</body>
</html>
