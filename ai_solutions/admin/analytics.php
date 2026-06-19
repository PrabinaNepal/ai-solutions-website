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
$total_sql = "SELECT COUNT(*) as total FROM inquiries";
$total_result = $conn->query($total_sql);
$total = $total_result->fetch_assoc()['total'];

// Get inquiries by country
$country_sql = "SELECT country, COUNT(*) as count FROM inquiries GROUP BY country ORDER BY count DESC";
$country_result = $conn->query($country_sql);
$countries = $country_result->fetch_all(MYSQLI_ASSOC);

// Get status distribution
$status_sql = "SELECT status, COUNT(*) as count FROM inquiries GROUP BY status";
$status_result = $conn->query($status_sql);
$statuses = $status_result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics | AI-Solutions Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f5f6fa; color: #2c3e50; }
        
        .admin-container { display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar { width: 260px; background: #1a1a2e; color: white; position: fixed; height: 100vh; }
        .sidebar-header { padding: 25px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-header h3 { font-size: 1.2rem; }
        .sidebar-header p { font-size: 0.75rem; color: #888; margin-top: 5px; }
        .sidebar-nav { padding: 20px 0; }
        .sidebar-nav a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #aaa; text-decoration: none; transition: 0.3s; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background: #1a73e8; color: white; }
        
        /* Main Content */
        .main-content { flex: 1; margin-left: 260px; padding: 20px; }
        
        /* Top Bar */
        .top-bar { background: white; padding: 15px 25px; border-radius: 12px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .top-bar h2 { font-size: 1.3rem; font-weight: 600; }
        .logout-btn { background: #dc2626; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 13px; }
        
        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 12px; text-align: center; }
        .stat-card h4 { color: #666; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; }
        .stat-card .number { font-size: 32px; font-weight: 700; color: #1a73e8; }
        
        /* Charts Grid */
        .charts-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 30px; }
        .chart-card { background: white; padding: 20px; border-radius: 12px; }
        .chart-card h3 { margin-bottom: 20px; font-size: 1rem; display: flex; align-items: center; gap: 8px; }
        canvas { max-height: 300px; width: 100%; }
        
        @media (max-width: 992px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .charts-grid { grid-template-columns: 1fr; }
        }
        
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <h3>🤖 AI-Solutions</h3>
                <p>Admin Panel</p>
            </div>
            <div class="sidebar-nav">
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="analytics.php" class="active"><i class="fas fa-chart-line"></i> Analytics</a>
                <a href="inquiries.php"><i class="fas fa-envelope"></i> Inquiries</a>
                <a href="accounts.php"><i class="fas fa-users"></i> Accounts</a>
                <a href="export-csv.php"><i class="fas fa-download"></i> Export CSV</a>
                <a href="export-excel.php"><i class="fas fa-file-excel"></i> Export Excel</a>
                <a href="/ai_solutions/index.php"><i class="fas fa-globe"></i> View Website</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
        
        <div class="main-content">
            <div class="top-bar">
                <h2><i class="fas fa-chart-line"></i> Analytics Dashboard</h2>
                <div class="user-info">
                    <span>Welcome, <?php echo htmlspecialchars($user_name); ?></span>
                    <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card"><h4>Total Inquiries</h4><div class="number"><?php echo $total; ?></div></div>
                <div class="stat-card"><h4>This Month</h4><div class="number"><?php echo $total; ?></div></div>
                <div class="stat-card"><h4>Conversion Rate</h4><div class="number">85%</div></div>
                <div class="stat-card"><h4>Response Time</h4><div class="number">2.4h</div></div>
            </div>
            
            <div class="charts-grid">
                <div class="chart-card">
                    <h3><i class="fas fa-globe"></i> Inquiries by Country</h3>
                    <canvas id="countryChart"></canvas>
                </div>
                <div class="chart-card">
                    <h3><i class="fas fa-chart-pie"></i> Status Distribution</h3>
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Country Chart
        const countryCtx = document.getElementById('countryChart').getContext('2d');
        new Chart(countryCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($countries, 'country')); ?>,
                datasets: [{
                    label: 'Number of Inquiries',
                    data: <?php echo json_encode(array_column($countries, 'count')); ?>,
                    backgroundColor: '#1a73e8',
                    borderRadius: 8
                }]
            },
            options: { responsive: true, maintainAspectRatio: true }
        });
        
        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode(array_column($statuses, 'status')); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_column($statuses, 'count')); ?>,
                    backgroundColor: ['#1a73e8', '#28a745', '#ffc107']
                }]
            },
            options: { responsive: true, maintainAspectRatio: true }
        });
    </script>
</body>
</html>