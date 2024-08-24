<?php
require(__DIR__ . '/config/config.php');
require(__DIR__ . '/config/baseURL.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT ID FROM ADMINS WHERE EMAIL='$email' AND PASSWORD='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['login_user'] = $email;
        header("location: app/home.php");
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo baseurl . '/design/style.css'; ?>">
</head>
<body>
<div class="login-container">
    <h2>Login</h2>
    <form action="" method="post">
        <label>Username:</label>
        <input type="text" name="email" value="<?php if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
</div>
</body>
</html>
