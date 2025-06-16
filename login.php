<?php
session_start();
require 'includes/config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'name' => $user['name'],
            'email' => $user['email']
        ];
        header('Location: dashboard.php');
        exit;
    } else {
        $errors[] = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Doraemon Login</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    .toggle-password {
      float: right;
      margin-right: 10px;
      margin-top: -32px;
      position: relative;
      cursor: pointer;
    }
  </style>
</head>
<body class="login-bg">
  <div class="form-container">
    <img src="img/doraemon.png" alt="Doraemon Logo" class="logo">
    <h2>Login</h2>
    <?php foreach ($errors as $error): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endforeach; ?>
    <form method="POST">
      <input type="email" name="email" placeholder="Email" required>

      <input type="password" name="password" id="password" placeholder="Password" required>
      <span class="toggle-password" onclick="togglePassword('password')">👁</span>

      <button type="submit">Login</button>
    </form>
    <p>No account? <a href="register.php">Register</a></p>
  </div>

  <script>
    function togglePassword(id) {
      const input = document.getElementById(id);
      input.type = input.type === "password" ? "text" : "password";
    }
  </script>
</body>
</html>
