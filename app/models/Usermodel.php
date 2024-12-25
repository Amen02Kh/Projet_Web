<?php

class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Fetch a user by username.
     *
     * @param string $username
     * @return array|null
     */
    public function getUserByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Returns user data or null
    }
    public function getAllUsersExcept($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id != ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUser($userId) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$userId]);
    }

    public function addUser($username, $email, $password, $role) {
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password, $role]);
    }
       // Check if a user exists by username or email
       public function userExists($username, $email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        return $stmt->fetch() !== false;
    }

    // Register a new user
    public function registerUser($username, $email, $hashedPassword) {
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'registered')");
        $stmt->execute([$username, $email, $hashedPassword]);
    }
  
}
