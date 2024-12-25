<?php

require_once '../app/models/GridModel.php';
require_once '../app/models/UserModel.php';

class AdminController {
    private $pdo;
    private $gridModel;
    private $userModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->gridModel = new GridModel($pdo);
        $this->userModel = new UserModel($pdo);
    }

    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the user is an admin
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            die("Access denied. Admins only.");
        }

        // Handle deleting a grid
        if (isset($_GET['delete_grid'])) {
            $gridId = intval($_GET['delete_grid']);
            $this->gridModel->deleteGrid($gridId);
            $_SESSION['message'] = "Grid deleted successfully.";
            $_SESSION['message_type'] = "success";
            header("Location: /web/public/admin/dashboard");
            exit;
        }

        // Handle deleting a user
        if (isset($_GET['delete_user'])) {
            $userId = intval($_GET['delete_user']);
            $this->userModel->deleteUser($userId);
            $_SESSION['message'] = "User deleted successfully.";
            $_SESSION['message_type'] = "success";
            header("Location: /web/public/admin/dashboard");
            exit;
        }

        // Handle adding a user
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
            $role = $_POST['role'];

            if (!empty($username) && !empty($email) && !empty($password) && in_array($role, ['registered', 'admin'])) {
                $this->userModel->addUser($username, $email, $password, $role);
                $_SESSION['message'] = "User added successfully.";
                $_SESSION['message_type'] = "success";
                header("Location: /web/public/admin/dashboard");
                exit;
            } else {
                $_SESSION['message'] = "Invalid input. Please ensure all fields are filled correctly.";
                $_SESSION['message_type'] = "error";
            }
        }

        // Fetch all grids and users
        $grids = $this->gridModel->getAllGrids();
        $users = $this->userModel->getAllUsersExcept($_SESSION['user_id']);

        // Include the view
        include '../app/views/admin_dashboard.php';
    }
}
