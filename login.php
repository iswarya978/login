<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Connect to MySQL server
    $conn = mysqli_connect("localhost", "root", "", "amv");
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Check if username and password match
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row['password']) {
            // Password is correct
            $_SESSION['login_message'] = "Hi";
            $updateStatusSql = "UPDATE users SET status = 1 WHERE username='$username'";
        } else {
            // Password is incorrect
            $_SESSION['login_message'] = "Hello";
            $updateStatusSql = "UPDATE users SET status = 0 WHERE username='$username'";
        }
        mysqli_query($conn, $updateStatusSql);
        
        // Redirect user to appropriate page
        if ($_SESSION['login_message'] === "Hi") {
            header("Location: hi.php");
            exit();
        } else {
            header("Location: hello.php");
            exit();
        }
    } else {
        // User not found
        $_SESSION['login_message'] = "Hello";
        header("Location: hello.php");
        exit();
    }
    
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Username: <input type="text" name="username"><br><br>
        Password: <input type="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>
