<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Fetch user by username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit;
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Connexion</h1>
    </header>
    <div class="container">
        <?php if (isset($error)): ?><p style="color: red;"><?= $error; ?></p><?php endif; ?>
        <form method="POST">
            <label>Nom d'utilisateur:</label>
            <input type="text" name="username" required>
            <label>Mot de passe:</label>
            <input type="password" name="password" required>
            <button type="submit">Se connecter</button>
            <button type="button" onclick="window.location.href='index.php'">Return</button>
        </form>
    </div>
    <footer>
        <p>&copy; 2024 Crossword Puzzle Platform</p>
    </footer>
</body>
</html>
