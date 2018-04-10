<?php
// Routes

$app->get('/getVersion', function ($request, $response, $args) {
    // Render index view
    return $response->withHeader('Content-Type','application/json')
        ->write(json_encode(array('result'=>true,'message'=>'http://www.hockma.com/app/pedidos','data'=>['version'=>'18.3.2'])));
});
$app->get('/[{name}]', function ($request, $response, $args) {

    // Sample log message

    // Render index view
    return $response->withHeader('Content-Type','application/json')
        ->write(json_encode(array('result'=>true,'message'=>'Sistema de pedidos','data'=>[$args])));
});
    