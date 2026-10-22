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

        .register-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #00000012;
            width: 100%;
            max-width: 450px;
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
        input[type="email"],
        input[type="password"],
        select {
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

        .error {
            background: #fee;
            color: #c33;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #fcc;
        }

        .success {
            background: #efe;
            color: #3c3;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #cfc;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>LSI SmartTrack Register</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= base_url('register') ?>">
        <label>Full Name</label>
        <input type="text" name="full_name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Role</label>
        <select name="role" required>
            <option value="trainee">Trainee</option>
            <option value="instructor">Instructor</option>
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
        </select>

        <label>Password</label>
        <div class="password-container">
            <input type="password" name="password" id="password" required>
            <button type="button" class="toggle-password" onclick="togglePassword()">👁️</button>
        </div>

        <label>Confirm Password</label>
        <div class="password-container">
            <input type="password" name="confirm_password" id="confirm_password" required>
            <button type="button" class="toggle-password" onclick="toggleConfirmPassword()">👁️</button>
        </div>

        <button type="submit">Register</button>
    </form>

    <div class="login-link">
        Already have an account? <a href="<?= base_url('login') ?>">Login here</a>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleButton = document.querySelector('.password-container:nth-of-type(1) .toggle-password');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.textContent = '🙈';
    } else {
        passwordInput.type = 'password';
        toggleButton.textContent = '👁️';
    }
}

function toggleConfirmPassword() {
    const passwordInput = document.getElementById('confirm_password');
    const toggleButton = document.querySelector('.password-container:nth-of-type(2) .toggle-password');

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
