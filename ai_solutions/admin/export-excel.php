<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once '../includes/config.php';

$sql = "SELECT * FROM inquiries ORDER BY submitted_at DESC";
$result = $conn->query($sql);
$inquiries = $result->fetch_all(MYSQLI_ASSOC);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="inquiries_' . date('Y-m-d') . '.xls"');

echo '<table border="1">';
echo '<tr><th>ID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>Company</th><th>Country</th><th>Job Title</th><th>Job Details</th><th>Status</th><th>Date</th></tr>';

foreach($inquiries as $inquiry) {
    echo '<tr>';
    echo '<td>' . $inquiry['id'] . '</td>';
    echo '<td>' . htmlspecialchars($inquiry['full_name']) . '</td>';
    echo '<td>' . htmlspecialchars($inquiry['email']) . '</td>';
    echo '<td>' . htmlspecialchars($inquiry['phone']) . '</td>';
    echo '<td>' . htmlspecialchars($inquiry['company_name']) . '</td>';
    echo '<td>' . htmlspecialchars($inquiry['country']) . '</td>';
    echo '<td>' . htmlspecialchars($inquiry['job_title']) . '</td>';
    echo '<td>' . htmlspecialchars($inquiry['job_details']) . '</td>';
    echo '<td>' . $inquiry['status'] . '</td>';
    echo '<td>' . $inquiry['submitted_at'] . '</td>';
    echo '</tr>';
}

echo '</table>';
exit();
?>