<?php
$dangerousPatterns = [
    'eval(',
    'base64_decode(',
    'shell_exec(',
    'system(',
    'exec(',
    'passthru(',
    'proc_open(',
    'popen(',
    'assert(',
    'file_put_contents(',
    'preg_replace("/.*e.*"/',
    '@include',
];

$ignoreDirs = ['vendor', 'node_modules', 'bootstrap/cache'];
$results = [];

function scanDirectory($dir, $ignoreDirs, $patterns, &$results) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;

        $path = $dir . DIRECTORY_SEPARATOR . $file;

        // Skip ignored directories
        if (is_dir($path)) {
            if (!in_array($file, $ignoreDirs)) {
                scanDirectory($path, $ignoreDirs, $patterns, $results);
            }
        } else {
            $content = @file_get_contents($path);
            if ($content === false) continue;

            foreach ($patterns as $pattern) {
                if (stripos($content, $pattern) !== false) {
                    $results[] = "⚠️ Ditemukan pola '$pattern' di file: $path";
                }
            }
        }
    }
}

scanDirectory(__DIR__, $ignoreDirs, $dangerousPatterns, $results);

echo "\n=== HASIL PEMINDAIAN BACKDOOR ===\n";
if (empty($results)) {
    echo "✅ Tidak ditemukan kode mencurigakan.\n";
} else {
    foreach ($results as $line) {
        echo $line . "\n";
    }
}
echo "=== SELESAI ===\n";
