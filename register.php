<?php
require('includes/config.php');

$name = $email = $password = $confirmPassword = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validation
    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        $error = "All fields are required.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $error = "Name must contain only letters and spaces.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $password_hashed]);
            header("Location: login.php");
            exit;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                $error = "Email already exists.";
            } else {
                $error = "Database error: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        .toggle-password {
            float: right;
            margin-right: 10px;
            margin-top: -32px;
            position: relative;
            cursor: pointer;
        }

        .strength {
            text-align: left;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .weak { color: red; }
        .medium { color: orange; }
        .strong { color: green; }
    </style>
</head>
<body class="register-bg">
    <div class="form-container">
        <img src="img/doraemon.png" alt="Doraemon Logo" class="logo">
        <h2>Register</h2>
        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <input type="text" name="name" pattern="[A-Za-z\s]+" title="Only letters and spaces allowed" placeholder="Name" value="<?= htmlspecialchars($name) ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($email) ?>" required>

            <input type="password" name="password" id="password" placeholder="Password" required>
            <span class="toggle-password" onclick="togglePassword('password')">👁</span>
            <div id="strengthMessage" class="strength"></div>

            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
            <span class="toggle-password" onclick="togglePassword('confirm_password')">👁</span>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }

        document.getElementById("password").addEventListener("input", function () {
            const strengthText = document.getElementById("strengthMessage");
            const val = this.value;
            let strength = "weak";

            const hasLower = /[a-z]/.test(val);
            const hasUpper = /[A-Z]/.test(val);
            const hasNumber = /\d/.test(val);
            const hasSpecial = /[!@#$%^&*]/.test(val);

            if (val.length >= 8 && hasLower && hasUpper && hasNumber && hasSpecial) {
                strength = "strong";
            } else if (val.length >= 6 && ((hasLower && hasUpper) || (hasNumber && hasLower))) {
                strength = "medium";
            }

            strengthText.textContent = `Strength: ${strength}`;
            strengthText.className = `strength ${strength}`;
        });
    </script>
</body>
</html>
