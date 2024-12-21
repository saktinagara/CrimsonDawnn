<?php
include 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$berita_id = $_POST['berita_id'] ?? null;
$reaction_type = $_POST['reaction_type'] ?? null;
$user_ip = $_SERVER['REMOTE_ADDR'];

if (!$berita_id || !$reaction_type) {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
    exit;
}

// Check if user has already reacted
$check_sql = "SELECT id, reaction_type FROM berita_reactions 
              WHERE berita_id = ? AND user_ip = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("is", $berita_id, $user_ip);
$check_stmt->execute();
$existing_reaction = $check_stmt->get_result()->fetch_assoc();

if ($existing_reaction) {
    if ($existing_reaction['reaction_type'] === $reaction_type) {
        // Remove reaction if clicking the same button
        $sql = "DELETE FROM berita_reactions WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $existing_reaction['id']);
    } else {
        // Update reaction if changing from like to dislike or vice versa
        $sql = "UPDATE berita_reactions SET reaction_type = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $reaction_type, $existing_reaction['id']);
    }
} else {
    // Insert new reaction
    $sql = "INSERT INTO berita_reactions (berita_id, user_ip, reaction_type) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $berita_id, $user_ip, $reaction_type);
}

$success = $stmt->execute();

if ($success) {
    // Get updated counts
    $count_sql = "SELECT 
        SUM(CASE WHEN reaction_type = 'like' THEN 1 ELSE 0 END) as likes,
        SUM(CASE WHEN reaction_type = 'dislike' THEN 1 ELSE 0 END) as dislikes
        FROM berita_reactions 
        WHERE berita_id = ?";
    
    $count_stmt = $conn->prepare($count_sql);
    $count_stmt->bind_param("i", $berita_id);
    $count_stmt->execute();
    $counts = $count_stmt->get_result()->fetch_assoc();
    
    // Get user's current reaction status
    $user_sql = "SELECT reaction_type FROM berita_reactions 
                 WHERE berita_id = ? AND user_ip = ?";
    $user_stmt = $conn->prepare($user_sql);
    $user_stmt->bind_param("is", $berita_id, $user_ip);
    $user_stmt->execute();
    $user_reaction = $user_stmt->get_result()->fetch_assoc();
    
    echo json_encode([
        'success' => true,
        'likes' => $counts['likes'] ?? 0,
        'dislikes' => $counts['dislikes'] ?? 0,
        'userReaction' => $user_reaction ? $user_reaction['reaction_type'] : null
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update reaction']);
}

$conn->close();
?>