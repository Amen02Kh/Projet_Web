<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crossword Grid</title>
    <link rel="stylesheet" href="/web/public/style.css">
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
                <?php foreach ($definitions as $definition): ?>
                    <?php if ($definition['orientation'] === 'horizontal'): ?>
                        <li><?= htmlspecialchars($definition['row_or_col']) . ': ' . htmlspecialchars($definition['definition']); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <h3>Vertical Clues</h3>
            <ul>
                <?php foreach ($definitions as $definition): ?>
                    <?php if ($definition['orientation'] === 'vertical'): ?>
                        <li><?= htmlspecialchars($definition['row_or_col']) . ': ' . htmlspecialchars($definition['definition']); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Crossword Grid -->
        <form id="crossword-form" method="POST" action="/web/public/grid/saveProgress">
    <input type="hidden" name="grid_id" value="<?= htmlspecialchars($gridId); ?>">
    <div class="grid-container">
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
</form>
    </div>
    <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?= htmlspecialchars($_SESSION['message_type']); ?>">
                <?= htmlspecialchars($_SESSION['message']); ?>
            </div>
            <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>
    <div class="button-container">
        <button type="button" onclick="checkSolution()">Check Solution</button>
        <?php if (isset($_SESSION['user_id'])): ?>
            <button type="submit" form="crossword-form">Save Progress</button>
        <?php else: ?>
            <button type="button" disabled title="Log in to save progress">Save Progress</button>
        <?php endif; ?>
        <button type="button" onclick="window.location.href='/web/public/grid/viewGrids'">Return</button>
    </div>

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
