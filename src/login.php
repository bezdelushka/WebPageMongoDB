<?php
session_start();
require 'connect.php';

$valid_email = "user@example.com";
$valid_password = "securepassword";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember_me']);

    if ($email === $valid_email && $password === $valid_password) {
        $_SESSION['email'] = $email; 
        header("Location: index.php");
 
        if ($remember_me) {
            setcookie("email", $email, time() + (86400 * 30), "/"); // 30 days
        } else {
            if (isset($_COOKIE['email'])) {
                setcookie("email", "", time() - 3600, "/");
            }
        }
    } else {
        echo "<p>Invalid email or password. Please try again.</p>";
    }
}


$saved_email = isset($_COOKIE['email']) ? $_COOKIE['email'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L O G I N</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="style.css?version40">
</head>
<body>
<div class="form" id="form-login">
    <form action="login.php" method="post" novalidate>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-input" value="<?php echo htmlspecialchars($saved_email); ?>" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-input" required>
        </div>
        <div>
            <label for="remember_me">
                <input type="checkbox" name="remember_me" id="remember_me" value="checked"> Remember me
            </label>
        </div>
        <input type="submit" value="Login">
    </form>
</div>
</body>
</html>
