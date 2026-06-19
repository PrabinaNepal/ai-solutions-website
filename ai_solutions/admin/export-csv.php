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

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="inquiries_' . date('Y-m-d') . '.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['ID', 'Full Name', 'Email', 'Phone', 'Company', 'Country', 'Job Title', 'Job Details', 'Status', 'Submitted Date']);

foreach($inquiries as $inquiry) {
    fputcsv($output, [
        $inquiry['id'],
        $inquiry['full_name'],
        $inquiry['email'],
        $inquiry['phone'],
        $inquiry['company'],
        $inquiry['country'],
        $inquiry['job_title'],
        $inquiry['job_details'],
        $inquiry['status'],
        $inquiry['submitted_at']
    ]);
}

fclose($output);
exit();
?>