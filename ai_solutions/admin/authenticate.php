<?php
session_start();
require_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['username'];
    $password = md5($_POST['password']);
    
    $sql = "SELECT * FROM admin_users WHERE (username = ? OR email = ?) AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $login, $login, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['admin_fullname'] = $user['full_name'] ?? $user['username'];  // ADD THIS LINE
        $_SESSION['admin_role'] = $user['role'] ?? 'staff';
        header('Location: dashboard.php');
    } else {
        header('Location: login.php?error=1');
    }
    exit();
} else {
    header('Location: login.php');
    exit();
}
?>