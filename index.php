<?php
session_start();

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Doraemon Portal - Home</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('img/dora.jpg') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 0;
    }

    .homepage-container {
      background: rgba(255, 255, 255, 0.9);
      width: 400px;
      margin: 10% auto;
      padding: 40px;
      text-align: center;
      border-radius: 20px;
      box-shadow: 0 0 20px #2196f3;
    }

    .homepage-container img {
      width: 100px;
      height: auto;
      margin-bottom: 20px;
    }

    h1 {
      margin-bottom: 10px;
      color: #333;
    }

    p {
      margin-bottom: 20px;
      color: #555;
    }

    .homepage-container a button {
      padding: 10px 20px;
      margin: 10px;
      font-size: 16px;
      background-color: #2196f3;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .homepage-container a button:hover {
      background-color: #0d8bf2;
    }
  </style>
</head>
<body>
  <div class="homepage-container">
    <img src="img/doraemon.png" alt="Doraemon Logo" />
    <h1>Welcome to Doraemon Portal</h1>
    <p>Your gateway to a smarter future!</p>
    <a href="register.php"><button>Register</button></a>
    <a href="login.php"><button>Login</button></a>
  </div>
</body>
</html>
