<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: Admin_Login.php"); exit; }
$conn = new mysqli("localhost","root","","bbm");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$donors = $conn->query("SELECT * FROM donors");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Donors</title>
    <style>
        body { margin:0; font-family: Arial, sans-serif; background:#f4f6f9; }
        .header { background:#c62828; color:white; padding:15px; text-align:center; font-size:22px; }
        .container { display:flex; }
        .sidebar { width:200px; background:#333; height:100vh; padding-top:20px; }
        .sidebar a { display:block; padding:12px; color:white; text-decoration:none; }
        .sidebar a:hover { background:#444; }
        .main { flex:1; padding:20px; }
        table { width:100%; border-collapse:collapse; background:white; box-shadow:0 2px 6px rgba(0,0,0,0.2); }
        th, td { padding:10px; border:1px solid #ddd; text-align:center; }
        th { background:#eee; }
    </style>
</head>
<body>
    <div class="header">Manage Donors</div>
    <div class="container">
        <div class="sidebar">
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="manage_donors.php">Manage Donors</a>
            <a href="manage_requests.php">Manage Requests</a>
            <a href="manage_stock.php">Blood Stock</a>
            <a href="a_logout.php">Logout</a>
        </div>
        <div class="main">
            <h2>Donor List</h2>
            <table>
                <tr>
                    <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Blood Group</th><th>Address</th>
                </tr>
                <?php while($row=$donors->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $row['d_id']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['blood_group']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>
