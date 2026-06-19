<?php
// admin/update-status.php
session_start();
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

require_once '../includes/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Allowed status values
$allowed_status = ['New', 'Read', 'Archived'];

if($id > 0 && in_array($status, $allowed_status)) {
    $sql = "UPDATE inquiries SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);
    
    if($stmt->execute()) {
        // Success - redirect back
        header('Location: dashboard.php?msg=Status updated successfully');
    } else {
        header('Location: dashboard.php?error=Failed to update status');
    }
} else {
    header('Location: dashboard.php?error=Invalid request');
}
exit();
?>