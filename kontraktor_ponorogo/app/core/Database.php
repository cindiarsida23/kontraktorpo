<?php

class Database
{
    private static ?PDO $instance = null;

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../../config/database.php';

            $baseDsn = sprintf(
                'mysql:host=%s;charset=%s',
                $config['host'],
                $config['charset']
            );

            $adminConnection = new PDO(
                $baseDsn,
                $config['username'],
                $config['password'],
                $config['options']
            );

            $adminConnection->exec(
                sprintf(
                    "CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci",
                    $config['dbname']
                )
            );

            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                $config['host'],
                $config['dbname'],
                $config['charset']
            );

            self::$instance = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                $config['options']
            );

            self::ensureSchema(self::$instance);
        }

        return self::$instance;
    }

    private static function ensureSchema(PDO $connection): void
    {
        $requiredTables = ['users', 'services', 'projects', 'houses', 'project_images', 'testimonials', 'contacts', 'site_settings'];
        $missingTables = [];

        foreach ($requiredTables as $table) {
            $stmt = $connection->query("SHOW TABLES LIKE '{$table}'");
            if ($stmt->rowCount() === 0) {
                $missingTables[] = $table;
            }
        }

        if (empty($missingTables)) {
            return;
        }

        $schemaPath = __DIR__ . '/../../database/schema.sql';
        if (!file_exists($schemaPath)) {
            return;
        }

        $sql = file_get_contents($schemaPath);
        $sql = preg_replace('/CREATE DATABASE IF NOT EXISTS.*?;/is', '', $sql);
        $sql = preg_replace('/USE .*?;/is', '', $sql);

        $statements = preg_split('/;\s*(?=(?:CREATE|INSERT|ALTER|DROP))/i', $sql);

        foreach ($statements as $statement) {
            $statement = trim($statement);
            if ($statement === '') {
                continue;
            }

            $connection->exec($statement . ';');
        }
    }
}
