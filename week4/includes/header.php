<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System - <?php echo $page_title ?? 'Home'; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="index.php">🏫 Student Management</a>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>