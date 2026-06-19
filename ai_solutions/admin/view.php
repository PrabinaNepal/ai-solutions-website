<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';

require_once '../includes/config.php';

$id = $_GET['id'] ?? 0;
$reply_success = '';
$reply_error = '';

// Get inquiry details
$sql = "SELECT * FROM inquiries WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$inquiry = $result->fetch_assoc();

if(!$inquiry) {
    header('Location: dashboard.php');
    exit();
}

// Handle reply submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_reply'])) {
    $reply_subject = trim($_POST['reply_subject']);
    $reply_message = trim($_POST['reply_message']);
    $admin_name = $_SESSION['admin_username'];
    $customer_email = $inquiry['email'];
    $customer_name = $inquiry['full_name'];
    
    if(empty($reply_subject) || empty($reply_message)) {
        $reply_error = 'Please fill in both subject and message.';
    } else {
        // Save reply to database
        $insert = "INSERT INTO email_replies (inquiry_id, reply_subject, reply_message, replied_by) VALUES (?, ?, ?, ?)";
        $stmt2 = $conn->prepare($insert);
        $stmt2->bind_param("isss", $id, $reply_subject, $reply_message, $admin_name);
        
        if($stmt2->execute()) {
            // Prepare email content
            $inquiry_number = $inquiry['inquiry_number'] ?? 'INQ-' . date('Y-m-', strtotime($inquiry['submitted_at'])) . str_pad($inquiry['id'], 4, '0', STR_PAD_LEFT);
            
            $email_body = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                    .header { background: linear-gradient(135deg, #1a73e8, #1557b0); color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
                    .content { padding: 20px; background: #f8f9fa; }
                    .footer { text-align: center; padding: 15px; font-size: 12px; color: #666; background: #f1f1f1; border-radius: 0 0 10px 10px; }
                    .reply-box { background: white; padding: 15px; border-radius: 8px; margin: 15px 0; border-left: 3px solid #1a73e8; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>🤖 AI-Solutions</h2>
                        <p>AI-Powered Solutions for a Better Workplace</p>
                    </div>
                    <div class='content'>
                        <h3>Dear " . htmlspecialchars($customer_name) . ",</h3>
                        <p>Thank you for contacting AI-Solutions. Here is our response to your inquiry:</p>
                        <div class='reply-box'>
                            <p><strong>Subject:</strong> " . htmlspecialchars($reply_subject) . "</p>
                            <p><strong>Message:</strong></p>
                            <p>" . nl2br(htmlspecialchars($reply_message)) . "</p>
                        </div>
                        <p><strong>Reference Number:</strong> " . $inquiry_number . "</p>
                        <p style='margin-top: 20px;'>Best regards,<br><strong>AI-Solutions Team</strong></p>
                    </div>
                    <div class='footer'>
                        <p>&copy; 2026 AI-Solutions. All rights reserved.</p>
                        <p>Sunderland, United Kingdom | support@ai-solution.com</p>
                    </div>
                </div>
            </body>
            </html>
            ";
            
            // Send email using PHPMailer with YOUR credentials
            $mail = new PHPMailer(true);
            
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'prabinanepal0816@gmail.com';  // YOUR GMAIL
                $mail->Password   = 'pzam cuxc wrku bgng';  // YOUR APP PASSWORD
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
                
                // Recipients
                $mail->setFrom('prabinanepal0816@gmail.com', 'AI-Solutions');
                $mail->addAddress($customer_email, $customer_name);
                $mail->addReplyTo('support@ai-solution.com', 'AI-Solutions Support');
                
                // Content
                $mail->isHTML(true);
                $mail->Subject = $reply_subject;
                $mail->Body    = $email_body;
                $mail->AltBody = strip_tags($email_body);
                
                $mail->send();
                
                // Update inquiry status
                $update = "UPDATE inquiries SET status = 'Read', reply_status = 'Replied' WHERE id = ?";
                $stmt3 = $conn->prepare($update);
                $stmt3->bind_param("i", $id);
                $stmt3->execute();
                
                $reply_success = '✅ Reply sent successfully to ' . htmlspecialchars($customer_email) . '!';
                
                // Refresh inquiry data
                $stmt->execute();
                $inquiry = $stmt->get_result()->fetch_assoc();
                
            } catch (Exception $e) {
                $reply_error = '❌ Email could not be sent. Error: ' . $mail->ErrorInfo;
            }
        } else {
            $reply_error = 'Failed to save reply. Please try again.';
        }
    }
}

// Get reply history
$replies_sql = "SELECT * FROM email_replies WHERE inquiry_id = ? ORDER BY replied_at DESC";
$replies_stmt = $conn->prepare($replies_sql);
$replies_stmt->bind_param("i", $id);
$replies_stmt->execute();
$replies_result = $replies_stmt->get_result();
$replies = $replies_result->fetch_all(MYSQLI_ASSOC);

$inquiry_number = $inquiry['inquiry_number'] ?? 'INQ-' . date('Y-m-', strtotime($inquiry['submitted_at'])) . str_pad($inquiry['id'], 4, '0', STR_PAD_LEFT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Details | AI-Solutions Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f0f2f5; }
        .admin-container { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #1a1a2e; color: white; position: fixed; height: 100vh; }
        .sidebar-header { padding: 25px 20px; border-bottom: 1px solid #333; }
        .sidebar-nav { padding: 20px 0; }
        .sidebar-nav a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #aaa; text-decoration: none; transition: 0.3s; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background: #1a73e8; color: white; }
        .main-content { flex: 1; margin-left: 260px; padding: 20px; }
        .top-bar { background: white; padding: 15px 25px; border-radius: 12px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .btn-back { background: #6c757d; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; }
        .alert { padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .card { background: white; border-radius: 16px; margin-bottom: 24px; overflow: hidden; }
        .card-header { padding: 20px 25px; border-bottom: 1px solid #eef2f6; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px; }
        .card-header h3 { display: flex; align-items: center; gap: 10px; }
        .card-body { padding: 25px; }
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .info-item { background: #f8f9fa; padding: 15px; border-radius: 12px; }
        .info-item label { font-size: 11px; font-weight: 600; text-transform: uppercase; color: #888; display: block; margin-bottom: 6px; }
        .info-item p { font-size: 14px; color: #1e1e2e; font-weight: 500; }
        .info-item.full-width { grid-column: span 2; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-new { background: #e3f2fd; color: #1a73e8; }
        .badge-read { background: #e8f5e9; color: #28a745; }
        .action-buttons { display: flex; gap: 10px; flex-wrap: wrap; }
        .btn-mark-read, .btn-delete { padding: 6px 14px; border-radius: 6px; font-size: 12px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
        .btn-mark-read { background: #28a745; color: white; }
        .btn-delete { background: #dc3545; color: white; }
        .reply-section { background: white; border-radius: 16px; margin-bottom: 24px; overflow: hidden; }
        .reply-header { background: #f8f9fa; padding: 15px 25px; border-bottom: 1px solid #eef2f6; display: flex; align-items: center; gap: 12px; }
        .reply-form { padding: 25px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; }
        .form-group input, .form-group textarea { width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 10px; font-family: inherit; }
        .btn-send { background: linear-gradient(135deg, #1a73e8, #1557b0); color: white; border: none; padding: 12px 24px; border-radius: 10px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 10px; }
        .btn-send:hover { transform: translateY(-2px); }
        .reply-item { background: #f8f9fa; border-radius: 12px; padding: 20px; margin-bottom: 15px; border-left: 3px solid #1a73e8; }
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; }
            .info-grid { grid-template-columns: 1fr; }
            .info-item.full-width { grid-column: span 1; }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <div class="sidebar-header"><h3>🤖 AI-Solutions</h3></div>
            <div class="sidebar-nav">
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="analytics.php"><i class="fas fa-chart-line"></i> Analytics</a>
                <a href="inquiries.php"><i class="fas fa-envelope"></i> Inquiries</a>
                <a href="register.php"><i class="fas fa-user-plus"></i> Add Admin</a>
                <a href="export-csv.php"><i class="fas fa-download"></i> Export CSV</a>
                <a href="export-excel.php"><i class="fas fa-file-excel"></i> Export Excel</a>
                <a href="/ai_solutions/index.php"><i class="fas fa-globe"></i> View Website</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
        
        <div class="main-content">
            <div class="top-bar">
                <h2>📧 Inquiry Details</h2>
                <a href="inquiries.php" class="btn-back"><i class="fas fa-arrow-left"></i> Back to Inquiries</a>
            </div>
            
            <?php if($reply_success): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo $reply_success; ?></div>
            <?php endif; ?>
            
            <?php if($reply_error): ?>
                <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?php echo $reply_error; ?></div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-info-circle"></i> Inquiry Details</h3>
                    <div># <?php echo $inquiry_number; ?></div>
                    <div class="action-buttons">
                        <?php if($inquiry['status'] != 'Read'): ?>
                            <a href="update-status.php?id=<?php echo $inquiry['id']; ?>&status=Read" class="btn-mark-read"><i class="fas fa-check"></i> Mark Read</a>
                        <?php endif; ?>
                        <a href="delete.php?id=<?php echo $inquiry['id']; ?>" class="btn-delete" onclick="return confirm('Delete this inquiry?')"><i class="fas fa-trash"></i> Delete</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item"><label>Full Name</label><p><?php echo htmlspecialchars($inquiry['full_name']); ?></p></div>
                        <div class="info-item"><label>Email</label><p><?php echo htmlspecialchars($inquiry['email']); ?></p></div>
                        <div class="info-item"><label>Phone</label><p><?php echo htmlspecialchars($inquiry['phone']); ?></p></div>
                        <div class="info-item"><label>Company</label><p><?php echo htmlspecialchars($inquiry['company_name']); ?></p></div>
                        <div class="info-item"><label>Country</label><p><?php echo htmlspecialchars($inquiry['country']); ?></p></div>
                        <div class="info-item"><label>Job Title</label><p><?php echo htmlspecialchars($inquiry['job_title']); ?></p></div>
                        <div class="info-item full-width"><label>Message</label><p><?php echo nl2br(htmlspecialchars($inquiry['job_details'])); ?></p></div>
                        <div class="info-item"><label>Status</label><p><span class="badge badge-<?php echo strtolower($inquiry['status']); ?>"><?php echo $inquiry['status']; ?></span></p></div>
                        <div class="info-item"><label>Submitted</label><p><?php echo date('F d, Y \a\t h:i A', strtotime($inquiry['submitted_at'])); ?></p></div>
                    </div>
                </div>
            </div>
            
            <div class="reply-section">
                <div class="reply-header">
                    <i class="fas fa-reply-all"></i>
                    <h3>Reply to Customer</h3>
                </div>
                <form method="POST" class="reply-form">
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="reply_subject" required value="Re: <?php echo $inquiry_number; ?> - Your inquiry from AI-Solutions">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="reply_message" rows="8" required>Dear <?php echo htmlspecialchars($inquiry['full_name']); ?>,

Thank you for contacting AI-Solutions.

[Write your response here]

Reference: <?php echo $inquiry_number; ?>

Best regards,
AI-Solutions Team</textarea>
                    </div>
                    <button type="submit" name="send_reply" class="btn-send"><i class="fas fa-paper-plane"></i> Send Reply Email</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>