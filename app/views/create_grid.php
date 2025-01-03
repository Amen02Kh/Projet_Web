<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Crossword Grid</title>
    <link rel="stylesheet" href="/web/public/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f9;
        }

        header {
            text-align: center;
            background-color: #0078d7;
            color: white;
            font-size: 1.2rem;
        }

        form {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .grid-wrapper {
            display: inline-block;
            margin: 20px 0;
            padding-left: 30px;
            padding-top: 30px;
            position: relative;
        }

        .grid-container {
            display: grid;
            gap: 2px;
        }

        .cell {
            width: 30px;
            height: 30px;
            text-align: center;
            background-color: white;
            border: 1px solid #ccc;
            font-size: 1rem;
            cursor: pointer;
        }

        .cell.black {
            background-color: #333;
        }

        .row-label, .col-label {
            position: absolute;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            color: #666;
            
        }

        .row-label {
            left: 0;
            margin-top:2px;
        }

        .col-label {
            top: 0;
            margin-left:2px;
        }

        button {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            background-color: #0078d7;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005bb5;
        }
    </style>
</head>
<body>
    <header>
        Create Crossword Grid
    </header>

    <form method="post" action="/web/public/grid/create">
        <div class="form-group">
            <label for="grid_name">Grid Name:</label>
            <input type="text" id="grid_name" name="grid_name" required>
        </div>
        <div class="form-group">
            <label for="rows">Rows:</label>
            <input type="number" id="rows" name="rows" min="5" max="20" value="10" required>
        </div>
        <div class="form-group">
            <label for="cols">Columns:</label>
            <input type="number" id="cols" name="cols" min="5" max="20" value="10" required>
        </div>
        <button type="button" onclick="generateGrid()">Generate Grid</button>
        <div class="form-group">
            <label>Grid:</label>
            <div class="grid-wrapper">
                <div id="grid-container" class="grid-container"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="horizontal_clues">Horizontal Clues (Comma-separated):</label>
            <textarea id="horizontal_clues" name="horizontal_clues" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="vertical_clues">Vertical Clues (Comma-separated):</label>
            <textarea id="vertical_clues" name="vertical_clues" rows="4" required></textarea>
        </div>

        <input type="hidden" id="grid_data" name="grid_data">
        
        <button type="submit">Save Grid</button>
        <button type="button" onclick="window.location.href='/web/public/dashboard'">Return</button>
    </form>

    <script>
        function generateGrid() {
            const rows = parseInt(document.getElementById("rows").value);
            const cols = parseInt(document.getElementById("cols").value);
            const container = document.getElementById("grid-container");
            const wrapper = container.parentElement;
            
            // Clear previous grid and labels
            container.innerHTML = "";
            const oldLabels = wrapper.querySelectorAll('.row-label, .col-label');
            oldLabels.forEach(label => label.remove());

            container.style.gridTemplateColumns = `repeat(${cols}, 30px)`;
            container.style.gridTemplateRows = `repeat(${rows}, 30px)`;
            
            // Add column labels (A, B, C, ...)
            for (let c = 0; c < cols; c++) {
                const label = document.createElement("div");
                label.classList.add("col-label");
                label.textContent = String.fromCharCode(65 + c);
                label.style.left = `${30 * c + 30}px`;
                wrapper.appendChild(label);
            }

            // Add row labels (1, 2, 3, ...)
            for (let r = 0; r < rows; r++) {
                const label = document.createElement("div");
                label.classList.add("row-label");
                label.textContent = r + 1;
                label.style.top = `${30 * r + 30}px`;
                wrapper.appendChild(label);
            }
            
            for (let r = 1; r <= rows; r++) {
                for (let c = 1; c <= cols; c++) {
                    const cell = document.createElement("div");
                    cell.classList.add("cell");
                    cell.dataset.row = r;
                    cell.dataset.col = c;

                    cell.onclick = () => {
                        if (cell.classList.contains("black")) {
                            cell.classList.remove("black");
                            cell.textContent = "";
                        } else {
                            cell.classList.add("black");
                            cell.textContent = "";
                        }
                    };

                    cell.contentEditable = !cell.classList.contains("black");

                    container.appendChild(cell);
                }
            }
        }

        function saveGridData() {
            const cells = document.querySelectorAll(".grid-container .cell");
            const gridData = [];

            cells.forEach(cell => {
                gridData.push({
                    row: cell.dataset.row,
                    col: cell.dataset.col,
                    is_black: cell.classList.contains("black") ? 1 : 0,
                    solution: cell.textContent || null,
                });
            });

            document.getElementById("grid_data").value = JSON.stringify(gridData);
        }

        document.querySelector("form").addEventListener("submit", saveGridData);
    </script>
</body>
</html>