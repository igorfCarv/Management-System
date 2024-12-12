<?php 
require __DIR__.'/../vendor/autoload.php';

use App\Utils\View;
use \WilliamCosta\DotEnv\Environment;
use \WilliamCosta\DatabaseManager\Database;

// Verificar se o .env está carregado corretamente
try {
    Environment::load(realpath(__DIR__.'/../../System Management'));
} catch (Exception $e) {
    echo "Erro ao carregar o arquivo .env: " . $e->getMessage();
}

// Carregar variáveis de ambiente manualmente, se necessário
$filePath = realpath(__DIR__.'/../../System Management/.env');
if (file_exists($filePath)) {
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        putenv($line);
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

// Carregar variáveis
$dbHost = $_ENV['DB_HOST'] ?? $_SERVER['DB_HOST'] ?? getenv('DB_HOST') ?? null;
$dbName = $_ENV['DB_NAME'] ?? $_SERVER['DB_NAME'] ?? getenv('DB_NAME') ?? null;
$dbUser = $_ENV['DB_USER'] ?? $_SERVER['DB_USER'] ?? getenv('DB_USER') ?? null;
$dbPass = $_ENV['DB_PASS'] ?? $_SERVER['DB_PASS'] ?? getenv('DB_PASS') ?? null;
$dbPort = $_ENV['DB_PORT'] ?? $_SERVER['DB_PORT'] ?? getenv('DB_PORT') ?? null;

// Configurar banco de dados
try {
    Database::config($dbHost, $dbName, $dbUser, $dbPass, $dbPort);
} catch (Exception $e) {
    echo "Erro ao configurar o banco de dados: " . $e->getMessage();
}

// Configurar URL
define('URL', $_ENV['URL'] ?? getenv('URL'));

// Iniciar View
View::init([
    'URL' => URL
]);
