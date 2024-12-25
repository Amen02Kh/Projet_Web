<?php
class HomeController {
    public function index() {
        session_start();
        
        // Redirect based on role
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] === 'admin') {
                header("Location: /admin/dashboard");
                exit;
            } elseif ($_SESSION['role'] === 'registered') {
                header("Location: /dashboard");
                exit;
            }
        }

        // Render the view
        include '../app/views/home.php';
    }
}
