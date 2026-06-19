<?php
// admin/delete.php
session_start();
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

require_once '../includes/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($id > 0) {
    // First check if inquiry exists
    $check = $conn->prepare("SELECT id FROM inquiries WHERE id = ?");
    $check->bind_param("i", $id);
    $check->execute();
    $check->store_result();
    
    if($check->num_rows > 0) {
        $sql = "DELETE FROM inquiries WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if($stmt->execute()) {
            header('Location: dashboard.php?msg=Inquiry deleted successfully');
        } else {
            header('Location: dashboard.php?error=Failed to delete inquiry');
        }
    } else {
        header('Location: dashboard.php?error=Inquiry not found');
    }
} else {
    header('Location: dashboard.php?error=Invalid ID');
}
exit();
?>