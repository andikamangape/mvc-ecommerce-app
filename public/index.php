<?php
require_once __DIR__ . '/../vendor/autoload.php';

// very-simple router berbasis query string: ?url=controller/method/param
$url = $_GET['url'] ?? 'customer/index';
$parts = explode('/', trim($url, '/'));

$controllerName = ucfirst(array_shift($parts)) . 'Controller';
$method = array_shift($parts) ?? 'index';
$params = $parts;

$controllerClass = "App\\Controllers\\{$controllerName}";

if (!class_exists($controllerClass)) {
    http_response_code(404);
    echo "Controller $controllerClass tidak ditemukan.";
    exit;
}

$controller = new $controllerClass();

if (!method_exists($controller, $method)) {
    http_response_code(404);
    echo "Method $method tidak ditemukan pada controller $controllerName.";
    exit;
}

// panggil method dengan parameter
call_user_func_array([$controller, $method], $params);
