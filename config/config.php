<?php


// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 1);
// ini_set('error_log', __DIR__ . '/../logs/error.log');

// error_reporting(E_ALL);
// ini_set('display_errors', 0);
// ini_set('log_errors', 1);
// ini_set('error_log', '/var/log/php-errors.log');

error_reporting(E_ALL);
// Enable display of errors temporarily for debugging (turn off in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// Ensure errors are also logged to a file inside the project for inspection
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/php_error.log');

function customErrorHandler($errno, $errstr, $errfile, $errline)
{
    $message = "Error: [$errno] $errstr - $errfile:$errline";
    error_log($message . PHP_EOL, 3, "error_log.txt");
}

set_error_handler("customErrorHandler");

// // or
// print_r("Error Reporting Function Active print");   // shows in readable format
// //exit;  // stop execution to see output



// Load .env variables
function loadEnv($path)
{
    if (!file_exists($path))
        return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0)
            continue;
        list($name, $value) = array_map('trim', explode('=', $line, 2));
        if (!getenv($name)) {
            putenv("$name=$value");
        }
    }
}
loadEnv(__DIR__ . '/../.env');

$db_host = getenv('DB_HOST') ?: 'localhost';
$db_port = getenv('DB_PORT') ?: '3306';
$db_name = getenv('DB_NAME') ?: '';
$user = getenv('DB_USER') ?: '';
$pass = getenv('DB_PASS') ?: '';
$dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name";

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection error: ' . $e->getMessage();
}


function clean($field)
{
    global $conn;
    $data = trim($field);
    $data = htmlentities($data);
    $data = strip_tags($data);


    return $data;
}

function formQuery($data)
{
    global $conn;
    var_dump("Connection", $conn);
    return $conn->query($data);
}

