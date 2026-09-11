<?php

/**
 * Export SQLite database to MySQL-compatible SQL.
 * Usage: php database/convert_sqlite_to_mysql.php
 */

$sqlitePath = __DIR__ . '/database.sqlite';
$outputPath = __DIR__ . '/ganesh_restaurant_mysql.sql';
$dbName = 'ganesh_restaurant';

if (! file_exists($sqlitePath)) {
    fwrite(STDERR, "SQLite file not found: {$sqlitePath}\n");
    exit(1);
}

$pdo = new PDO('sqlite:' . $sqlitePath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$skipTables = ['sqlite_sequence'];

$preferredOrder = [
    'migrations', 'users', 'password_reset_tokens', 'sessions', 'cache', 'cache_locks',
    'jobs', 'job_batches', 'failed_jobs', 'site_settings', 'pages', 'menu_categories',
    'menu_items', 'orders', 'order_items', 'vegetables', 'vegetable_price_logs', 'staff',
    'salary_transactions', 'gallery_categories', 'gallery_images', 'video_categories',
    'videos', 'portfolios', 'sops', 'contact_messages', 'order_activity_logs',
    'vegetable_sales', 'team_members', 'home_sliders', 'promotions', 'founders', 'customer_reviews',
];

$tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' ORDER BY name")
    ->fetchAll(PDO::FETCH_COLUMN);
$tables = array_values(array_filter($tables, fn ($t) => ! in_array($t, $skipTables, true)));
$tables = array_values(array_unique(array_merge(
    array_intersect($preferredOrder, $tables),
    array_diff($tables, $preferredOrder)
)));

function mysqlEscape(mixed $value): string
{
    if ($value === null) {
        return 'NULL';
    }

    if (is_int($value) || is_float($value)) {
        return (string) $value;
    }

    return "'".str_replace(["\\", "'", "\0", "\n", "\r"], ["\\\\", "\\'", '\\0', '\\n', '\\r'], (string) $value)."'";
}

function sqliteTypeToMysql(string $type, string $name, bool $pk, bool $notNull): string
{
    $type = strtolower($type);

    if ($pk && $name === 'id' && str_contains($type, 'int')) {
        return 'BIGINT UNSIGNED NOT NULL AUTO_INCREMENT';
    }

    return match (true) {
        str_contains($type, 'int') => ($notNull ? 'BIGINT UNSIGNED NOT NULL' : 'BIGINT UNSIGNED NULL'),
        $type === 'text' => ($notNull ? 'TEXT NOT NULL' : 'TEXT NULL'),
        str_contains($type, 'varchar') || str_contains($type, 'char') => ($notNull ? 'VARCHAR(255) NOT NULL' : 'VARCHAR(255) NULL'),
        str_contains($type, 'real') || str_contains($type, 'floa') || str_contains($type, 'doub') || str_contains($type, 'numeric') => ($notNull ? 'DECIMAL(12,2) NOT NULL' : 'DECIMAL(12,2) NULL'),
        str_contains($type, 'bool') || str_contains($type, 'tinyint') => ($notNull ? 'TINYINT(1) NOT NULL' : 'TINYINT(1) NULL'),
        str_contains($type, 'date') && ! str_contains($type, 'time') => ($notNull ? 'DATE NOT NULL' : 'DATE NULL'),
        str_contains($type, 'datetime') || str_contains($type, 'timestamp') => ($notNull ? 'DATETIME NOT NULL' : 'DATETIME NULL'),
        default => ($notNull ? 'VARCHAR(255) NOT NULL' : 'VARCHAR(255) NULL'),
    };
}

function buildCreateTable(PDO $pdo, string $table): string
{
    $columns = $pdo->query("PRAGMA table_info(`{$table}`)")->fetchAll(PDO::FETCH_ASSOC);
    $parts = [];
    $primaryKeys = [];

    foreach ($columns as $column) {
        $name = $column['name'];
        $mysqlType = sqliteTypeToMysql(
            (string) $column['type'],
            $name,
            (int) $column['pk'] === 1,
            (int) $column['notnull'] === 1
        );

        $definition = "`{$name}` {$mysqlType}";

        if ($column['dflt_value'] !== null) {
            $default = (string) $column['dflt_value'];
            $default = trim($default, "'");

            if (strtoupper($default) === 'CURRENT_TIMESTAMP') {
                $definition .= ' DEFAULT CURRENT_TIMESTAMP';
            } elseif (is_numeric($default)) {
                $definition .= " DEFAULT {$default}";
            } else {
                $definition .= " DEFAULT '".str_replace("'", "\\'", $default)."'";
            }
        }

        $parts[] = $definition;

        if ((int) $column['pk'] === 1) {
            $primaryKeys[] = "`{$name}`";
        }
    }

    if ($primaryKeys !== []) {
        $parts[] = 'PRIMARY KEY ('.implode(', ', $primaryKeys).')';
    }

    $indexes = $pdo->query("SELECT sql FROM sqlite_master WHERE type='index' AND tbl_name='{$table}' AND sql IS NOT NULL")->fetchAll(PDO::FETCH_COLUMN);
    $indexSql = [];

    foreach ($indexes as $index) {
        if (str_contains($index, 'sqlite_autoindex')) {
            continue;
        }

        $index = str_replace('"', '`', $index);
        $index = preg_replace('/\binteger\b/i', 'BIGINT UNSIGNED', $index);
        $indexSql[] = $index.';';
    }

    $create = 'CREATE TABLE IF NOT EXISTS `'.$table.'` ('.implode(', ', $parts).') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;';

    return $create."\n".implode("\n", $indexSql);
}

$out = [];
$out[] = '-- Ganesh The Family Restaurant — MySQL export';
$out[] = '-- Generated: '.date('Y-m-d H:i:s');
$out[] = 'SET NAMES utf8mb4;';
$out[] = 'SET FOREIGN_KEY_CHECKS=0;';
$out[] = "CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
$out[] = "USE `{$dbName}`;";
$out[] = '';

foreach ($tables as $table) {
    $out[] = "DROP TABLE IF EXISTS `{$table}`;";
    $out[] = buildCreateTable($pdo, $table);
    $out[] = '';
}

foreach ($tables as $table) {
    $columns = $pdo->query("PRAGMA table_info(`{$table}`)")->fetchAll(PDO::FETCH_ASSOC);
    $colNames = array_map(fn ($c) => $c['name'], $columns);
    $rows = $pdo->query("SELECT * FROM `{$table}`")->fetchAll(PDO::FETCH_ASSOC);

    if ($rows === []) {
        continue;
    }

    $out[] = "-- Data for table `{$table}`";
    $columnList = implode(', ', array_map(fn ($c) => "`{$c}`", $colNames));

    foreach ($rows as $row) {
        $values = implode(', ', array_map(fn ($col) => mysqlEscape($row[$col] ?? null), $colNames));
        $out[] = "INSERT INTO `{$table}` ({$columnList}) VALUES ({$values});";
    }

    $out[] = '';
}

$out[] = 'SET FOREIGN_KEY_CHECKS=1;';
$out[] = '';

file_put_contents($outputPath, implode("\n", $out));

echo "MySQL export written to: {$outputPath}\n";
echo 'Tables exported: '.count($tables)."\n";
