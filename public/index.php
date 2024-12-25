<?php
session_start();

// Check if the user is already logged in and redirect accordingly
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin_dashboard.php");
        exit;
    } elseif ($_SESSION['role'] === 'registered') {
        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crossword Platform</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS -->
</head>
<style>
    .action-buttons {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 2rem;
}

.btn {
    display: inline-block;
    padding: 1rem 2rem;
    font-size: 1rem;
    font-weight: bold;
    text-align: center;
    color: white;
    background-color: #0078d7;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #005bb5;
}

</style>
<body>
    <header>
        <h1>Welcome to the Crossword Platform</h1>
    </header>
    <div class="container">
        <div class="action-buttons">
            <a href="register.php" class="btn">Register</a>
            <a href="login.php" class="btn">Login</a>
            <a href="view_grids.php" class="btn">Continue as Anonymous</a>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Crossword Puzzle Platform</p>
    </footer>
</body>
</html>