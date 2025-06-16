<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doraemon Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        body.dashboard-bg {
            display: flex;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            width: 220px;
            background-color: rgba(255, 255, 255, 0.9);
            height: 100vh;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar .logo {
            width: 80px;
            margin-bottom: 20px;
        }

        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 20px;
            color: #2196f3;
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            margin: 10px 0;
            font-weight: bold;
            transition: color 0.2s;
        }

        .sidebar a:hover {
            color: #2196f3;
        }

        .main-content {
            flex: 1;
            padding: 40px;
            background: url('../img/dora.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.95);
            color: #333;
            padding: 30px;
            border-radius: 15px;
            max-width: 600px;
            box-shadow: 0 0 15px #2196f3;
        }

        .card h1 {
            margin-top: 0;
        }

        .logout-btn {
            background-color: #2196f3;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 30px;
            text-decoration: none;
            display: inline-block;
        }

        .logout-btn:hover {
            background-color: #0d8bf2;
        }
    </style>
</head>
<body class="dashboard-bg">
    <div class="sidebar">
        <img src="img/doraemon.png" alt="Logo" class="logo">
        <h2><?= htmlspecialchars($user['name']) ?></h2>
        <a href="#">Dashboard</a>
        <a href="#">Profile</a>
        <a href="#">Settings</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
    <div class="main-content">
        <div class="card">
            <h1>Welcome, <?= htmlspecialchars($user['name']) ?>!</h1>
            <p>You are now logged in to your Doraemon Dashboard. Enjoy the tools, updates, and more!</p>
        </div>
    </div>
</body>
</html>
