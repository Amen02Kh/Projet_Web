<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Grids</title>
    <link rel="stylesheet" href="/web/public/style.css">
    <style>
    button {
    display: block;
    margin: 10px auto;
    padding: 6px 12px;
    background-color: #0078d7;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 0.8rem;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #005bb5;
}
</style>
</head>
<body>
    <header>
        <h1>Published Grids</h1>
    </header>
    <div class="container">
        <!-- Sort options -->
        <form method="GET" class="sort-form">
            <label for="sort_by">Sort By:</label>
            <select name="sort_by" id="sort_by" onchange="this.form.submit()">
                <option value="created_at" <?= $sortBy === 'created_at' ? 'selected' : ''; ?>>Date Added</option>
                <option value="difficulty" <?= $sortBy === 'difficulty' ? 'selected' : ''; ?>>Difficulty</option>
            </select>
        </form>

        <!-- Display grids -->
        <?php if (empty($grids)): ?>
            <p>No grids have been published yet. Please check back later!</p>
        <?php else: ?>
            <?php foreach ($grids as $grid): ?>
                <div class="grid-item">
                    <h3><?= htmlspecialchars($grid['name']); ?></h3>
                    <p>Dimensions: <?= htmlspecialchars($grid['dimensions']); ?></p>
                    <p>Difficulty: <?= ucfirst(htmlspecialchars($grid['difficulty'])); ?></p>
                    <p>Published on: <?= htmlspecialchars($grid['created_at']); ?></p>
                    <a href="/web/public/grid/solveGrid?grid_id=<?= $grid['id']; ?>" class="btn">Solve This Grid</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="button-container">
        <button type="button" onclick="window.location.href='/web/public'">Return</button>
    </div>
    
</body>
</html>
