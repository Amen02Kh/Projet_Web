<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CruciWeb</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        CruciWeb - Your Crossword Hub
    </header>
    <div class="container">
        <h1>Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>What would you like to do today?</p>
        <a href="create_grid.php" class="btn">Create a Crossword Grid</a>
        <a href="view_grids.php" class="btn">View Published Grids</a>
        <a href="progress.php" class="btn">View In Progress Grids</a>
        <a href="logout.php" class="btn">Logout</a>

    </div>
    <footer>
        &copy; <?= date("Y"); ?> CruciWeb. All rights reserved.
    </footer>
</body>
</html>
