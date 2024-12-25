<?php

require_once '../app/models/GridModel.php';

class GridController {
    private $pdo;
    private $gridModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->gridModel = new GridModel($pdo);
    }

    public function create() {
        

        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            echo "<script>alert('You need to log in to create a grid.'); window.location.href = '/web/public/user/login';</script>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle grid creation
            $gridName = htmlspecialchars($_POST['grid_name']);
            $rows = (int)$_POST['rows'];
            $cols = (int)$_POST['cols'];
            $horizontalClues = explode(",", $_POST['horizontal_clues']); // Convert comma-separated clues to an array
            $verticalClues = explode(",", $_POST['vertical_clues']); // Convert comma-separated clues to an array
            $gridData = json_decode($_POST['grid_data'], true); // Grid cell data as JSON
            $createdBy = $_SESSION['user_id']; // Get the logged-in user's ID

            try {
                // Use the GridModel to save the grid
                $this->gridModel->createGrid($gridName, $rows, $cols, $horizontalClues, $verticalClues, $gridData, $createdBy);
                echo "<script>alert('Grid created successfully!'); window.location.href = '/web/app/views/create_grid.php';</script>";
            } catch (Exception $e) {
                echo "<script>alert('Error creating the grid: " . $e->getMessage() . "');</script>";
            }
        }

        // Include the view
        include '../app/views/create_grid.php';
    }
    public function viewGrids() {
        // Default sort parameters
        $sortBy = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'created_at';
        $order = ($sortBy === 'difficulty') ? 'ASC' : 'DESC';

        // Validate sort parameter
        if (!in_array($sortBy, ['created_at', 'difficulty'])) {
            $sortBy = 'created_at';
        }

        // Fetch grids from the model
        $grids = $this->gridModel->getGrids($sortBy, $order);

        // Include the view
        include '../app/views/view_grids.php';
    }
    public function solveGrid() {
        

        // Check if grid_id is provided
        if (!isset($_GET['grid_id']) || empty($_GET['grid_id'])) {
            die("Grid ID is missing.");
        }

        $gridId = $_GET['grid_id'];
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $gridDimensions = $this->gridModel->getGridDimensions($gridId);
        $rows = $gridDimensions['rows'];
        $columns = $gridDimensions['columns'];
        // Fetch grid data and clues
        $gridData = $this->gridModel->getGridCells($gridId);
        $definitions = $this->gridModel->getDefinitions($gridId);

        // Fetch user progress if logged in
        $currentState = [];
        if ($userId) {
            $currentState = $this->gridModel->getUserProgress($userId, $gridId);
        }

        // Include the view
        include '../app/views/solve_grid.php';
    }
    public function saveProgress() {
        session_start();

        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: /web/public/user/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $gridId = intval($_POST['grid_id']);
            $gridState = json_encode($_POST['grid']); // Convert grid state to JSON

            try {
                // Save or update progress in the database
                if ($this->gridModel->progressExists($userId, $gridId)) {
                    $this->gridModel->updateProgress($userId, $gridId, $gridState);
                    $_SESSION['message'] = "Progress updated successfully.";
                } else {
                    $this->gridModel->saveProgress($userId, $gridId, $gridState);
                    $_SESSION['message'] = "Progress saved successfully.";
                }

                $_SESSION['message_type'] = "success";
            } catch (Exception $e) {
                $_SESSION['message'] = "Error saving progress: " . $e->getMessage();
                $_SESSION['message_type'] = "error";
            }

            // Redirect back to the grid solving page
            header("Location: /web/public/grid/solveGrid?grid_id=$gridId");
            exit;
        }
    }
    public function viewProgress() {
       

        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: /web/public/user/login");
            exit;
        }

        $userId = $_SESSION['user_id'];
        $message = null;

        // Handle deletion of progress
        if (isset($_GET['delete_progress'])) {
            $progressId = intval($_GET['delete_progress']);
            try {
                $this->gridModel->deleteProgress($progressId, $userId);
                $_SESSION['message'] = "Progress deleted successfully.";
                $_SESSION['message_type'] = "success";
            } catch (Exception $e) {
                $_SESSION['message'] = "Error deleting progress: " . $e->getMessage();
                $_SESSION['message_type'] = "error";
            }
            header("Location: /web/public/grid/viewProgress");
            exit;
        }

        // Fetch in-progress grids for the user
        $gridsInProgress = $this->gridModel->getInProgressGrids($userId);

        // Include the view
        include '../app/views/progress.php';
    }
}
