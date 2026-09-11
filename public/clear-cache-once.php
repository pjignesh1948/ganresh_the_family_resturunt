<?php

/**
 * ONE-TIME cache clear for shared hosting (no SSH).
 * 1. Upload this file stays in public/
 * 2. Visit: https://ganeshtfr.com/clear-cache-once.php?key=CHANGE_ME_TO_RANDOM_STRING
 * 3. DELETE this file immediately after use.
 */

$secret = 'CHANGE_ME_TO_RANDOM_STRING';

if (($_GET['key'] ?? '') !== $secret) {
    http_response_code(403);
    exit('Forbidden. Set ?key= to match $secret in this file.');
}

$root = dirname(__DIR__);

function deleteMatchingFiles(string $dir, callable $match): int
{
    $count = 0;

    if (! is_dir($dir)) {
        return 0;
    }

    foreach (scandir($dir) ?: [] as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $path = $dir.DIRECTORY_SEPARATOR.$item;

        if (is_dir($path)) {
            $count += deleteMatchingFiles($path, $match);
            continue;
        }

        if ($match($path)) {
            @unlink($path);
            $count++;
        }
    }

    return $count;
}

$removed = 0;

$bootstrapCache = $root.'/bootstrap/cache';
foreach (['config.php', 'routes-v7.php', 'events.php', 'services.php', 'packages.php'] as $file) {
    $path = $bootstrapCache.'/'.$file;
    if (is_file($path) && @unlink($path)) {
        $removed++;
    }
}

$removed += deleteMatchingFiles($root.'/storage/framework/cache/data', fn ($p) => basename($p) !== '.gitignore');
$removed += deleteMatchingFiles($root.'/storage/framework/views', fn ($p) => basename($p) !== '.gitignore');

header('Content-Type: text/plain; charset=utf-8');
echo "Cache cleared. Removed {$removed} file(s).\n";
echo "Now DELETE public/clear-cache-once.php from your server.\n";
