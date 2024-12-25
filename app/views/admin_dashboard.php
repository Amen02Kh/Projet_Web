<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/web/public/style.css">
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
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?= htmlspecialchars($_SESSION['message_type']); ?>">
                <?= htmlspecialchars($_SESSION['message']); ?>
            </div>
            <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>

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
                        <td><?= htmlspecialchars($grid['difficulty']); ?></td>
                        <td>
                            <a href="?delete_grid=<?= $grid['id']; ?>" class="btn">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

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
                        <td><?= htmlspecialchars($user['role']); ?></td>
                        <td>
                            <a href="?delete_user=<?= $user['id']; ?>" class="btn">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Add User</h2>
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
    <a href="/web/public/user/logout" class="btn">Logout</a>
</body>
</html>
