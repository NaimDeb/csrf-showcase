<?php
session_start();
require 'connect_db.php';

// Ensure the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: index.php");
    exit();
}



// ! Validation du token CSRF

if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Token CSRF invalide. La requête a été bloquée.");
}




$user_id = $_SESSION['user_id'];






try {
    // Delete the user from the database
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute([':id' => $user_id]);

    // Log the user out and redirect
    session_destroy();
    echo "Account deleted successfully. <a href='index.php'>Go to Create Account / Login</a>";
} catch (PDOException $e) {
    die("Error deleting account: " . $e->getMessage());
}
