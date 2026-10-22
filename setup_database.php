<?php
// Simple database setup script
define('PREVENT_DIRECT_ACCESS', TRUE);
define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('SYSTEM_DIR', ROOT_DIR . 'scheme' . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . 'app' . DIRECTORY_SEPARATOR);

require_once SYSTEM_DIR . 'kernel/LavaLust.php';

// Get database instance
$db = LavaLust::instance()->db;

echo "Setting up database tables...\n";

// Load and run migrations manually
$migrations = [
    '000_initial_setup',
    '001_create_users_table',
    '002_create_training_programs_table',
    '003_create_classes_table',
    '004_create_class_enrollments_table',
    '005_create_attendance_table',
    '006_create_documents_table',
    '007_create_announcements_table',
    '008_create_inquiries_table',
    '009_create_inquiry_replies_table',
    '010_create_activity_logs_table'
];

foreach ($migrations as $migration) {
    $file = APP_DIR . 'migrations/' . $migration . '.php';
    if (file_exists($file)) {
        require_once $file;
        $class_name = str_replace(' ', '_', ucwords(str_replace('_', ' ', $migration)));
        $migration_obj = new $class_name();
        $migration_obj->up();
        echo "✓ Migration $migration completed\n";
    }
}

echo "\nDatabase setup completed!\n";
