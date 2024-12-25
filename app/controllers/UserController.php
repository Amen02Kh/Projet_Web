<?php

require_once '../app/models/UserModel.php'; // Include UserModel at the top

class UserController {
    private $pdo;
    private $userModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new UserModel($this->pdo); // Instantiate UserModel in the constructor
    }

    public function register() {
        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Secure password hashing

            if (empty($username) || empty($email) || empty($password)) {
                $error = "Veuillez remplir tous les champs.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Veuillez fournir une adresse email valide.";
            } else {
                // Use the UserModel to handle the database operations
                if ($this->userModel->userExists($username, $email)) {
                    $error = "Le nom d'utilisateur ou l'email existe déjà.";
                } else {
                    $this->userModel->registerUser($username, $email, $hashedPassword);
                    $success = "Inscription réussie. Vous pouvez maintenant vous connecter.";
                }
            }
        }

        // Include the register view
        include '../app/views/register.php';
    }

    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $error = null;

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            // Fetch user by username
            $user = $this->userModel->getUserByUsername($username);

            // Verify password
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header("Location: /web/public/admin/dashboard");
                } else {
                    header("Location: /web/public/dashboard");
                }
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        }

        // Include the login view
        include '../app/views/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();

        // Redirect to the home page
        header("Location: /web/public");
        exit;
    }
}
