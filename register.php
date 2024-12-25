<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Secure password hashing

    if (empty($username) || empty($email) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Veuillez fournir une adresse email valide.";
    } else {
        // Vérifier si le nom d'utilisateur ou l'email existe déjà
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $error = "Le nom d'utilisateur ou l'email existe déjà.";
        } else {
            // Inscription comme utilisateur inscrit
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'registered')");
            $stmt->execute([$username, $email, $hashedPassword]);
            $success = "Inscription réussie. Vous pouvez maintenant vous connecter.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Inscription</h1>
    </header>
    <div class="container">
        <?php if (isset($error)): ?><p style="color: red;"><?= $error; ?></p><?php endif; ?>
        <?php if (isset($success)): ?><p style="color: green;"><?= $success; ?></p><?php endif; ?>
        <form method="POST">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">S'inscrire</button>
            <button type="button" onclick="window.location.href='index.php'">Return</button>
        </form>
    </div>
    <footer>
        <p>&copy; 2024 Crossword Puzzle Platform</p>
    </footer>
</body>
</html>
