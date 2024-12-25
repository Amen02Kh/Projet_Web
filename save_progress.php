<?php
require 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $gridId = intval($_POST['grid_id']);
    $gridState = json_encode($_POST['grid']); // Convert grid state to JSON

    try {
        // Check if the progress already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_grids WHERE user_id = ? AND grid_id = ?");
        $stmt->execute([$userId, $gridId]);
        $exists = $stmt->fetchColumn();

        if ($exists) {
            // Update the existing progress
            $stmt = $pdo->prepare("UPDATE user_grids SET state = ?, updated_at = NOW() WHERE user_id = ? AND grid_id = ?");
            $stmt->execute([$gridState, $userId, $gridId]);
            $_SESSION['message'] = "Progress updated successfully.";
        } else {
            // Insert new progress
            $stmt = $pdo->prepare("INSERT INTO user_grids (user_id, grid_id, state) VALUES (?, ?, ?)");
            $stmt->execute([$userId, $gridId, $gridState]);
            $_SESSION['message'] = "Progress saved successfully.";
        }

        $_SESSION['message_type'] = "success";
    } catch (Exception $e) {
        $_SESSION['message'] = "Error saving progress: " . $e->getMessage();
        $_SESSION['message_type'] = "error";
    }

    header("Location: solve_grid.php?grid_id=$gridId");
    exit;
}
?>
