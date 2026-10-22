<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LSI SmartTrack</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            margin: 0;
            color: #1f2937;
        }

        header {
            background: #123b68;
            color: white;
            padding: 24px;
            text-align: center;
        }

        main {
            max-width: 900px;
            margin: 40px auto;
            padding: 24px;
        }

        .panel {
            background: white;
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #00000012;
        }

        .button {
            display: inline-block;
            background: #123b68;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            margin-right: 10px;
        }

        .button-outline {
            display: inline-block;
            background: transparent;
            color: #123b68;
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            border: 2px solid #123b68;
        }

        .button-outline:hover {
            background: #123b68;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <h1>LSI SmartTrack</h1>
        <p>QR-Based Real-time Attendance and LSI Trainees Monitoring System</p>
    </header>

    <main>
        <section class="panel">
            <h2>Welcome to SmartTrack</h2>
            <p>
                Monitor trainee attendance, manage training programs,
                and access attendance records in one place.
            </p>
            <a href="<?= base_url('login') ?>" class="button">Login</a>
            <a href="<?= base_url('register') ?>" class="button-outline">Register</a>
        </section>
    </main>
</body>
</html>
