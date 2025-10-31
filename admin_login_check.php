<?php
session_start();
$conn = new mysqli("localhost", "root", "", "bbm");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE admin_emailid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $row['admin_password'])) {
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['admin_username'] = $row['admin_username'];
            header("Location: admin_dashboard.php");
            exit;
        } else {
            echo "❌ Invalid Password or email!";
    } 
}
}
?>
