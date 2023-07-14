<?php

// Application default settings

// Error reporting
use App\Console\BakeCommand;
use App\Console\ExampleCommand;
use App\Console\SetupCommand;

error_reporting(0);
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

// Timezone
date_default_timezone_set('Europe/Riga');

$settings = [];

// Error handler
$settings['error'] = [
    // Should be set to false for the production environment
    'display_error_details' => false,
    // Should be set to false for the test environment
    'log_errors' => true,
    // Display error details in error log
    'log_error_details' => true,
];

// Logger settings
$settings['logger'] = [
    // Log file location
    'path' => __DIR__ . '/../logs',
    // Default log level
    'level' => \Monolog\Level::Info,
];

// Database settings
$settings['db'] = [
    'driver' => \Cake\Database\Driver\Mysql::class,
    'host' => 'localhost',
    'encoding' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    // Enable identifier quoting
    'quoteIdentifiers' => true,
    // Set to null to use MySQL servers timezone
    'timezone' => null,
    // Disable meta data cache
    'cacheMetadata' => false,
    // Disable query logging
    'log' => false,
    // PDO options
    'flags' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Convert numeric values to strings when fetching.
        // Since PHP 8.1 integers and floats in result sets will be returned using native PHP types.
        // This option restores the previous behavior.
        PDO::ATTR_STRINGIFY_FETCHES => true,
    ],
];

// Console commands
$settings['commands'] = [
    ExampleCommand::class,
    SetupCommand::class,
    BakeCommand::class,
];

$settings['twig'] = [
    'path' => __DIR__ . '/../templates',
    'loader_path' => __DIR__ . '/../public',
    'loader_name' => 'public',
    'debug_enabled' => true,
    'cache_enabled' => true,
    'cache_path' => __DIR__ . '/../tmp/twig-cache',
];

$settings['assets'] = [
    'path' => __DIR__ . '/../public/assets',
    'url_base_path' => 'assets/',
    'cache_path' => __DIR__ . '/../tmp/twig-assets',
    'cache_name' => 'assets-cache',
    'minify' => 1,
];

$settings['session'] = [
    'name' => 'hloudBin',
    'cache_expire' => 1669067999,
];

$settings['files'] = [
    'upload_directory' => __DIR__ . '/../uploads',
];

return $settings;
