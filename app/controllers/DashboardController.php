<?php

class DashboardController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Redirect to login if user is not authenticated
        if (!isset($_SESSION['user_id'])) {
            header("Location: /web/public/user/login");
            exit;
        }

        // Pass necessary data to the view (like username)
        $username = $_SESSION['username'];

        // Include the view
        include '../app/views/dashboard.php';
    }
}
