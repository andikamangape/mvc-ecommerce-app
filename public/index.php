<?php
// Autoload semua class via Composer
require_once __DIR__ . '/../vendor/autoload.php';

// ===============================
//  Simple Router
//  URL format: index.php?url=controller/method/param
// ===============================

// Ambil parameter url, default ke 'customer/index'
$url = $_GET['url'] ?? 'customer/index';

// Pisahkan jadi bagian-bagian
$parts = explode('/', trim($url, '/'));

// Tentukan nama controller dan method
$controllerName = ucfirst(array_shift($parts)) . 'Controller';
$method         = array_shift($parts) ?? 'index';
$params         = $parts; // sisa array = parameter method

// Bentuk nama class lengkap dengan namespace
$controllerClass = "App\\Controllers\\{$controllerName}";

// Pastikan class controller ada
if (!class_exists($controllerClass)) {
    http_response_code(404);
    echo "Controller {$controllerClass} tidak ditemukan.";
    exit;
}

// Buat instance controller
$controller = new $controllerClass();

// Pastikan method di controller ada
if (!method_exists($controller, $method)) {
    http_response_code(404);
    echo "Method {$method} tidak ditemukan pada controller {$controllerName}.";
    exit;
}

// Panggil method dengan parameter (jika ada)
call_user_func_array([$controller, $method], $params);


// $route = $_GET['route'] ?? 'home';

// switch($route){
//     case 'customers/create':
//         (new App\Controllers\CustomerController())->create();
//         break;
// }
