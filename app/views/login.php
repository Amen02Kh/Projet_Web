<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/web/public/style.css">
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <div class="container">
        <?php if (isset($error) && $error): ?>
            <p style="color: red;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST" action="/web/public/user/login">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
            <button type="button" onclick="window.location.href='/web/public'">Return</button>
        </form>
    </div>
    
</body>
</html>
