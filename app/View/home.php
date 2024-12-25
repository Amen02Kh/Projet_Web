<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crossword Platform</title>
    <link rel="stylesheet" href="/public/style.css"> <!-- Link to your CSS -->
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
</head>
<body>
    <header>
        <h1>Welcome to the Crossword Platform</h1>
    </header>
    <div class="container">
        <div class="action-buttons">
            <a href="/user/register" class="btn">Register</a>
            <a href="/user/login" class="btn">Login</a>
            <a href="/grids/view" class="btn">Continue as Anonymous</a>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Crossword Puzzle Platform</p>
    </footer>
</body>
</html>
