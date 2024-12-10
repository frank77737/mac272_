<?php
// Question 1: Register Page (register.php)

// Database connection
$conn = mysqli_connect("localhost", "root", "", "your_database_name");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Hash the password
    $email = $_POST['email'];

    $sql = "INSERT INTO users (name, username, password, email) VALUES ('$name', '$username', '$password', '$email')";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Question 2: Login Page (login.php)

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            echo "User found";
        } else {
            header("Location: welcome.php");
        }
    } else {
        header("Location: welcome.php");
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register or Login</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <button type="submit" name="register">Register</button>
    </form>

    <h2>Login</h2>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
