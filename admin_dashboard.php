<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: Admin_Login.php"); exit; }
$conn = new mysqli("localhost","root","","bbm");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$total_donors = $conn->query("SELECT COUNT(*) AS c FROM donors")->fetch_assoc()['c'];
$total_requests = $conn->query("SELECT COUNT(*) AS c FROM donation_requests")->fetch_assoc()['c'];
$pending = $conn->query("SELECT COUNT(*) AS c FROM donation_requests WHERE status='Pending'")->fetch_assoc()['c'];
$completed = $conn->query("SELECT COUNT(*) AS c FROM donation_requests WHERE status='Completed'")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { margin:0; font-family: Arial, sans-serif; background:#f4f6f9; }
        .header { background:#c62828; color:white; padding:15px; text-align:center; font-size:22px; }
        .container { display:flex; }
        .sidebar { width:200px; background:#333; height:100vh; padding-top:20px; }
        .sidebar a { display:block; padding:12px; color:white; text-decoration:none; }
        .sidebar a:hover { background:#444; }
        .main { flex:1; padding:20px; }
        .stats { display:grid; grid-template-columns: repeat(4, 1fr); gap:20px; margin-top:20px; }
        .card { padding:20px; border-radius:8px; text-align:center; font-size:18px; font-weight:bold; color:white; }
        .total { background:#1976d2; }
        .pending { background:#fbc02d; }
        .completed { background:#43a047; }
        .donors { background:#8e24aa; }
    </style>
</head>
<body>
    <div class="header">Welcome, <?php echo $_SESSION['admin_username']; ?> </div>
    <div class="container">
        <div class="sidebar">
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="manage_donors.php">Manage Donors</a>
            <a href="manage_requests.php">Manage Requests</a>
            <a href="manage_stock.php">Blood Stock</a>
            <a href="a_logout.php">Logout</a>
        </div>
        <div class="main">
            <h2>System Overview</h2>
            <div class="stats">
                <div class="card donors">Total Donors<br><?php echo $total_donors; ?></div>
                <div class="card total">Total Requests<br><?php echo $total_requests; ?></div>
                <div class="card pending">Pending<br><?php echo $pending; ?></div>
                <div class="card completed">Completed<br><?php echo $completed; ?></div>
            </div>
        </div>
    </div>
</body>
</html>
