<?php

class HomeController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Redirect based on role
        $basePath = '/web/public'; // Adjust this to match your project structure

        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] === 'admin') {
                header("Location: $basePath/admin/dashboard");
                exit;
            } elseif ($_SESSION['role'] === 'registered') {
                header("Location: $basePath/dashboard");
                exit;
            }
        }

        // Render the home view
        include '../app/views/home.php';
    }
}
