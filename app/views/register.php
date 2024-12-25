<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="/web/public/style.css">
</head>
<body>
    <header>
        <h1>Inscription</h1>
    </header>
    <div class="container">
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p style="color: green;"><?= htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <form method="POST" action="/web/public/user/register">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">S'inscrire</button>
            <button type="button" onclick="window.location.href='/web/public'">Return</button>
        </form>
    </div>
    
</body>
</html>
