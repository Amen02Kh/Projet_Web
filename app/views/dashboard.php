<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CruciWeb</title>
    <link rel="stylesheet" href="/web/public/style.css">
    <style>
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
            margin: 1rem;
        }
        .btn:hover {
            background-color: #005bb5;
        }
        .container {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <header>
        <h1>CruciWeb - Your Crossword Hub</h1>
    </header>
    <div class="container">
        <h1>Welcome, <?= htmlspecialchars($username); ?>!</h1>
        <p>What would you like to do today?</p>
        <a href="/web/public/grid/create" class="btn">Create a Crossword Grid</a>
        <a href="/web/public/grid/viewGrids" class="btn">View Published Grids</a>
        <a href="/web/public/grid/viewProgress" class="btn">View In Progress Grids</a>
        <a href="/web/public/user/logout" class="btn">Logout</a>

    </div>
</body>
</html>
