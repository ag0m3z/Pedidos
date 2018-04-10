<?php

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Database
$container['db'] = function($c){
    $connectionString = $c->get('settings')['connectionString'];
    
    $pdo = new PDO($connectionString['dns'], $connectionString['user'], $connectionString['pass']);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    return new FluentPDO($pdo); 
};

// Modelos
$container['model'] = function($c){
    return (object)[
        'usuario' => new App\Model\UsuarioModel($c->db),
        'auth' => new App\Model\AuthModel($c->db),
        'sucursal'=>new App\Model\SucursalModel($c->db),
        'cliente'=>new App\Model\ClienteModel($c->db),
        'empresa'=>new App\Model\EmpresaModel($c->db),
        'mesa'=> new App\Model\MesaModel($c->db),
        'platillo'=> new App\Model\PlatilloModel($c->db)
    ];
};