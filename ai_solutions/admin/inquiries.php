<?php
session_start();
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

require_once '../includes/config.php';

// Get user full name
$user_name = $_SESSION['admin_fullname'] ?? $_SESSION['admin_username'];

// Get search parameter
$search = $_GET['search'] ?? '';

// Build query
$sql = "SELECT * FROM inquiries";
if(!empty($search)) {
    $sql .= " WHERE full_name LIKE '%$search%' OR email LIKE '%$search%' OR company_name LIKE '%$search%'";
}
$sql .= " ORDER BY submitted_at DESC";

$inquiries = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
$total = count($inquiries);
$new_count = count(array_filter($inquiries, function($i) { return $i['status'] == 'New'; }));
$read_count = count(array_filter($inquiries, function($i) { return $i['status'] == 'Read'; }));
$replied_count = count(array_filter($inquiries, function($i) { return ($i['reply_status'] ?? 'Pending') == 'Replied'; }));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiries Management | AI-Solutions</title>
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
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 25px;
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
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            background: #e3f2fd;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .stat-icon i {
            font-size: 1.3rem;
            color: #1a73e8;
        }
        
        .stat-info h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e1e2e;
        }
        
        .stat-info p {
            font-size: 0.75rem;
            color: #666;
        }
        
        /* Search Box */
        .search-box {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .search-box input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            min-width: 200px;
            transition: 0.3s;
        }
        
        .search-box input:focus {
            outline: none;
            border-color: #1a73e8;
            box-shadow: 0 0 0 3px rgba(26,115,232,0.1);
        }
        
        .search-box button {
            background: #1a73e8;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s;
        }
        
        .search-box button:hover {
            background: #1557b0;
        }
        
        .search-box .clear-btn {
            background: #6c757d;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }
        
        .search-box .clear-btn:hover {
            background: #5a6268;
        }
        
        /* Table */
        .table-wrapper {
            background: white;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th {
            background: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: #555;
            border-bottom: 1px solid #eef2f6;
        }
        
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #eef2f6;
            font-size: 13px;
            color: #333;
        }
        
        tr:hover td {
            background: #fafbfc;
        }
        
        /* Badges */
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
        
        .badge-New {
            background: #e3f2fd;
            color: #1a73e8;
        }
        
        .badge-Read {
            background: #e8f5e9;
            color: #28a745;
        }
        
        .badge-Archived {
            background: #f5f5f5;
            color: #999;
        }
        
        /* Action Buttons */
        .action-btns {
            display: flex;
            gap: 8px;
        }
        
        .btn-view {
            background: #1a73e8;
            color: white;
            padding: 5px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 500;
            transition: 0.3s;
        }
        
        .btn-view:hover {
            background: #1557b0;
        }
        
        .btn-delete {
            background: #dc3545;
            color: white;
            padding: 5px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 500;
            transition: 0.3s;
        }
        
        .btn-delete:hover {
            background: #c82333;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px;
            color: #999;
        }
        
        .empty-state i {
            font-size: 48px;
            color: #ccc;
            margin-bottom: 15px;
            display: block;
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
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
            .search-box {
                flex-direction: column;
            }
            .search-box input {
                width: 100%;
            }
            th, td {
                padding: 10px;
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
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="analytics.php"><i class="fas fa-chart-line"></i> Analytics</a>
                <a href="inquiries.php" class="active"><i class="fas fa-envelope"></i> Inquiries</a>
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
                <h1><i class="fas fa-envelope"></i> Inquiries Management</h1>
                <div class="user-info">
                    <span class="user-name"><i class="fas fa-user-circle"></i> Welcome, <?php echo htmlspecialchars($user_name); ?></span>
                    <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-envelope"></i></div>
                    <div class="stat-info">
                        <h3><?php echo $total; ?></h3>
                        <p>Total Inquiries</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                    <div class="stat-info">
                        <h3><?php echo $new_count; ?></h3>
                        <p>New</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="stat-info">
                        <h3><?php echo $read_count; ?></h3>
                        <p>Read</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-reply-all"></i></div>
                    <div class="stat-info">
                        <h3><?php echo $replied_count; ?></h3>
                        <p>Replied</p>
                    </div>
                </div>
            </div>
            
            <!-- Search Box -->
            <form method="GET" class="search-box">
                <input type="text" name="search" placeholder="Search by Name, Email, Company..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit"><i class="fas fa-search"></i> Search</button>
                <?php if(!empty($search)): ?>
                    <a href="inquiries.php" class="clear-btn"><i class="fas fa-times"></i> Clear</a>
                <?php endif; ?>
            </form>
            
            <!-- Inquiries Table -->
            <?php if(empty($inquiries)): ?>
                <div class="table-wrapper">
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        No inquiries found.
                    </div>
                </div>
            <?php else: ?>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Country</th>
                                <th>Job Title</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($inquiries as $inquiry): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($inquiry['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($inquiry['email']); ?></td>
                                <td><?php echo htmlspecialchars($inquiry['company_name']); ?></td>
                                <td><?php echo htmlspecialchars($inquiry['country']); ?></td>
                                <td><?php echo htmlspecialchars($inquiry['job_title']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($inquiry['submitted_at'])); ?></td>
                                <td><span class="badge badge-<?php echo $inquiry['status']; ?>"><?php echo $inquiry['status']; ?></span></td>
                                <td class="action-btns">
                                    <a href="view.php?id=<?php echo $inquiry['id']; ?>" class="btn-view"><i class="fas fa-eye"></i> View</a>
                                    <a href="delete.php?id=<?php echo $inquiry['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this inquiry?')"><i class="fas fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>