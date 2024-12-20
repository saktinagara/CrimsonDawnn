// navbar.php
<div class="sidenav">
    <div class="nav-brand">Admin Panel</div>
    <div class="nav-links">
        <a href="dashboard.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'class="active"' : ''; ?>>
            Dashboard Berita
        </a>
        <a href="admin.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'admin.php') ? 'class="active"' : ''; ?>>
            Data Laporan
        </a>
    </div>
    <a href="index.php" class="logout-btn">Log out</a>
</div>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    display: flex;
    min-height: 100vh;
}

.sidenav {
    width: 250px;
    height: 100vh;
    background-color: #333;
    position: fixed;
    left: 0;
    top: 0;
    display: flex;
    flex-direction: column;
    padding: 20px 0;
}

.nav-brand {
    color: white;
    font-size: 1.5rem;
    padding: 20px;
    text-align: center;
    border-bottom: 1px solid #444;
    margin-bottom: 20px;
}

.nav-links {
    flex: 1;
}

.sidenav a {
    display: block;
    color: white;
    text-decoration: none;
    padding: 15px 25px;
    margin: 5px 15px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.sidenav a:hover {
    background-color: #555;
}

.sidenav a.active {
    background-color: #4CAF50;
}

.sidenav .logout-btn {
    background-color: #f44336;
    margin-top: auto;
    margin-bottom: 20px;
}

.sidenav .logout-btn:hover {
    background-color: #d32f2f;
}

/* Main content wrapper style for dashboard.php and admin.php */
.container {
    margin-left: 250px;
    padding: 30px;
    width: calc(100% - 250px);
}

/* Ensuring tables don't overflow */
.table-container {
    overflow-x: auto;
}
</style>