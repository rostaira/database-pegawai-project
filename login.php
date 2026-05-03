<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $file = fopen(filename: 'pengguna.txt', mode: 'r');
    $valid = false;

    while (($line = fgets(stream: $file)) !== false) {
        list($user, $pass) = explode(separator: ';', string: trim(string: $line));
        if ($username === $user && $password === $pass) {
            $valid = true;
            $_SESSION['username'] = $username;
            break;
        }
    }
    fclose(stream: $file);

    if ($valid) {
        header(header: 'Location: home.php');
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif;  margin: 0; padding: 0; }
        .login-container { width: 300px; margin: 50px auto; padding: 20px; box-shadow: 0 0 10px #ccc; border-radius: 10px; }
        h2 { text-align: center; margin-bottom: 20px; color: black; }
        input[type="text"], input[type="password"] { width: 280px; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; }
        input[type="submit"] { background: #28a745; color: #fff; border: none; padding: 10px; width: 100%; cursor: pointer; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>
<div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="login" value="Login">
        </form>
    </div>
</body>
</html>