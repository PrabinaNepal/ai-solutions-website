<?php
session_start();
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

require_once '../includes/config.php';

$admins = $conn->query("SELECT id, full_name, username, email, role, created_at FROM admin_users ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users | AI-Solutions</title>
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
        table { width: 100%; background: white; border-radius: 10px; overflow: hidden; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; }
        .badge { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-admin { background: #e3f2fd; color: #1a73e8; }
        .badge-staff { background: #e8f5e9; color: #28a745; }
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
                <a href="register.php"><i class="fas fa-user-plus"></i> Add Admin</a>
                <a href="admins.php" class="active"><i class="fas fa-users"></i> All Admins</a>
                <a href="export-csv.php"><i class="fas fa-download"></i> Export CSV</a>
                <a href="export-excel.php"><i class="fas fa-file-excel"></i> Export Excel</a>
                <a href="/ai_solutions/index.php"><i class="fas fa-globe"></i> View Website</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
        
        <div class="main-content">
            <div class="top-bar">
                <h2><i class="fas fa-users"></i> Admin Users</h2>
                <div>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></div>
            </div>
            
            <table>
                <thead>
                    <tr><th>ID</th><th>Full Name</th><th>Username</th><th>Email</th><th>Role</th><th>Created At</th></tr>
                </thead>
                <tbody>
                    <?php foreach($admins as $admin): ?>
                    <tr>
                        <td><?php echo $admin['id']; ?></td>
                        <td><?php echo htmlspecialchars($admin['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($admin['username']); ?></td>
                        <td><?php echo htmlspecialchars($admin['email']); ?></td>
                        <td><span class="badge badge-<?php echo $admin['role']; ?>"><?php echo ucfirst($admin['role']); ?></span></td>
                        <td><?php echo date('d/m/Y', strtotime($admin['created_at'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>