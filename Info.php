<?php
include 'config.php';

// Function to get reaction counts
function getReactionCounts($berita_id, $conn) {
    $sql = "SELECT 
        SUM(CASE WHEN reaction_type = 'like' THEN 1 ELSE 0 END) as likes,
        SUM(CASE WHEN reaction_type = 'dislike' THEN 1 ELSE 0 END) as dislikes
        FROM berita_reactions 
        WHERE berita_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $berita_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $counts = $result->fetch_assoc();
    
    return [
        'likes' => $counts['likes'] ?? 0,
        'dislikes' => $counts['dislikes'] ?? 0
    ];
}

// Function to check if user has already reacted
function getUserReaction($berita_id, $user_ip, $conn) {
    $sql = "SELECT reaction_type FROM berita_reactions WHERE berita_id = ? AND user_ip = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $berita_id, $user_ip);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        return $row['reaction_type'];
    }
    return null;
}

$sql = "SELECT * FROM berita ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Berita</title>
    <link rel="stylesheet" href="css/info-style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    /* Tambahkan ini di dalam tag <style> yang sudah ada */
body {
    font-family: 'Montserrat', sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 20px;
    background-color: #000;
    color: #333;
}

h1 {
    text-align: center;
    color: #57c5b6;
    margin-bottom: 30px;
}

.berita-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
}

.card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    overflow: hidden;
}

.card-image {
    width: 100%;
    height: 280px;
    object-fit: cover;
}

.card-header {
    background-color: #57c5b6;
    padding: 10px 15px;
}

.card-header h2 {
    color: #fff;
    margin: 0;
    font-size: 1.2rem;
}

.card-body {
    padding: 15px;
    font-size: 0.9rem;
}

.timestamp {
    padding: 8px 15px;
    color: #666;
    font-size: 0.8rem;
    border-top: 1px solid #eee;
    display: flex;
    align-items: center;
    gap: 5px;
}

.reaction-buttons {
    display: flex;
    gap: 10px;
    padding: 10px 15px;
    background-color: #f8f9fa;
    border-top: 1px solid #eee;
}

.reaction-btn {
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 5px 10px;
    border: none;
    background: none;
    cursor: pointer;
    color: #666;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.reaction-btn:hover {
    color: #57c5b6;
}

.reaction-btn.active-like {
    color: #57c5b6;
}

.reaction-btn.active-dislike {
    color: #ff6b6b;
}

.reaction-count {
    font-size: 0.8em;
}

footer {
    text-align: center;
    padding: 20px;
    color: #57c5b6;
    margin-top: 40px;
}

.back-button {
    position: fixed;
    top: 20px;
    left: 20px;
    padding: 10px 20px;
    background-color: #57c5b6;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 5px;
    z-index: 1000;
}

.back-button:hover {
    background-color: #45a497;
}
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <h1><a href="welcome.php">Crimson Dawn</a></h1>
            <nav class="global-nav">
                <ul>
                    <li><a href="#beranda">About Us</a></li>
                    <li><a href="#main-co">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="index.php">Sign up</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="content-wrapper">
        <a href="javascript:history.back()" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        
        <h1>Info Berita</h1>

        <div class="berita-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $hasImage = !empty($row['gambar']);
                    $cardClass = $hasImage ? 'card card-with-image' : 'card';
                    $reactions = getReactionCounts($row['id'], $conn);
                    $userReaction = getUserReaction($row['id'], $_SERVER['REMOTE_ADDR'], $conn);
                    
                    echo "<div class='$cardClass'>";
                    
                    if ($hasImage) {
                        echo "<img src='" . htmlspecialchars($row['gambar']) . "' alt='Gambar Berita' class='card-image'>";
                    }
                    
                    echo "<div class='card-header'>";
                    echo "<h2>" . htmlspecialchars($row['judul']) . "</h2>";
                    echo "</div>";
                    
                    echo "<div class='card-body'>";
                    echo "<p>" . htmlspecialchars($row['konten']) . "</p>";
                    echo "</div>";
                    
                    echo "<div class='timestamp'>";
                    echo "<i class='far fa-clock'></i> " . date('d-m-Y H:i', strtotime($row['tanggal']));
                    echo "</div>";

                    // Add reaction buttons
                    echo "<div class='reaction-buttons'>";
                    $likeActiveClass = ($userReaction === 'like') ? 'active-like' : '';
                    $dislikeActiveClass = ($userReaction === 'dislike') ? 'active-dislike' : '';
                    
                    echo "<button class='reaction-btn like-btn {$likeActiveClass}' data-berita-id='{$row['id']}' data-type='like'>";
                    echo "<i class='fas fa-thumbs-up'></i>";
                    echo "<span class='reaction-count like-count'>{$reactions['likes']}</span>";
                    echo "</button>";
                    
                    echo "<button class='reaction-btn dislike-btn {$dislikeActiveClass}' data-berita-id='{$row['id']}' data-type='dislike'>";
                    echo "<i class='fas fa-thumbs-down'></i>";
                    echo "<span class='reaction-count dislike-count'>{$reactions['dislikes']}</span>";
                    echo "</button>";
                    echo "</div>";
                    
                    echo "</div>";
                }
            } else {
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<p>Tidak ada berita yang tersedia.</p>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>

        <footer>
            <p>&copy; <?= date('Y') ?> Info Berita. Semua hak dilindungi.</p>
        </footer>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const reactionButtons = document.querySelectorAll('.reaction-btn');
        
        reactionButtons.forEach(button => {
            button.addEventListener('click', async function() {
                const beritaId = this.dataset.beritaId;
                const reactionType = this.dataset.type;
                
                try {
                    const response = await fetch('handle_reaction.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `berita_id=${beritaId}&reaction_type=${reactionType}`
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        // Update reaction counts
                        const card = this.closest('.card');
                        card.querySelector('.like-count').textContent = data.likes;
                        card.querySelector('.dislike-count').textContent = data.dislikes;
                        
                        // Update active states
                        const likeBtn = card.querySelector('.like-btn');
                        const dislikeBtn = card.querySelector('.dislike-btn');
                        
                        likeBtn.classList.toggle('active-like', data.userReaction === 'like');
                        dislikeBtn.classList.toggle('active-dislike', data.userReaction === 'dislike');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });
    });
    </script>
</body>
</html>

<?php $conn->close(); ?>