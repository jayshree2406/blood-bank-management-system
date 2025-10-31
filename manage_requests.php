<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: Admin_Login.php"); exit; }
$conn = new mysqli("localhost","root","","bbm");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

if (isset($_GET['update_id']) && isset($_GET['status'])) {
    $id = $_GET['update_id'];
    $status = $_GET['status'];

    if ($status == "Completed") {
        $req = $conn->query("SELECT blood_group, units FROM donation_requests WHERE id=$id")->fetch_assoc();
        $bg = $req['blood_group'];
        $units = $req['units'];
        $conn->query("UPDATE blood_stock SET units = units + $units WHERE blood_group='$bg'");
    }

    $conn->query("UPDATE donation_requests SET status='$status' WHERE id=$id");
    header("Location: manage_requests.php");
    exit;
}

$requests = $conn->query("SELECT r.*, d.full_name FROM donation_requests r JOIN donors d ON r.donor_id=d.d_id ORDER BY r.id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Requests</title>
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
        .btn { padding:6px 10px; border:none; border-radius:4px; color:white; cursor:pointer; text-decoration:none; }
        .approve { background:#29b6f6; }
        .reject { background:#e53935; }
        .complete { background:#43a047; }
    </style>
</head>
<body>
    <div class="header">Manage Requests</div>
    <div class="container">
        <div class="sidebar">
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="manage_donors.php">Manage Donors</a>
            <a href="manage_requests.php">Manage Requests</a>
            <a href="manage_stock.php">Blood Stock</a>
            <a href="a_logout.php">Logout</a>
        </div>
        <div class="main">
            <h2>Donation Requests</h2>
            <table>
                <tr>
                    <th>ID</th><th>Donor</th><th>Blood Group</th><th>Units</th>
                    <th>Date</th><th>Time</th><th>Center</th><th>Status</th><th>Action</th>
                </tr>
                <?php while($row=$requests->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['blood_group']; ?></td>
                    <td><?php echo $row['units']; ?></td>
                    <td><?php echo $row['donation_date']; ?></td>
                    <td><?php echo $row['donation_time']; ?></td>
                    <td><?php echo $row['donation_center']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <a class="btn approve" href="?update_id=<?php echo $row['id']; ?>&status=Approved">Approve</a>
                        <a class="btn reject" href="?update_id=<?php echo $row['id']; ?>&status=Rejected">Reject</a>
                        <a class="btn complete" href="?update_id=<?php echo $row['id']; ?>&status=Completed">Complete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>
