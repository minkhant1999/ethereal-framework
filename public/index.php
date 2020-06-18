<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('show_erros', 'On');

require __DIR__ . '/../vendor/autoload.php';

$app = new Ethereal\Foundation\Application(dirname(__DIR__));

$kernel = new App\Http\Kernel($app);

$app->bind('database', new PDO('mysql:host=localhost;port=3306;dbname=achievement crm', 'root', ''));

try {
    $response = $kernel->handle(
        $request = Ethereal\Http\Request::create()
    );
} catch (Exception $e) {
    http_response_code(404);

    echo file_get_contents($app->viewPath('errors/404.html'));

    return;
} catch (Error $error) {
    http_response_code(500);
    require app()->viewPath('errors/500.phtml');

    return;
}

$response->send();