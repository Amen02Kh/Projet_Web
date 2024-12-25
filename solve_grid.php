<?php
require 'config.php'; // Database configuration
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_GET['grid_id']) || empty($_GET['grid_id'])) {
    die("Grid ID is missing.");
}
// Fetch grid data from the database
$gridId = $_GET['grid_id'];
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    // Fetch saved progress for the current grid
$stmt = $pdo->prepare("SELECT state FROM user_grids WHERE user_id = ? AND grid_id = ?");
$stmt->execute([$userId, $gridId]);
$savedState = $stmt->fetchColumn();

// Decode the saved state (JSON to PHP array)
$currentState = [];
if ($savedState) {
    $currentState = json_decode($savedState, true);
}
}
// Get the logged-in user's ID


// Validate grid_id parameter
 // Example: http://localhost/solve_grid.php?grid_id=1
$stmt = $pdo->prepare("SELECT * FROM grid_cells WHERE grid_id = ? ORDER BY row_num, col_num");
$stmt->execute([$gridId]);
$gridData = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM definitions WHERE grid_id = ?");
$stmt->execute([$gridId]);
$definitions = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crossword Grid</title>
    <link rel="stylesheet" href="style.css">
    <style>
   
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
       
        
        
    }

    header {
        width: 100%;
        text-align: center;
        padding: 10px;
        background-color: #0078d7;
        color: white;
        font-size: 1.2rem;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        gap: 15px;
        width: 90%;
        max-width: 900px;
    }

    .clues-container {
        display: flex;
        gap: 15px;
        width: 300px;
    }

    .description {
        width: 50%;
        text-align: left;
    }

    .description h3 {
        margin-bottom: 8px;
        color: #0078d7;
        font-size: 0.9rem;
    }

    .description ul {
        padding-left: 10px;
        list-style-type: none;
    }

    .description li {
        margin-bottom: 4px;
        font-size: 0.75rem;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(10, 40px);
        grid-template-rows: repeat(10, 40px);
        gap: 1px;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        padding: 2px;
    }

    .cell {
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #ccc;
        font-size: 0.9rem;
        text-transform: uppercase;
        background-color: white;
    }

    .cell.black {
        background-color: #333;
    }

    .cell input {
        border: none;
        text-align: center;
        font-size: 0.9rem;
        width: 90%;
        height: 90%;
        background: transparent;
        text-transform: uppercase;
        outline: none;
    }

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

    @media (max-width: 768px) {
        .container, .clues-container {
            flex-direction: column;
            align-items: center;
        }
    }
</style>
</head>
<body>
    <header>
        Crossword Grid
    </header>

    <div class="container">
        <!-- Clues Section -->
        <div class="description">
            <h3>Horizontal Clues</h3>
            <ul>
                <?php
                foreach ($definitions as $definition) {
                    if ($definition['orientation'] === 'horizontal') {
                        echo '<li>' . htmlspecialchars($definition['row_or_col']) . ': ' . htmlspecialchars($definition['definition']) . '</li>';
                    }
                }
                ?>
            </ul>
            <h3>Vertical Clues</h3>
            <ul>
                <?php
                foreach ($definitions as $definition) {
                    if ($definition['orientation'] === 'vertical') {
                        echo '<li>' . htmlspecialchars($definition['row_or_col']) . ': ' . htmlspecialchars($definition['definition']) . '</li>';
                    }
                }
                ?>
            </ul>
        </div>
        <form id="crossword-form" method="POST" action="save_progress.php">
        <!-- Hidden Input to Pass Grid ID -->
        <input type="hidden" name="grid_id" value="<?= htmlspecialchars($gridId); ?>">
        <!-- Crossword Grid -->
        <div class="grid-container" id="crossword-grid">
    <?php foreach ($gridData as $cell): ?>
        <?php if ($cell['is_black']): ?>
            <div class="cell black"></div>
        <?php else: ?>
            <div class="cell">
                <input 
                    type="text" 
                    name="grid[<?= $cell['row_num']; ?>][<?= $cell['col_num']; ?>]" 
                    maxlength="1" 
                    value="<?= isset($currentState[$cell['row_num']][$cell['col_num']]) ? htmlspecialchars($currentState[$cell['row_num']][$cell['col_num']]) : ''; ?>" 
                    data-solution="<?= htmlspecialchars($cell['solution']); ?>">
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
    </div>

    <div class="button-container">
            <button type="button" onclick="checkSolution()">Check Solution</button>
            <?php if (isset($_SESSION['user_id'])): ?>
        <button type="submit">Save Progress</button>
    <?php else: ?>
        <button type="button" disabled title="Log in to save progress">Save Progress</button>
    <?php endif; ?>
            <button type="button" onclick="window.location.href='view_grids.php'">Return</button>
        </div>
    </form>

    <script>
        function checkSolution() {
            const cells = document.querySelectorAll('.grid-container .cell input');
            let allCorrect = true;

            cells.forEach(cell => {
                const solution = cell.dataset.solution;
                const userInput = cell.value.toUpperCase();

                if (userInput !== solution) {
                    cell.style.backgroundColor = '#ffcccc'; // Highlight incorrect cells
                    allCorrect = false;
                } else {
                    cell.style.backgroundColor = '#ccffcc'; // Highlight correct cells
                }
            });

            if (allCorrect) {
                alert("Congratulations! You solved the crossword.");
            } else {
                alert("Some answers are incorrect. Keep trying!");
            }
        }
    </script>
</body>
</html>

