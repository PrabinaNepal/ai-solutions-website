<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once '../includes/config.php';

$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'] ?? 'staff';
    
    if(empty($full_name) || empty($username) || empty($email) || empty($password)) {
        $error = 'Please fill in all fields.';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } elseif(strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
        // Check if username or email exists
        $check = $conn->prepare("SELECT id FROM admin_users WHERE username = ? OR email = ?");
        $check->bind_param("ss", $username, $email);
        $check->execute();
        $check->store_result();
        
        if($check->num_rows > 0) {
            $error = 'Username or email already exists.';
        } else {
            $hashed_password = md5($password);
            
            $sql = "INSERT INTO admin_users (full_name, username, email, password, role) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $full_name, $username, $email, $hashed_password, $role);
            
            if($stmt->execute()) {
                $success = 'Admin user created successfully!';
                $_POST = array();
            } else {
                $error = 'Something went wrong. Please try again.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin | AI-Solutions</title>
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
        .top-bar { background: white; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .card { background: white; border-radius: 16px; padding: 30px; max-width: 550px; margin: 0 auto; }
        .card h2 { margin-bottom: 10px; }
        .card p { color: #666; margin-bottom: 25px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; }
        .form-group input, .form-group select { width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 10px; }
        .btn-submit { background: linear-gradient(135deg, #1a73e8, #1557b0); color: white; border: none; padding: 14px; border-radius: 10px; font-weight: 600; cursor: pointer; width: 100%; }
        .alert { padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .back-link { text-align: center; margin-top: 20px; }
        .back-link a { color: #1a73e8; text-decoration: none; }
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; }
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
                <a href="register.php" class="active"><i class="fas fa-user-plus"></i> Add Admin</a>
                <a href="export-csv.php"><i class="fas fa-download"></i> Export CSV</a>
                <a href="export-excel.php"><i class="fas fa-file-excel"></i> Export Excel</a>
                <a href="/ai_solutions/index.php"><i class="fas fa-globe"></i> View Website</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
        
        <div class="main-content">
            <div class="top-bar">
                <h2><i class="fas fa-user-plus"></i> Add New Admin</h2>
                <div>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></div>
            </div>
            
            <div class="card">
                <h2>Create Admin Account</h2>
                <p>Fill out the form below to add a new administrator.</p>
                
                <?php if($success): ?>
                    <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo $success; ?></div>
                <?php endif; ?>
                
                <?php if($error): ?>
                    <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="form-group">
                        <label>Full Name *</label>
                        <input type="text" name="full_name" required placeholder="Enter full name">
                    </div>
                    <div class="form-group">
                        <label>Username *</label>
                        <input type="text" name="username" required placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" required placeholder="Enter email address">
                    </div>
                    <div class="form-group">
                        <label>Password * (min 6 characters)</label>
                        <input type="password" name="password" required placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password *</label>
                        <input type="password" name="confirm_password" required placeholder="Confirm password">
                    </div>
                    <div class="form-group">
                        <label>Role *</label>
                        <select name="role">
                            <option value="staff">Staff</option>
                            <option value="admin">Admin (Full Access)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Create Admin</button>
                </form>
                
                <div class="back-link">
                    <a href="dashboard.php">← Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>