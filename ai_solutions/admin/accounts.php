<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Load PHPMailer for sending emails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';

require_once '../includes/config.php';

$success = $error = '';

// Handle Add User
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'] ?? 'staff';
    
    if(empty($username) || empty($email) || empty($password)) {
        $error = 'Please fill in all fields.';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif(strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
        // Check if user exists
        $check = $conn->prepare("SELECT id FROM admin_users WHERE username = ? OR email = ?");
        $check->bind_param("ss", $username, $email);
        $check->execute();
        $check->store_result();
        
        if($check->num_rows > 0) {
            $error = 'Username or email already exists.';
        } else {
            $hashed_password = md5($password);
            $full_name = $username;
            
            $sql = "INSERT INTO admin_users (full_name, username, email, password, role) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $full_name, $username, $email, $hashed_password, $role);
            
            if($stmt->execute()) {
                // ========== SEND EMAIL TO NEW ADMIN ==========
                $login_url = "http://localhost/ai_solutions/admin/login.php";
                $admin_name = $_SESSION['admin_username'];
                
                $email_subject = "Your Admin Account for AI-Solutions";
                
                $email_body = "
                <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; line-height: 1.6; }
                        .container { max-width: 500px; margin: 0 auto; padding: 20px; }
                        .header { background: linear-gradient(135deg, #1a73e8, #1557b0); color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
                        .content { padding: 20px; background: #f8f9fa; }
                        .credentials { background: white; padding: 15px; border-radius: 8px; margin: 15px 0; border-left: 3px solid #1a73e8; }
                        .footer { text-align: center; padding: 15px; font-size: 12px; color: #666; background: #f1f1f1; border-radius: 0 0 10px 10px; }
                        .btn { background: #1a73e8; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <h2>🤖 AI-Solutions</h2>
                            <p>Admin Panel Access</p>
                        </div>
                        <div class='content'>
                            <p>Dear <strong>" . htmlspecialchars($username) . "</strong>,</p>
                            <p>An administrator account has been created for you on the AI-Solutions Admin Panel.</p>
                            <div class='credentials'>
                                <p><strong>Your Login Credentials:</strong></p>
                                <p><strong>Username:</strong> " . htmlspecialchars($username) . "</p>
                                <p><strong>Password:</strong> <code style='background:#f0f0f0;padding:2px 5px;'>" . htmlspecialchars($password) . "</code></p>
                                <p><strong>Role:</strong> " . ucfirst($role) . "</p>
                            </div>
                            <p><strong>Login URL:</strong> <a href='$login_url'>$login_url</a></p>
                            <p style='margin-top: 20px;'>For security reasons, please change your password after your first login.</p>
                            <p>Best regards,<br><strong>AI-Solutions Admin Team</strong></p>
                        </div>
                        <div class='footer'>
                            <p>&copy; 2026 AI-Solutions. All rights reserved.</p>
                        </div>
                    </div>
                </body>
                </html>
                ";
                
                // Send email using PHPMailer
                $mail = new PHPMailer(true);
                
                try {
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'prabinanepal0816@gmail.com';
                    $mail->Password   = 'pzam cuxc wrku bgng';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;
                    
                    $mail->setFrom('prabinanepal0816@gmail.com', 'AI-Solutions Admin');
                    $mail->addAddress($email, $username);
                    
                    $mail->isHTML(true);
                    $mail->Subject = $email_subject;
                    $mail->Body    = $email_body;
                    $mail->AltBody = strip_tags($email_body);
                    
                    $mail->send();
                    $email_sent = true;
                } catch (Exception $e) {
                    $email_sent = false;
                }
                
                if($email_sent) {
                    $success = "✅ User '$username' added successfully! Login credentials have been sent to <strong>$email</strong>";
                } else {
                    $success = "✅ User '$username' added successfully! (Email could not be sent. Please share credentials manually.)<br>
                               📧 Email: $email<br>
                               🔑 Password: <strong>$password</strong>";
                }
                
                $_POST = array();
            } else {
                $error = 'Something went wrong.';
            }
        }
    }
}

// Handle Delete User
if(isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if($id != $_SESSION['admin_id']) {
        $conn->query("DELETE FROM admin_users WHERE id = $id");
        $success = "User deleted successfully!";
    } else {
        $error = "You cannot delete your own account!";
    }
}

// Get all users
$users = $conn->query("SELECT id, username, email, role, created_at, last_login FROM admin_users ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts Management | AI-Solutions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; }
        .admin-container { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #1a1a2e; color: white; position: fixed; height: 100vh; }
        .sidebar-header { padding: 25px 20px; border-bottom: 1px solid #333; }
        .sidebar-nav { padding: 20px 0; }
        .sidebar-nav a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #aaa; text-decoration: none; transition: 0.3s; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background: #1a73e8; color: white; }
        .main-content { flex: 1; margin-left: 260px; padding: 20px; }
        .top-bar { background: white; padding: 15px 25px; border-radius: 12px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .card { background: white; border-radius: 16px; padding: 25px; margin-bottom: 25px; }
        .card h3 { margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .form-row { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 15px; }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-weight: 600; margin-bottom: 8px; color: #333; }
        .form-group input, .form-group select { padding: 12px 15px; border: 1px solid #ddd; border-radius: 10px; font-size: 14px; }
        .btn-primary { background: linear-gradient(135deg, #1a73e8, #1557b0); color: white; border: none; padding: 12px 24px; border-radius: 10px; font-weight: 600; cursor: pointer; }
        .btn-primary:hover { transform: translateY(-2px); }
        .btn-back { background: #6c757d; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; }
        .btn-edit { background: #ffc107; color: #333; padding: 5px 12px; border-radius: 5px; text-decoration: none; font-size: 12px; display: inline-block; }
        .btn-delete { background: #dc3545; color: white; padding: 5px 12px; border-radius: 5px; text-decoration: none; font-size: 12px; display: inline-block; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-admin { background: #e3f2fd; color: #1a73e8; }
        .badge-staff { background: #e8f5e9; color: #28a745; }
        .alert { padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; }
            .form-row { grid-template-columns: 1fr; }
            table { display: block; overflow-x: auto; }
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
                <a href="accounts.php" class="active"><i class="fas fa-users"></i> Accounts</a>
                <a href="export-csv.php"><i class="fas fa-download"></i> Export CSV</a>
                <a href="export-excel.php"><i class="fas fa-file-excel"></i> Export Excel</a>
                <a href="/ai_solutions/index.php"><i class="fas fa-globe"></i> View Website</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
        
        <div class="main-content">
            <div class="top-bar">
                <h2><i class="fas fa-users"></i> Accounts Management</h2>
                <a href="dashboard.php" class="btn-back"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
            </div>
            
            <?php if($success): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if($error): ?>
                <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></div>
            <?php endif; ?>
            
            <!-- Add New User Form -->
            <div class="card">
                <h3><i class="fas fa-user-plus"></i> Add New User</h3>
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Username *</label>
                            <input type="text" name="username" required placeholder="Enter username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" required placeholder="Enter email (to receive login credentials)" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="password" required placeholder="Enter password (min 6 chars)">
                        </div>
                        <div class="form-group">
                            <label>Role *</label>
                            <select name="role">
                                <option value="staff">📋 Staff (Limited Access)</option>
                                <option value="admin">👑 Admin (Full Access)</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="add_user" class="btn-primary"><i class="fas fa-save"></i> Add User & Send Email</button>
                </form>
            </div>
            
            <!-- All Users Table -->
            <div class="card">
                <h3><i class="fas fa-list"></i> All Users</h3>
                <table>
                    <thead>
                        <tr><th>SN</th><th>Username</th><th>Email</th><th>Role</th><th>Created At</th><th>Last Login</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php $sn = 1; foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email'] ?: '-'); ?></td>
                            <td><span class="badge badge-<?php echo $user['role']; ?>"><?php echo ucfirst($user['role']); ?></span></td>
                            <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                            <td><?php echo $user['last_login'] ? date('M d, Y', strtotime($user['last_login'])) : '-'; ?></td>
                            <td>
                                <a href="?delete=<?php echo $user['id']; ?>" class="btn-delete" onclick="return confirm('Delete this user?')"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>