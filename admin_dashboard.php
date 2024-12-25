<?php
require 'config.php';
session_start();

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}

// Handle deleting a grid
if (isset($_GET['delete_grid'])) {
    $gridId = intval($_GET['delete_grid']);
    $stmt = $pdo->prepare("DELETE FROM crossword_grids WHERE id = ?");
    $stmt->execute([$gridId]);
    $_SESSION['message'] = "Grid deleted successfully.";
    $_SESSION['message_type'] = "success";
    header("Location: admin_dashboard.php");
    exit;
}

// Handle deleting a user
if (isset($_GET['delete_user'])) {
    $userId = intval($_GET['delete_user']);
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $_SESSION['message'] = "User deleted successfully.";
    $_SESSION['message_type'] = "success";
    header("Location: admin_dashboard.php");
    exit;
}

// Handle adding a user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $role = $_POST['role'];

    if (!empty($username) && !empty($email) && !empty($password) && in_array($role, ['registered', 'admin'])) {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password, $role]);
        $_SESSION['message'] = "User added successfully.";
        $_SESSION['message_type'] = "success";
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $_SESSION['message'] = "Invalid input. Please ensure all fields are filled correctly.";
        $_SESSION['message_type'] = "error";
    }
}

// Fetch all grids
$grids = $pdo->query("SELECT * FROM crossword_grids ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch all users except the current admin
$users = $pdo->prepare("SELECT * FROM users WHERE id != ?");
$users->execute([$_SESSION['user_id']]);
$users = $users->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #0078d7;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .container {
            margin-left: auto;
        }

        h2 {
            color: #0078d7;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #0078d7;
            color: white;
        }

        button, .btn {
            padding: 8px 16px;
            margin: 5px;
            background-color: #0078d7;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        button:hover, .btn:hover {
            background-color: #005bb5;
        }

        .form-container {
            margin-bottom: 20px;
        }

        input, select {
            padding: 8px;
            margin: 5px;
            width: calc(100% - 20px);
            font-size: 1rem;
        }

        .message {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>
    <div class="container">
        <!-- Display Messages -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?= $_SESSION['message_type']; ?>">
                <?= htmlspecialchars($_SESSION['message']); ?>
            </div>
            <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>

        <!-- Manage Grids -->
        <h2>Manage Grids</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Dimensions</th>
                    <th>Difficulty</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($grids as $grid): ?>
                    <tr>
                        <td><?= htmlspecialchars($grid['name']); ?></td>
                        <td><?= htmlspecialchars($grid['dimensions']); ?></td>
                        <td><?= ucfirst(htmlspecialchars($grid['difficulty'])); ?></td>
                        <td>
                            <a href="?delete_grid=<?= $grid['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this grid?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Manage Users -->
        <h2>Manage Users</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['username']); ?></td>
                        <td><?= htmlspecialchars($user['email']); ?></td>
                        <td><?= ucfirst(htmlspecialchars($user['role'])); ?></td>
                        <td>
                            <a href="?delete_user=<?= $user['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Add User Form -->
        <h2>Add User</h2>
        <div class="form-container">
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role">
                    <option value="registered">Registered</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit">Add User</button>
            </form>
        </div>
    </div>
    <a href="logout.php" class="btn">Logout</a>
</body>
</html>
