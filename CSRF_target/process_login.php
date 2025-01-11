<?php
session_start();
require 'connect_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['message'] = "Username and password are required.";
        $_SESSION['message_type'] = "error";
        header("Location: index.php");
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];
            header("Location: account.php");
            exit();
        } else {
            $_SESSION['message'] = "Invalid username or password.";
            $_SESSION['message_type'] = "error";
            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error logging in: " . $e->getMessage();
        $_SESSION['message_type'] = "error";
        header("Location: index.php");
        exit();
    }
}
