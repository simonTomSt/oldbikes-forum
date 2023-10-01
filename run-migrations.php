<?php

require __DIR__ . "/vendor/autoload.php";

use App\Config\Paths;
use App\Core\Database;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();

$db = new Database([
    'dsn' => $_ENV['DB_DSN'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
]);

$migrationsDirectory = __DIR__ . "/migrations/";

// Get all migration files in the directory
$migrationFiles = scandir($migrationsDirectory);

// Sort migration files based on their names
sort($migrationFiles);

foreach ($migrationFiles as $migrationFile) {
    if (preg_match('/^m(\d+)_/', $migrationFile, $matches)) {
        $migrationNumber = $matches[1];
        $sqlFilePath = $migrationsDirectory . $migrationFile;

        // Check if the file is a valid migration file
        if (is_file($sqlFilePath) && pathinfo($sqlFilePath, PATHINFO_EXTENSION) === 'sql') {
            $sqlFile = file_get_contents($sqlFilePath);
            echo "Running migration: $migrationFile\n";
            $db->query($sqlFile);
            echo "Migration completed: $migrationFile\n";
        }
    }
}
