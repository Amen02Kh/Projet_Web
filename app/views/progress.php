<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In-Progress Grids</title>
    <link rel="stylesheet" href="/web/public/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #0078d7;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .container {
            margin-left: auto;
        }

        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .message.success {
            background-color: #ccffcc;
            color: #006600;
        }

        .message.error {
            background-color: #ffcccc;
            color: #990000;
        }

        .grid-item {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: white;
        }

        .grid-item h3 {
            margin: 0 0 10px;
        }

        .grid-item p {
            margin: 5px 0;
        }

        .btn {
            padding: 8px 16px;
            margin: 5px;
            background-color: #0078d7;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background-color: #005bb5;
        }
    </style>
</head>
<body>
    <header>
        <h1>Your In-Progress Grids</h1>
    </header>
    <div class="container">
        <!-- Display Messages -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?= htmlspecialchars($_SESSION['message_type']); ?>">
                <?= htmlspecialchars($_SESSION['message']); ?>
            </div>
            <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>

        <?php if (empty($gridsInProgress)): ?>
            <p>You have no in-progress grids.</p>
        <?php else: ?>
            <?php foreach ($gridsInProgress as $grid): ?>
                <div class="grid-item">
                    <h3><?= htmlspecialchars($grid['name']); ?></h3>
                    <p>Dimensions: <?= htmlspecialchars($grid['dimensions']); ?></p>
                    <p>Difficulty: <?= ucfirst(htmlspecialchars($grid['difficulty'])); ?></p>
                    <p><strong>Progress:</strong> Saved progress available.</p>
                    <a href="/web/public/grid/solveGrid?grid_id=<?= $grid['grid_id']; ?>" class="btn">Continue</a>
                    <a href="?delete_progress=<?= $grid['user_grid_id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this progress?');">Delete</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <button type="button" onclick="window.location.href='/web/public/dashboard'">Return</button>
</body>
</html>
