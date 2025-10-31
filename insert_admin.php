<?php
$conn = new mysqli("localhost", "root", "", "bbm");

$username = "admin";
$email = "admin@gmail.com";
$password = "admin@123";  // plain password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO admin (admin_username, admin_emailid, admin_password) 
        VALUES ('$username', '$email', '$hashedPassword')";

if ($conn->query($sql)) {
    echo "Admin created successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>
