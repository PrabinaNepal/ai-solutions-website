<?php
session_start();
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

require_once '../includes/config.php';

// Get user full name
$user_name = $_SESSION['admin_fullname'] ?? $_SESSION['admin_username'];

// Get statistics
$total_inquiries = $conn->query("SELECT COUNT(*) as count FROM inquiries")->fetch_assoc()['count'];
$total_admins = $conn->query("SELECT COUNT(*) as count FROM admin_users")->fetch_assoc()['count'];
$new_inquiries = $conn->query("SELECT COUNT(*) as count FROM inquiries WHERE status = 'New'")->fetch_assoc()['count'];
$replied_inquiries = $conn->query("SELECT COUNT(*) as count FROM inquiries WHERE reply_status = 'Replied'")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | AI-Solutions Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
            color: #1a1a2e;
        }
        
        /* Admin Container */
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 260px;
            background: #1a1a2e;
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        
        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-header h3 {
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .sidebar-header p {
            font-size: 0.7rem;
            color: #888;
            margin-top: 5px;
        }
        
        .sidebar-nav {
            padding: 20px 0;
        }
        
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #aaa;
            text-decoration: none;
            transition: 0.3s;
        }
        
        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: #1a73e8;
            color: white;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 25px;
        }
        
        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            background: white;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .top-bar h1 {
            font-size: 1.3rem;
            font-weight: 600;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-name {
            font-weight: 500;
            color: #333;
        }
        
        .logout-btn {
            background: #dc2626;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            transition: 0.3s;
        }
        
        .logout-btn:hover {
            background: #b91c1c;
        }
        
        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, #1a73e8, #1557b0);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            color: white;
        }
        
        .welcome-section h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .welcome-section p {
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .stat-icon {
            width: 55px;
            height: 55px;
            background: #e3f2fd;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .stat-icon i {
            font-size: 1.5rem;
            color: #1a73e8;
        }
        
        .stat-info h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e1e2e;
        }
        
        .stat-info p {
            font-size: 0.8rem;
            color: #666;
        }
        
        /* Management Grid */
        .management-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }
        
        .management-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            transition: all 0.3s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #eef2f6;
        }
        
        .management-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            border-color: #1a73e8;
        }
        
        .card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .card-icon {
            width: 50px;
            height: 50px;
            background: #e3f2fd;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .card-icon i {
            font-size: 1.3rem;
            color: #1a73e8;
        }
        
        .card-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e1e2e;
        }
        
        .card-description {
            color: #666;
            font-size: 0.85rem;
            line-height: 1.5;
            margin-bottom: 20px;
            padding-left: 65px;
        }
        
        .card-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #1a73e8;
            color: white;
            padding: 8px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            margin-left: 65px;
            transition: 0.3s;
        }
        
        .card-btn:hover {
            background: #1557b0;
            transform: translateX(3px);
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .management-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .main-content {
                margin-left: 0;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .top-bar {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            .welcome-section {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h3>🤖 AI-Solutions</h3>
                <p>Admin Panel</p>
            </div>
            <div class="sidebar-nav">
                <a href="dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="analytics.php"><i class="fas fa-chart-line"></i> Analytics</a>
                <a href="inquiries.php"><i class="fas fa-envelope"></i> Inquiries</a>
                <a href="accounts.php"><i class="fas fa-users"></i> Accounts</a>
                <a href="export-csv.php"><i class="fas fa-download"></i> Export CSV</a>
                <a href="export-excel.php"><i class="fas fa-file-excel"></i> Export Excel</a>
                <a href="/ai_solutions/index.php"><i class="fas fa-globe"></i> View Website</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
                <div class="user-info">
                    <span class="user-name"><i class="fas fa-user-circle"></i> Welcome, <?php echo htmlspecialchars($user_name); ?></span>
                    <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
            
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h2>Welcome back, <?php echo htmlspecialchars($user_name); ?>! 👋</h2>
                <p>Here's what's happening with your AI-Solutions platform today.</p>
            </div>
            
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-envelope"></i></div>
                    <div class="stat-info">
                        <h3><?php echo $total_inquiries; ?></h3>
                        <p>Total Inquiries</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                    <div class="stat-info">
                        <h3><?php echo $new_inquiries; ?></h3>
                        <p>New Inquiries</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-reply-all"></i></div>
                    <div class="stat-info">
                        <h3><?php echo $replied_inquiries; ?></h3>
                        <p>Replied</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-info">
                        <h3><?php echo $total_admins; ?></h3>
                        <p>Admin Users</p>
                    </div>
                </div>
            </div>
            
            <!-- Management Cards -->
            <div class="management-grid">
                <!-- Analytics Overview -->
                <div class="management-card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                        <h3>Analytics Overview</h3>
                    </div>
                    <div class="card-description">
                        View overall analytics of the company, including inquiry statistics, country distribution, and status reports.
                    </div>
                    <a href="analytics.php" class="card-btn">View Analytics →</a>
                </div>
                
                <!-- Inquiry Management -->
                <div class="management-card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-envelope"></i></div>
                        <h3>Inquiry Management</h3>
                    </div>
                    <div class="card-description">
                        Manage incoming customer inquiries, reply to messages with email, and track communication history.
                    </div>
                    <a href="inquiries.php" class="card-btn">Manage Inquiries →</a>
                </div>
                
                <!-- Data Export -->
                <div class="management-card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-download"></i></div>
                        <h3>Data Export</h3>
                    </div>
                    <div class="card-description">
                        Export all inquiry data to CSV or Excel format for offline analysis and reporting.
                    </div>
                    <a href="export-csv.php" class="card-btn">Export Data →</a>
                </div>
                
                <!-- Accounts Management -->
                <div class="management-card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-users"></i></div>
                        <h3>Accounts Management</h3>
                    </div>
                    <div class="card-description">
                        Manage admin user accounts. Add new admins, delete users, and manage roles.
                    </div>
                    <a href="accounts.php" class="card-btn">Manage Accounts →</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>