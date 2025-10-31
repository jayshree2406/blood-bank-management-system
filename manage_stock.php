<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: Admin_Login.php"); exit; }

$conn = new mysqli("localhost","root","","bbm");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// ✅ Update stock manually if form submitted
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $units = (int) $_POST['units'];
    $conn->query("UPDATE blood_stock SET units=$units WHERE id=$id");
    header("Location: manage_stock.php");
    exit;
}

// ✅ Fetch stock
$stock = $conn->query("SELECT * FROM blood_stock ORDER BY blood_group ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Blood Stock</title>
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
        input[type=number] { width:80px; padding:5px; }
        button { background:#c62828; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer; }
        button:hover { background:#a11414; }
    </style>
</head>
<body>
    <div class="header">Manage Blood Stock</div>
    <div class="container">
        <div class="sidebar">
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="manage_donors.php">Manage Donors</a>
            <a href="manage_requests.php">Manage Requests</a>
            <a href="manage_stock.php">Blood Stock</a>
            <a href="a_logout.php">Logout</a>
        </div>
        <div class="main">
            <h2>Blood Stock Availability</h2>
            <table>
                <tr><th>Blood Group</th><th>Units Available</th><th>Update</th></tr>
                <?php while($row=$stock->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $row['blood_group']; ?></td>
                    <td>
                        <form method="POST" style="display:flex; justify-content:center; gap:10px;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="number" name="units" value="<?php echo $row['units']; ?>" min="0">
                            <button type="submit" name="update">Save</button>
                        </form>
                    </td>
                    <td><?php echo $row['units']; ?> Units</td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>
