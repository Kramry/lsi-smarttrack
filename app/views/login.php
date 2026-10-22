<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            margin: 0;
            color: #1f2937;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #00000012;
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #123b68;
            margin-top: 0;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 20px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            font-size: 20px;
            color: #666;
        }

        .toggle-password:hover {
            color: #123b68;
        }

        button[type="submit"] {
            width: 100%;
            background: #123b68;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background: #0d2d4f;
        }

        .error {
            background: #fee;
            color: #c33;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #fcc;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #123b68;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>LSI SmartTrack Login</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= base_url('login') ?>">
        <label>Email</label>
        <input type="email" name="username" required>

        <label>Password</label>
        <div class="password-container">
            <input type="password" name="password" id="password" required>
            <button type="button" class="toggle-password" onclick="togglePassword()">👁️</button>
        </div>

        <button type="submit">Login</button>
    </form>

    <div class="login-link">
        Don't have an account? <a href="<?= base_url('register') ?>">Register here</a>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleButton = passwordInput.nextElementSibling;

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.textContent = '🙈';
    } else {
        passwordInput.type = 'password';
        toggleButton.textContent = '👁️';
    }
}
</script>

</body>
</html>
