<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['login_message']) || $_SESSION['login_message'] !== "Hello") {
    // If not logged in or message is not "Hello", redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hello Page</title>
</head>
<body>
    <h2>Hello</h2>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
