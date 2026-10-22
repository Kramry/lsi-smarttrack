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
        }

        header {
            background: #123b68;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #00000012;
            margin-bottom: 20px;
        }

        h1 { margin: 0; }
        h2 { color: #123b68; margin-top: 0; }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .stat-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #123b68;
        }

        .logout-btn {
            background: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>LSI SmartTrack - Staff</h1>
        <div>
            <span>Welcome, <?= $username ?></span>
            <a href="<?= base_url('/logout') ?>" class="logout-btn">Logout</a>
        </div>
    </header>

    <div class="container">
        <div class="card">
            <h2>Staff Dashboard</h2>
            <p>Manage attendance records and assist with trainee monitoring.</p>

            <div class="stats">
                <div class="stat-card">
                    <div class="stat-number">0</div>
                    <div>Today's Check-ins</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">0</div>
                    <div>Pending Requests</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">0</div>
                    <div>Active Classes</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
