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
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);

        if ($stmt->fetch()) {
            $_SESSION['message'] = "Username already exists. Please choose another.";
            $_SESSION['message_type'] = "error";
            header("Location: index.php");
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute([':username' => $username, ':password' => $hashed_password]);

        $_SESSION['message'] = "Account created successfully! You can now log in.";
        $_SESSION['message_type'] = "success";
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error creating account: " . $e->getMessage();
        $_SESSION['message_type'] = "error";
        header("Location: index.php");
        exit();
    }
}
