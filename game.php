<?php
session_start();

// Initialize high score
if (!isset($_SESSION['high_score'])) {
    $_SESSION['high_score'] = 0;
}

// Update high score if received
if (isset($_POST['score'])) {
    $score = intval($_POST['score']);
    if ($score > $_SESSION['high_score']) {
        $_SESSION['high_score'] = $score;
        echo json_encode(['high_score' => $_SESSION['high_score']]);
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Snake Game</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        #game-container {
            margin: 20px;
        }
        canvas {
            border: 2px solid #333;
            background-color: #fff;
        }
        #score-container {
            margin: 10px;
            font-size: 20px;
        }
        .controls {
            margin: 15px;
            padding: 10px;
            background-color: #eee;
            border-radius: 5px;
        }
        #game-over {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            margin: 5px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Snake Game</h1>
    <div id="score-container">
        Score: <span id="score">0</span> | High Score: <span id="high-score"><?php echo $_SESSION['high_score']; ?></span>
    </div>
    <div id="game-container">
        <canvas id="gameCanvas" width="400" height="400"></canvas>
    </div>
    <div class="controls">
        <p>Use arrow keys or WASD to move</p>
        <button onclick="startGame()">New Game</button>
    </div>
    <div id="game-over">
        <h2>Game Over!</h2>
        <p>Your Score: <span id="final-score">0</span></p>
        <button onclick="startGame()">Play Again</button>
    </div>

    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');
        const gridSize = 20;
        const tileCount = canvas.width / gridSize;

        let snake = [];
        let food = {};
        let dx = gridSize;
        let dy = 0;
        let score = 0;
        let gameLoop = null;

        function startGame() {
            // Reset game state
            snake = [{x: 5 * gridSize, y: 5 * gridSize}];
            score = 0;
            dx = gridSize;
            dy = 0;
            document.getElementById('score').textContent = '0';
            document.getElementById('game-over').style.display = 'none';
            
            // Generate first food
            generateFood();
            
            // Clear previous game loop if exists
            if (gameLoop) clearInterval(gameLoop);
            
            // Start game loop
            gameLoop = setInterval(gameStep, 100);
        }

        function gameStep() {
            // Move snake
            const head = {x: snake[0].x + dx, y: snake[0].y + dy};
            
            // Check wall collision
            if (head.x < 0 || head.x >= canvas.width || head.y < 0 || head.y >= canvas.height) {
                gameOver();
                return;
            }
            
            // Check self collision
            for (let i = 0; i < snake.length; i++) {
                if (head.x === snake[i].x && head.y === snake[i].y) {
                    gameOver();
                    return;
                }
            }
            
            // Add new head
            snake.unshift(head);
            
            // Check food collision
            if (head.x === food.x && head.y === food.y) {
                score += 10;
                document.getElementById('score').textContent = score;
                generateFood();
            } else {
                snake.pop();
            }
            
            // Draw everything
            draw();
        }

        function draw() {
            // Clear canvas
            ctx.fillStyle = 'white';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            // Draw snake
            ctx.fillStyle = 'green';
            snake.forEach(segment => {
                ctx.fillRect(segment.x, segment.y, gridSize-2, gridSize-2);
            });
            
            // Draw food
            ctx.fillStyle = 'red';
            ctx.fillRect(food.x, food.y, gridSize-2, gridSize-2);
        }

        function generateFood() {
            food = {
                x: Math.floor(Math.random() * tileCount) * gridSize,
                y: Math.floor(Math.random() * tileCount) * gridSize
            };
            
            // Make sure food doesn't spawn on snake
            for (let segment of snake) {
                if (food.x === segment.x && food.y === segment.y) {
                    generateFood();
                    return;
                }
            }
        }

        function gameOver() {
            clearInterval(gameLoop);
            document.getElementById('game-over').style.display = 'block';
            document.getElementById('final-score').textContent = score;
            
            // Update high score in PHP session
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'score=' + score
            })
            .then(response => response.json())
            .then(data => {
                if (data.high_score) {
                    document.getElementById('high-score').textContent = data.high_score;
                }
            });
        }

        // Handle keyboard input
        document.addEventListener('keydown', function(event) {
            switch(event.key) {
                case 'ArrowUp':
                case 'w':
                    if (dy === 0) {
                        dx = 0;
                        dy = -gridSize;
                    }
                    break;
                case 'ArrowDown':
                case 's':
                    if (dy === 0) {
                        dx = 0;
                        dy = gridSize;
                    }
                    break;
                case 'ArrowLeft':
                case 'a':
                    if (dx === 0) {
                        dx = -gridSize;
                        dy = 0;
                    }
                    break;
                case 'ArrowRight':
                case 'd':
                    if (dx === 0) {
                        dx = gridSize;
                        dy = 0;
                    }
                    break;
            }
        });

        // Start the game when the page loads
        startGame();
    </script>
</body>
</html>