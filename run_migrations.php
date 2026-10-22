<?php
// Standalone migration runner
define('PREVENT_DIRECT_ACCESS', TRUE);
define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('SYSTEM_DIR', ROOT_DIR . 'scheme' . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . 'app' . DIRECTORY_SEPARATOR);

require_once SYSTEM_DIR . 'kernel/LavaLust.php';

require_once APP_DIR . 'config' . DIRECTORY_SEPARATOR . 'migration.php';
require_once SYSTEM_DIR . 'libraries' . DIRECTORY_SEPARATOR . 'Migration.php';

$migration = new Migration();
$migration->migrate();
