<?php

class GridModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllGrids() {
        $stmt = $this->pdo->query("SELECT * FROM crossword_grids ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteGrid($gridId) {
        $stmt = $this->pdo->prepare("DELETE FROM crossword_grids WHERE id = ?");
        $stmt->execute([$gridId]);
    }
    public function createGrid($gridName, $rows, $cols, $horizontalClues, $verticalClues, $gridData, $createdBy) {
        $this->pdo->beginTransaction();

        try {
            // Insert grid into `crossword_grids`
            $stmt = $this->pdo->prepare("INSERT INTO crossword_grids (name, dimensions, created_by) VALUES (?, ?, ?)");
            $stmt->execute([$gridName, "{$rows}x{$cols}", $createdBy]);
            $gridId = $this->pdo->lastInsertId();

            // Insert grid cells into `grid_cells`
            $stmt = $this->pdo->prepare("INSERT INTO grid_cells (grid_id, row_num, col_num, is_black, solution) VALUES (?, ?, ?, ?, ?)");
            foreach ($gridData as $cell) {
                $stmt->execute([$gridId, $cell['row'], $cell['col'], $cell['is_black'], $cell['solution']]);
            }

            // Insert definitions into `definitions`
            $stmt = $this->pdo->prepare("INSERT INTO definitions (grid_id, orientation, row_or_col, definition) VALUES (?, ?, ?, ?)");
            foreach ($horizontalClues as $key => $clue) {
                $stmt->execute([$gridId, 'horizontal', $key + 1, htmlspecialchars(trim($clue))]);
            }
            foreach ($verticalClues as $key => $clue) {
                $stmt->execute([$gridId, 'vertical', $key + 1, htmlspecialchars(trim($clue))]);
            }

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
    public function getGridData($gridId) {
        $stmt = $this->pdo->prepare("SELECT * FROM grid_cells WHERE grid_id = ?");
        $stmt->execute([$gridId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGrids($sortBy, $order) {
        $stmt = $this->pdo->prepare("SELECT * FROM crossword_grids ORDER BY $sortBy $order");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGridCells($gridId) {
        $stmt = $this->pdo->prepare("SELECT * FROM grid_cells WHERE grid_id = ? ORDER BY row_num, col_num");
        $stmt->execute([$gridId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch definitions for a specific grid ID
    public function getDefinitions($gridId) {
        $stmt = $this->pdo->prepare("SELECT * FROM definitions WHERE grid_id = ?");
        $stmt->execute([$gridId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGridDimensions($gridId) {
        $stmt = $this->pdo->prepare("SELECT dimensions FROM crossword_grids WHERE id = ?");
        $stmt->execute([$gridId]);
        $dimension = $stmt->fetchColumn();

        if (!$dimension) {
            throw new Exception("Grid not found or dimensions missing.");
        }

        // Parse dimensions (e.g., "10x10" -> rows = 10, columns = 10)
        list($rows, $columns) = explode('x', $dimension);

        return [
            'rows' => (int) $rows,
            'columns' => (int) $columns,
        ];
    }
    // Fetch user progress for a specific grid and user
    public function getUserProgress($userId, $gridId) {
        $stmt = $this->pdo->prepare("SELECT state FROM user_grids WHERE user_id = ? AND grid_id = ?");
        $stmt->execute([$userId, $gridId]);
        $savedState = $stmt->fetchColumn();
        return $savedState ? json_decode($savedState, true) : [];
    }
    public function progressExists($userId, $gridId) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM user_grids WHERE user_id = ? AND grid_id = ?");
        $stmt->execute([$userId, $gridId]);
        return $stmt->fetchColumn() > 0;
    }

    // Save new progress
    public function saveProgress($userId, $gridId, $gridState) {
        $stmt = $this->pdo->prepare("INSERT INTO user_grids (user_id, grid_id, state) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $gridId, $gridState]);
    }

    // Update existing progress
    public function updateProgress($userId, $gridId, $gridState) {
        $stmt = $this->pdo->prepare("UPDATE user_grids SET state = ?, updated_at = NOW() WHERE user_id = ? AND grid_id = ?");
        $stmt->execute([$gridState, $userId, $gridId]);
    }
    public function getInProgressGrids($userId) {
        $stmt = $this->pdo->prepare("
            SELECT ug.id AS user_grid_id, cg.id AS grid_id, cg.name, cg.dimensions, cg.difficulty, ug.state 
            FROM user_grids ug
            JOIN crossword_grids cg ON ug.grid_id = cg.id
            WHERE ug.user_id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Delete a specific progress entry for a user
    public function deleteProgress($progressId, $userId) {
        $stmt = $this->pdo->prepare("DELETE FROM user_grids WHERE id = ? AND user_id = ?");
        $stmt->execute([$progressId, $userId]);
    }
}
