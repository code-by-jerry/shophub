<?php
/**
 * Router for PHP built-in server
 * Allows accessing the app via both:
 *   http://localhost:8000/        (correct)
 *   http://localhost:8000/templates/ (legacy redirect)
 *
 * Start with: php -S localhost:8000 router.php
 */

$uri = $_SERVER['REQUEST_URI'];
$docRoot = __DIR__;

// Strip /templates prefix if present
if (strpos($uri, '/templates') === 0) {
    $newUri = substr($uri, strlen('/templates'));
    if ($newUri === '' || $newUri === '/') {
        $newUri = '/index.php';
    }
    // Redirect browser to correct URL
    header('Location: ' . $newUri, true, 301);
    exit;
}

// Map URI to file
$filePath = $docRoot . $uri;

// If it's a directory, append index.php
if (is_dir($filePath)) {
    $filePath = rtrim($filePath, '/') . '/index.php';
}

// Serve existing files
if (is_file($filePath)) {
    $_SERVER['SCRIPT_FILENAME'] = $filePath;
    $_SERVER['DOCUMENT_ROOT'] = $docRoot;
    return false;
}

// Fallback to index.php (SPA-style)
$fallback = $docRoot . '/index.php';
if (is_file($fallback)) {
    $_SERVER['REQUEST_URI'] = '/index.php';
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    $_SERVER['SCRIPT_FILENAME'] = $fallback;
    require $fallback;
    return true;
}

http_response_code(404);
echo "404 Not Found";
return true;