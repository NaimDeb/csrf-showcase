<?php
session_start();

// Determine the background color classes based on login status
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    // If not logged in, show black background with slate-colored div
    $body_class = 'bg-black';
    $div_class = 'bg-slate-700';
    $text_class = 'text-white';
    $error = "Ce compte n'existe pas.";
} else {
    // If logged in, show default background and div styling
    $body_class = 'bg-gray-100';
    $div_class = 'bg-white';
    $text_class = 'text-black';
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
}

// ! Ajout du token CSRF dans la session de l'utilisateur
if (!isset($_SESSION['csrf_token'])) {
    // retourne une chaine de caractères au hasard et la stocke dans la session
    $_SESSION['csrf_token'] = random_bytes(32);
}
$csrf_token = $_SESSION['csrf_token'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="<?= $body_class ?> flex flex-col h-screen">

    <!-- Header -->
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
        <header class="bg-blue-500 text-white p-4 text-center text-lg font-bold">
            <h1>My Twitter-like App</h1>
        </header>
    <?php endif; ?>

    <!-- Main Content -->
    <?php if (isset($error)): ?>
        <div class="flex flex-col items-center justify-center h-screen <?= $div_class ?>">
            <p class="text-3xl text-red-500 font-semibold"><?= htmlspecialchars($error) ?></p>
            <a href="./index.php" class="text-xl text-white font-semibold"> Retourner à la connexion </a>
        </div>
    <?php else: ?>
        <div class="flex flex-grow">
            <!-- Profile Section (Left) -->
            <div class="w-1/4 bg-gray-800 text-white p-6">
                <div class="text-center mb-6">
                    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Profile Picture" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <p class="text-xl font-semibold"><?= htmlspecialchars($username) ?></p>
                    <p class="text-sm text-gray-400">@<?= htmlspecialchars($username) ?></p>
                </div>
                <div class="flex flex-col items-center space-y-4">
                    <button class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Follow</button>
                    <button class="w-full bg-gray-600 text-white py-2 rounded hover:bg-gray-700">Message</button>
                    <button class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">Logout</button>
<?php 
// ! Formulaire pour supprimer le compte, avec un input caché qui donne le token csrf
?>
                    <form action="process_delete_account.php" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                        <button type="submit" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">Delete My Account</button>
                    </form>
                </div>
            </div>

            <!-- Main Content (Tweets) -->
            <div class="w-2/3 bg-gray-100 p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-900">Latest Tweets</h2>
                </div>

                <!-- Tweet 1 -->
                <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                    <div class="flex items-center space-x-2 mb-2">
                        <img src="https://www.w3schools.com/howto/img_avatar.png" alt="User1" class="w-8 h-8 rounded-full">
                        <div class="text-sm">
                            <p class="font-semibold text-gray-900">User1</p>
                            <p class="text-gray-500">@user1 &bull; 2h ago</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-2">This is a fake tweet, just for fun! #fun #exciting</p>
                    <div class="flex space-x-6 text-gray-500 text-sm">
                        <div class="flex items-center space-x-1">
                            <span>5</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 01-1-7.75V7a4 4 0 011 7.75V15zM15 12a4 4 0 111-7.75V7a4 4 0 11-1 7.75V12z" />
                            </svg>
                            <span>1</span>
                        </div>
                    </div>
                </div>

                <!-- Tweet 2 -->
                <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                    <div class="flex items-center space-x-2 mb-2">
                        <img src="https://www.w3schools.com/howto/img_avatar.png" alt="User2" class="w-8 h-8 rounded-full">
                        <div class="text-sm">
                            <p class="font-semibold text-gray-900">User2</p>
                            <p class="text-gray-500">@user2 &bull; 5h ago</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-2">Regardez sur super site ! <a href="http://localhost/CSRF_attacker/">Cliquez ici</a></p>
                    <div class="flex space-x-6 text-gray-500 text-sm">
                        <div class="flex items-center space-x-1">
                            <span>3</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 01-1-7.75V7a4 4 0 011 7.75V15zM15 12a4 4 0 111-7.75V7a4 4 0 11-1 7.75V12z" />
                            </svg>
                            <span>2</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Footer -->
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
        <footer class="bg-blue-500 text-white p-4 text-center">
            <p>© 2025 My Twitter-like App</p>
        </footer>
    <?php endif; ?>

</body>
</html>